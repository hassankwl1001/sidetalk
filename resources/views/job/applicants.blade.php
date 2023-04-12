<div class="row">
@forelse($applicants as $applicant)

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <a href="{{url('/user/profile')}}/{{$applicant->id}}" style="text-decoration: none;">
                <div class="card">
                    <div class="card-body">
                        @if($applicant->profile_pic != null)
                             <img style="width: 100%; height: 80px;" src="{{url('/')}}/storage/app/media/{{$applicant->profile_pic}}" alt="">
                        @else
                            <img style="width: 100%; height: 80px;" src="{{ ('assets/img/profile.png') }}" alt="Profile picture" />
                        @endif
                        <p style="margin-top: 10px;">{{$applicant->firstname}}  {{$applicant->lastname}}</p>
                    </div>
                </div>
            </a>
        </div>

@empty

    <p class="m-5 text-center">No Applicants</p>

@endforelse
</div>