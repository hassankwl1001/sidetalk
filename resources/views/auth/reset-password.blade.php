@extends('custom.layouts.guest')
@section('content')

    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -28px;
            margin-right: 6px;
            position: relative;
            z-index: 2;
        }
    </style>
    <main class="signup__content">
        <div class="header__logo">
            <img src="{{asset('assets/img/skilled.png')}}" alt="logo">
        </div>
        <!-- <div class="header__content">
          <h1 class="header__content__heading">Sign Up</h1>
        </div> -->
        @if(Session::has('status'))
            <p class="alert alert-info">{{ Session::get('status') }}</p>
        @endif
        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="mb-4" style="color: red;">{{ $error }}</p>
            @endforeach
        @endif
        <form id="signform" class="login__form"  action="{{ route('password.update') }}" method="post">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <fieldset>
                <h2 class="fs-title">Reset Password</h2>
{{--                <h3 class="fs-subtitle">Give your Registered Email</h3>--}}
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--email">Email</label>
                    <input id="email" value="{{ $request->email}}" type="email" placeholder="abx@xyz.com" name="email" required>
                    <small style="color: red" id="emailvalidation"></small>
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--password">Password</label>

                    <input id="password-field"  type="password"  placeholder="******" name="password" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--password">Password Confirmation</label>

                    <input id="password-fields"  type="password"  placeholder="******" name="password_confirmation" required>
                    <span toggle="#password-fields" class="fa fa-fw fa-eye field-icon toggle-passwords"></span>
                </div>
                <div class="login__form_action_container login__form_action_container--multiple-actions">
                    <input type="submit" class="btn__primary--large from__button--floating" aria-label="Sign Up" value="Reset Password" />
                </div>

                <div class="footer-app-content-actions">


                    <div class="login__para">
                        <p>Please read our <a href="{{route('policy')}}">privacy policy</a> & <a href="{{route('terms')}}">terms of use</a> here</p>
                    </div>
                    <div class="Signin__class">
                        <p>Create account on <img src="{{asset('assets/img/skilled.png')}}" alt="">?<a href="{{ route('register') }}">Sign Up</a></p>
                    </div>
                </div>
            </fieldset>
        </form>
        <script>
            $(document).ready(function () {
                $(".toggle-password").click(function() {

                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
                $(".toggle-passwords").click(function() {

                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            })

        </script>
    </main>

@endsection





