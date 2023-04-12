@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<div style="padding-top:100px;">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Filter
        </div>
        {{-- <form method="POST" action="#"> --}}
            <input type="hidden" name="_token" value="64cx9DthVEm2atcDFQmrEIDqiaTZMQkMmsx1CGIU">            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="fromDate">Date From</label>
                        <input type="date" name="created_at" id="fromDate" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="toDate">Date To</label>
                        <input type="date" name="date_to" id="toDate" class="form-control">
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-4">
                    <select class="form-control" name="gender">
                        <option disabled="disabled" selected="selected">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="conficted_felony">
                            <option disabled="disabled" selected="selected">Have you been convicted of a felony?</option>
                            <option value="Male">Yes</option>
                            <option value="Female">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <select class="form-control" name="culture">
                        <option disabled="disabled" selected="selected">What culture/ethnicity do you identify as?</option>
                        <option value="Black or African American">Black or African American</option>
                        <option value="Latino (Not Black)">Latino (Not Black)</option>
                        <option value="Asian">Asian</option>
                        <option value="Asian (Not Pacific)">Asian (Not Pacific)</option>
                        <option value="White">White</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                        <select name="is_high_school_graduated" class="form-control">
                            <option disabled="disabled" selected="selected">High school graduated?</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <select name="income" class="form-control">
                            <option disabled="disabled" selected="selected">What is your household income?</option>
                            <option value="less than $20,000">less than $20,000</option>
                            <option value="$20,001 to $50,000">$20,001 to $50,000</option>
                            <option value="$50,001 to 80,000">$50,001 to 80,000</option>
                            <option value="$80,001 or more">$80,001 or more</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="total_household_people" class="form-control">
                            <option disabled="disabled" selected="selected">How many people are in your household?</option>
                            <option value="less than 2">less than 2</option>
                            <option value="2 to 6">2 to 6</option>
                            <option value="More than 6">More than 6</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <select name="is_disabled" class="form-control">
                            <option disabled="disabled" selected="selected">Do you consider yourself a person with a disability?</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="is_active_military" class="form-control">
                            <option disabled="disabled" selected="selected">Are you actively in the US Military?</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <select name="age_range" class="form-control">
                            <option disabled="disabled" selected="selected">Select Age Range</option>
                            <option value="18,24">18-24</option>
                            <option value="25,36">25-36</option>
                            <option value="37,54">25-36</option>
                            <option value="55,70">55-70</option>
                            <option value="71,200">Above 70</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="program_id" class="form-control" required="">
                            <option value="">Select Program</option>
                                                                    <option value="11">TANF</option>
                                                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="postcode" class="form-control" placeholder="Enter Postcode">
                    </div>
                </div> --}}
<br>
                <input type="submit" class="btn btn-primary" value="Filter">
            </div>
        {{-- </form> --}}
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
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Type</th>
            <th scope="col">Description</th>
            <th scope="col">Verify</th>
            <th scope="col">Acceptance</th>
            <th scope="col">J oin</th>
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
                <td> @if($engagement->is_approved == 0)
                            @if($engagement->consult_from == auth()->id())
                                <a href="{{route('engagements.verify',$engagement->id)}}" class="btn btn-success">Verify</a>
                            @else
                                <a href="#" class="btn btn-success disabled">Pending</a>
                            @endif
                        @elseif($engagement->is_approved == 1)
                            @if($engagement->consult_from == auth()->id())
                                <a href="#" class="btn btn-success disabled">Approved</a>
                            @else
                                <a href="#" class="btn btn-success disabled">Approved</a>
                            @endif
                        @endif
                </td>
                {{-- <td>
                    @if($engagement->is_approved == 0)
                        Pending
                    @elseif($engagement->is_approved == 1)
                        Approved
                    @endif
                </td> --}}
                <td>
                    @if($engagement->is_accepted == 0)
                        Pending
                    @elseif($engagement->is_accepted == 1)
                        Accepted
                    @elseif($engagement->is_accepted == -1)
                        Canceled
                    @endif
                </td>
                <td> <a href="{{route('user.calling',$engagement->meeting_id)}}" class="btn btn-primary @if($engagement->is_accepted != 1) disabled @endif">Join</a></td>
            </tr>
            @empty
            No Consultation
            @endforelse

        </tbody>
        </table>
    </div>
</div>
