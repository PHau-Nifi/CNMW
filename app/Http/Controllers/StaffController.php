<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
use App\Models\Movie;
use App\Models\Price;
use App\Models\Seat;
use App\Models\RoomType;
use App\Models\Schedule;
use App\Models\SeatType;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\TicketCombo;
use App\Models\TicketFood;
use App\Models\User;
use App\Models\Discount;
use Carbon\Carbon;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class StaffController extends Controller
{


    
    public function addUser(){
        return view('admin.web.addUser.index');
    }

    function __construct(){
        $cloud_name = cloud_name();
        view()->share('cloud_name',$cloud_name);
    }

    public function buyTicket(Request $request) {
        $cur = Carbon::now('Asia/Ho_Chi_Minh');
        $theater = auth('staff')->user()->theater;
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
        }
        $time_cur = Carbon::now('Asia/Ho_Chi_Minh')->toTimeString();
        $roomTypes = RoomType::all();
        $movies = Movie::whereDate('releaseDate', '<=', Carbon::today()->format('Y-m-d'))
            ->where('endDate', '>', Carbon::today()->format('Y-m-d'))
            ->get();
        $moviesEarly = Movie::all()->filter(function ($movie) {
            foreach ($movie->schedules as $schedule) {
                if ($schedule->status && $movie->releaseDate > date('Y-m-d')) {
                    return $movie;
                }
            }
            return null;
        });
        return view('admin.web.buyTicket.index', [
            'movies' => $movies,
            'moviesEarly' => $moviesEarly,
            'theater' => $theater,
            'date_cur' => $date_cur,
            'time_cur' => $time_cur,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function ticket($schedule_id, Request $request) {
        $seatTypes = SeatType::all();
        $combos = Combo::where('status', 1)->get();
        $tickets = Ticket::where('schedule_id', $schedule_id)->get();
        $schedule = Schedule::find($schedule_id);
        $dayOfWeek = strtolower(date('l', strtotime($schedule->date)));
        $day = in_array($dayOfWeek, ['saturday', 'sunday']) ? 'weekend' : 'weekday';
        if ($request->customerType == 'nl'){
            if (strtotime($schedule->startTime) < strtotime('17:00')) {
                $price = Price::where('generation', 'nl')
                    ->where('day', $day)
                    ->where('after', '08:00')->get()->first()->price;
            } else {
                $price = Price::where('generation', 'nl')
                    ->where('day', $day)
                    ->where('after', '17:00')->get()->first()->price;
            }
        }

        if ($request->customerType == 'nctte'){
            if (strtotime($schedule->startTime) < strtotime('17:00')) {
                $price = Price::where('generation', 'nctte')
                    ->where('day', $day)
                    ->where('after', '08:00')->get()->first()->price;
            } else {
                $price = Price::where('generation', 'nctte')
                    ->where('day', $day)
                    ->where('after', '17:00')->get()->first()->price;
            }
        }

        if ($request->customerType == 'hssv'){
            if (strtotime($schedule->startTime) < strtotime('17:00')) {
                $price = Price::where('generation', 'hssv')
                    ->where('day', $day)
                    ->where('after', '08:00')->get()->first()->price;
            } else {
                $price = Price::where('generation', 'hssv')
                    ->where('day', $day)
                    ->where('after', '17:00')->get()->first()->price;
            }
        }
        
        $roomSurcharge = $schedule->room->roomType->surcharge;
        $room = $schedule->room;
        $movie = $schedule->movie;

        return view('admin.web.buyTicket.ticket', [
            'schedule' => $schedule,
            'room' => $room,
            'seatTypes' => $seatTypes,
            'roomSurcharge' => $roomSurcharge,
            'price' => $price,
            'movie' => $movie,
            'tickets' => $tickets,
            'combos' => $combos,
        ]);
    }

    public function scanBarcode(Request $request) {
        $user = User::where('code', $request->code)->get()->first();
        if (!$user) {
            return response('user not found', 500);
        }
        return response()->json([
            'username' => $user->fullName,
            'userPoint' => $user->point,
            'userId' => $user->code,
        ]);
    }



    public function createTicket (Request $request)
    {
        $ticket_old = Ticket::where('schedule_id', $request->schedule_id )->get();
        if($ticket_old->isNotEmpty()){
            foreach($ticket_old as $i => $ticket){
                foreach($ticket->ticketSeats as $seat_old){
                    foreach ($request->ticketSeats as $i => $seat) {
                        $seatArray = json_decode($seat, true);
                        foreach ($seatArray as $seatId => $seats){
                            $seat_id = $seats[0];
                            if($seat_old->seat_id == $seat_id){
                                return redirect('admin/buyTicket/ticket/' . $request->schedule_id)->with('warning','Ghế bạn chọn đã đặt vui lòng chọn ghế khác!');
                            }
                        }
                    }
                }
            }
        }
        $ticket = new Ticket([
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'code'=>rand(1000000000000000, 9999999999999999),
            'payment' => $request->ticketPayment,
            'totalPrice' => $request->totalPrice,
            'hadScan' => '1',
        ]);
        if($request->discount_id){
            $ticket->discount_id = $request->discount_id;
            $discount = Discount::find($request->discount_id);
            $discount->quantity --;
            $discount->save();
        }
        $ticket->save();
        if ($request->ticketSeats) {
            foreach ($request->ticketSeats as $i => $seat) {
                $seatArray = json_decode($seat, true);
                foreach ($seatArray as $seatId => $seats) {
                    $seat_id = $seats[0];
                    $seatPrice = $seats[1];
                    $roomId = new Schedule;
                    $ticketSeat = new TicketSeat([
                        'seat_id' => $seat_id,
                        'price' => $seatPrice,
                        'ticket_id' => $ticket->id,
                    ]);
                    $seats = Seat::where('id', $seat_id)->first();
                    $ticketSeat->seatType = $seats->seatType->name;
                    $ticketSeat->save();
                }
            }
        }

        if($request->ticketCombos){
            foreach ($request->ticketCombos as $combo) {
                $comboArray = json_decode($combo, true);
                $comboId = key($comboArray);
                $comboId = key($comboArray);
                foreach ($comboArray as $comboId => $combos){
                    $combo_id = $combos[0];
                    $quantity = $combos[1];
                }
                if ($combo_id !== null) {
                    $ticketcombo = new TicketCombo([
                        'combo_id' => $combo_id,
                        'quantity' => $quantity,
                        'ticket_id' => $ticket->id,
                    ]);
                    $ticketcombo->save();
                }
            }
        }

        if($request->ticketPayment === 'QR'){
            return redirect('/admin/buyTicket/paymentQR/' . $ticket->id);
        }
        if($request->ticketPayment === 'MONEY'){
            return view('admin.web.buyTicket.payMoney', [
                'ticket' => $ticket
            ]);
        }
    }

    public function paymentQR($ticket_id){
        $ticket = Ticket::find($ticket_id);
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }


        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua QR MoMo";
        $amount = $ticket->totalPrice;
        $orderId = $ticket->code;
        $redirectUrl = "http://127.0.0.1:8000/admin/buyTicket/fail?ticket_id={$ticket_id}";
        $ipnUrl = "http://127.0.0.1:8000/admin/buyTicket/Success?ticket_id={$ticket_id}";
        $extraData = "";
        $autoCapture =FALSE;

            $requestId = time() . "";
            $requestType = "captureWallet";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId  . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            // decode json
            //Just a example, please check more in there
            return redirect($jsonResult['payUrl']);
    }
    
    public function Hadpaid(Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        if($ticket->user_id){
            $user = User::find($ticket->user_id);
            $total = 0;
            if($ticket->discount_id){
                $per = 100 - $ticket->discount->percent;
                $money = $ticket['totalPrice'] / ($per / 100); 
            }
            if($money < 1000000){
                $point = $money * 5 / 100;
            }else{
                $point = $money * 10 / 100;
            }
            $user->point += $point;
            dd($user->point);
            $user->save();
        }
        if ($ticket) {
            $ticket->hasPaid = '1';
            $ticket->save(); 
        }
        return redirect('admin/buyTicket')->with('success', 'Thanh toán thành công!');
    }

    public function handleResult(Request $request)
    {
        if ($request->type == 'ticket') {
            $ticket = Ticket::find($request->ticket_id);
            $ticket->hasPaid = '1';
            if($ticket->user_id){
                $user = User::find($ticket->user_id);
                $total = 0;
                if($ticket->discount_id){
                    $per = 100 - $ticket->discount->percent;
                    $money = $ticket['totalPrice'] / ($per / 100); 
                }
                else {
                    $money = $ticket['totalPrice'];
                }
                if($money < 500000){
                    $point = $money * 5 / 100;
                }else{
                    $point = $money * 10 / 100;
                }
                $user->point += $point;
                $user->save();
            }
            $ticket->save();
            return redirect('admin/buyTicket')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect('admin/buyCombo')->with('success', 'Thanh toán thành công!');
        }
        return redirect('admin/buyTicket')->with('fail', 'Thanh toán thất bại!');
    }

    public function delete($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect('admin/buyTicket')->with('fail', 'Thanh toán thất bại!');
    }

    public function scanTicket() {
        return view('admin.web.scanTicket.index');
    }

    public function buyCombo(Request $request) {
        $combos = Combo::where('status', 1)->get();
        $foods = Food::where('status', 1)->get();
        return view('admin.web.buyCombo.index', [
            'combos' => $combos,
            'foods' => $foods,
        ]);
    }

    public function checkTicket(Request $request){
        $ticket = Ticket::where('code', $request->code)->first();
        return redirect('admin/staff/scanTicket')->with('ticket', $ticket);
    }

    public function confirmTicket(Request $request){
        $ticket = Ticket::where('code', $request->code)->first();
        if(!$ticket){
            return redirect('admin/staff/scanTicket')->with('fail', 'Vé lỗi!')->with('ticket', $ticket);
        }
        elseif($ticket->status == '0'){
            return redirect('admin/staff/scanTicket')->with('warning', 'Vé đã được hoàn tiền!')->with('ticket', $ticket);
        }
        elseif($ticket->hadScan == '1'){
            return redirect('admin/staff/scanTicket')->with('warning', 'Vé đã được sử dụng!')->with('ticket', $ticket);
        }

        else{
            $ticket->hadScan = '1';
            $ticket->save();
            return redirect('admin/staff/scanTicket')->with('success', 'Xác nhận vé thành công!');
        }
    }

    public function checkUser(Request $request){
        $userCode = $request->input('userCode');
        $user = User::where('code', $userCode)
            ->orWhere('phone', $userCode)
            ->first();
        if ($user) {
            return response()->json(['success' => true, 'user' => $user]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function checkDiscount(Request $request){
        $discountcode = $request->input('discount');
        $discount = Discount::where('code', $discountcode)->first();
        if ($discount) {
            if($discount->quantity > 0 ){
                return response()->json(['success' => true, 'discount' => $discount]);
            }
            else{
                return response()->json(['success' => false, 'discount' => $discount]);
            }
            
        } else {
            return response()->json(['fail' => false]);
        }
    }
}
