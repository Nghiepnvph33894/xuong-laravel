@extends('master')

@section('title')
    chi tiết STUDENT
@endsection

@section('content')
    <h1> chi tiết STUDENT {{ $student->name }}</h1>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Tên trường</th>
                    <th scope="col">Giá trị</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($student->toArray()); --}}
                @foreach ($student->toArray() as $key => $value)
                    <tr>
                        <td scope="row">{{ strtoupper($key) }}</td>
                        <td>
                            @php
                                switch ($key) {

                                    case 'classroom':
                                        if ($value) {
                                            echo $student->classroom->name;
                                        }
                                        break;

                                    case 'passport':
                                        if ($value) {
                                            echo $student->passport->passport_number;
                                        }
                                        break;

                                    case 'subjects':
                                        if ($value) {
                                            foreach ($student->subjects as $key => $subject) {
                                                echo $subject->name . ', ';
                                            }
                                        }
                                        break;

                                    default:
                                        if (!is_array($value)) {
                                            echo $value; // In ra các giá trị khác không phải là mảng
                                        }
                                        break;
                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
