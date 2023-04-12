@if (\Session::has('success'))
<div class="alert alert-success" style="text-align:center">
    {!! \Session::get('success') !!}
</div>
@elseif(\Session::has('error'))
<div class="alert alert-danger" style="text-align:center;">
    {!! \Session::get('error') !!}
</div>
@endif