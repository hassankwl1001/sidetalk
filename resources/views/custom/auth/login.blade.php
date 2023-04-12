
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
      <img src="{{('assets/img/skilled.png')}}" alt="logo">
    </div>
    <!-- <div class="header__content">
      <h1 class="header__content__heading">Sign Up</h1>
    </div> -->
    <x-auth-validation-errors class="mb-4" style="color:red" :errors="$errors" />


    @if (Session::has('error'))
        <div style="color:red" class="mb-3">
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                <li>{{ Session::get('error') }}</li>
                @php
                    session()->pull('error');
                @endphp
            </ul>
        </div>
    @endif



    <form id="signform" class="login__form" action="{{ route('login') }}" method="post" autocomplete="off">
      @csrf
      <fieldset>
        <h2 class="fs-title">SignIn Detail</h2>
        <h3 class="fs-subtitle">Give your login credentails</h3>
        <div class="form__input--floating">
          <label class="form__label--floating" id="label--email">Email</label>
          <input id="email" value="{{ old('email') }}" type="email" placeholder="abx@xyz.com" name="email" autocomplete="off" required>
            <small style="color: red" id="emailvalidation"></small>
        </div>
        <div class="form__input--floating">
          <label class="form__label--floating" id="label--password">Password</label>

          <input id="password-field"  type="password"  placeholder="******" name="password" required>
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
{{--            <i class="far fa-eye" id="toggle-password" style="    float: right; margin-left: -25px;margin-right: 6px;margin-top: 14px; position: relative; z-index: 2;"></i>--}}
        </div>


        <div class="login__form_action_container login__form_action_container--multiple-actions">
          <input type="submit" class=" btn__primary--large from__button--floating" aria-label="Sign Up" value="Login" />
        </div>
        <div class="login__form_action_container text-center">
          <p>or</p>
        </div>
        <div class="login__form_action_container login__form_action_container--multiple-actions">
          <a  href="{{route('login.google')}}" class="btn__secondary--large from__button--floating" aria-label="Join Google" style="margin-bottom: 0px;"><img src="{{('assets/img/google-icon.png')}}" alt="google-icon" />Continue with Google</a>
        </div>
        <div class="login__form_action_container login__form_action_container--multiple-actions">
          <a  href="{{route('login.facebook')}}" class="btn__secondary--large from__button--floating" aria-label="Join Facebook"><img src="{{('assets/img/facebook-icon.png')}}" alt="facebook-icon" style="width:20px;"/>Continue with Facebook</a>
        </div>
        <div class="footer-app-content-actions">
          @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                  {{ __('Forgot your password?') }}
              </a>
          @endif

          <div class="login__para">
            <p>Please read our <a href="{{route('policy')}}">privacy policy</a> & <a href="{{route('terms')}}">terms of use</a> here</p>
          </div>
          <div class="Signin__class">
              <p>Create account on <img src="{{('assets/img/skilled.png')}}" alt="">?<a href="{{ route('register') }}">Sign Up</a></p>
          </div>
        </div>
      </fieldset>
    </form>

</main>
    <script>
        $(document).ready(function () {

            $(document).on("paste",'#email',function (){
                document.getElementById('emailvalidation').innerHTML = '';
            });

            $(document).on('keyup','#email',function () {

                if(signform.email.value != ""){
                    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(signform.email.value))
                    {
                        document.getElementById('emailvalidation').innerHTML=''
                        return
                    }
                    document.getElementById('emailvalidation').innerHTML='Please enter valid email address.'
                    // alert("You have entered an invalid email address!")
                    return
                }


            })
            $(".toggle-password").click(function() {

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
@endsection
