@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<section class="jobdetail-page inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 jobpost">
                <div class="job-company">
                    <div class="job-company-detail">
                        <img src="assets/img/alpha.jpg" alt="">
                        <div class="job-company-post">
                            <h2>{{ $post->jobs->job_title }}</h2>
                            <p>{{ $post->jobs->location }}</p>
                            <span>Posted {{ $post->created_at->diffForHumans() }} | {{$post->view_count}} views</span>
                            @if($post->user_id != auth()->user()->id)
                                @if($post->userApplicant->isEmpty())
                                        <a href="" id="quickSubmitJob" data-job="{{ $post->id }}" class="btn__primary--large">Quick Submit</a>
                                    @else
                                    <a href="" class="btn__primary--large disabled">Applied</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="job-connections">
                        <div class="joblistsname">
                            <h4>Jobs</h4>
                            <ul>
                                <li>{{ $post->applicants_count }} applicants</li>
                                <li>Experience: {{  $post->jobs->exp_from  }} - {{  $post->jobs->exp_to  }}</li>
                                <li>Skills: {{ $post->jobs->skills }}</li>
                            </ul>
                        </div>
                        <div class="joblistsname">
                            <h4>Company</h4>
                            <ul>
{{--                                <li>11-50 employees</li>--}}
                                <li>{{ $post->jobs->company }}</li>
                            </ul>
                        </div>
                        <div class="joblistsname">
                            <h4>Skills</h4>
                            <ul>
                                {{--                                <li>11-50 employees</li>--}}
                                <li>
                                    @php

                                        $skills = explode(",",$post->jobs->skills);
                                    @endphp
                                    @foreach($skills as $skill)
                                        <ul style="list-style-type: none !important; text-decoration: none;">
                                            <li>{{$skill}}</li>
                                        </ul>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="joblistsname">
                            <h4>Description</h4>
                            <ul>
                                {{--                                <li>11-50 employees</li>--}}
                                <li>{{ $post->jobs->description }}</li>
                            </ul>
                        </div>
                        <div class="joblistsname">
                            <h4>Salary</h4>
                            <ul>
                                <li>{{ $post->jobs->salary_from }} - {{ $post->jobs->salary_to }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr/>
                    <div class="jobdescription">
                        {{ $post->jobs->descriptiond }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('custom.inc.chatWidget')

@endsection
