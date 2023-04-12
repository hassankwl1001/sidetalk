@extends('custom.layouts.app')
@section('content')
    @include('custom.inc.loading')
    @include('custom.inc.header')

    <section class="create-page inner-padding-top">
        <div class="container default-container">
            <div class="row marginleftright">
                <div class="col-md-12">
                    <div class="create-page-section">
                        <form class="page__form" action="{{ route('page.store') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="page__identity">
                                <h3>Page Identity</h3>
                                <div class="form__input--floating">
                                    <label class="form__label--floating" id="label--name">Name <span>*</span></label>
                                    <input id="input--name" type="text" placeholder="" name="name" required>
                                </div>
                                <p>Skiledtalk public URL</p>
                                <div class="form__input--floating">
                                    <div class="row company_url">
                                        <label class="col-md-4 form__label--floating" id="label--company">skiledtalk.com/company/</label>
                                        <input class="col-md-8" id="input--company" type="text" placeholder=""
                                               name="public_url" required>
                                    </div>
                                </div>
                                <div class="form__input--floating">
                                    <label class="form__label--floating" id="label--website">Website (Optional)</label>
                                    <input id="input--website" type="text"
                                           placeholder="Begin with http:// or https:// or www." name="website">
                                    <label class="form__label--floating">This is a link to your external
                                        website.</label>
                                </div>

                            </div>
                            <div class="page__identity">
                                <h3>Company Details</h3>
                                <div class="form__input--floating" id="industry_selection">
                                    <label class="form__label--floating" id="label--industry">Industry
                                        <span>*</span></label>
                                    <div class="form__label--dropdown">
                                        <select required class="mr-0 dropdown_selector" name="industry" id="input--industry" >
{{--                                            <option>Select Industry</option>--}}
                                            @foreach($industry as $ind)
                                                   <option value="{{$ind->information}}">{{$ind->information}}</option>
                                            @endforeach
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form__input--floating" style="display: none" id="industry_selection_input">
                                    <label class="form__label--floating" id="label--name">Your Industry
                                        <span>*</span></label>
                                    <input id="input--name" type="text" placeholder="enter your industry name"
                                            class="industry-second-input">
                                </div>
                                <div class="form__input--floating" id="company_size_selection">
                                    <label class="form__label--floating" id="label--size">Company Size
                                        <span>*</span></label>
                                    <div class="form__label--dropdown">
                                        <select required class="mr-0" name="company_size" id="input--size" >
{{--                                            <option>Select Company Size</option>--}}
                                            @foreach($company_size as $company)
                                                <option value="{{$company->information}}">{{$company->information}}</option>
                                            @endforeach
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form__input--floating" style="display: none" id="company_size_input">
                                    <label class="form__label--floating" id="label--name">Your Company size
                                        <span>*</span></label>
                                    <input id="input--name" type="text" placeholder="Enter your Company size"
                                           class="company-second-input">
                                </div>
                                <div class="form__input--floating" id="company_type_selection">
                                    <label class="form__label--floating" id="label--type">Company Type
                                        <span>*</span></label>
                                    <div class="form__label--dropdown">
                                        <select required class="mr-0" name="company_type" id="input--type" >
{{--                                            <option>Select Company Type</option>--}}
                                            @foreach($company_type as $type)
                                                <option value="{{$type->information}}">{{$type->information}}</option>
                                            @endforeach
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form__input--floating" style="display: none" id="company_type_input">
                                    <label class="form__label--floating" id="label--name">Your  Company Type
                                        <span>*</span></label>
                                    <input id="input--name" type="text" placeholder="Enter your  Company Type"
                                           class="type-second-input">
                                </div>
                            </div>
                            <div class="page__identity">
                                <h3>Profile Details</h3>
                                <div class="upload-preview">
                                    <label class="form__label--floating" id="label--logo">Logo </label>
                                    <input id="input--logo" type="file" placeholder="" name="log">
                                    <label class="form__label--floating">recommended. JPGs, JPEGs, and PNGs
                                        supported.</label>
                                </div>
                                <div class="upload-preview">
                                    <label class="form__label--floating" id="label--logo">Banner </label>
                                    <input id="input--logo" type="file" placeholder="" name="ban">
                                    <label class="form__label--floating">recommended. JPGs, JPEGs, and PNGs
                                        supported.</label>
                                </div>
                                <div class="form__input--floating">
                                    <label class="form__label--floating" id="label--tagline">Tagline </label>
                                    <input id="input--tagline" type="text" placeholder="" name="tagline" required/>
                                </div>
                                <div class="form__input--floating">
                                    <label class="form__label--floating" id="label--tagline">About </label>
                                    <textarea id="input--tagline" type="text" placeholder="" name="about"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="form__input--floating checkboxlist-page">
                                <input id="input--checklist" type="checkbox" placeholder="" name="checklist" required> I
                                verify that I am an authorized representative of this organization and have the right to
                                act on its behalf in the creation and management of this page. The organization and I
                                agree to the additional terms for Pages.
                            </div>
                            <input type="hidden" name="page_type_id" value="{{ $id }}">
                            <div class="login__form_action_container login__form_action_container--multiple-actions">
                                <input type="submit" class="btn btn-page btn__primary--large from__button--floating"
                                       value="Create page">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('#input--industry').on('change',function(){
                var optionText = $("#input--industry option:selected").text();
                if(optionText =='Other'){

                    $(this).removeAttr("name required");
                    $(".industry-second-input").attr({"name":"industry","required":true});
                    $('#industry_selection').css("display", "none");
                    $('#industry_selection_input').css("display", "block");
                }
            });
            $('#input--size').on('change',function(){
                var optionText = $("#input--size option:selected").text();
                if(optionText =='Other'){
                    $(this).removeAttr("name required");
                    $('.company-second-input').attr({"name":"company_size","required":true});
                    $('#company_size_selection').css("display", "none");
                    $('#company_size_input').css("display", "block");
                }
            });
            $('#input--type').on('change',function(){
                var optionText = $("#input--type option:selected").text();
                if(optionText =='Other'){
                    $(this).removeAttr("name required");
                    $('.type-second-input').attr({"name":"company_type","required":true});
                    $('#company_type_selection').css("display", "none");
                    $('#company_type_input').css("display", "block");
                }
            });
        });
        // $(document).ready(function () {
        //
        //     $('dropdown_selector').change(function() {
        //         //Use $option (with the "$") to see that the variable is a jQuery object
        //         var $option = $(this).find('option:selected');
        //         //Added with the EDIT
        //         var value = $option.val();//to get content of "value" attrib
        //         console.log('working')
        //         console.log(value)
        //         var text = $option.text();//to get <option>Text</option> content
        //     });
        //     //    pages company detail custom inputs
        //     $(document).on('click', '.industry_selection', function () {
        //         console.log('working')
        //         $('#industry_selection').css('display:none');
        //         $('#industry_selection_input').css('display:block');
        //     });
        // });

    </script>
    @include('custom.inc.chatWidget')

@endsection
