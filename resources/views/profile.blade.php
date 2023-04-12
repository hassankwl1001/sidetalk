@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<style>
    #left-aside-wrapper, #main-wrapper, #right-aside {
        margin-top: 300px;
    }
</style>

    <!-- MAIN CONTAINER -->
    <div class="container">
        <!-- PROFILE -->
        <section id="profile">
            <div class="main-card">
                @php
                    if(auth()->user()->banner != null){
                        $banner =  $profileUrl."/".auth()->user()->banner;
                    }else{
                        $banner = asset('assets/img/banner.png');
                    }
                @endphp
                <div class="profile-info" id="profile-info" style="background-image: url({{ $banner }}); background-size: cover; background-position: center">
                    <div class="profile-image-uploader">
                        @if(auth()->user()->profile_pic != null)
                             <img src="{{ $profileUrl }}/{{ auth()->user()->profile_pic }}" alt="Profile picture" />
                        @else
                             <img src="{{ asset('assets/img/profile.png') }}" alt="Profile picture" />
                        @endif
                        <a href="" data-toggle="modal" data-target="#image-photo"><i class="fas fa-camera-retro"></i></a>
                    </div>
                    <div class="author-description">
                        <div class="post-name-experience">
                            <strong class="post-author-name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} {{ auth()->user()->current_position != "" ? ", ".auth()->user()->current_position : ""  }}</strong>
                            <span>
                                @if(auth()->user()->experience > 0)
                                    <span>&nbsp;·&nbsp;</span>
                                    {{auth()->user()->experience}}Y Exp</span>
                                @endif
                        </div>
                        <span class="designation">{{ auth()->user()->headline }}</span>
                        {{-- <ul>
                            <li>SME Specialty</li>
                            <li>EMS</li>
                            <li>Optimization</li>
                            <li>Simulation</li>
                            <li>Cogeneration</li>
                        </ul> --}}
                    </div>
                    <div class="profile-camera">
                        <a href="" data-toggle="modal" data-target="#upload-background-photo"><i class="fas fa-camera-retro"></i></a>
                    </div>
                </div>
                <div class="profile-review">
                    <div class="profile-points">
                        <ul>
                            <li>
                                <i class="far fa-star"></i>
                                <span>Rating</span>
                                <p>{{$totalRating}}</p>
                            </li>
                            <li>
                                <img src="{{asset('assets/img/Group8.png')}}" alt="">
                                <span>Reflects</span>
                                <p>{{$totalReflections}}</p>
                            </li>
                            <li>
                                <i class="far fa-eye"></i>
                                <span>Content Views</span>
                                <p>{{ $contentView }}</p>
                            </li>
                            <li>
                                <i class="far fa-calendar-alt"></i>
                                <span>Engagements</span>
                                <p>{{$engagement}}</p>
                            </li>

                        </ul>
                    </div>
                    <div class="consult-sme">
                        <i data-toggle="modal" data-target="#edit-profile" class="fas fa-cog"></i>
{{--                        <a href="" data-toggle="modal" data-target="#consultation">Consult SME <i class="fas fa-video"></i></a>--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- LEFT ASIDE -->
        <div class="left-aside-wrapper" id="left-aside-wrapper">
            <aside class="left-aside" id="left-aside">
                <div class="profile-groups" id="profile-groups">
                    <section class="profiles-section">
                        <header>
                            <span>Introduction</span>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit-introduction"><i class="far fa-edit"></i></a>
                        </header>
                        <div class="Introduction-details">
                            <small>Company</small>
                            <h2>{{ auth()->user()->recent_company }}</h2>
                        </div>
                        <div class="Introduction-details">
                            <small>Work Location</small>
                            <h2>{{ auth()->user()->work_location }}</h2>
                        </div>
                        <div class="Introduction-details">
                            <small>Type of Industry</small>
                            <h2>{{ auth()->user()->industry }}</h2>
                        </div>
                        <div class="Introduction-details">
                            <small>Industry Sub Category</small>
                            <h2>{{ auth()->user()->sub_industry }}</h2>
                        </div>
                        <div class="border-space"></div>
                        <div class="Introduction-details">
                            <small>Education</small>
                            <h2>{{ auth()->user()->education }}</h2>
                        </div>
                        <div class="Introduction-details">
                            <small>Home Town</small>
                            <h2>{{ auth()->user()->city }} , {{ auth()->user()->country }}</h2>
                        </div>
                    </section>
                </div>
                <div class="rec-section" id="rec-section">
                    <div class="right-sidebar">
                        <header>
                            <span>Experience</span>
                            <a data-toggle="modal" data-target="#add-experience" href="javascript:void(0)"><i class="fa fa-plus-circle"></i></a>
                        </header>
                        <div class="top-right-bar">
                          @foreach($experiences as $exp)
                            <div class="top-right-bar-detail">

                                <div class="top-right-bar-description">
                                    <h5>{{ $exp->title }}</h5>
                                    <span>{{ $exp->responsibility }} at {{ $exp->company }}</span>
                                    <small>{{ $exp->start_date }} - {{ $exp->end_date }}  .  {{ \Carbon\Carbon::parse($exp->start_date)->diffAsCarbonInterval(\Carbon\Carbon::parse($exp->end_date))}}, {{ $exp->location }}</small>
                                </div>
                                <a  data-experienced="{{$exp->id}}" class="experienced-edit" href="javascript:void(0)"><i class="far fa-edit"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if(auth()->user()->getSubscription() != '')
                    <div>
                        <a href="{{ route('unsubscribe') }}" class="btn btn-danger">Unsubscribe</a>
                    </div>
                @endif
            </aside>
        </div>
        <!-- MAIN -->
        <div id="main-wrapper">
            <main class="main-section" id="main-section">
                @include('custom.inc.postsCard')

                @include('custom.inc.alerts')

                @foreach($posts as $post)

                  <article data-post="{{ $post->id }}" class="post-article">
                      <!-- post header -->
                      <div class="post-author">
                          <a href="{{ route('profile') }}">
                              <div class="author-details">
                                  <figure class="image-container">
                                      @if($post->user->profile_pic != null)
                                          <img class="img-size" src="{{ $urlProfile }}/{{ $post->user->profile_pic }}" alt="">
                                      @else
                                          <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                      @endif
                                  </figure>
                                  <div class="author-description">
                                      <div class="post-name-experience">
                                          <strong class="post-author-name">{{ $post->user->firstname }} {{ $post->user->lastname }}</strong>
{{--                                          {{dd($post->user->experience)}}--}}
                                          @if($post->user->experience > 0)
                                              <span>
                                                  <span>&nbsp;·&nbsp;</span>
                                                  {{ $post->user->experience }}Y Exp
                                              </span>

                                              <span class="green_slot">J</span>
                                          @endif
                                      </div>
                                      <span class="designation">
                                          @if($post->user->is_student == 1) Student |@endif
                                          {{ $post->user->current_position }}
                                      </span>
                                      <span class="time-ago">{{ $post->created_at->diffForHumans() }}</span>
                                  </div>
                              </div>
                          </a>
{{--                          <div class="consult-btn">--}}
{{--                              <button data-toggle="modal" data-target="#consultation"><img src="assets/img/camera.png" alt="">Consult</button>--}}
{{--                          </div>--}}
                              <div class="vertical-icons">
                                  <span class="fas fa-circle"></span>
                                  <span class="fas fa-circle"></span>
                                  <span class="fas fa-circle"></span>
                                  <div class="notifications-signs">
                                      <ul>
                                            @if($post->user_id == auth()->id())
                                            <li><a href="javascript:void(0)" class="edit-post" data-post="{{$post->id}}"><i class="fas fa-edit" aria-hidden="true"></i> Edit <span class="dropdown-edit">Edit this Post</span></a></li>
                                            <li><a href="javascript:void(0)" class="delete-post" data-post="{{$post->id}}"><i class="fas fa-trash" aria-hidden="true"></i> Delete <span class="dropdown-edit">Delete this Post</span></a></li>
                                            @endif
                                          <li><a href="save-post.html"><i class="fas fa-save" aria-hidden="true"></i> Save <span class="dropdown-edit">Save for later</span></a></li>
                                                <li><a href="javascript:void(0);" class="copyLink" link="{{url('/post/detail')}}/{{$post->id}}"><i class="fa fa-copy" aria-hidden="true"></i> Copy link to post</a></li>
{{--                                           <li><a href=""><i class="fas fa-volume-mute" aria-hidden="true"></i> Mute Usman Rahim <span class="dropdown-edit">Stop seeing post for Usman</span></a></li>--}}
{{--                                          <li><a href=""><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Leave this group<span class="dropdown-edit">Stop seeing post for this group</span></a></li>--}}
                                                <li><a href="javascript:void(0);" class="reportPost" data-post="{{$post->id}}"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Report this post<span class="dropdown-edit">This post is offensive or account is hacked</span></a></li>

                                      </ul>
                                  </div>
                              </div>
                      </div>
                      <!-- /post header -->

                      <!-- post body -->
                      @if($post->postType->name == 'Article')
                        <div class="post-data">
                            <h4 class="article-heading">{{ $post->heading }}</h4>
                            <p>
                                {{ $post->description }}
                            </p>
                            <p class="post-translation">
                                <button>{{$post->hashtags}}</button>

                            </p>

                            @if(!$post->postMedia->isEmpty())
                                {{-- <iframe src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" width="100%" height="500px">
                                </iframe> --}}

                                {{-- <embed src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" type="application/pdf" width="100%" height="500px" /> --}}
                                <iframe src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" width="100%" height="500px"></iframe>
                            @endif

                        </div>
                      @elseif($post->postType->name == 'Photo' || $post->postType->name == 'Video')
                        <div class="post-data">
                            <p>
                                {{ $post->description }}
                            </p>
                            <p class="post-translation">
                                <button>{{$post->hashtags}}</button>

                            </p>
                            @php
                                $mediaCount = count($post->postMedia);
                            @endphp
                            @if($mediaCount == 1)
                                @if($post->postType->name == 'Photo')
                                <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postMediaContent" alt="Modal Image" />
                                @elseif($post->postType->name == 'Video')
                                <video style="width: 100%;" controls>
                                    <source src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" type="video/mp4">
                                    <source src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" type="video/mkv">
                                    Your browser does not support HTML video.
                                </video>
                                @endif
                            @else

                                @if($mediaCount == 2)
                                <div class="row">
                                    <div class="col-md-6 imgShowColumn1">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                    <div class="col-md-6 imgShowColumn2">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                </div>
                                @elseif($mediaCount == 3)
                                <div class="row">
                                    <div class="col-md-12 singleImage">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postMediaContent" alt="" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 imgShowColumn1">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                    <div class="col-md-6 imgShowColumn2">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                </div>
                                @elseif($mediaCount == 4)
                                <div class="row">
                                    <div class="col-md-6 imgShowColumn1">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                    <div class="col-md-6 imgShowColumn2">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 imgShowColumn3">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[2]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                    <div class="col-md-6 imgShowColumn4">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[3]->name }}" class="postImage postMediaContent" alt="" />
                                    </div>
                                </div>
                                @elseif($mediaCount > 4)
                                <div class="row">
                                    <div class="col-md-12">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" class="postMediaContent" alt="" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-md-4 imgShowColumn1">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[1]->name }}" class="postMediaContent" alt="" />
                                </div>
                                <div class="col-md-4 imgShowColumn2 imgShowColumn3">
                                    <img src="{{ $urlPost }}/{{ $post->postMedia[2]->name }}" class="postMediaContent" alt="" />
                                </div>
                                <div class="col-md-4 imgShowColumn3" id="moreImagesbox">
                                <span id="moreImages">
                                        +{{ $mediaCount - 3 }}
                                    </span>
                                </div>
                                </div>

                                @endif <!-- /count == 2 -->
                            @endif <!-- /count == 1 -->

                        </div>
                      @elseif($post->postType->name == 'Job')
                        <div class="job-post-data">
                            <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" alt="" />
                            <div class="job-post-details">
                                <h2>{{ $post->jobs->job_title }}</h2>
                                <p>{{ $post->jobs->description }}</p>
                                <div class="job-post-descrption-detail">
                                    <span>{{ $post->jobs->location }}</span> .
                                    <span>{{ $post->jobs->employeeType->name }}</span> .
                                    <span>{{ $post->jobs->salary_from }}-{{ $post->jobs->salary_to }}k /month</span>
                                    <a class="btn-primary" href="{{ route('job.detail', $post->jobs->id) }}">Apply now</a>

                                </div>
                            </div>
                        </div>
                     @elseif($post->postType->name == 'Shared')
                        <div class="job-post-data">
                            {{-- <img src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" alt="" />
                            <div class="job-post-details">
                                <h2>{{ $post->jobs->job_title }}</h2>
                                <p>{{ $post->jobs->description }}</p>
                                <div class="job-post-descrption-detail">
                                    <span>{{ $post->jobs->location }}</span> .
                                    <span>{{ $post->jobs->employeeType->name }}</span> .
                                    <span>{{ $post->jobs->salary_from }}-{{ $post->jobs->salary_to }}k /month</span>
                                    <a class="btn-primary" href="jobs-detail.html">Apply now</a>
                                </div>
                            </div> --}}

                               <!-- post header -->
                                <div class="post-author">
                                    <a href="{{ $post->shared->user->id == auth()->id() ? route('profile') : route('user.profile.show', $post->shared->user->id) }}">
                                        <div class="author-details">
                                            <figure class="image-container">
                                                @if($post->shared->user->profile_pic != null)
                                                    <img class="img-size" src="{{ $urlProfile }}/{{ $post->shared->user->profile_pic }}" alt="">
                                                @else
                                                    <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                                @endif
                                            </figure>
                                            <div class="author-description">
                                                <div class="post-name-experience">
                                                    <strong class="post-author-name">{{ $post->shared->user->firstname }} {{ $post->shared->user->lastname }}</strong>
                                                    @if($post->shared->user->experience > 0)
                                                    <span>
                                                        <span>&nbsp;·&nbsp;</span>
                                                        {{ $post->shared->user->experience }}Y Exp</span>
                                                    <span class="green_slot">J</span>
                                                    @endif
                                                </div>
                                                <span class="designation">
                                                    @if($post->shared->user->is_student == 1) Student |@endif
                                                    {{ $post->shared->user->current_position }}
                                                </span>
                                                <span class="time-ago">{{ $post->shared->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- /post header -->

                                {{-- shared post content start --}}
                                @if($post->shared->postType->name == 'Article')
                                <div class="post-data">
                                    <h4 class="article-heading">{{ $post->shared->heading }}</h4>
                                    <p>
                                        {{ $post->shared->description }}
                                    </p>
                                    <p class="post-translation">
                                        <button>{{$post->hashtags}}</button>

                                    </p>

                                    @if(!$post->shared->postMedia->isEmpty())
                                        {{-- <iframe src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" width="100%" height="500px">
                                        </iframe> --}}

                                        {{-- <embed src="{{ $urlPost }}/{{ $post->postMedia[0]->name }}" type="application/pdf" width="100%" height="500px" /> --}}
                                        <iframe src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" width="100%" height="500px"></iframe>
                                    @endif

                                </div>
                                @elseif($post->shared->postType->name == 'Photo' || $post->postType->name == 'Video')
                                    <div class="post-data">
                                        <p>
                                            {{ $post->shared->description }}
                                        </p>
                                        <p class="post-translation">
                                            <button>{{$post->hashtags}}</button>

                                        </p>
                                        @php
                                            $mediaCount = count($post->shared->postMedia);
                                        @endphp
                                        @if($mediaCount == 1)
                                            @if($post->shared->postType->name == 'Photo')
                                            <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postMediaContent" alt="Modal Image" />
                                            @elseif($post->shared->postType->name == 'Video')
                                            <video style="width: 100%;" controls>
                                                <source src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" type="video/mp4">
                                                <source src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" type="video/mkv">
                                                Your browser does not support HTML video.
                                            </video>
                                            @endif
                                        @else

                                            @if($mediaCount == 2)
                                            <div class="row">
                                                <div class="col-md-6 imgShowColumn1">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                                <div class="col-md-6 imgShowColumn2">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                            </div>
                                            @elseif($mediaCount == 3)
                                            <div class="row">
                                                <div class="col-md-12 singleImage">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postMediaContent" alt="" />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 imgShowColumn1">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                                <div class="col-md-6 imgShowColumn2">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                            </div>
                                            @elseif($mediaCount == 4)
                                            <div class="row">
                                                <div class="col-md-6 imgShowColumn1">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                                <div class="col-md-6 imgShowColumn2">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[1]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 imgShowColumn3">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[2]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                                <div class="col-md-6 imgShowColumn4">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[3]->name }}" class="postImage postMediaContent" alt="" />
                                                </div>
                                            </div>
                                            @elseif($mediaCount > 4)
                                            <div class="row">
                                                <div class="col-md-12">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" class="postMediaContent" alt="" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                            <div class="col-md-4 imgShowColumn1">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[1]->name }}" class="postMediaContent" alt="" />
                                            </div>
                                            <div class="col-md-4 imgShowColumn2 imgShowColumn3">
                                                <img src="{{ $urlPost }}/{{ $post->shared->postMedia[2]->name }}" class="postMediaContent" alt="" />
                                            </div>
                                            <div class="col-md-4 imgShowColumn3" id="moreImagesbox">
                                            <span id="moreImages">
                                                    +{{ $mediaCount - 3 }}
                                                </span>
                                            </div>
                                            </div>

                                            @endif <!-- /count == 2 -->
                                        @endif <!-- /count == 1 -->

                                    </div>
                                @elseif($post->shared->postType->name == 'Job')
                                    <div class="job-post-data">
                                        <img src="{{ $urlPost }}/{{ $post->shared->postMedia[0]->name }}" alt="" />
                                        <div class="job-post-details">
                                            <h2>{{ $post->shared->jobs->job_title }}</h2>
                                            <p>{{ $post->shared->jobs->description }}</p>
                                            <div class="job-post-descrption-detail">
                                                <span>{{ $post->shared->jobs->location }}</span> .
                                                <span>{{ $post->shared->jobs->employeeType->name }}</span> .
                                                <span>{{ $post->shared->jobs->salary_from }}-{{ $post->shared->jobs->salary_to }}k /month</span>
                                                <a class="btn-primary" href="jobs-detail.html">Apply now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- shared post content end --}}
                        </div>
                      @endif
                      <!-- /post body -->

                      <!-- post interactions -->
                      <div class="post-interactions">
                          <div class="interactions-amount">
                              <div class="rating-stars">
                                  <ul id="stars">
                                    <li class="star 1 2 3 4 5 @if(!$post->rate->isEmpty() && $post->rate[0]->stars >= 1) selected @endif" title="Poor" data-value="1"  data-rate="@if(!$post->rate->isEmpty()) {{ $post->rate[0]->id }} @endif">
                                      <i class="fa fa-star fa-fw"></i>
                                    </li>
                                    <li class="star 2 3 4 @if(!$post->rate->isEmpty() && $post->rate[0]->stars >= 2 ) selected @endif" title="Fair" data-value="2" data-rate="@if(!$post->rate->isEmpty()) {{ $post->rate[0]->id }} @endif">
                                      <i class="fa fa-star fa-fw"></i>
                                    </li>
                                    <li class="star 3 4 5 @if(!$post->rate->isEmpty() && $post->rate[0]->stars >= 3) selected @endif" title="Good" data-value="3" data-rate="@if(!$post->rate->isEmpty()) {{ $post->rate[0]->id }} @endif">
                                      <i class="fa fa-star fa-fw"></i>
                                    </li>
                                    <li class="star 4 5 @if(!$post->rate->isEmpty() && $post->rate[0]->stars >= 4) selected @endif" title="Excellent" data-value="4" data-rate="@if(!$post->rate->isEmpty()) {{ $post->rate[0]->id }} @endif">
                                      <i class="fa fa-star fa-fw"></i>
                                    </li>
                                    <li class="star 5 @if(!$post->rate->isEmpty() && $post->rate[0]->stars == 5) selected @endif" title="WOW!!!" data-value="5" data-rate="@if(!$post->rate->isEmpty()) {{ $post->rate[0]->id }} @endif">
                                      <i class="fa fa-star fa-fw"></i>
                                    </li>
                                  </ul>
                              </div>
                              <span class="amount-info">{{ $post->view_count }} Views</span>
                          </div>
                          <div class="interactions-btns">
                            @if($post->rate->isEmpty())
                              <button>
                                <span class="counter ratePost"><i class="far fa-star"></i></span>
                                <span class="ratePost rateCounter">Rate [{{ $post->rate_count }}]</span>
                              </button>
                            @else
                              <button>
                                <span class="counter ratePost"><i class="fa fa-star fa-clicked"></i></span>
                                <span class="ratePost rateCounter">Rate [{{ $post->rate_count }}]</span>
                              </button>
                            @endif

                              <button>
                                  <span class="counter"><img src="assets/img/Group8.png" alt=""></span>
                                  <span>Reflect [{{ $post->reflections_count }}]</span>
                              </button>
                              <button class="repost-button">
                                  <span class="counter"><img src="assets/img/Group5.png" alt=""></span>
                                  <span>Repost [{{ $post->post_shared_count }}]</span>
                              </button>
                              <button>
                                  <span class="counter"><i class="fas fa-paper-plane"></i></span>
                                  <span class="post-send">Send</span>
                              </button>
                          </div>
                      </div>
                      <!-- /post interactions -->

                      <!-- add new comment -->
                      <div class="post-input">
                          <div class="input-section">
                              <figure class="image-container">
                                  @if(auth()->user()->profile_pic == "")
                                      <img class="img-size" src="{{asset('assets/img/profile.png')}}" alt="">
                                  @else
                                      <img class="img-size" src="{{ $urlProfile }}/{{ auth()->user()->profile_pic }}" alt="">
                                  @endif
                              </figure>
                              <div class="input-portion">
                                  <div>
                                      <textarea class="form-control reflection" style="height: 43px;" type="text" placeholder="Add a reflection"></textarea>
                                  </div>
                              </div>
                              <button class="submit-reflection">
                                <span class="counter"><i class="fas fa-paper-plane" aria-hidden="true"></i></span>
                                <span>Send</span>
                              </button>
                          </div>
                      </div>
                      <!-- /add new comment -->

                      <!-- previous comments -->
                      <div class="commented-groups">
                          <section>
                              <header>
                                  <span class="heading-commented">Recent Reflections</span>
                                  <span
                                      class="fas fa-angle-down"
                                      onclick="toggleProfileGroupList(this)"
                                  ></span>
                              </header>
                              <ul class="group-list reflection-list">
                                @foreach($post->reflections as $reflection)
                                  <li>
                                      <div class="operations-user">
                                          <figure class="image-container">
                                            @if($reflection->user->profile_pic != null)
                                                <img class="img-size" src="{{ $urlProfile }}/{{ $reflection->user->profile_pic }}" alt="">
                                            @else
                                                <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                            @endif
                                          </figure>
                                          <div class="box-commented">
                                              <div class="commented-description">
                                                  <strong class="post_name">{{ $reflection->user->firstname }} {{ $reflection->user->lastname }}</strong>
                                                  @if($reflection->user->experience > 0)
                                                  <span class="post_designation">
                                                      <span>&nbsp;·&nbsp;</span>
                                                      {{ $reflection->user->experience }}Y Exp
                                                    </span>
                                                  @endif
                                              </div>
                                              <span class="designation">{{ $reflection->user->current_position }}</span>
                                              <span class="comment-user">{{ $reflection->reflection }}</span>
                                          </div>
                                      </div>
{{--                                      <div class="like-reply-part">--}}
{{--                                          <span>Like <span>&nbsp;·&nbsp;</span> Reply</span>--}}
{{--                                      </div>--}}

                                      @if($reflection->user->id == auth()->id())
                                          <div class="edit-del-part">
                                              <span><a href="javascript:;" onclick="return editComment(this)" data-comment-id="{{ $reflection->id }}" class="edit-comment">Edit</a>  <span>&nbsp;·&nbsp;</span><a href="javascript:;" onclick="return deleteComment(this)" data-comment-id="{{ $reflection->id }}" class="delete-comment">Delete</a> </span>
                                          </div>
                                      @endif
                                  </li>
                                  @endforeach
                              </ul>
                              <div class="load-more">
                                  <a href="" data-value="0">Load more reflections</a>
                              </div>
                          </section>
                      </div>
                      <!-- /previous comments -->
                  </article>

                @endforeach

            </main>
        </div>
        <!-- RIGHT ASIDE -->
        <aside class="right-aside" id="right-aside">
            {{-- <div class="message-section">
                <div class="right-sidebar">
                    <header>
                        <span>New Messages</span>
                    </header>
                    <div class="top-right-bar">
                        <ul>
                            <li>
                                <div class="operations-user">
                                    <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                    <div class="box-commented">
                                        <div class="commented-description">
                                            <strong class="post_name">Akram Sheikh</strong>
                                            <span class="post_designation">
                                                <span>&nbsp;·&nbsp;</span>
                                                5Y Exp</span>
                                        </div>
                                        <span class="designation">Marketing &amp; Operations at BTW</span>
                                        <span class="comment-user">Without too many CGI this movie represent</span>
                                    </div>
                                </div>
                                <div class="like-reply-part">
                                    <span>Like <span>&nbsp;·&nbsp;</span> Reply</span>
                                </div>
                            </li>
                            <li>
                                <div class="operations-user">
                                    <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                    <div class="box-commented">
                                        <div class="commented-description">
                                            <strong class="post_name">Akram Sheikh</strong>
                                            <span class="post_designation">
                                                <span>&nbsp;·&nbsp;</span>
                                                5Y Exp</span>
                                        </div>
                                        <span class="designation">Marketing &amp; Operations at BTW</span>
                                        <span class="comment-user">Without too many CGI this movie represent</span>
                                    </div>
                                </div>
                                <div class="like-reply-part">
                                    <span>Like <span>&nbsp;·&nbsp;</span> Reply</span>
                                </div>
                            </li>
                            <li>
                                <div class="operations-user">
                                    <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                    <div class="box-commented">
                                        <div class="commented-description">
                                            <strong class="post_name">Akram Sheikh</strong>
                                            <span class="post_designation">
                                                <span>&nbsp;·&nbsp;</span>
                                                5Y Exp</span>
                                        </div>
                                        <span class="designation">Marketing &amp; Operations at BTW</span>
                                        <span class="comment-user">Without too many CGI this movie represent</span>
                                    </div>
                                </div>
                                <div class="like-reply-part">
                                    <span>Like <span>&nbsp;·&nbsp;</span> Reply</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="rec-section" id="rec-section">
                <div class="right-sidebar">
                    <header>
                        <span>Follows</span>
                        <span class="default-span">{{$totalPages}} Follows</span>
                    </header>
                    <div class="top-right-bar" style="max-height: 300px;overflow-y: scroll">
                        {{--                             @dd($similarPages)--}}

                        @foreach($follows as $page)

                            <div class="top-right-bar-detail">
                                <a href="{{route('page.detail',$page->id)}}" style="background: none">
                                    <img src="{{url('/storage/app/media')}}/{{$page->logo}}" alt=""></a>
                                <div class="top-right-bar-description">
                                    <strong>{{$page->name}}</strong>
                                    <small>{{$page->tagline}}</small>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <a href="{{route('pages.list')}}">Discover more</a>
                </div>
            </div>
        </aside>
    </div>


    @include('custom.inc.postsCardModels')
    @include('custom.inc.consultationModal')

{{--    <div class="modal fade" id="consultation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--              <div class="modal-header">--}}
{{--                <h2 class="modal-title" id="exampleModalLongTitle">Consultation</h2>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                  <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--              </div>--}}
{{--              <div class="modal-body">--}}
{{--                <div class="content">--}}
{{--                    <form class="login__form popup__form" action="" method="post">--}}
{{--                      <div class="form__heading">--}}
{{--                          <h4>Usman Ahmed</h4>--}}
{{--                          <p class="cost-session">Session Price: <span>$300</span></p>--}}
{{--                      </div>--}}
{{--                      <div class="form__input--floating radio-btn">--}}
{{--                        <div class="radiogroup">--}}
{{--                            <input type="radio" name="optradioconsultanting" value="Online" checked="checked" id="label--online"/>--}}
{{--                            <label class="form__label--floating" for="label--online">Virtual Consultation</label>--}}
{{--                            <p class="cost-session">Cost per session: <span>(30-60 mints)</span></p>--}}
{{--                        </div>--}}
{{--                        <div class="radiogroup">--}}
{{--                            <input type="radio" name="optradioconsultanting" value="Physical" id="label--meeting"/>--}}
{{--                            <label class="form__label--floating" for="label--meeting">Physical Consultation</label>--}}
{{--                            <p class="cost-session">Cost per day: <span>(6 hrs)</span></p>--}}
{{--                            <h6>*Travel expense and logistics shall be paid separately.</h6>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="show_physical_box" id="Physical">--}}
{{--                        <div class="form__input--floating">--}}
{{--                            <label class="form__label--floating" id="label--city">City/District </label>--}}
{{--                            <input id="input--city" type="text" placeholder="Lahore" name="city">--}}
{{--                        </div>--}}
{{--                        <div class="form__input--floating">--}}
{{--                            <label class="form__label--floating" id="label--country">Country/Region </label>--}}
{{--                            <input id="input--country" type="text" placeholder="Pakistan" name="country">--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="form__input--floating">--}}
{{--                        <label class="form__label--floating" id="label--subject">Matter of Subject </label>--}}
{{--                        <textarea id="input--subject" placeholder="Explain what skills you are looking for" name="subject"></textarea>--}}
{{--                      </div>--}}
{{--                      <div class="form__attached_file">--}}
{{--                          <a href=""><i class="fas fa-plus-circle"></i></a>--}}
{{--                          <span>Attach files</span>--}}
{{--                      </div>--}}
{{--                      <div class="form__input--floating">--}}
{{--                        <label class="form__label--floating" id="label--time">Time of Consultation </label>--}}
{{--                        <div class="form__label--dropdown">--}}
{{--                            <select name="date" id="input--date">--}}
{{--                                <option>Date</option>--}}
{{--                                <option value="1">1</option>--}}
{{--                                <option value="2">2</option>--}}
{{--                                <option value="3">3</option>--}}
{{--                                <option value="4">4</option>--}}
{{--                                <option value="5">5</option>--}}
{{--                                <option value="6">6</option>--}}
{{--                                <option value="7">7</option>--}}
{{--                                <option value="8">8</option>--}}
{{--                                <option value="9">9</option>--}}
{{--                                <option value="10">10</option>--}}
{{--                                <option value="11">11</option>--}}
{{--                                <option value="12">12</option>--}}
{{--                                <option value="13">13</option>--}}
{{--                                <option value="14">14</option>--}}
{{--                                <option value="15">15</option>--}}
{{--                                <option value="16">16</option>--}}
{{--                                <option value="17">17</option>--}}
{{--                                <option value="18">18</option>--}}
{{--                                <option value="19">19</option>--}}
{{--                                <option value="20">20</option>--}}
{{--                                <option value="21">21</option>--}}
{{--                                <option value="22">22</option>--}}
{{--                                <option value="23">23</option>--}}
{{--                                <option value="24">24</option>--}}
{{--                                <option value="25">25</option>--}}
{{--                                <option value="26">26</option>--}}
{{--                                <option value="27">27</option>--}}
{{--                                <option value="28">28</option>--}}
{{--                                <option value="29">29</option>--}}
{{--                                <option value="30">30</option>--}}
{{--                                <option value="31">31</option>--}}
{{--                            </select>--}}
{{--                            <select name="month" id="input--month">--}}
{{--                                <option value="">Month</option>--}}
{{--                                <option value="January">January</option>--}}
{{--                                <option value="Febuary">Febuary</option>--}}
{{--                                <option value="March">March</option>--}}
{{--                                <option value="April">April</option>--}}
{{--                                <option value="May">May</option>--}}
{{--                                <option value="June">June</option>--}}
{{--                                <option value="July">July</option>--}}
{{--                                <option value="August">August</option>--}}
{{--                                <option value="September">September</option>--}}
{{--                                <option value="October">October</option>--}}
{{--                                <option value="November">November</option>--}}
{{--                                <option value="December">December</option>--}}
{{--                            </select>--}}
{{--                            <select name="month" id="input--month">--}}
{{--                                <option value="">Year</option>--}}
{{--                                <option value="2020">2020</option>--}}
{{--                                <option value="2019">2019</option>--}}
{{--                                <option value="2018">2018</option>--}}
{{--                                <option value="2017">2017</option>--}}
{{--                                <option value="2016">2016</option>--}}
{{--                                <option value="2015">2015</option>--}}
{{--                                <option value="2014">2014</option>--}}
{{--                                <option value="2013">2013</option>--}}
{{--                                <option value="2012">2012</option>--}}
{{--                                <option value="2011">2011</option>--}}
{{--                                <option value="2010">2010</option>--}}
{{--                                <option value="2009">2009</option>--}}
{{--                                <option value="2008">2008</option>--}}
{{--                                <option value="2007">2007</option>--}}
{{--                                <option value="2006">2006</option>--}}
{{--                                <option value="2005">2005</option>--}}
{{--                                <option value="2004">2004</option>--}}
{{--                                <option value="2003">2003</option>--}}
{{--                                <option value="2002">2002</option>--}}
{{--                                <option value="2001">2001</option>--}}
{{--                                <option value="2000">2000</option>--}}
{{--                                <option value="1999">1999</option>--}}
{{--                                <option value="1998">1998</option>--}}
{{--                                <option value="1997">1997</option>--}}
{{--                                <option value="1996">1996</option>--}}
{{--                                <option value="1995">1995</option>--}}
{{--                                <option value="1994">1994</option>--}}
{{--                                <option value="1993">1993</option>--}}
{{--                                <option value="1992">1992</option>--}}
{{--                                <option value="1991">1991</option>--}}
{{--                                <option value="1990">1990</option>--}}
{{--                                <option value="1989">1989</option>--}}
{{--                                <option value="1988">1988</option>--}}
{{--                                <option value="1987">1987</option>--}}
{{--                                <option value="1986">1986</option>--}}
{{--                                <option value="1985">1985</option>--}}
{{--                                <option value="1984">1984</option>--}}
{{--                                <option value="1983">1983</option>--}}
{{--                                <option value="1982">1982</option>--}}
{{--                                <option value="1981">1981</option>--}}
{{--                                <option value="1980">1980</option>--}}
{{--                            </select>--}}
{{--                            <select name="time" id="input--time">--}}
{{--                                <option value="">Time</option>--}}
{{--                                <option value="00:00">12.00 AM</option>--}}
{{--                                <option value="00:30">12.30 AM</option>--}}
{{--                                <option value="01:00">01.00 AM</option>--}}
{{--                                <option value="01:30">01.30 AM</option>--}}
{{--                                <option value="02:00">02.00 AM</option>--}}
{{--                                <option value="02:30">02.30 AM</option>--}}
{{--                                <option value="03:00">03.00 AM</option>--}}
{{--                                <option value="03:30">03.30 AM</option>--}}
{{--                                <option value="04:00">04.00 AM</option>--}}
{{--                                <option value="04:30">04.30 AM</option>--}}
{{--                                <option value="05:00">05.00 AM</option>--}}
{{--                                <option value="05:30">05.30 AM</option>--}}
{{--                                <option value="06:00">06.00 AM</option>--}}
{{--                                <option value="06:30">06.30 AM</option>--}}
{{--                                <option value="07:00">07.00 AM</option>--}}
{{--                                <option value="07:30">07.30 AM</option>--}}
{{--                                <option value="08:00">08.00 AM</option>--}}
{{--                                <option value="08:30">08.30 AM</option>--}}
{{--                                <option value="09:00">09.00 AM</option>--}}
{{--                                <option value="09:30">09.30 AM</option>--}}
{{--                                <option value="10:00">10.00 AM</option>--}}
{{--                                <option value="10:30">10.30 AM</option>--}}
{{--                                <option value="11:00">11.00 AM</option>--}}
{{--                                <option value="11:30">11.30 AM</option>--}}
{{--                                <option value="12:00">12.00 PM</option>--}}
{{--                                <option value="12:30">12.30 PM</option>--}}
{{--                                <option value="13:00">01.00 PM</option>--}}
{{--                                <option value="13:30">01.30 PM</option>--}}
{{--                                <option value="14:00">02.00 PM</option>--}}
{{--                                <option value="14:30">02.30 PM</option>--}}
{{--                                <option value="15:00">03.00 PM</option>--}}
{{--                                <option value="15:30">03.30 PM</option>--}}
{{--                                <option value="16:00">04.00 PM</option>--}}
{{--                                <option value="16:30">04.30 PM</option>--}}
{{--                                <option value="17:00">05.00 PM</option>--}}
{{--                                <option value="17:30">05.30 PM</option>--}}
{{--                                <option value="18:00">06.00 PM</option>--}}
{{--                                <option value="18:30">06.30 PM</option>--}}
{{--                                <option value="19:00">07.00 PM</option>--}}
{{--                                <option value="19:30">07.30 PM</option>--}}
{{--                                <option value="20:00">08.00 PM</option>--}}
{{--                                <option value="20:30">08.30 PM</option>--}}
{{--                                <option value="21:00">09.00 PM</option>--}}
{{--                                <option value="21:30">09.30 PM</option>--}}
{{--                                <option value="22:00">10.00 PM</option>--}}
{{--                                <option value="22:30">10.30 PM</option>--}}
{{--                                <option value="23:00">11.00 PM</option>--}}
{{--                                <option value="23:30">11.30 PM</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="login__form_action_container login__form_action_container--multiple-actions">--}}
{{--                        <a href="javascript:void(0)" class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</a>--}}
{{--                        <a href="consultant-thread.html" class="btn__primary--large from__button--floating" type="submit" aria-label="">Send</a>--}}
{{--                      </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="modal fade" id="upload-background-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Add Background Photo</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{ route('profile.update') }}" enctype="multipart/form-data" method="post">
                        @csrf
                      <div class="form__input--floating photo_upload">
                          <div class="row w-100">
                              <div class="md-col-8">
                                  <input id="background_imageupload" name="banner_pic" type="file"/>
                              </div>
                              <div class="md-col-2">
                                  <span id="background_image_delete" style="display: none"><i class="fa fa-trash"></i></span>
                              </div>
                          </div>


                        <div id="background_image"></div>

                      </div>

                      <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                        <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Upload a photo</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Edit Profile</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <div class="profile-info" id="profile-info" style="background-image: url({{ $banner }}); background-size: cover; background-position: center;">
                        @if(auth()->user()->profile_pic != null)
                                <img src="{{ $profileUrl }}/{{ auth()->user()->profile_pic }}" alt="Profile picture" />
                        @else
                            <img src="{{ asset('assets/img/profile.png') }}" alt="Profile picture" />
                        @endif
                    </div>
                    <form class="login__form popup__form" action="{{ route('profile.update') }}" method="post">
                        @csrf
                      <div class="form__input--floating">
                        <div class="form__input--floating two-column-grid-first">
                            <label class="form__label--floating" id="label--first">First Name </label>
                            <input required id="input--first" type="text" placeholder="" value="{{ auth()->user()->firstname }}" name="firstname">
                        </div>
                        <div class="form__input--floating two-column-grid-second">
                            <label class="form__label--floating" id="label--last">Last Name </label>
                            <input required id="input--last" type="text" placeholder="" value="{{ auth()->user()->lastname }}" name="lastname">
                        </div>
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--session-price">Phone </label>
                        <input id="input--session-price" type="text" value="{{ auth()->user()->phone }}" placeholder="+923120796726" name="phone">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--session-price">Add your skills </label>
                        <input id="skills_input_field" type="text" placeholder="" name="skills">
                        <ul id="skills_search_result" style="height: auto !important; width:100% !important">
                        </ul>
                        <br><br>
                        <button type="button" class="btn btn-primary" id="addNewSkillButton">Add</button>
                        <b>Added:</b>
                          <p id="mySkills">
                            @forelse (auth()->user()->skills()->get() as $skill)
                                  <a class="btn btn-secondary btn-xs d-inline removeSkill" skill_id="{{$skill->id}}" href="javascript:;">{{ $skill->name}} &nbsp; <i class="fas fa-times"></i></a>
                            @empty
                                <p> </p>
                            @endforelse
                          </p>
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--session-price">Add Session Price in USD </label>
                        <input id="input--session-price" type="number" placeholder="" value="{{ auth()->user()->session_price }}" name="session_price">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--headline">Headline </label>
                        <input id="input--headline" type="text" placeholder="" value="{{ auth()->user()->headline }}" name="headline">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--position">Current Position </label>
                        <input id="input--position" type="text" placeholder="" value="{{ auth()->user()->current_position }}" name="current_position">
                      </div>


                      <div class="login__form_action_container login__form_action_container--multiple-actions editprofile-btn">
                        <input type="submit" value="Save" class="btn__primary--large from__button--floating">
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Add Experience</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{ route('experience') }}" method="post">
                      @csrf
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--experience-title">Title </label>
                        <input type="text" id="input--experience-title" placeholder="Ex: Experience Title" name="title" required />
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--emp-type">Employment Type </label>
                        <div class="form__label--dropdown">
                            <select class="mr-0" name="employee_type_id" id="input--emp-type" required>
                                <option selected disabled>Select Employment Type</option>
                                @foreach($employeeTypes as $type)
                                <option value="{{ $type->id }}"> {{  $type->name }} </option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--company">Company </label>
                        <input type="text" id="input--company" placeholder="Enter Company Name" name="company" required />
                      </div>
                      <div class="form__input--floating">
                        <div class="form__label--dropdown row">
                            <div class="col-md-6 paddingleft">
                                <label class="form__label--floating" id="label--experience">Start Date </label>
                                <input type="date"  name="start_date" required />
                            </div>
                            <div class="col-md-6 paddingright">
                                <label class="form__label--floating" id="label--experience">End Date </label>
                                <input type="date"  name="end_date" required />
                            </div>
                        </div>
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--heading">Responsibility </label>
                        <input type="text" id="input--heading" placeholder="Enter your responsibility" required name="responsibility" />
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--heading">Location </label>
                        <input type="text" id="input--heading" placeholder="Enter Work Location" required name="location" />
                      </div>
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="">Currently Working </label>
                            <input style="width: auto;" type="checkbox" id=""  name="currently_working" />
                        </div>
                      <div class="login__form_action_container login__form_action_container--multiple-actions">
                        <button class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</button>
                        <button  id="" class="btn__primary--large from__button--floating" type="submit" aria-label="">Submit</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="EditExperienceModal">
            </div>
        </div>
    </div>

    <div class="modal fade" id="report-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Select a reporting reason:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="" method="post">
                      <div class="form__input--floating billing-cycle reporting-post">
                        <div class="payment-plans">
                            <span>
                                <input type="radio" name="report-posts" value="">
                                <label>Suspicious or fake</label>
                            </span>
                        </div>
                        <div class="payment-plans">
                            <span>
                                <input type="radio" name="report-posts" value="">
                                <label>Harassment or hateful speech</label>
                            </span>
                        </div>
                        <div class="payment-plans">
                            <span>
                                <input type="radio" name="report-posts" value="">
                                <label>Violence or physical harm</label>
                            </span>
                        </div>
                        <div class="payment-plans">
                            <span>
                                <input type="radio" name="report-posts" value="">
                                <label>Adult content</label>
                            </span>
                        </div>
                        <div class="payment-plans">
                            <span>
                                <input type="radio" name="report-posts" value="">
                                <label>Intellectual property infringement or defamation</label>
                            </span>
                        </div>
                      </div>
                      <div class="login__form_action_container login__form_action_container--multiple-actions">
                        <button class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</button>
                        <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Submit</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Add Profile Photo</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="form__input--floating photo_upload">
                        <div class="row w-100">
                            <div class="md-col-8">
                                <input id="fileUpload" name="profile_photo" type="file"/>
                            </div>
                            <div class="md-col-2">
                                <span id="background_profile_pic_delete" style="display: none"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>

                        <div id="image-holder"></div>


                      </div>

                      <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                        <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Upload a photo</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Consultation Payment</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form" action="" method="post">
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--fname">First Name </label>
                        <input id="input--fname" type="text" placeholder="" name="fname">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--lname">Last Name </label>
                        <input id="input--lname" type="text" placeholder="" name="lname">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--card">Credit or debit card number </label>
                        <input id="input--card" type="text" placeholder="" data-inputmask="'mask': '9999 9999 9999 9999'" name="card">
                      </div>
                      <div class="form__input--floating two-column-grid-first">
                        <label class="form__label--floating" id="label--expiration">Expiration date </label>
                        <input id="input--expiration" type="text" placeholder="" data-inputmask="'alias': 'date'" name="expiration">
                      </div>
                      <div class="form__input--floating two-column-grid-second">
                        <label class="form__label--floating" id="label--security">Security code </label>
                        <input id="input--security" type="text" placeholder="" name="security">
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--postal">Postal code </label>
                        <input id="input--postal" type="text" placeholder="" name="postal">
                      </div>

                      <div class="login__form_action_container login__form_action_container--multiple-actions">
                        <a href="" class="btn__primary--large from__button--floating" type="submit" aria-label="">Confirm</a>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-introduction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="exampleModalLongTitle">Edit Introduction</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="content">
                  <form class="login__form popup__form" action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--company">Company </label>
                      <input id="input--session-company" type="text" value="{{ auth()->user()->recent_company }}" placeholder="Enter Company Name" name="recent_company">
                    </div>
                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--city">Work location </label>
                      <input id="input--city" type="text" value="{{ auth()->user()->work_location }}" placeholder="Enter wok location" name="work_location">
                    </div>

                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--industry">Industry </label>
                      <input id="input--industry" type="text" value="{{ auth()->user()->industry }}" placeholder="Type of Industry" name="industry">
                    </div>
                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--main-industry">Industry Sub Category </label>
                      <input id="input--main-industry" type="text" value="{{ auth()->user()->sub_industry }}" placeholder="Industry Sub Category" name="sub_industry">
                    </div>
                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--education">Education </label>
                      <textarea id="input--education" type="text" placeholder="" value="{{ auth()->user()->education }}" name="education">{{ auth()->user()->education }}</textarea>
                    </div>

                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--country">Home Country </label>
{{--                      <input id="input--country" type="text" placeholder="" value="{{ auth()->user()->country }}"  name="country">--}}
                        <div class="form__label--dropdown">
                            <select class="mr-0" name="country" id="input--emp-type" required>
                                <option>Select Country</option>
                                @foreach($countries as $country)
                                    @if($country->id == auth()->user()->country)
                                    <option selected value="{{ $country->id }}"> {{  $country->name }} </option>
                                    @else
                                    <option value="{{ $country->id }}"> {{  $country->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form__input--floating">
                      <label class="form__label--floating" id="label--location">Home Location </label>
                      <input id="input--location" type="text" placeholder="" value="{{ auth()->user()->city }}" name="city">
                    </div>

                    <div class="login__form_action_container login__form_action_container--multiple-actions editprofile-btn">
                      {{-- <a href="profile.html" class="btn__primary--large from__button--floating" type="submit" aria-label="">Save</a> --}}
                      <input type="submit" class="btn__primary--large from__button--floating" value="Save">
                    </div>
                  </form>
              </div>
            </div>
          </div>
      </div>
  </div>



<script>

</script>

  @include('custom.inc.chatWidget')
  @include('custom.inc.pushNotifications')
  @include('custom.inc.editPostModals')

@endsection
