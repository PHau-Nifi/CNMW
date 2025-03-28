<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;
use App\Mail\VerifyAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập email hoặc số điện thoại!',
                'password.required' => 'Vui lòng nhập mật khẩu!'
            ]
        );
        $email = Auth::attempt(['email' => $request['username'], 'password' => $request['password']]);
        $phone = Auth::attempt(['phone' => $request['username'], 'password' => $request['password']]);

        if ($email || $phone) {
            if($request->has('rememberme')){
                session(['username_web'=>$request->username]);
                session(['password_web'=>$request->password]);
            }else{
                session()->forget('username_web');
                session()->forget('password_web');
            }
            return redirect()->intended('/')->with('success','Chào mừng bạn '.Auth::user()->fullname.' !');
        } else {
            return redirect($request->url)->with('warning','Sai tài khoản hoặc mật khẩu');
        }
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:1',
            'email' => 'required|max:255|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12|unique:users',
            'agreement' => 'required',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'repassword' => 'required|same:password',
        ], [
            'fullname.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone.regex'=>'Vui lòng nhập nhập lại số điện thoại (10 số)',
            'password.regex'=>'Mật khẩu phải có ít nhất 1 chữ hoa,1 chữ thường,1 số và độ dài tối thiểu 6 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu',
            'repassword.same' => "Mật khẩu nhập lại không trùng khớp",
            'agreement.required' => "Vui lòng đồng ý với điều khoản",
        ]);
        $user = new User([
            'fullname'=>$request['fullname'],
            'password'=>bcrypt($request['password']),
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'code'=>rand(1000000000000000, 9999999999999999),
            'level_id' => '1',
        ]);
        $token = Str::random(20);
        $user->setRememberToken($token);
        $user->save();
        if($request->type == 'staff'){
            return redirect()->route('verify_email', [
                'user_id' => $user->id,
                'token' => $token,
                'type' => 'staff'
            ])->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
        }
        return redirect()->route('verify_email', [
            'user_id' => $user->id,
            'token' => $token,
            'type' => 'user'
        ])->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.');
        return redirect('/login')->with('success','Đăng ký thành công!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success','Đăng xuất thành công');
    }

    public function verify_email(Request $request){
        $info = Info::find(1);
        $user = User::find($request->user_id);
        $to_email =  $user->email;
        $token = $request->token;
        $link_verify = url('/handle_verify-email?email='.$to_email.'&token='.$token);
        if(isset($to_email)){
            Mail::send('email.verify_account', [
                'account' => $user,
                'to_email' => $to_email,
                'info' => $info,
                'link_verify'=>$link_verify,
            ], function ($email) use ($to_email) {
                $email->subject('Kích hoạt tài khoản: '.$to_email);
                $email->to($to_email);
            });

            if($request->type == 'staff')
            {
                return redirect('/admin/addUser')->with('success', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản !')->with('user', $user);
            }
            return redirect('/login')->with('success', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản !');
        }else{
            if($request->type == 'staff')
            {
                return redirect('/admin/addUser')->with('success', 'Đăng ký thành công tài khoản !')->with('user', $user);
            }
            return redirect('/login')->with('success', 'Đăng ký thành công tài khoản !');
        }
    }

    public function handle_verify_email(Request $request){
        $email = $request->get('email');
        $token = $request->get('token');
        
        $user = User::where('email', '=', $email)->where('remember_token', '=', $token)->first();
    
        if ($user) {
            if ($user->email_verified == 1) {
                return redirect('/')->with('info', 'Email đã được xác minh từ trước.');
            }
            $user->email_verified = 1;
            $user->remember_token = Str::random(20);
            $user->save();
    
            if (Auth::check()) {
                $name = Auth::user()->fullname;
                return redirect('/profile')->with('success', 'Kích hoạt email cho tài khoản ' . $name . ' thành công!');
            }
            return redirect('/login')->with('success', 'Kích hoạt email thành công');
        } else {
            return redirect('/login')->with('warning', 'Vui lòng thử lại vì đường dẫn không hợp lệ hoặc hết hạn');
        }
    }
    
}
