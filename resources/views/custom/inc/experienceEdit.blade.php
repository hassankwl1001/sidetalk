<div class="modal-header">
    <h2 class="modal-title" id="exampleModalLongTitle">Edit Experience</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="content">
        <form class="login__form popup__form" action="{{ route('experience.update') }}" method="post">
            @csrf
            <div class="form__input--floating">
                <input type="hidden" name="id" value="{{$exp->id}}">
                <label class="form__label--floating" id="label--experience-title">Title <span>*</span></label>
                <input type="text" id="input--experience-title" value="{{$exp->title}}"
                       placeholder="Ex: Experience Title" name="title" required/>
            </div>
            <div class="form__input--floating">
                <label class="form__label--floating" id="label--emp-type">Employment Type <span>*</span></label>
                <div class="form__label--dropdown">
                    <select class="mr-0" name="employee_type_id" id="input--emp-type" required>
                        <option>Select Employment Type</option>
                        @foreach($employeeTypes as $type)
                            @if($type->id==$exp->employee_type_id)
                                <option selected value="{{ $type->id }}"> {{  $type->name }} </option>
                            @else
                                <option value="{{ $type->id }}"> {{  $type->name }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form__input--floating">
                <label class="form__label--floating" id="label--company">Company <span>*</span></label>
                <input type="text" id="input--company" value="{{$exp->company}}" placeholder="Enter Company Name" name="company" required/>
            </div>
            <div class="form__input--floating">
                <div class="form__label--dropdown row">
                    <div class="col-md-6 paddingleft">
                        <label class="form__label--floating" id="label--experience">Start Date <span>*</span></label>
                        <input type="date" name="start_date" value="{{$exp->start_date}}" required/>
                    </div>
                    <div class="col-md-6 paddingright">
                        <label class="form__label--floating" id="label--experience">End Date <span>*</span></label>
                        <input type="date" name="end_date" value="{{$exp->end_date}}"  required/>
                    </div>
                </div>
            </div>
            <div class="form__input--floating">
                <label class="form__label--floating" id="label--heading">Responsibility <span>*</span></label>
                <input type="text" id="input--heading" placeholder="Enter your responsibility" required
                       value="{{$exp->responsibility}}" name="responsibility"/>
            </div>
            <div class="form__input--floating">
                <label class="form__label--floating" id="label--heading">Location <span>*</span></label>
                <input type="text" id="input--heading" value="{{$exp->location}}" placeholder="Enter Work Location" required name="location"/>
            </div>
                <div class="form__input--floating">
                    <label class="form__label--floating" id="">Currently Working </label>
                    <input style="width: auto;" type="checkbox" value="1" {{$exp->currently_working == true ? "checked" : ""}} id=""  name="currently_working" />
                </div>
            <div class="login__form_action_container login__form_action_container--multiple-actions">
                <button class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back
                </button>
                <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Submit</button>
            </div>
        </form>
    </div>
</div>
