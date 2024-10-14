@extends('auth.layout.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <!-- Nested Row within Card Body -->
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Easy Shop!</h1>
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
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="user" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user" id="email"
                    aria-describedby="emailHelp" placeholder="Enter Email Address..." required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" id="password"
                    placeholder="Password" required>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
            </button>

            <hr>
            <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
            </a>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('forgot-password') }}">Quên mật khẩu?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('register') }}">Tạo tài khoản!</a>
        </div>
    </div>
@endsection
