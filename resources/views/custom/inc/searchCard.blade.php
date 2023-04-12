<div class="share-box" id="share-box">

    <form >
      
    <div class="profile-box">

        @if(auth()->user()->profile_pic != null)
             <img src="{{ $urlProfile }}/{{ auth()->user()->profile_pic }}" alt="Profile picture" />
        @else
             <img src="{{ asset('assets/img/profile.png') }}" alt="Profile picture" />
        @endif
            <div class="search-profile">
            <input class="form-control" value="{{request('discover')}}" type="text" id="discover" name="discover" required placeholder="discover...">
        </div>
    </div>
    <div class="text-right">
        <div class="right">
            <button type="button" class="postButton border-0 border-none p-1 discover_posts1">
                Discover
            </button>
        </div>
    </div>

    </form>

</div>
