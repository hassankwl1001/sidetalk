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
                <h6>Page Search </h6>
                <form>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form__input--floating">
                                <label class="form__label--floating" id="label--text">Page Search </label>
                                <div class="search-jobs">
                                    <i class="fas fa-search"></i>
                                    <input id="input--text" type="text" placeholder="Search by title, skill or company" value="{{request('search')}}" name="search">
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
                <a class="btn btn-outline-success m-2" href="{{route("pages.list")}}">{{request("search")}} <i class="fas fa-times"></i></a>
                <a class="btn btn-outline-success m-2" href="{{route("pages.list")}}">Reset</a>
            </div>
        </div>
    </div>
@endif

<section class="tag-list searchjob-lists ">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <div class="">
                </div>
                <ul>
                    @forelse ($pagesList as $page)
                        <li>
                            <a href="{{ route('page.detail', $page->id) }}">
                                <div class="hashtag job-lists">

                                    @if($page->logo != "")
                                    <img class="job-logo" style="height: 200px; width: 230px;" src="{{ env('PAGE_CONTENT_URL') }}/{{ $page->logo }}" alt="not available">
                                    @else
                                        <img class="job-logo" style="height: 200px; width: 230px" src="{{asset("assets/img/page-icon.png")}}" alt="not available">
                                    @endif
                                    <h3>{{ $page->name }}</h3>
                                    <span>{{ $page->about }}</span>
                                    {{-- <div class="viewjob-connections">
                                        <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                        <p>1 Connection</p>
                                    </div> --}}
                                    <hr/>
                                    @if( in_array($page->id,auth()->user()->pagesfollow->pluck("id")->toArray()) )
                                        <a class="btn btn-info btn-sm unfollow_page " href="javascript:void(0)"  data-page="{{$page->id}}">
                                            Un-Follow
                                        </a>
                                    @else
                                        <a class="btn btn-primary follow_page " href="javascript:void(0)"  data-page="{{$page->id}}">
                                        Follow
                                    </a>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @empty
                        <p style="text-align: center">No Job Found</p>
                    @endforelse

                </ul>
            </div>

        </div>
        <div >
            {{ $pagesList->links('vendor.pagination.custom') }}

        </div>
    </div>
</section>
@include('custom.inc.chatWidget')
@endsection
