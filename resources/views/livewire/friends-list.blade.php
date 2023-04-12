<div>
    @foreach ($friends as $friend)

        <li class="messages-lists">
            <figure >
                <img class="img-size" src="{{ $friend->sender->profile_pic != null ? $profileUrl.$friend->sender->profile_pic : asset('assets/img').'/profile.png' }}" alt="">
            </figure>

            <div class="box-commented">
                <a href="{{route('user.profile.show',$friend->sender->id)}}">

                    <div class="commented-description">
                        <strong class="post_name">{{ $friend->sender == null ? $friend->sender->firstname." ". $friend->sender->lastname : 'N/A' }}</strong>
                    </div>
                    <span class="designation">{{ $friend->sender->current_position != null ?  $friend->sender->current_position : 'No designation'}}</span>
                </a>

            </div>


        </li>
    @endforeach
</div>
