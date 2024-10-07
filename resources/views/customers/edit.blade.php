@extends('master')

@section('title')
    Cập nhật: {{ $customer->name }}
@endsection
@section('content')
    <h1>Cập nhật: {{ $customer->name }}</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            <ul>
                {{ session()->get('error') }}
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            <ul>
                Thao tác thành công
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ $customer->address }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ $customer->phone }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{ $customer->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">is_active</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox" @checked($customer->is_active) value="1"
                        name="is_active" id="is_active">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="avatar" class="col-4 col-form-label">avatar</label>
                <div class="col-8">
                    <input type="file" class="form-controlavatar" name="avatar" id="avatar">
                    @if ($customer->avatar)
                        <img src="{{ Storage::url($customer->avatar) }}" alt="" width="100px">
                    @endif
                </div>

            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
