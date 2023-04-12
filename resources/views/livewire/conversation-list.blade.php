<div>
    @foreach ($conversations as $conversation)

        <li class="messages-lists">
            <figure>
                <img class="img-size"
                     src="{{ $conversation->profile_pic != null ? $profileUrl.$profile_pic : asset('assets/img').'/profile.png' }}"
                     style="height: 50px;width: auto;"   alt="">
            </figure>

            <div class="box-commented">
                <a href="{{route('inbox',$conversation->sender == null ? $conversation->receiver->id : $conversation->sender->id)}}">

                    <div class="commented-description">
                        <strong
                            class="post_name">{{ $conversation->sender == null ? $conversation->receiver->firstname." ". $conversation->receiver->lastname : $conversation->sender->firstname." ". $conversation->sender->lastname }}</strong>
                    </div>
                    @if(isset($conversation->messages[0]))
                        <span style="color: gray;font-size: 12px">{{ $conversation->messages[0]->text}}</span>
                    @endif
{{--                    <span--}}
{{--                        class="designation">{{ $conversation->current_position != null ?  $conversation->current_position : 'No designation'}}</span>--}}
                </a>
            </div>
        </li>
    @endforeach
</div>
