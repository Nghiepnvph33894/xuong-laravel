@extends('auth.layout.master')
@section('title')
    Quên mật khẩu
@endsection
@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu?</h1>
            <p class="mb-4">Chúng tôi hiểu, mọi chuyện đều có thể xảy ra. Chỉ cần nhập địa chỉ email của bạn bên dưới
                và chúng tôi sẽ gửi cho bạn liên kết để đặt lại mật khẩu!</p>
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

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="user" action="{{ route('forgot-password') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                    aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Đặt lại mật khẩu
            </button>
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
