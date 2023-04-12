@extends('custom.layouts.app')
@section('content')
    @include('custom.inc.loading')
    @include('custom.inc.header')

    @include('custom.inc.alerts')
    <section class="tag-section inner-padding-top">
        <div class="container default-container">
            <div class="row marginleftright">
                <div class="col-12 tag-count">
                    <h6>Page Search </h6>
                    <form>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form__input--floating">
                                    <label class="form__label--floating" id="label--text">Page Search </label>
                                    <div class="search-jobs">
                                        <i class="fas fa-search"></i>
                                        <input required id="input--text" type="text" placeholder="Search by title, skill or company" name="search">
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
    @if(request()->has("search") && request("search") != "")
        <div class="container default-container inner-padding-top" style="margin-top: 10px;">
            <div class="row marginleftright">
                <div class="col-12 paddingleftright">
                    <a class="btn btn-outline-success m-2" href="{{route("pages.list.user")}}">{{request("search")}} <i class="fas fa-times"></i></a>
                    <a class="btn btn-outline-success m-2" href="{{route("pages.list.user")}}">Reset</a>
                </div>
            </div>
        </div>
    @endif
    <section class="group-list inner-padding-top" style="padding-top: 50px;">
        <div class="container default-container">
            <div class="row marginleftright">
                <div class="col-12 paddingleftright">
{{--                    <a href="{{ route('group.create') }}" class="btn btn-info" style="float: right;">Create Group</a>--}}
                    <div class="section-heading">
                        <h3>Your Pages</h3>
                    </div>
                </div>
                <div class="col-12 paddingleftright">
                    <div class="group-lists">

                        @forelse ($all_my_pages as $page)
                            <div class="group-section">
                                <figure>
                                    @if($page->logo != "")

                                        <img src="{{ $url }}/{{ $page->logo }}" alt="" width="50" height="50">
                                    @else

                                        <img src="{{asset("/assets/img")}}/page-icon.png" alt="" width="50" height="50">
                                    @endif

                                </figure>
                                <div class="group-name">
                                    <a href="{{ route('page.detail', $page->id) }}">{{ $page->name }}</a>
                                    <p>{{ count($page->pageUser)  }} members</p>
                                    <p>

                                            @if(auth()->user()->id == $page->user_id)
                                                <span class='text-success'>Admin</span>
                                            @endif
                                    </p>
                                </div>
                                <div class="vertical-icons">
                                    <span class="fas fa-circle" aria-hidden="true"></span>
                                    <span class="fas fa-circle" aria-hidden="true"></span>
                                    <span class="fas fa-circle" aria-hidden="true"></span>
                                    <div class="notifications-signs">
                                        <ul>
                                            <li><a href=""><i class="far fa-copy"></i> Copy the link</a></li>
                                            @if($page->user_id != null &&  auth()->user()->id == $page->user_id)
                                                <li><a onclick="return confirm('Are you sure you want to delete this?')" href="{{url('pages/delete')}}/{{$page->id}}"><i class="fas fa-trash"></i> Delete the Page</a></li>
                                            @else
                                                <li><a href="javascript:;" class="unfollow_page" data-page="{{$page->id}}"><i class="fas fa-sign-out-alt"></i> Unfollow the Page</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Pages</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>









    @include('custom.inc.chatWidget')


@endsection
