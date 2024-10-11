@extends('master')

@section('title')
    Danh sách học sinh
@endsection

@section('content')
    <h1>
        Danh sách học sinh
        <a href="{{ route('students.create') }}" class="btn btn-primary">CREATE</a>
    </h1>

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            <h5>
                Thao tác thành công
            </h5>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Classroom</th>
                    <th>Passport Number</th>
                    <th>Issued Date</th>
                    <th>Expiry Date</th>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $student)
                    <tr class="">
                        <td scope="row">{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->passport->passport_number }}</td>
                        <td>{{ $student->passport->issued_date }}</td>
                        <td>{{ $student->passport->expiry_date }}</td>
                        <td>
                            @foreach ($student->subjects as $subject)
                                <span class="badge bg-info">{{ $subject->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm mb-1" href="{{ route('students.edit', $student) }}">EDIT</a>
                            <a class="btn btn-warning btn-sm mb-1" href="{{ route('students.show', $student) }}">SHOW</a>
                            <form action="{{ route('students.destroy', $student) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('Có chắc chắn không?')"
                                    class="btn btn-danger btn-sm">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
