<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\Verify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function dashboard() {}
    public function showRegisterForm()
    {
        return view('auth.register2');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
        ]);

        if ($user = User::create($data)) {
            Auth::login($user);

            Mail::to($user->email)->send(new Verify($user));

            return redirect('/')->with('success', 'Đăng ký thành công');
        }

        return redirect()->back()
            ->withErrors(['error' => 'Đăng ký thất bại, vui lòng thử lại.']);
    }
    public function verify($email)
    {
        User::where('email', $email)
            ->whereNull('email_verified_at')
            ->firstOrFail();

        User::where('email', $email)
            ->update(['email_verified_at' => now()]);

        return view('auth.login2');
    }

    public function showLoginForm()
    {
        return view('auth.login2');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Đăng nhập thành công');
        }

        return back()
            ->with('error', 'Thông tin đăng nhập không khớp với dữ liệu của chúng tôi')
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email|exists:users,email']);

            $user = User::where('email', $request->email)->firstOrFail();

            $token = Str::random(40);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => now()
                ]
            );

            // Tạo URL đặt lại mật khẩu
            $resetUrl = route('reset-password', ['token' => $token, 'email' => $request->email]);

            Mail::to($request->email)->send(new ForgotPassword($user, $resetUrl));

            return back()->with('success', 'Liên kết đặt lại mật khẩu đã được gửi!');
            //code...
        } catch (\Throwable $th) {
            return back()->with('error', 'Liên kết đặt lại mật khẩu gửi thất bại!');
        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view(
            'auth.reset-password',
            [
                'token' => $token,
                'email' => $request->email
            ]
        );
    }
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed',
                'token' => 'required'
            ]);

            $passwordReset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$passwordReset) {
                return back()->withErrors(['token' => 'Invalid or expired token.']);
            }

            $user = User::where('email', $request->email)->firstOrFail();

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công!');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Đổi mật khẩu thất bại!');
        }
    }
}
