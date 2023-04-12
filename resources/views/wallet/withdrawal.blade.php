@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<div style="padding-top:100px;">

    @include('custom.inc.alerts')

    <h4>Select Ebank</h4>
    <div class="card-header">
        <i class="fa fa-table"></i> Ebanks
        <button style="float: right" type="button" data-toggle="modal" data-target="#addEbank" class="btn btn-primary">Add New</button>
    </div>
<form action="{{ route('withdrawalRequest') }}" method="POST">
    @csrf
    <div class="table-responsive" >
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Select</th>
            <th scope="col">Name</th>
            <th scope="col">email</th>
            <th scope="col">Added</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userEbanks as $ebank)
            <tr>
                <th scope="row"><input type="radio" name="withdraw" value="{{ $ebank->id }}" required></th>
                <td>{{ $ebank->ebank->ebank_name }}</td>
                <td>{{ $ebank->email }}</td>
                <td>{{ $ebank->created_at->diffForHumans() }}</td>
                <td><a href="#" class="btn btn-danger">Remove</a></td>
            </tr>
            @empty
            <p style="text-align: center">No Ebank</p>
            @endforelse

        </tbody>
        </table>
    </div>

    <input type="submit" class="btn btn-default withdraw-btn" @if ($usdEarned <= 1) disabled @endif value="Withdraw">
</form>

    <hr>
    <div class="card-header">
        <i class="fa fa-table"></i> Withdrawals
    </div>

    <div class="table-responsive" >
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">eBank</th>
            <th scope="col">email</th>
            <th scope="col">price</th>
            <th scope="col">date</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($withdrawal_history as $withdrawal)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $withdrawal->userEbank->ebank->ebank_name }}</td>
                <td>{{ $withdrawal->userEbank->email }}</td>
                <td>{{ $withdrawal->price }}</td>
                <td>{{ $withdrawal->created_at }}</td>
                <td> @if($withdrawal->is_approved == 0)
                        <a href="#" class="btn btn-info disabled">Pending</a>
                    @elseif($withdrawal->is_approved == 1)
                        <a href="#" class="btn btn-success disabled">Approved</a>
                    @elseif($withdrawal->is_approved == -1)
                        <a href="#" class="btn btn-success disabled">Declined</a>
                    @endif
                </td>
            </tr>
            @empty
            <p style="text-align: center">No Withdrawal</p>
            @endforelse

        </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="addEbank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Add eBank</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" id="payment-form" action="{{ route('addEbank') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <select name="id" class="form-control">
                            <option value="">Select your eBank</option>
                            @foreach ($ebanks as $ebank)
                                <option value="{{ $ebank->id }}"> {{ $ebank->ebank_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Enter your Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Add">
                </form>
            </div>
          </div>
        </div>
    </div>
</div>


