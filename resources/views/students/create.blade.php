@extends('master')

@section('title')
    Thêm mới học sinh
@endsection

@section('content')
    <div class="container">
        <h2>Thêm Sinh Viên Mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-sm-6">
                    <!-- Lớp học -->
                    <div class="form-group">
                        <label for="classroom_id">Classroom:</label>
                        <select name="classroom_id" class="form-control">
                            @foreach ($classroom as $id => $name)
                                <option value="{{ $id }}">
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tên sinh viên -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <!-- Email sinh viên -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>


                </div>


                <div class="col-sm-6">
                    <!-- Số hộ chiếu -->
                    <div class="form-group">
                        <label for="passport_number">Passport number:</label>
                        <input type="text" name="passport_number" class="form-control"
                            value="{{ old('passport_number') }}">
                    </div>

                    <!-- Ngày cấp hộ chiếu -->
                    <div class="form-group">
                        <label for="issued_date">Issued date:</label>
                        <input type="date" name="issued_date" class="form-control" value="{{ old('issued_date') }}">
                    </div>

                    <!-- Ngày hết hạn hộ chiếu -->
                    <div class="form-group">
                        <label for="expiry_date">Expiry date:</label>
                        <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}">
                    </div>
                </div>
            </div>

            <!-- Môn học -->
            <div class="form-group">
                <label for="subjects">Subject:</label>
                <select name="subjects[]" class="form-control" multiple>
                    @foreach ($subject as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nút Submit -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
