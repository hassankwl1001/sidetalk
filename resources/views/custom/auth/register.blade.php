@extends('custom.layouts.guest')
@section('content')
    {!! RecaptchaV3::initJs() !!}
    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -28px;
            margin-right: 6px;
            position: relative;
            z-index: 2;
        }


        /**************************************************************************
            LOADING PAGE
        **************************************************************************/
        #loading-page1{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            z-index: 2;
        }
        .loading-page1 .loading-section1 {
            position: absolute;
            top: 50%;
            left: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translate(-50%, -50%);

        }

        .loading-page1 .loading-section1 .dot-loader {
            padding-left: 2px;
            width: 64px;
            height: 64px;

        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 64px;
        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div {
            position: absolute;
            top: 27px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #057642;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(1) {
            left: 6px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(2) {
            left: 6px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(3) {
            left: 26px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(4) {
            left: 45px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(19px, 0);
            }
        }
    </style>

    <div class="loading-page1" id="loading-page1" style="display: none;">
        <div class="loading-section1">
            <img src="{{asset('assets/img/skilled.png')}}" alt="" />
            <div class="dot-loader" id="dot-loader">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>



    <main class="signup__content">
        <div class="header__logo">
            <img src="{{asset('assets/img/skilled.png')}}" alt="logo">
        </div>


        <p class="m-3" id="alert-error" style="color: red; display: none;"></p>


        <!-- <div class="header__content">
          <h1 class="header__content__heading">Sign Up</h1>
        </div> -->
        <x-auth-validation-errors class="mb-4" style="color:red" :errors="$errors"/>
        <div class="progress mx-4">
            <div class="progress-bar bg-success" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        <form id="signform" class="login__form signup__page" action="{{ route('register') }}" method="post" autocomplete="off">
            @csrf
            <fieldset style="position: relative">
                <div class="pageNumber" style="position: absolute; font-size:12px">1 / 4</div>
                <a class="arrow" >Step 1</a>
                <h2 class="fs-title">SignUp Detail</h2>
                <h3 class="fs-subtitle">Give your login credentails</h3>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--email">Email</label>
                    <input required id="input--email" type="email" value="{{old('email')}}" placeholder="abx@xyz.com"
                           name="email" autocomplete="off">
                    <small style="color: red" id="emailvalidation"></small>

                </div>
                {{--        <div class="form__input--floating">--}}
                {{--          <label class="form__label--floating" id="label--password">Password (6 or more characters)</label>--}}
                {{--          <input id="input--password" type="password" placeholder="******" name="password">--}}
                {{--        </div>--}}
                {{--        <div class="form__input--floating">--}}
                {{--            <label class="form__label--floating" id="label--password">Confirm Password</label>--}}
                {{--            <input id="input--password--confirmation" type="password" placeholder="******" name="password_confirmation">--}}
                {{--          </div>--}}
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--password">Password</label>

                    <input id="password-field" type="password" placeholder="******" name="password" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--password">Password Confirmation</label>

                    <input id="password-fields" type="password" placeholder="******" name="password_confirmation"
                           required>
                    <span toggle="#password-fields" class="fa fa-fw fa-eye field-icon toggle-passwords"></span>
                    <small style="color: red" id="passwordvalidation"></small>
                </div>
               <div class="row">
                   <div class="md-col-12 w-100">
                       <div class="login__form_action_container login__form_action_container--multiple-actions">
                           <input type="button" id="registerNext"
                                  class="continue_button btn__primary--large from__button--floating" aria-label="Sign Up"
                                  value="Join"/>
                       </div>
                   </div>
               </div>
                <div class="login__form_action_container text-center">
                    <p>or</p>
                </div>
                {{--        <div class="login__form_action_container login__form_action_container--multiple-actions">--}}
                {{--          <button class="btn__secondary--large from__button--floating" aria-label="Join Google"><img src="assets/img/google-icon.png" alt="google-icon" />Join with Google</button>--}}
                {{--        </div>--}}
                <div class="footer-app-content-actions">
                    <div class="login__para">
                        <p>Please read our <a href="{{route('policy')}}">privacy policy</a> & <a
                                href="{{route('terms')}}">terms of use</a> here</p>
                    </div>
                    <div class="Signin__class">
                        <p>Already on <img src="assets/img/skilled.png" alt="">?<a href="{{ route('login') }}">Sign
                                in</a></p>
                    </div>
                </div>
            </fieldset>
            <fieldset style="position: relative">
                <div class="pageNumber" style="position: absolute; font-size:12px">2 / 4</div>
                <a class="arrow" >Step 2</a>
               
                <h2 class="fs-title">Personal Detail</h2>
                <h3 class="fs-subtitle">Tell us something more about you</h3>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--first-name">First Name</label>
                    <input id="input--first-name" type="text" value="{{old('firstname')}}" placeholder="abc"
                           name="firstname">
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--last-name">Last Name</label>
                    <input id="input--last-name" type="text" placeholder="xyz" value="{{old('lastname')}}"
                           name="lastname">
                    {{--          <span class="error">Please enter your last name</span>--}}
                </div>
                <div class="row">
                    <div class="md-col-6 w-100 p-1">
                        <div class="login__form_action_container login__form_action_container--multiple-actions">
                            <input type="button" name=""
                                   class="continue_button btn__primary--large from__button--floating"
                                   aria-label="Sign Up" value="Continue"/>
                        </div>
                    </div>
                    
                </div>

            </fieldset>
            <fieldset style="position: relative">
                <div class="pageNumber" style="position: absolute; font-size:12px">3 / 4</div>
                <a class="arrow" >Step 3</a>
               
                <h2 class="fs-title">Your Location</h2>
                <h3 class="fs-subtitle">Desired location for your network</h3>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--country">Country/Region <span>*</span></label>
{{--                    <input id="input--country" type="text" placeholder="Pakistan" value="{{old('country')}}"--}}
{{--                           name="country">--}}
{{--                    --}}

                    <select required name="country" id="input--country" >
                        <option value="" disabled selected>Select Country</option>
                        @foreach($countries as $key=>$value )
                            <option value="{{$value}}">{{$key}}</option>
                        @endforeach
                    </select>


                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--city">City/District <span>*</span></label>
{{--                    <input id="input--city" type="text" placeholder="Lahore" value="{{old('city')}}" name="city">--}}

                    <select required name="city" id="input--city">

                    </select>

                </div>
                <div class="row">
                    <div class="md-col-6 w-100 p-1">
                        <div class="login__form_action_container login__form_action_container--multiple-actions">
                            <input type="button" name=""
                                   class="continue_button btn__primary--large from__button--floating"
                                   aria-label="Sign Up" value="Continue"/>
                        </div>
                    </div>
                    
                </div>


            </fieldset>
            <fieldset style="position: relative" id="last-element">
                <div class="pageNumber" style="position: absolute; font-size:12px">4 / 4</div>
                <a class="arrow" >Step 4</a>
               
                <h2 class="fs-title">Professional experience</h2>
                <h3 class="fs-subtitle">Recent job employment type</h3>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--job">Industry Type <span>*</span></label>
                    <div >
                        <div >
                            <select name="industry_type_id" id="input--employment" required>
                                <option value="">Select Your Industry</option>
                                    @if($industryTypes)
                                        @foreach($industryTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--job">Most recent job title <span>*</span></label>
                    <select class="" id="input--job"  name="job_type_id" required>
                        <option disabled selected>Select Most Recent Job Title</option>
                            @if($jobTypes)
                                @foreach($jobTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                     @endif               
                    </select>
                </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--company">Most recent company <span>*</span></label>
                    <select class="" id="input--company"  name="company_id" required>
                        <option disabled selected>Select Most Recent Company</option>
                            @if($company)
                                @foreach($company as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                     @endif               
                    </select>
                </div>
                {{-- <div class="form__input--floating">
                    <label class="form__label--floating" id="label--company">Most recent company <span>*</span></label>
                    <input id="input--company" type="text" placeholder="" value="{{old('recent_company')}}"
                           name="recent_company" required>
                </div> --}}
                <div class="form__input--floating">
                    <label class="form__label--floating" id="label--company">Keep your company name on profile</span></label>
                    <div class="custom-control custom-radio">
                    <input type="radio" checked name="show_company_name" class="custom-control-input" id="show_company_name" value="1">
                    <label class="custom-control-label" for="show_company_name">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" name="show_company_name" class="custom-control-input" id="not_show_company_name" value="0">
                    <label class="custom-control-label" for="not_show_company_name">No</label>
                    </div>
                </div>
               
                <div>
                    {{-- <button class="btn__secondary--large from__button--floating">I'm a student</button> --}}
                    <input type="checkbox" id="vehicle1" name="is_student" value="1">
                    <label for="vehicle1">I am Fresher</label>
                </div>
                        {!! RecaptchaV3::field('register') !!}
                <div class="row">
                    <div class="md-col-6 w-100 p-1">
                        <div class=" login__form_action_container login__form_action_container--multiple-actions">
                            <input type="submit" class="btn__primary--large from__button--floating"
                                   value="Sign up"/>
                        </div>
                    </div>
                   
                </div>

            </fieldset>

        </form>





    </main>



    <script>
        $(document).ready(function () {

            $(document).on("paste",function (){
                document.getElementById('emailvalidation').innerHTML = '';
            });

            $("#input--email").focusout(function(){
                let email = $(this).val();
                let f = new FormData();
                f.append("_token",$("input[name='_token']").val());
                _ajax("{{url('check-email')}}/"+email, f, function(resp){
                    if (resp.resp=="error"){
                        $("#emailvalidation").text(resp.msg);
                    }else{
                        $("#emailvalidation").text("");
                    }
                });
            });


            $(document).on('keyup', '#input--email', function () {

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

            $(".toggle-password").click(function () {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
            $(".toggle-passwords").click(function () {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        })

        // $("#registerNext").on('click',function (e){
        //
        //     e.preventDefault();
        //     var password = $("#password-field").val();
        //     var confirm_password = $("#password-fields").val();
        //
        //     // console.log($(this));
        //
        //     if(password != confirm_password){
        //         $(this).removeClass("continue_button");
        //         alert("password and confirm password does not matched!");
        //         return;
        //     }else{
        //         $(this).addClass("continue_button");
        //     }
        //
        // });


        $("#input--country").on("change",function () {
            var code = $(this).val();
            // alert(code);

            if(code != ""){
                $.ajax({
                    method:"GET",
                    url:"{{url('getRealtedCities')}}"+"/"+code,
                    success:function (data) {
                        // console.log(data);
                        $("#input--city").empty();
                        data.cities.forEach(function (city){
                            $('<option>').val(city).text(city).appendTo('#input--city');
                        });

                    }
                });
            }


        });




    </script>
@endsection
