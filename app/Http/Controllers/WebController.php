<?php

namespace App\Http\Controllers;
use App\Models\Info;
use App\Models\User;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Banner;
use App\Models\Schedule;
use App\Models\RoomType;
use App\Models\SeatType;
use App\Models\Combo;
use App\Models\Ticket;
use App\Models\Discount;
use App\Models\Seat;
use App\Models\Price;
use App\Models\TicketSeat;
use App\Models\TicketCombo;
use App\Models\MovieGenre;
use App\Models\Rating;
use App\Models\News;

use Illuminate\Support\Carbon;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\NeuralNetwork\ActivationFunction\Sigmoid;
use Phpml\NeuralNetwork\MLP;
use Phpml\Classification\KNearestNeighbors;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




class WebController extends Controller
{
    public function __construct()
    {
        User::where('point', '>', 100000)->update(['level_id' => 2]);
        User::where('point', '>', 200000)->update(['level_id' => 3]);
        User::where('point', '>', 500000)->update(['level_id' => 4]);
        $cities = [];
        $theaters = Theater::where('status', 1)->get();
        foreach ($theaters as $theater) {
            if (in_array($theater->city, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->city);
            }
        }
        $info = Info::find(1);
        $cloud_name = cloud_name();
        view()->share('cloud_name',$cloud_name);
        view()->share('info', $info);
        view()->share('cities', $cities);
    }

    public function profile(){
        $user = Auth::user();
        $sum = 0;
        foreach ($user['ticket'] as $ticket) {
            $sum += $ticket['totalPrice'];
        }
        $tickets= $user->ticket->sortDesc();
        $sort_ticket = $user->ticket()->orderBy('id', 'DESC')->paginate(3);
        return view('web.profile', ['sort_ticket' => $sort_ticket, 'user' => $user, 'sum' => $sum, '$sum' => $sum, 'tickets' => $tickets]);
    }

    public function admin(){
        return view('admin.web.home');
    }

    public function home(){
        $movies = Movie::where('status', 1)->get();
        $banners = Banner::where('status', 1)->get();
        foreach ($movies as $movie) {
            $total_seat = 0;
            $total_price = 0;
            foreach ($movie['schedules'] as $movie_schedule) {
                foreach ($movie_schedule['Ticket'] as $movie_ticket) {
                    $total_seat += $movie_ticket['ticketseats']->count();
                    $total_price += $movie_ticket['totalPrice'];
                }
            }
            $movie->setAttribute('totalPrice', $total_price);
            $movie->setAttribute('ticketseats', $total_seat);
        }
        $movies = $movies->sortByDesc('totalPrice');
        return view('web.home', [
            'movies' => $movies,
            'banners' => $banners
        ]);
    }

