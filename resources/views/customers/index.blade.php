@extends('master')

@section('title')
    Danh sách khách hàng
@endsection

@section('content')
    <h1>
        Danh sách khách hàng
        <a class="btn btn-primary" href="{{ route('customers.create') }}">CREATE</a>
    </h1>
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            <ul>
                {{ session()->get('error') }}
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

    <div class="table-responsive-sm">
        <table class="table table-info">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">AVATAR</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATED AT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $customer)
                    <tr class="">
                        <td scope="row">{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @if ($customer->avatar)
                                <img src="{{ Storage::url($customer->avatar) }}" alt="" width="100px">
                            @endif
                        </td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            @if ($customer->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('customers.edit', $customer) }}">EDIT</a>
                            <a class="btn btn-info" href="{{ route('customers.show', $customer) }}">SHOW</a>

                            <form action="{{ route('customers.destroy', $customer) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Có chắc chắn không?')"
                                    class="btn btn-danger">XM</button>
                            </form>

                            <form action="{{ route('customers.forceDestroy', $customer) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Có chắc chắn không?')"
                                    class="btn btn-dark">XC</button>
                            </form>

                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
