@extends('auth.layout.master')
@section('title')
    Đặt lại mật khẩu
@endsection
@section('content')
    <div class="p-3">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Đặt lại mật khẩu!</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="user" action="{{ route('reset-password.post') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <input type="password" class="form-control form-control-user" id="password" name="password"
                    placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" id="password_confirmation"
                    name="password_confirmation" placeholder="Repeat Password">
            </div>

            <button class="btn btn-primary btn-user btn-block" type="submit">Xác nhận</button>

        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('register') }}">Tạo tài khoản!</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Đã có tài khoản? Đăng nhập!</a>
        </div>
    </div>
@endsection
