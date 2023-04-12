{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <div class="mb-4 text-sm text-gray-600">--}}
{{--            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}--}}
{{--        </div>--}}

{{--        @if (session('status') == 'verification-link-sent')--}}
{{--            <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--                {{ __('A new verification link has been sent to the email address you provided during registration.') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="mt-4 flex items-center justify-between">--}}
{{--            <form method="POST" action="{{ route('verification.send') }}">--}}
{{--                @csrf--}}

{{--                <div>--}}
{{--                    <x-button>--}}
{{--                        {{ __('Resend Verification Email') }}--}}
{{--                    </x-button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}

{{--                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}













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
{{--        @if(Session::has('status'))--}}
{{--            <p class="alert alert-info">{{ Session::get('status') }}</p>--}}
{{--        @endif--}}
{{--        @if(count($errors) > 0)--}}
{{--            <p class="alert alert-danger">{{ $errors}}</p>--}}
{{--        @endif--}}

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 alert alert-info">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif




{{--        <div class="mt-4 flex items-center justify-between">--}}
{{--            <form method="POST" action="{{ route('verification.send') }}">--}}
{{--                @csrf--}}

{{--                <div>--}}
{{--                    <button>--}}
{{--                        {{ __('Resend Verification Email') }}--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}

{{--                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
        <form id="signform" class="login__form"  action="{{ route('verification.send') }}" method="post">
            @csrf
            <fieldset>
                <div class="form__input--floating">
                    <label class="form__label--floating text-center" id="label--email">Please Verify Email</label>
                    <label class="form__label--floating" id="label--email">A new verification link has been sent to the email address you provided during registration.</label>
                </div>

                <input type="submit" class=" btn__primary--large from__button--floating px-1" value="Resend Email">
            </fieldset>
        </form>

    </main>

@endsection




