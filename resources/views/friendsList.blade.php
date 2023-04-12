@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<style>

</style>

<section class="tag-section inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 tag-count">
                <h6>Friends list </h6>
                <form>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form__input--floating">
                                <label class="form__label--floating" id="label--text">Friend Search </label>
                                <div class="search-jobs">
                                    <i class="fas fa-search"></i>
                                    <input id="input--text" type="text" placeholder="Search by title, skill or company" name="search">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button class="btn__primary--large from__button--floating">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="tag-list searchjob-lists ">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <div class="">
                </div>
                <ul>
                    @forelse ($friends as $friend)
                        <li>
                            <a href="{{route('user.profile.show',$friend->sender->id)}}">
                                <div class="hashtag job-lists">

                                    <img class="job-logo w-100" style="height: 200px;width: auto" src="{{ $friend->sender->profile_pic != null ? $url.'/'.$friend->sender->profile_pic : asset('assets/img').'/profile.png' }}" alt="">
                                    <h3>{{ $friend->sender->firstname." ". $friend->sender->lastname }}</h3>
                                    <span>{{$friend->sender->country}}</span>
                                    <span>{{$friend->sender->city}}</span>
                                    <span>{{$friend->sender->is_student == 1 ? "Student" : ""}}</span>
                                    <span>{{$friend->sender->current_position ?? 'No designation' }}</span>
                                    <span>{{$friend->sender->experience > 0 ? $friend->sender->experience. " Exp"   : 'No Experience' }}</span>
                                    <hr/>
                                </div>
                            </a>
                        </li>
                    @empty
                        <p style="text-align: center">No Friend Found</p>
                    @endforelse
                </ul>
            </div>

        </div>
        <div >
            {{ $friends->links('vendor.pagination.custom') }}

        </div>
    </div>
</section>
@include('custom.inc.chatWidget')
@endsection
