@extends('auth.layout.master')
@section('title')
    Đăng ký
@endsection
@section('content')

    <div class="p-3">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản mới!</h1>
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

        <form class="user" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="first_name" name="first_name"
                        placeholder="First Name" value="{{ old('first_name') }}">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="last_name" name="last_name"
                        placeholder="Last Name" value=" {{ old('last_name') }}">
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user" id="email" name="email"
                    placeholder="Email Address" value="{{ old('email') }}">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password"
                        placeholder="Password">
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password_confirmation"
                        name="password_confirmation" placeholder="Repeat Password">
                </div>
            </div>

            <button class="btn btn-primary btn-user btn-block" type="submit">Đăng ký</button>

            <hr>
            <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Register with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
            </a>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('forgot-password') }}">Quên mật khẩu?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Đã có tài khoản? Đăng nhập!</a>
        </div>
    </div>
@endsection
