@extends('custom.layouts.app')
@section('content')


@include('custom.inc.loading')
  @include('custom.inc.header')
  <!-- MAIN CONTAINER -->
    <!-- MAIN CONTAINER -->

    @php
        function turnUrlIntoHyperlink($string){
            //The Regular Expression filter
            $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

            // Check if there is a url in the text
            if(preg_match_all($reg_exUrl, $string, $url)) {

                // Loop through all matches
                foreach($url[0] as $newLinks){
                    if(strstr( $newLinks, ":" ) === false){
                        $link = 'http://'.$newLinks;
                    }else{
                        $link = $newLinks;
                    }

                    // Create Search and Replace strings
                    $search  = $newLinks;
                    $replace = '<a href="'.$link.'" title="'.$newLinks.'" target="_blank">'.$link.'</a>';
                    $string = str_replace($search, $replace, $string);
                }
            }

            //Return result
            return $string;
        }
    @endphp

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
                            <span>Filters</span>
                        </header>

                        <input type="radio" id="Posts"  @if(request('filter_type')=='Posts') checked @endif class="discover_posts" name="filter_type" value="Posts">
                         <label for="html">Posts</label><br>
                         <input type="radio" id="Jobs" @if(request('filter_type')=='Jobs') checked @endif class="discover_posts" name="filter_type" value="Jobs">
                         <label for="Jobs">Jobs</label><br>
                    </section>
{{--                    <a class="discover-more" id="discoverMore" href="{{route('group.all')}}">Discover more</a>--}}
                </div>
            </aside>
        </div>
        <!-- MAIN -->
        <div id="main-wrapper">
            <main class="main-section" id="main-section">

                @include('custom.inc.searchCard')

                @include('custom.inc.alerts')

                @forelse($posts as $post)

                  <article data-post="{{ $post->id }}" class="post-article">
                      <!-- post header -->
                      <div class="post-author">
                          @if ($post->user_id == auth()->id())
                            <a href="{{ route('profile') }}">
                          @else
                            <a href="{{ route('user.profile.show', $post->user_id) }}">
                          @endif

                              <div class="author-details">
                                  <figure class="image-container">
                                      @if($post->user->profile_pic != null)
                                          <img class="img-size" src="{{ $urlProfile }}/{{ $post->user->profile_pic }}" alt="">
                                      @else
                                          <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                      @endif


                                          @if($post->user->isOnline() == true)
                                              <span class="logged-in" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: #5BE38F;">●</span>
                                          @elseif($post->user->isOnline() != true)
                                              <span class="logged-out" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: darkgray;">●</span>
                                          @endif

                                  </figure>
                                  <div class="author-description">
                                      <div class="post-name-experience">
                                          <strong class="post-author-name">{{ $post->user->firstname }} {{ $post->user->lastname }}</strong>
                                          <span>
                                              <span>&nbsp;·&nbsp;</span>
                                              {{ $post->user->experience }}Y Exp</span>
                                          <span class="green_slot">J</span>
                                      </div>
                                      <span class="designation">
                                          @if($post->user->is_student == 1) Student |@endif
                                          {{ $post->user->current_position }}
                                      </span>
                                      <span class="time-ago">{{ $post->created_at->diffForHumans() }}</span>
                                  </div>
                              </div>
                          </a>
{{--                                @dd(auth()->user()->getSubscription() != null)--}}
                          <div class="consult-btn">
                            @if($post->user->id != auth()->id() && $post->user->session_price !=null)
                                @if(auth()->user()->getSubscription() != null)
                                <button class="open_consultation" data-user="{{ $post->user->id }}"><img src="assets/img/camera.png" alt="">Consult</button>
                                  @else
                                <button type="button" data-toggle="modal" data-target="#subscription" ><img src="assets/img/camera.png" alt="">Consult</button>
                                 @endif
                            @endif
                          </div>
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
                                          <li><a href="javascript:void(0)" class="save-post" data-post="{{$post->id}}"><i class="fas fa-save" aria-hidden="true"></i> Save <span class="dropdown-edit">Save for later</span></a></li>
                                          <li><a href=""><i class="fa fa-copy" aria-hidden="true"></i> Copy link to post</a></li>
                                          {{-- <li><a href=""><i class="fas fa-volume-mute" aria-hidden="true"></i> Mute Usman Rahim <span class="dropdown-edit">Stop seeing post for Usman</span></a></li>
                                          <li><a href=""><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Leave this group<span class="dropdown-edit">Stop seeing post for this group</span></a></li>
                                          <li><a href="" data-toggle="modal" data-target="#report-post"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Report this post<span class="dropdown-edit">This post is offensive or account is hacked</span></a></li> --}}
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
                                {!! turnUrlIntoHyperlink($post->description) !!}
                                {{-- {{ $post->description }} --}}
                            </p>
                            <p class="post-translation">
                                <a href="{{route('discover')}}?hashtags={{preg_replace("/#/i", "", $post->hashtags)}}"><button>{{$post->hashtags}}</button></a>

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
                                <a href="{{route('discover')}}?hashtags={{preg_replace("/#/i", "", $post->hashtags)}}"><button>{{$post->hashtags}}</button></a>

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
                                    @if($post->user_id != auth()->user()->id)
                                        <a class="btn-primary" href="{{ route('job.detail', $post->id) }}">Apply now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                     @elseif($post->postType->name == 'Shared')
                        <p style="margin-left: 10%;">{{ $post->description }}</p>
                        <div class="job-post-data">
                               <!-- post header -->
                                <div class="post-author">
                                    @if ($post->user_id == auth()->id())
                                        <a href="{{ route('profile') }}">
                                    @else
                                        <a href="{{ route('user.profile.show', $post->user_id) }}">
                                    @endif
                                        <div class="author-details">
                                            <figure class="image-container">
                                                @if($post->shared->user->profile_pic != null)
                                                    <img class="img-size" src="{{ $urlProfile }}/{{ $post->shared->user->profile_pic }}" alt="">
                                                @else
                                                    <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                                @endif

                                                    @if($post->shared->user->isOnline() == true)
                                                        <span class="logged-in" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: #5BE38F;">●</span>
                                                    @elseif($post->shared->user->isOnline() != true)
                                                        <span class="logged-out" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: darkgray;">●</span>
                                                    @endif

                                            </figure>
                                            <div class="author-description">
                                                <div class="post-name-experience">
                                                    <strong class="post-author-name">{{ $post->shared->user->firstname }} {{ $post->shared->user->lastname }}</strong>
                                                    <span>
                                                        <span>&nbsp;·&nbsp;</span>
                                                        {{ $post->shared->user->experience }} Y Exp</span>
                                                    <span class="green_slot">J</span>
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
                                                @if($post->user_id != auth()->user()->id)
                                                    <a class="btn-primary" href="{{ route('job.detail', $post->id) }}">Apply now</a>
                                                @endif
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
                              {{-- <span class="amount-info">128 Views</span> --}}
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
                                  <span class="counter"><i class="fas fa-paper-plane "></i></span>
                                  <span class="post-send">Send</span>
                              </button>
                          </div>
                      </div>
                      <!-- /post interactions -->

                      <!-- add new comment -->
                      <div class="post-input">
                          <div class="input-section">
                              <figure class="image-container">
                                  @if(auth()->user()->profile_pic != null)
                                    <img class="img-size" src="{{ $urlProfile }}/{{ auth()->user()->profile_pic }}" alt="">
                                 @else
                                    <img class="img-size" src="{{ asset('assets/img/profile.png') }}" alt="">
                                 @endif


