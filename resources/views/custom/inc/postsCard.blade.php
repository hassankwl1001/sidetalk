<div class="share-box" id="share-box">

    <form action="{{ route('post.store') }}" method="post">
        @csrf

    <div class="profile-box">

        @if(auth()->user()->profile_pic != null)
             <img src="{{ $urlProfile }}/{{ auth()->user()->profile_pic }}" alt="Profile picture" />
        @else
             <img src="{{ asset('assets/img/profile.png') }}" alt="Profile picture" />
        @endif
            <input type="hidden" name="privacy" value="Public">
            <input type="hidden" name="post_type" value="Article">


            <div class="search-profile">
            <input class="form-control" type="text" name="description" required placeholder="Share you skills, thoughts and achievements">
        </div>
    </div>
    <div class="button-box" id="button-box">
        <div class="top-search-icons">
            <a data-toggle="modal" data-target="#write-article" href="javascript:void(0)" id="btn-article">
                <i class=" fas fa-file-alt"></i>
                <span>Article</span>
            </a>
            <a data-toggle="modal" data-target="#upload-photo" href="javascript:void(0)" id="btn-picture">
                <i class="fas fa-camera-retro"></i>
                <span>Photo</span>
            </a>
            <a data-toggle="modal" data-target="#upload-video" href="javascript:void(0)" href="" id="btn-video">
                <i class="fas fa-video"></i>
                <span>Video</span>
            </a>
            @if(Route::current()->getName() == 'group.detail')
            <a  href="javascript:void(0)" id="btn-job">
                <i class="fas fa-briefcase"></i>
                <span>Job</span>
            </a>
            @else
                <a data-toggle="modal" data-target="#create-job" href="javascript:void(0)" id="btn-job">
                    <i class="fas fa-briefcase"></i>
                    <span>Job</span>
                </a>
            @endif
        </div>
        <div class="right">
            <button type="submit" class="postButton">
                Post
            </button>
        </div>
    </div>

    </form>

</div>
