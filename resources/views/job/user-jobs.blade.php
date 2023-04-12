@extends('custom.layouts.app')
@section('content')
    @include('custom.inc.loading')
    @include('custom.inc.header')
    <div class="jumbotron" style="background-color: #f5f5f5">
        <h1 class="m-3 text-center">My Jobs</h1>
    </div>
    <section class="tag-list searchjob-lists clearfix" style="margin: 0;">
        <div class="container default-container">
            <div class="row marginleftright">
                <div class="col-12 paddingleftright">

                    <ul>
                        @forelse ($posts as $job)
                            <li>

                                    <div class="hashtag job-lists">
                                        <a href="{{ route('job.detail', $job->id) }}" >
                                        <img class="job-logo" style="height: 180px; width: 100%;" src="{{ $urlPost }}/{{ $job->postMedia[0]->name }}" alt="">
                                        <h3>{{ $job->jobs->job_title }}</h3>
                                        <span>{{ $job->jobs->company }}</span>
                                        <span>{{ $job->jobs->location }}</span>
                                        {{-- <div class="viewjob-connections">
                                            <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                                            <p>1 Connection</p>
                                        </div> --}}
                                        </a>
                                        <hr/>
                                        <span>{{ $job->created_at->diffForHumans() }} . <a id="job-applicants" href="javascript:void(0);" job-id="{{$job->id}}" ><span class="color-green">{{count($job->applicants)}} applicants</span></a></span>
                                    </div>

                            </li>
                        @empty
                            <p style="text-align: center">No Job Found</p>
                        @endforelse

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Applicants</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body applicants-section">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function (){

            $(document).on("click","#job-applicants",function (){

                var job_id = $(this).attr("job-id");

                // alert(job_id);

                $.ajax({
                    url:"{{url('job/getJobApplicants')}}"+"/"+job_id,
                    method:"GET",
                    success:function (data){
                        $(".applicants-section").html("");
                        $(".applicants-section").html(data);
                        $("#exampleModal").modal("show");
                    }
                });

            });
        });
    </script>
@endsection
