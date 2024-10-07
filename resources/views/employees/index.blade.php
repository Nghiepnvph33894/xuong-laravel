@extends('master')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    <h1>
        Danh sách nhân viên
        <a class="btn btn-primary" href="{{ route('employees.create') }}">CREATE</a>
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
                    <th scope="col">FIRST NAME</th>
                    <th scope="col">lAST NAME</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">AVATAR</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">DATE OF BIRTH</th>
                    <th scope="col">HIRE DATE</th>
                    <th scope="col">SALARY</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">DEPARTMENT</th>
                    <th scope="col">MANAGER</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATED AT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="data:image/jpeg;base64,{{ base64_encode($employee->profile_picture) }}"
                                    alt="Profile Picture" width="100px">
                            @endif
                        </td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employee->department->name }}</td>
                        <td>{{ $employee->manager->name }}</td>

                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">EDIT</a>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">SHOW</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Có chắc chắn không?')"
                                    class="btn btn-danger">XOÁ</button>
                            </form>

                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
