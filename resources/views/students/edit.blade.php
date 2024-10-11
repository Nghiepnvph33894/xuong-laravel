@extends('master')

@section('title')
    Cập nhật thông tin học sinh
@endsection

@section('content')
    <div class="container">
        <h2>Cập Nhật Thông Tin Sinh Viên</h2>

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
                <h5>
                    Thao tác thành công
                </h5>
            </div>
        @endif
        @if (session()->has('success') && !session()->get('success'))
            <div class="alert alert-danger">
                <h5>
                    Thao tác thất bại
                </h5>
            </div>
        @endif

        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-sm-6">
                    <!-- Lớp học -->
                    <div class="form-group">
                        <label for="classroom_id">Classroom:</label>
                        <select name="classroom_id" class="form-control">
                            @foreach ($classroom as $id => $name)
                                <option value="{{ $id }}" {{ $student->classroom_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tên sinh viên -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}">
                    </div>

                    <!-- Email sinh viên -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $student->email) }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- Số hộ chiếu -->
                    <div class="form-group">
                        <label for="passport_number">Passport number:</label>
                        <input type="text" name="passport_number" class="form-control"
                            value="{{ old('passport_number', $student->passport->passport_number ?? '') }}">
                    </div>

                    <!-- Ngày cấp hộ chiếu -->
                    <div class="form-group">
                        <label for="issued_date">Issued date:</label>
                        <input type="date" name="issued_date" class="form-control"
                            value="{{ old('issued_date', $student->passport->issued_date ?? '') }}">
                    </div>

                    <!-- Ngày hết hạn hộ chiếu -->
                    <div class="form-group">
                        <label for="expiry_date">Expiry date:</label>
                        <input type="date" name="expiry_date" class="form-control"
                            value="{{ old('expiry_date', $student->passport->expiry_date ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Môn học -->
            <div class="form-group">
                <label for="subjects">Subjects:</label>
                <select name="subjects[]" class="form-control" multiple>
                    @foreach ($subject as $id => $name)
                        <option value="{{ $id }}"
                            {{ in_array($id, old('subjects', $student->subjects->pluck('id')->toArray())) ? 'selected' : '' }}>
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
