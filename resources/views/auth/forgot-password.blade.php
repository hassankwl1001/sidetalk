@extends('custom.layouts.guest')
@section('content')
{{--    @include('custom.inc.loading')--}}
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

@include("custom.inc.loading-infinite")

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

        <form id="signform" class="login__form"  action="{{ route('password.email') }}" method="post">
            @csrf
            <fieldset>
                <h2 class="fs-title">Forget Password</h2>
                <h3 class="fs-subtitle">Give your Registered Email</h3>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--email">Email</label>
                    <input id="email" value="{{ old('email') }}" type="email" placeholder="abx@xyz.com" name="email" required autocomplete="off">
                    <small style="color: red" id="emailvalidation"></small>
                </div>

                <div class="login__form_action_container login__form_action_container--multiple-actions">
                    <input type="submit" class="btn__primary--large from__button--floating" aria-label="Sign Up" value="Email Password Reset Link" />
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

                $(document).on("paste",'#email',function (){
                    document.getElementById('emailvalidation').innerHTML = '';
                });

                $(document).on('keypress keydown','#email',function () {

                    if(signform.email.value != "") {

                        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(signform.email.value)) {
                            document.getElementById('emailvalidation').innerHTML = ''
                            return
                        }
                        document.getElementById('emailvalidation').innerHTML = 'Please enter valid email address.'
                        // alert("You have entered an invalid email address!")
                        return
                    }
                })

                $(document).on("submit","#signform",function (e){
                    $("#loading-page1").show();
                });

            })

        </script>
    </main>

@endsection




