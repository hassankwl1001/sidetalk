@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<section class="create-page inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-md-12">
                <div class="create-page-section">
                    <form class="page__form" action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="page__identity">
                          <h3>Create Group</h3>

                          <div class="form__input--floating">
                            <label class="form__label--floating" id="label--tagline">Group Name </label>
                            <input id="input--tagline" type="text" placeholder="" name="name" required/>
                          </div>
                          <div class="form__input--floating">
                            <label class="form__label--floating" id="label--tagline">About Group</label>
                            <textarea id="input--tagline" type="text" placeholder="" name="about" required></textarea>
                          </div>
                           <div class="">
                               <label class="form__label--floating" id="label--tagline">Private</label>
                               <input type="checkbox" name="is_private" id="is_private" class="" value="1">
                           </div>
                           <div class="upload-preview">
                            <label class="form__label--floating" id="label--logo">Logo </label>
                            <input id="input--logo" type="file" placeholder="" name="log" required>
                            <label class="form__label--floating">recommended. JPGs, JPEGs, and PNGs supported.</label>
                          </div>
                          <div class="upload-preview">
                            <label class="form__label--floating" id="label--logo">Banner </label>
                            <input id="input--logo" type="file" placeholder="" name="ban" required>
                            <label class="form__label--floating">recommended. JPGs, JPEGs, and PNGs supported.</label>
                          </div>
                      </div>

                      <div class="login__form_action_container login__form_action_container--multiple-actions">
                        <input type="submit" class="btn btn-page btn__primary--large from__button--floating" value="Create Group">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('custom.inc.chatWidget')


@endsection