{{--                                      @if(auth()->user()->isOnline() == true)--}}
{{--                                          <span class="logged-in" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: #5BE38F;">●</span>--}}
{{--                                      @elseif(auth()->user()->isOnline() != true)--}}
{{--                                          <span class="logged-out" style="position: relative; top: 15px; right: 19px; font-size: 21px; color: darkgray;">●</span>--}}
{{--                                      @endif--}}
                              </figure>
                              <div class="input-portion">
                                  <div>
                                      <input class="form-control reflection" type="text" placeholder="Add a reflection">
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
                              <ul class="group-list reflection-list" >
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
                                                  <span class="post_designation">
                                                      <span>&nbsp;·&nbsp;</span>
                                                        {{ $reflection->user->experience }}Y Exp
                                                    </span>
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

                  @empty
                  <p style="text-align:center">No post found</p>
                @endforelse

            </main>
        </div>
        <!-- RIGHT ASIDE -->
    </div>
@if(auth()->user()->getSubscription() != null)
@include('custom.inc.consultationModal')
@else
@include('custom.inc.subscriptionModal')
@endif
    @include('custom.inc.postsCardModels')


    <!-- Post Report -->
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


    <!-- Chat box -->
    @include('custom.inc.chatWidget')

    @include('custom.inc.mediaDisplayModal')
    @include('custom.inc.pushNotifications')
    @include('custom.inc.editPostModals')

    @endsection
