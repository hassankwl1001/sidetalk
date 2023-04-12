@extends('custom.layouts.app')
@section('content')
    @include('custom.inc.loading')
    @include('custom.inc.header')

    @include('custom.inc.alerts')
    <section class="group-list inner-padding-top" style="padding-top: 50px;">

        <div class="container default-container">
            <div class="row marginleftright justify-content-center">
                <div class="col-6 paddingleftright mt-5">
                    <h3>Notifications</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="group-list inner-padding-top" style="padding-top: 50px;">
        <div class="container default-container">
            <div class="row marginleftright justify-content-center">
                <div class="col-6 paddingleftright">
                    <div class="group-lists">


                        @forelse ($notifications as $notify)

                            <div class="group-section">
                                <figure>
                                    @if($notify->otherUser->profile_pic != "" && str_contains(strtolower($notify->otherUser->profile_pic),"jpg") || str_contains(strtolower($notify->otherUser->profile_pic),"png") || str_contains(strtolower($notify->otherUser->profile_pic),"jpeg") || str_contains(strtolower($notify->otherUser->profile_pic),"gif") )
                                        <img style="border-radius: 50%"  src="{{ $url }}/{{ $notify->otherUser->profile_pic }}" alt="" width="80" height="80">
                                    @else
                                        <img style="border-radius: 50%" src="{{asset("assets/img/profile.png")}}" alt="No image avaialable" width="80" height="80">
                                    @endif
                                </figure>
                                <div class="sub-menu-notifications ml-4">
                                    <p>
                                        <b>
                                            {{$notify->otherUser->firstname ." ".$notify->otherUser->lastname." ".$notify->otherUser->experience."Y" }}
                                        </b>
                                        <p>{{$notify->text}}</p>
                                    </p>
                                    <span style="margin-top: 15px;">
                                        {{$notify->notification_time}}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p>No Notifications</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('custom.inc.pushNotifications')
    @include('custom.inc.chatWidget')


@endsection
