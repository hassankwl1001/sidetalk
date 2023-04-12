@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

@include('custom.inc.alerts')
<section class="tag-section inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 tag-count">
                <h6>Group Search </h6>
                <form>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form__input--floating">
                                <label class="form__label--floating" id="label--text">Group Search </label>
                                <div class="search-jobs">
                                    <i class="fas fa-search"></i>
                                    <input required id="input--text" value="{{request('search')}}" type="text" placeholder="Search by title or keyword" name="search">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button class="btn__primary--large from__button--floating">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@if(request()->has("search") && request("search") != "")
    <div class="container default-container inner-padding-top" style="margin-top: 10px;">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <a class="btn btn-outline-success m-2" href="{{route("group.list")}}">{{request("search")}} <i class="fas fa-times"></i></a>
                <a class="btn btn-outline-success m-2" href="{{route("group.list")}}">Reset</a>
            </div>
        </div>
    </div>
@endif
<section class="group-list inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <a href="{{ route('group.create') }}" class="btn btn-info" style="float: right;">Create Group</a>
                <div class="section-heading">
                    <h3>Your Groups</h3>
                </div>
            </div>
            <div class="col-12 paddingleftright">
                <div class="group-lists">
{{--                    {{dd($groups)}}--}}

                    @forelse ($groups as $group)
                    <div class="group-section">
                        <figure>
                            <img src="{{ $url }}/{{ $group->profile_pic }}" alt="" width="50" height="50">
                        </figure>
                        <div class="group-name">
                            <a href="{{ route('group.detail', $group->id) }}">{{ $group->name }}</a>
                            <p>{{ $group->members_count }} members</p>
                            <p>
                                @php
                                  $group_admins =  $group->groupAdmins->pluck("id")->toArray();
                                  if(in_array(auth()->user()->id,$group_admins)){
                                       echo "<span class='text-success'>Admin</span>";
                                   }
                                @endphp

                            </p>
                        </div>
                        <div class="vertical-icons">
                            <span class="fas fa-circle" aria-hidden="true"></span>
                            <span class="fas fa-circle" aria-hidden="true"></span>
                            <span class="fas fa-circle" aria-hidden="true"></span>
                            <div class="notifications-signs">
                                <ul>
                                    <li><a href=""><i class="far fa-copy"></i> Copy the link</a></li>
                                    @if(in_array(auth()->user()->id,$group_admins))
                                        <li><a href=""><i class="fas fa-trash"></i> Delete the group</a></li>
                                    @else
                                        <li><a href=""><i class="fas fa-sign-out-alt"></i> Leave the group</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p>No Group</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>


@include('custom.inc.chatWidget')


@endsection
