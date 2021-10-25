<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginOTP;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);
        $data = array('usuario' => $request->usuario,
            'password' => $request->password,
        );

        $result = $this->login_verify($data);

        if ($result == 'email' || $result == 'password') {
            return back()->withErrors(['usuario' => trans('auth.failed')])->withInput(request(['usuario']));
        } else {
            $request->session()->put($result);
            // return redirect('/verify');
            return view('auth.loginverify');
        }

        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password, 'condicion' => 1])) {
            return redirect('/home');
        }

        return back()->withErrors(['usuario' => trans('auth.failed')])->withInput(request(['usuario']));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

    }
    protected function login_verify($data = '')
    {
        $users = DB::table('users')->where('usuario', $data['usuario'])->first();

        if (!empty($users)) {
            if (Hash::check($data['password'], $users->password)) {
                $key = Str::random(6);
                $key_expire = date("Y-m-d H:i:s", strtotime("+15 minutes"));
                DB::table('users')->where('email', $users->email)->update(['forget_key' => $key, 'expire_forget_key' => $key_expire]);
                // send mail here
                Mail::to($users->email)->send(new LoginOTP($key));
                $session_array = array(
                    'forget_email' => $users->email,
                    'pswd' => $data['password'],
                    'user_roll' => $users->idrol,
                );
                return $session_array;
            } else {
                return 'password';
            }
        } else {
            return 'email';
        }
    }
    public function forget_key_verify(Request $request)
    {
        $request->validate(['key' => 'required']);
        $email = $request->session()->get('forget_email');
        $where = array(
            'email' => $email,
            'forget_key' => $request->input('key'),
        );

        $aaaa = date("Y-m-d H:i:s");
        $user_info = DB::table('users')->where($where)->first();
        if (!empty($user_info)) {
            if (strtotime($user_info->expire_forget_key) < strtotime(date("Y-m-d H:i:s"))) {
                return view('auth.loginverify')->withErrors(['key' => trans('Your key is expired')])->withInput(request(['key']));
            } else if (Auth::attempt(['usuario' => $user_info->usuario, 'password' => session('pswd'), 'condicion' => 1])) {
                return redirect('/home');
            }
        } else {
            return view('auth.loginverify')->withErrors(['key' => trans('Wrong key')])->withInput(request(['key']));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}
