@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<style>
    .scroll::-webkit-scrollbar {
        display: none;
    }
</style>
    <!-- MAIN CONTAINER -->
    <div class="container">
        <!-- PROFILE -->
        <section id="profile">

        </section>
        <!-- LEFT ASIDE -->
        <div class="left-aside-wrapper" id="left-aside-wrapper">
            <aside class="left-aside" id="left-aside">
                <div class="profile-groups" id="profile-groups">
                    <section class="profiles-section">
                        <header>
                            <span>Messages</span>
                            {{-- <i class="far fa-edit"></i> --}}
                        </header>
                        <div class="searchbar default-bar">
                            <input class="form-control search" id="search"  type="text" placeholder="Search">
                            <span id="search-icon" class="fas fa-search" aria-hidden="true"></span>
                        </div>
                        <ul class="group-list" id="conversationList">
                            @if(isset($user))
                                <li class="messages-lists" data-user="{{ $user->id }}">
                                    <figure class="image-container">
                                        <img class="img-size" src="{{ $user->profile_pic != null ? $profileUrl.'/'.$user->profile_pic : asset('assets/img'). '/profile.png' }}" alt="">
                                    </figure>
                                    <div class="box-commented">
                                        <div class="commented-description">
                                            <strong class="post_name">{{ $user->firstname." ". $user->lastname }}</strong>
                                        </div>
                                        <span class="designation">{{ $user->current_position != null ?  $user->current_position : 'No designation'}}</span>
                                    </div>
                                </li>
                            @endif
{{--                            {{dd($conversations)}}--}}

                            @forelse ($conversations as $conversation)
                                <li class="messages-lists" data-user-name="{{ $conversation->sender == null ? $conversation->receiver->firstname ." ".$conversation->receiver->lastname : $conversation->sender->firstname." ".$conversation->sender->lastname }}" data-user="{{ $conversation->sender == null ? $conversation->receiver->id : $conversation->sender->id }}">
                                    <figure class="image-container">
                                        <img class="img-size" src="{{ $conversation->profile_pic != null ? $profileUrl.$profile_pic : asset('assets/img'). '/profile.png' }}" alt="">
                                    </figure>
                                    <div class="box-commented">
                                        <div class="commented-description">
                                            <strong class="post_name">{{ $conversation->sender == null ? $conversation->receiver->firstname." ". $conversation->receiver->lastname : $conversation->sender->firstname." ". $conversation->sender->lastname }}</strong>
                                        </div>
                                        <span class="designation">{{ $conversation->current_position != null ?  $conversation->current_position : 'No designation'}}</span>
                                    </div>
                                </li>
                            @empty
                                No Conversation found
                            @endforelse

                        </ul>
                    </section>
                </div>
            </aside>
        </div>
        <!-- MAIN -->
        <div id="main-wrapper">
            <main class="main-section" id="main-section">
                <article id="chatbox1" data-user="">
                    <div class="post-author">
                        <a href="#">
                            <div class="author-details">
                                <figure class="image-container">
                                    <img id="user_image" class="img-size" src="assets/img/Ellipse2.png" alt="">
                                </figure>
                                <div class="author-description">
                                    <div class="post-name-experience">
                                        <strong class="post-author-name" id="user_name">Akram Sheikh</strong>
                                    </div>
                                    <span class="designation" id="user_designation">Marketing & Operations at BTW
                                </div>
                            </div>
                        </a>
{{--                        <div class="consult-btn">--}}
{{--                            <button class="consultation" data-toggle="modal" data-target="#consultation"><img src="{{asset('assets/img/camera.png')}}" alt="">Consult</button>--}}
{{--                        </div>--}}
                    </div>
                    <div class="mesgs"  style="max-height: 500px;overflow-y: scroll" >
                      <div class="msg_history " id="conversation_chat"  >
                        <div class="incoming_msg">
                          <div class="incoming_msg_img"> <img src="assets/img/Ellipse2.png" alt=""> </div>
                          <div class="received_msg">
                            <div class="received_withd_msg">
                              <p>Hi!</p>
                            </div>
                          </div>
                        </div>
                        <div class="outgoing_msg">
                          <div class="sent_msg">
                            <p>Hey! how are you?</p>
                          </div>
                        </div>
                        <div class="incoming_msg">
                          <div class="incoming_msg_img"> <img src="assets/img/Ellipse2.png" alt=""> </div>
                          <div class="received_msg">
                            <div class="received_withd_msg">
                              <p>I am great!! What's Up?</p>
                          </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="type_msg w-100">
                        <div class="input_msg_write w-100">
                            {{--                            <i class="fas fa-2x fa-file-alt"></i>--}}
                            {{--                            <i class="fas fa-2x fa-camera-retro"></i>--}}
                            {{--                            <i class="fas fa-2x fa-plus-circle"></i>--}}
                            <textarea id="send_message_on_enter" style="height: 43px;" class="write_msg w-100 p-1 scroll" placeholder="Type a message"></textarea>
                            <button class="msg_send_btn" type="button"><i class="fas fa-paper-plane mx-2" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </article>
            </main>
        </div>
        <!-- RIGHT ASIDE -->
        <aside class="right-aside" id="right-aside">
            <div class="advertisement-section" id="advertisement-section">
                <div class="advertisement-portion">
                    <header>
                        <span>Advertisement</span>
                    </header>
                    <div class="advertisement-space">
                        <figure>
                            <img src="assets/img/advertisement.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    @include('custom.inc.consultationModal')


    <script>

        $(".search").on("keyup", function() {

            var value = this.value.toLowerCase().trim();

            // console.log(value);

            $("#conversationList li").addClass("messages-lists").show().filter(function() {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).removeClass("messages-lists").hide();

        });
    </script>


@endsection
