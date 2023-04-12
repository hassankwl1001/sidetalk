@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')


<div style="padding-top:100px;">
    <div class="balance">
        <span class="usdEarned">$ {{ $usdEarned }}</span>
        <p>Your Available Balance</p>
        <br>
        <p class="text-dark">Total balance paid : $ {{$total_paid}} </p>
        <a href="{{ route('withdrawal') }}" class="btn btn-info">Withdraw</a>
    </div>




    <div class="card-header">
        <i class="fa fa-table"></i> Consultations
    </div>

    <div class="table-responsive" >
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Profile</th>
            <th scope="col">date</th>
            <th scope="col">time</th>
            <th scope="col">type</th>
            <th scope="col">description</th>
{{--            <th scope="col">Verify</th>--}}
                <th scope="col">Status</th>
            <th scope="col">Price</th>
            <th scope="col">Join</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($engagement as $engagement)
            @php
                if($engagement->consultFrom->id == auth()->id()){
                    $user = $engagement->consultWith;
                }else{
                    $user = $engagement->consultFrom;
                }

            @endphp
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="@if($user->profile_pic !=null){{ $profileUrl }}/{{ $user->profile_pic }} @else {{asset('assets/img/profile.png')}} @endif" class="img-size"> <a href="{{ route('user.profile.show', $user->id) }}">{{ $user->firstname }} {{  $user->lastname }}</a></td>
                <td>{{ $engagement->date }}</td>
                <td>{{ $engagement->time }}</td>
                <td>{{ $engagement->consult_type }}</td>
                <td>{{ $engagement->desc }}</td>
{{--                <td> @if($engagement->is_approved == 0)--}}
{{--                            @if($engagement->consult_from == auth()->id())--}}
{{--                                <a href="{{route('engagements.verify',$engagement->id)}}" class="btn btn-success">Verify</a>--}}
{{--                            @else--}}
{{--                                <a href="#" class="btn btn-success disabled">Pending</a>--}}
{{--                            @endif--}}
{{--                        @elseif($engagement->is_approved == 1)--}}
{{--                            <a href="#" class="btn btn-success disabled">Approved</a>--}}
{{--                        @endif--}}
{{--                </td>--}}
                <td>{{ $engagement->is_accepted == 1 ? "Accepted" : "Rejected" }}</td>
                <td>$ {{ $engagement->actual_payment_earned }}</td>
                <td> <a href="{{route('user.calling',$engagement->meeting_id)}}" class="btn btn-primary @if($engagement->is_accepted != 1) disabled @endif">Join</a></td>
            </tr>
            @empty
            No Consultation
            @endforelse

        </tbody>
        </table>
    </div>
</div>
