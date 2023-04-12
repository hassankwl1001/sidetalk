@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<section class="tag-section inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 tag-count">
                <h6>Search for your next job</h6>
                <form>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form__input--floating">
                                <label class="form__label--floating" id="label--text">Search Job</label>
                                <div class="search-jobs">
                                    <i class="fas fa-search"></i>
                                    <input required id="input--text" type="text" placeholder="Search by title, skill or company" name="search">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form__input--floating">
                                <label class="form__label--floating" id="label--text">City</label>
                                <div class="search-jobs">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input required id="input--text" type="text" placeholder="Pakistan" name="city">
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
                <a class="btn btn-outline-success m-2" href="{{route("job.list")}}">Reset</a>
            </div>
        </div>
    </div>
@endif
<section class="tag-list searchjob-lists">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <div class="">
                </div>
                <ul>
                    @forelse ($posts as $job)
                        @if($job->jobs != "")


                    <li>
                        @if($job->userApplicant->isEmpty())
                                <a href="{{ route('job.detail', $job->id) }}">
                                    <div class="hashtag job-lists">
                                        <img class="job-logo" style="height: 180px; width: 100%;" src="{{ $urlPost }}/{{ $job->postMedia[0]->name }}" alt="">
                                        <h3>{{ $job->jobs->job_title }}</h3>
                                        <span>{{ $job->jobs->company }}</span>
                                        <span>{{ $job->jobs->location }}</span>
                                        {{-- <div class="viewjob-connections">
                                            <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                            <p>1 Connection</p>
                                        </div> --}}
                                        <hr/>
                                        <span>{{ $job->created_at->diffForHumans() }} . <span class="color-green">{{count($job->applicants)}} applicants</span></span>
                                    </div>
                                </a>
                        @else
                            <a href="{{ route('job.detail', $job->id) }}">
                                <div class="hashtag job-lists">
                                    <img style="height: 180px; width: 100%;" class="job-logo" src="{{ $urlPost }}/{{ $job->postMedia[0]->name }}" alt="">
                                    <h3>{{ $job->jobs->job_title }}</h3>
                                    <span>{{ $job->jobs->company }}</span>
                                    <span>{{ $job->jobs->location }}</span>
                                    {{-- <div class="viewjob-connections">
                                        <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                        <p>1 Connection</p>
                                    </div> --}}
                                    <hr/>
                                    <span>{{ $job->created_at->diffForHumans() }} . <span class="color-green"> Applied</span></span>
                                </div>
                            </a>
                        @endif
                    </li>
                        @endif
                    @empty
                        <p style="text-align: center">No Job Found</p>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