    public function movieDetails($id, Request $request)
    {
        $movie = Movie::find($id);
        $roomTypes = RoomType::all();
        $cities = [];
        $theaters = Theater::where('status', 1)->get();
        foreach ($theaters as $theater) {
            if (in_array($theater->city, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->city);
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ cho múi giờ của Việt Nam
        $current_time = date('H:i');
        

        return view('web.movieDetails', [
            'current_time' => $current_time,
            'movie' => $movie,
            'cities' => $cities,
            'roomTypes' => $roomTypes,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
        ]);
    }

    public function news(){
        $news = News::orderBy('id', 'DESC')->Paginate(5);
        return view('web.news', ['news' => $news]);
    }

    public function news_detail($id)
    {
        $news = News::find($id);
        $news_all = News::where('status', 1)->where('id', "!=", $id)->take(4)->get();
        return view('web.news_detail', ['news' => $news, 'news_all' => $news_all]);
    }

    public function contact(){
        return view('web.contact');
    }

    public function login(){
        return view('web.auth.login');
    }

    public function register(){
        return view('web.auth.register');
    }

    public function movies(){
        $movies = Movie::all();
        $genres = MovieGenre::all();
        $rating = Rating::all();
        return view('web.movies', 
        [
            'movies' => $movies, 
            'genres' => $genres,
            'rating' => $rating,
        ]);
    }


    public function theater(){
        $movies = Movie::all();
        $roomTypes = RoomType::all();
        $cities = [];
        $theaters = Theater::where('status', 1)->get();
        foreach ($theaters as $theater) {
            if (in_array($theater->city, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->city);
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('H:i');
        return view('web.theater',[
            'current_time' => $current_time,
            'movies' => $movies,
            'cities' => $cities,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
        ]);
    }

    public function test(Request $request ){
        dd($request->all());
    }

    public function ticket($schedule_id){
        if(Auth::check()){
            $seatTypes = SeatType::all();
            $combos = Combo::where('status', 1)->get();
            $tickets = Ticket::where('schedule_id', $schedule_id)->get();
            $schedule = Schedule::find($schedule_id);
            $discounts = Auth::user()->level->discount;
            $dayOfWeek = strtolower(date('l', strtotime($schedule->date)));
            $day = in_array($dayOfWeek, ['saturday', 'sunday']) ? 'weekend' : 'weekday';
    
            if (strtotime($schedule->startTime) < strtotime('17:00')) {
                $price = Price::where('generation', 'vtt')
                    ->where('day', $day)
                    ->where('after', '08:00')->get()->first()->price;
            } else {
                $price = Price::where('generation', 'vtt')
                    ->where('day', $day)
                    ->where('after', '17:00')->get()->first()->price;
            }
            $roomSurcharge = $schedule->room->roomType->surcharge;
            $room = $schedule->room;
            $movie = $schedule->movie;
            return view('web.ticket',[
                'schedule' => $schedule,
                'room' => $room,
                'seatTypes' => $seatTypes,
                'roomSurcharge' => $roomSurcharge,
                'price' => $price,
                'movie' => $movie,
                'tickets' => $tickets,
                'combos' => $combos,
                'discounts' => $discounts,
            ]);
        }
        else {
            return redirect()->guest('/login')->with('warning', 'Yêu cầu đăng nhập');
        }
    }

    public function createTicket (Request $request)
    {
        $ticket_old = Ticket::where('schedule_id', $request->schedule_id )->where('status', '!=', 0)->get();
        if($ticket_old->isNotEmpty()){
            foreach($ticket_old as $i => $ticket){
                foreach($ticket->ticketSeats as $seat_old){
                    foreach ($request->ticketSeats as $i => $seat) {
                        $seatArray = json_decode($seat, true);
                        foreach ($seatArray as $seatId => $seats){
                            $seat_id = $seats[0];
                            if($seat_old->seat_id == $seat_id){
                                return redirect('/ticket/' . $request->schedule_id)->with('warning','Ghế bạn chọn đã đặt vui lòng chọn ghế khác!');
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
        ]);
        if($request->discount_id){
            $ticket->discount_id = $request->discount_id;
            $discount = Discount::find($request->discount_id);
            $discount->quantity --;
            $discount->save();
        }
        $ticket->save();
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

        foreach ($request->ticketCombos as $combo) {
            $comboArray = json_decode($combo, true);
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
        if($request->ticketPayment === 'QR'){
            return redirect('/paymentQR/' . $ticket->id);
        }
        if($request->ticketPayment === 'ATM'){
            return redirect('/paymentATM/' . $ticket->id);
        }
    }

    public function ticketPaid($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->hasPaid = 1;
        $ticket->save();
        $ticketCombo = TicketCombo::where('ticket_id',$ticket_id)->get();
        $ticketSeat = TicketSeat::where('ticket_id',$ticket_id)->get();
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
        
        return view('web.ticketPaid',[
            'ticket' => $ticket,
            'ticketCombo' => $ticketCombo,
            'ticketSeat' => $ticketSeat,
            'user' => $user,
        ]);
    }

    // Thanh toán momo

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
        $redirectUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $ipnUrl = "http://127.0.0.1:8000/fail".$ticket_id;
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
            $jsonResult = json_decode($result, true);  // decode json
            return redirect($jsonResult['payUrl']);
    }

    public function verifyTransaction($momoTransId, $ticket_id)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/confirm"; // Đường dẫn xác thực
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        
        $requestId = time() . "";
        $requestType = "capture"; // Hoặc "refund" nếu bạn muốn hoàn tiền
        
        // Chuẩn bị hash cho signature
        $rawHash = "accessKey={$accessKey}&amount={$amount}&orderId={$orderId}&partnerCode={$partnerCode}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'momoTransId' => $momoTransId,
            'signature' => $signature,
        );

        // Gửi yêu cầu xác thực
        $result = execPostRequest($endpoint, json_encode($data));
        return json_decode($result, true); // Trả về kết quả
    }



    public function paymentATM($ticket_id){
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
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $ticket->totalPrice;
        $orderId = $ticket->code;
        $redirectUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $ipnUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $extraData = "";
        

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
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
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect($jsonResult['payUrl']);
    }

    public function search(Request $request)
    {
        $request->validate(
            [
                'search' => 'required|min:3',
            ],
            [
                'search.required' => 'Nhập tìm kiếm',
            ]
        );
        $result = new Collection();
        $genres = MovieGenre::all();
        $rating = Rating::all();
        $movies = Movie::select('movies.*')
            ->join('MovieGenres_movies', 'movies.id', '=', 'MovieGenres_movies.movie_id')
            ->join('movie_genres', 'MovieGenres_movies.movieGenre_id', '=', 'movie_genres.id')
            ->where('movies.status', '=', '1')
            ->where('movie_genres.name', 'like', '%' . $request->search . '%')
            ->orWhere('movies.name', 'like', '%' . $request->search . '%')->get();
        foreach ($movies as $movie) {
            if (!$result->contains('id', $movie->id)) {
                $result->push($movie);
            }
        }
        return view('web.search', [
            'result' => $result,
            'search' => $request->search,
            'genres' => $genres, 
            'rating' => $rating, 
        ]);
    }

    public function movieFilter(Request $request){
        $result1 = new Collection();
        $result2 = new Collection();
        $search = '';
        $genres = MovieGenre::all();
        $rating = Rating::all();
        if (isset($request->movieGenres) &&$request->movieGenres[0]!=null) {
            foreach ($request->movieGenres as $value) {
                $movies = Movie::select('movies.*')
                    ->join('MovieGenres_movies', 'movies.id', '=', 'MovieGenres_movies.movie_id')
                    ->join('movie_genres', 'MovieGenres_movies.movieGenre_id', '=', 'movie_genres.id')
                    ->where('movies.status', '=', '1')
                    ->where('movie_genres.id', '=', $value)->get();
                
                foreach ($movies as $movie) {
                    if (!$result1->contains('id', $movie->id)) {
                        $result1->push($movie);
                    }
                }
                $MovieGenres = new Collection();
                $genre = MovieGenre::find($value);
                $MovieGenres->push($genre);
            }
        }else{
            $MovieGenres = NULL;
        }
        
        if ($request->rating){
            $rate = Rating::find($request->rating);
            $movies = Movie::where('rating_id', $request->rating)->get();
            
            foreach ($movies as $movie) {
                if (!$result2->contains('id', $movie->id)) {
                    $result2->push($movie);
                }
            }
        }else{
            $rate = NULL;
        }
    
        if($result1->isNotEmpty() && $result2->isNotEmpty()) {
            $result = $result1->intersect($result2);
        } elseif($result1->isNotEmpty() && $result2->isEmpty()) {
            $result = $result1;
        } elseif($result1->isEmpty() && $result2->isNotEmpty()) {
            $result = $result2;
        } else {
            $result = new Collection(); 
        }
        return view('web.search', [
            'result' => $result, 
            'rate' => $rate,
            'search' => $search,
            'movieGenres' => $MovieGenres, 
            'genres' => $genres, 
            'rating' => $rating, 
        ]);
    }

    public function refund_ticket(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $user = User::find($ticket['user_id']);
        $money = 0;
        if ($ticket->status ==0){
            return response()->json(['error' => 'Vé đã được hoàn!']);
        }
        if ($ticket['schedule']['date'] == date("Y-m-d")) {
            if (strtotime($ticket['schedule']['startTime']) - 3600 <= strtotime(date("H:i:s"))) {

                return response()->json(['error' => 'Đã quá thời gian hoàn vé mong quý khách thông cảm !']);
            }
        }
        if ($ticket['schedule']['date'] < date("Y-m-d")) {
            return response()->json(['error' => 'Đã quá thời gian hoàn vé mong quý khách thông cảm !']);
        }
        if ($ticket['Discount'] != NULL) {
            return response()->json(['error' => 'Vé đã áp dụng mã khuyến mãi nên không thể hoàn lại. Mong quý khách thông cảm !']);
        }
        if($ticket->discount_id){
            $per = 100 - $ticket->discount->percent;
            $money = $ticket['totalPrice'] / ($per / 100); 
        }
        else{
            $money = $ticket['totalPrice'];
        }
        if($money < 500000){
            $point = $money * 5 / 100;
        }else{
            $point = $money * 10 / 100;
        }
        $user->point -= $point;
        $user->save();
        $ticket->status = 0;
        $ticket->save();
        return response()->json(['success' => 'Gửi yêu cầu thành công,vé sẽ được hoàn vào điểm thưởng vui lòng kiểm tra điểm thưởng trong profile !']);
    }

    public function ticketPaid_image(Request $request)
    {
        $name = Auth::user()->fullName;
        echo $request->image;
        $cloud = Cloudinary::upload($request->image, [
            'folder' => 'ticket_user',
            'format' => 'png',
        ])->getPublicId();

        $email_cur = Auth::user()->email;
        

        if (isset(Auth::user()->email) && Auth::user()->email_verified == true) {
            Mail::send('email.ticket', [
                'name' => $name,
                'cloud' => $cloud,
                'cloud_name' => cloud_name(),
            ], function ($email) use ($email_cur) {
                $email->subject('Vé xem phim tại HCinema');
                $email->to($email_cur);
            });
        }
        return response();
    }

    public function checkDiscount(Request $request)
{
    $discountcode = $request->input('discount');
    $discount = Discount::where('code', $discountcode)->first();
    $userId = Auth::id();

    $usedToday = Ticket::where('user_id', $userId)
        ->whereDate('created_at', Carbon::today())
        ->where('discount_id', $discount->id ?? null) 
        ->exists();

    if ($discount) {
        if ($usedToday) {
            return response()->json(['warning' => true, 'discount' => $discount]);
        }

        if ($discount->quantity > 0) {
            return response()->json(['success' => true, 'discount' => $discount]);
        } else {
            return response()->json(['success' => false, 'discount' => $discount]);
        }
    } else {
        return response()->json(['fail' => true]);
    }
}

}
