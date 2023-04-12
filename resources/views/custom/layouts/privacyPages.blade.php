<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Skilledtalk - SignIn</title>
    <link rel="shortcut icon" type="image/png" href="{{ ('assets/img/favicon.ico') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ ('assets/css/style.css') }}" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ ('assets/js/jquery.inputmask.bundle.js') }}"></script>
    <script src="https://kit.fontawesome.com/3f24241a54.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
{{--    <script src="{{ ('assets/js/signupscript.js') }}"></script>--}}
</head>

<body style="overflow-y: scroll!important;">
<main @if(request()->routeIs('login')) class="signup__content" @endif>
    @yield('content')
    @include('custom.inc.guestFooter')
</main>

</body>
</html>
