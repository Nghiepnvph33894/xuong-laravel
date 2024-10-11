<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Easy Shop - @yield('title', 'Home')</title>

    @include('auth.layout.partials.css')

</head>

<body class="bg-gradient-primary">

    <div class="container" style="max-width: 40%">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                @yield('content')
            </div>
        </div>

    </div>

    @include('auth.layout.partials.js')

</body>

</html>
