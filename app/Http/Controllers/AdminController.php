<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\TicketCombo;
use App\Models\Info;
use App\Models\User;
use App\Models\Movie;
use App\Models\Staff;
use App\Models\Role;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $info = Info::find(1);
        view()->share('info', $info);
    }

    public function sign_in()
    {
        return view('admin.web.sign_in');
    }

    public function Post_sign_in(Request $request){
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập email quản lý hoặc nhân viên',
                'password.required' => 'Vui lòng nhập mật khẩu!'
            ]
        );
        $email = Auth::guard('staff')->attempt(['email' => $request['username'], 'password' => $request['password']]);
    
        if (Auth::guard('staff')->attempt(['email' => $request['username'], 'password' => $request['password']])) {
                return redirect('/admin')->with('success','Đăng nhập tài khoản admin thành công');
        } else {
            return redirect('/admin')->with('warning','Sai tài khoản hoặc mật khẩu');
        }
    }

    public function sign_out(){
        auth('staff')->logout();
        return redirect('/admin')->with('success','Đăng xuất thành công');
    }

    public function home()    {
        if(auth('staff')->user()->hasRole('Staff')){
            return redirect('/admin/buyTicket');
        }
        $info = Info::find(1);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();
        $start_of_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        $total_year = Ticket::whereBetween('created_at', [$year, $now])->orderBy('created_at', 'ASC')->get();
        $theaters = Theater::orderBy('id', 'ASC')->get();
        $ticket = Ticket::whereDate('created_at', Carbon::today())->get();
        $ticket_seat = TicketSeat::get()->whereBetween('created_at', [$year, $now])->count();
        $user = User::all();
        $movies = Movie::all();
        foreach ($theaters as $theater) {
            $total_seat = 0;
            $total_price = 0;
            foreach ($theater['rooms'] as $theater_room) {
                foreach ($theater_room['schedules'] as $theater_schedule) {
                    foreach ($theater_schedule['Ticket'] as $theater_ticket) {
                        if($theater_ticket->status == 1){
                            $total_seat += $theater_ticket['ticketseats']->count();
                            $total_price += $theater_ticket['totalPrice'];
                        }
                    }
                }
            }
            $theater->setAttribute('totalPrice', $total_price);
            $theater->setAttribute('ticketseats', $total_seat);
        }
        
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
        
        $sum = 0;
        $sum_today = 0;
        //total of month
        foreach ($total_year as $value) {
            $sum += $value['totalPrice'];
        }
        //total today
        foreach ($ticket as $today) {
            if($today->status == 1){
                $sum_today += $today['totalPrice'];
            }

        }
        return view('admin.web.Home.home', [
            'user' => $user,
            'ticket' => $ticket,
            'sum' => $sum,
            'sum_today' => $sum_today,
            'now' => $now,
            'start_of_month' => $start_of_month,
            'ticket_seat' => $ticket_seat,
            'year' => $year,
            'theaters' => $theaters,
            'movies' => $movies
        ]);
    }

    public function filter_by_date(Request $request)
    {
        $start_time = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $end_time = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay(); // lấy ngày cuối cùng
        

        $get = Ticket::whereBetween('created_at', [$start_time, $end_time])->orderBy('created_at', 'ASC')->get();
        $value_first = $get->first();
        $value_last = $get->last();

        $date_current = date("d-m-Y", strtotime($value_first['created_at']));

        $total = 0;
        $seat_count = 0;
        $chart_data = [];

        foreach ($get as $value) {
            if ($date_current == date("d-m-Y", strtotime($value['created_at']))) {
                $total += $value['totalPrice'];
                $seat_count += $value['ticketSeats']->count();
            } else {
                $data = array(
                    'date' =>  $date_current,
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                $date_current = date("d-m-Y", strtotime($value['created_at']));
                $total = $value['totalPrice'];
                $seat_count = $value['ticketSeats']->count();
                array_push($chart_data, $data);
            }
            if ($value_last->id == $value['id']) {
                $data = array(
                    'date' => date("d-m-Y", strtotime($value['created_at'])),
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                array_push($chart_data, $data);
            }
        }
        return response()->json([
            'success' => 'Thành công',
            'chart_data' => $chart_data
        ]);
    }

    public function statistical_filter(Request $request)
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $week = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();
        $this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $start_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();

        if ($request['statistical_value'] == 'week') {
            $get = Ticket::whereBetween('created_at', [$week, $now])->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'year') {
            $get = Ticket::whereBetween('created_at', [$year, $now])->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'this_month') {
            $get = Ticket::whereBetween('created_at', [$this_month, $now])->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'last_month') {
            $get = Ticket::whereBetween('created_at', [$start_last_month, $end_last_month])->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        function date_statistical($option, $date)
        {
            if ($option == 'year') {
                return date("m-Y", strtotime($date));
            } else {
                return date("d-m-Y", strtotime($date));
            }
        }
        $total = 0;
        $seat_count = 0;
        $chart_data = [];

        foreach ($get as $value) {
            if ($date_current == date_statistical($request['statistical_value'], $value['created_at'])) {
                $total += $value['totalPrice'];
                $seat_count += $value['ticketSeats']->count();
            } else {
                $data = array(
                    'date' =>  $date_current,
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                $date_current = date_statistical($request['statistical_value'], $value['created_at']);
                $total = $value['totalPrice'];
                $seat_count = $value['ticketSeats']->count();
                array_push($chart_data, $data);
            }
            if ($value_last->id == $value['id']) {
                $data = array(
                    'date' => date_statistical($request['statistical_value'], $value['created_at']),
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                array_push($chart_data, $data);
            }
        }

        return response()->json([
            'success' => 'Thành công',
            'get' => $get,
            'chart_data' => $chart_data,
        ]);
    }

    public function statistical_sortby(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();

        $get = Ticket::whereBetween('created_at', [$year, $now])->orderBy('created_at', 'ASC')->get();
        $value_first = $get->first();
        $value_last = $get->last();
        $date_current = date("m-Y", strtotime($value_first['created_at']));

        $seat_count = 0;
        $theaters = Theater::all();
        foreach ($theaters as $theater) {
            $total[$theater->id] = 0;
        }
        $chart_data = [];
        if ($request['statistical_value'] == 'ticket') {
            foreach ($get as $value) {
                if ($date_current == date("m-Y", strtotime($value['created_at']))) {
                    $seat_count += $value['ticketSeats']->count();
                } else {
                    $data = array(
                        'date' =>  $date_current,
                        'seat_count' => $seat_count
                    );
                    $date_current = date("m-Y", strtotime($value['created_at']));
                    $seat_count = $value['ticketSeats']->count();
                    array_push($chart_data, $data);
                }
                if ($value_last->id == $value['id']) {
                    $data = array(
                        'date' => date("m-Y", strtotime($value['created_at'])),
                        'seat_count' => $seat_count
                    );
                    array_push($chart_data, $data);
                }
            }
        }
        if ($request['statistical_value'] == 'theater') {
            foreach ($get as $value) {
                if ($date_current == date("m-Y", strtotime($value['created_at']))) {
                    if ($value->schedule_id != null) {
                        $total[$value->schedule->room->theater_id] += $value['totalPrice'];
                    }
                } else {
                    $data = array(
                        'date' =>  $date_current,
                    );
                    foreach ($theaters as $theater) {

                        $data[$theater->id] = $total[$theater->id];
                        //                        dd($data);
                    }
                    $date_current = date("m-Y", strtotime($value['created_at']));
                    foreach ($theaters as $theater) {
                        if ($value->schedule_id != null && $value->schedule->room->theater_id == $theater->id) {
                            $total[$theater->id] = $value['totalPrice'];
                        } else {
                            $total[$theater->id] = 0;
                        }
                    }
                    array_push($chart_data, $data);
                }
                if ($value_last->id == $value['id']) {
                    $data = array(
                        'date' =>  $date_current,
                    );
                    foreach ($theaters as $theater) {
                        $data[$theater->id] = $total[$theater->id];
                        //                        dd($data);
                    }
                }
            }
        }
        //        if($request['statistical_value'] == 'genre'){
        //
        //        }
        return response()->json([
            'success' => 'Thành công',
            'chart_data' => $chart_data,
        ]);
    }
    
    public function info()
    {
        $info = Info::find(1);
        return view('admin.web.Info.index', [
            'info' => $info
        ]);
    }
    public function postInfo(Request $request)
    {
        $info = Info::find(1);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/info')->with('warning', 'Không hỗ trợ ' . $format);
            }
            if ($info->logo != '') {
                unlink('images/web/' . $info->logo);
            }
            $file->move('images/web/', "logo.png");
            $request['logo'] =  "logo.png";
        }

        $info->update($request->all());

        return redirect('admin/info')->with('success', 'Thành công');
    }

    public function staff()
    {
        $staff = Staff::orderBy('id', 'DESC')->paginate(10);
        $theaters = Theater::all();
        $role = Role::all();
        
        return view('admin.web.Staffs.index', [
            'staff' => $staff,
            'theaters' => $theaters,
            'role' => $role
        ]);
    }

    public function postCreateStaff(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:1',
            'email' => 'required|unique:staffs',
            'phone' => 'required|unique:staffs',
            'password' => 'required',
        ], [
            'fullname.required' => 'fullname is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'phone.unique' => 'Phone already exists'
        ]);
        $request['password'] = bcrypt($request['password']);
        $staff = new Staff([
            'fullname' => $request['fullname'],
            'password' => $request['password'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role_id' => '3',
            'code' => rand(10000000000, 9999999999999999),
            'theater_id' => $request['theater_id'],
        ]);
        $staff->save();
        if ($staff) {
            return redirect('/admin/staff')->with('success', 'Tạo tài khoản thành công!');
        }
        else{
            return redirect('/admin/staff')->with('fail', 'Tạo tài khoản không thành công!');
        }
    }

    public function editCreateStaff(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->fullname = $request->fullname;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->theater_id = $request->theater_id;
        $staff->role_id = $request->role_id;
        $staff->save();
        return redirect('/admin/staff')->with('success', 'Cập nhật thành công!!!');    
    }

    public function user()
    {
        $users = User::orderBy('id', 'DESC')->paginate(20);
        return view('admin.web.users.index', ['users' => $users]);
    }
    public function searchUser(Request $request)
    {
        $output = '';
        if ($request->search == null) {
            $users = User::orderBy('id', 'DESC')->Paginate(50);
        } else {
            $users = User::where('code', 'LIKE', '%' . $request->search . '%')->orWhere('email', 'LIKE', '%' . $request->search . '%')->get();
        }

        return Response($output);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->status(200);
    }
}
