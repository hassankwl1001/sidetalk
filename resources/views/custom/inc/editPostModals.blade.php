<div class="modal fade" id="edit-photo-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Update</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{ route('post.update') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="upload-photo-profile">
                            <div class="operations-user">
                                <img class="img-size" src="{{ $profile_pic }}" alt="">
                                <div class="box-commented">
                                    <div class="commented-description">
                                        <strong
                                            class="post_name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong>
                                    </div>
                                    <select class="postPrivacy" name="privacy">
                                        <option value="Public" selected> &#xf0ac; &nbsp;&nbsp;<span
                                                style="font-family: 'Lato', sans-serif !important;">Public</span>
                                        </option>
                                        <option value="Friends">&#xf0c0; &nbsp;Friends</option>
                                        <option value="Private">&#xf406; &nbsp; &nbsp;Private</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form__input--floating border-none">
                            <textarea id="edit-post-description-field-photo" placeholder="Add Text" name="description"></textarea>
                        </div>
                        <div class="form__input--floating photo_upload">
                            <input type="file" multiple="" id="gallery-photo-add" name="file[]" class="myPdf">
                                <small>Leave empty if you don't want to change.</small>
                            <div class="gallery_images"></div>

                            <canvas id="pdfViewer" style="width:0%;"></canvas>

                        </div>

                        <input type="hidden" id="edit-post-photo-post" name="post" value="">
                        <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                            <button class="btn__secondary--large from__button--floating" data-dismiss="modal"
                                    aria-label="">Back
                            </button>
                            <button class="btn__primary--large from__button--floating" type="submit" aria-label="">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- post a job -->
<div class="modal fade" id="edit-job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Edit job</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{route('post.update')}}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--job">Job Title <span>*</span></label>
                            <input type="text" id="edit-job-title" placeholder="Enter a job title" name="job_title"
                                   required/>
                        </div>

                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--job">Job Poster <span>*</span></label>
                            <input type="file" name="file" class="form-control" >
                            <small>Leave Empty if you don't want to change</small>
                        </div>

                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--job">Company <span>*</span></label>
                            <input type="text" id="edit-job-company" placeholder="Enter a Company Name" required
                                   name="company"/>
                        </div>

                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--location">Location <span>*</span></label>
                            <input type="text" id="edit-job-location" placeholder="Enter a location" required
                                   name="location"/>
                        </div>
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--job">Skills <span>*</span></label>
                            <input type="text" id="edit-job-skills" placeholder="Enter a job Skills" required
                                   name="skills"/>
                        </div>

                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--qualification">Qualification <span>*</span></label>
                            <input type="text" id="edit-job-qualification" required placeholder="Enter a qualification"
                                   name="qualification"/>
                        </div>
                        <div class="form__input--floating">
                            <div class="form__label--dropdown">
                                <label class="form__label--floating" id="label--experience">Experience</label>
                                <select class="mr-0" name="exp_from" id="edit-experience-from" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <span>to</span>
                                <select class="mr-0" name="exp_to" id="edit-experience-to" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--employment">Employment Type
                                <span>*</span></label>
                            <div class="form__label--dropdown">
                                <select class="mr-0" name="employee_type_id" id="edit-employment-type" required>
                                    <option value="1">Full-time and Part-time employees</option>
                                    <option value="2">Casual Employees</option>
                                    <option value="3">Fixed term and contract</option>
                                    <option value="4">Apprentices and trainees</option>
                                    <option value="5">Commission and piece rate employees</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__input--floating">
                            <div class="form__label--dropdown">
                                <label class="form__label--floating" id="label--salary-from">Salary</label>
                                <select class="mr-0" name="salary_from" id="edit-salary-from" required>
                                    <option value="10,000">10,000</option>
                                    <option value="20,000">20,000</option>
                                    <option value="30,000">30,000</option>
                                    <option value="40,000">40,000</option>
                                    <option value="50,000">50,000</option>
                                    <option value="60,000">60,000</option>
                                    <option value="70,000">70,000</option>
                                    <option value="80,000">80,000</option>
                                    <option value="90,000">90,000</option>
                                    <option value="100,000">100,000</option>
                                </select>
                                <span>to</span>
                                <select class="mr-0" name="salary_to" id="edit-salary-to" required>
                                    <option value="100,000">100,000</option>
                                    <option value="200,000">200,000</option>
                                    <option value="300,000">300,000</option>
                                    <option value="400,000">400,000</option>
                                    <option value="500,000">500,000</option>
                                    <option value="600,000">600,000</option>
                                    <option value="700,000">700,000</option>
                                    <option value="800,000">800,000</option>
                                    <option value="900,000">900,000</option>
                                    <option value="1,000,000">1,000,000</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form__input--floating">
                          <label class="form__label--floating" id="label--time">Time of Consultation <span>*</span></label>
                          <div class="form__label--dropdown">
                              <select name="date" id="input--date">
                                  <option>Date</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                  <option value="26">26</option>
                                  <option value="27">27</option>
                                  <option value="28">28</option>
                                  <option value="29">29</option>
                                  <option value="30">30</option>
                                  <option value="31">31</option>
                              </select>
                              <select name="month" id="input--month">
                                  <option value="">Month</option>
                                  <option value="January">January</option>
                                  <option value="Febuary">Febuary</option>
                                  <option value="March">March</option>
                                  <option value="April">April</option>
                                  <option value="May">May</option>
                                  <option value="June">June</option>
                                  <option value="July">July</option>
                                  <option value="August">August</option>
                                  <option value="September">September</option>
                                  <option value="October">October</option>
                                  <option value="November">November</option>
                                  <option value="December">December</option>
                              </select>
                              <select name="month" id="input--month">
                                  <option value="">Year</option>
                                  <option value="2020">2020</option>
                                  <option value="2019">2019</option>
                                  <option value="2018">2018</option>
                                  <option value="2017">2017</option>
                                  <option value="2016">2016</option>
                                  <option value="2015">2015</option>
                                  <option value="2014">2014</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2010">2010</option>
                                  <option value="2009">2009</option>
                                  <option value="2008">2008</option>
                                  <option value="2007">2007</option>
                                  <option value="2006">2006</option>
                                  <option value="2005">2005</option>
                                  <option value="2004">2004</option>
                                  <option value="2003">2003</option>
                                  <option value="2002">2002</option>
                                  <option value="2001">2001</option>
                                  <option value="2000">2000</option>
                                  <option value="1999">1999</option>
                                  <option value="1998">1998</option>
                                  <option value="1997">1997</option>
                                  <option value="1996">1996</option>
                                  <option value="1995">1995</option>
                                  <option value="1994">1994</option>
                                  <option value="1993">1993</option>
                                  <option value="1992">1992</option>
                                  <option value="1991">1991</option>
                                  <option value="1990">1990</option>
                                  <option value="1989">1989</option>
                                  <option value="1988">1988</option>
                                  <option value="1987">1987</option>
                                  <option value="1986">1986</option>
                                  <option value="1985">1985</option>
                                  <option value="1984">1984</option>
                                  <option value="1983">1983</option>
                                  <option value="1982">1982</option>
                                  <option value="1981">1981</option>
                                  <option value="1980">1980</option>
                              </select>
                              <select name="time" id="input--time">
                                  <option value="">Time</option>
                                  <option value="00:00">12.00 AM</option>
                                  <option value="00:30">12.30 AM</option>
                                  <option value="01:00">01.00 AM</option>
                                  <option value="01:30">01.30 AM</option>
                                  <option value="02:00">02.00 AM</option>
                                  <option value="02:30">02.30 AM</option>
                                  <option value="03:00">03.00 AM</option>
                                  <option value="03:30">03.30 AM</option>
                                  <option value="04:00">04.00 AM</option>
                                  <option value="04:30">04.30 AM</option>
                                  <option value="05:00">05.00 AM</option>
                                  <option value="05:30">05.30 AM</option>
                                  <option value="06:00">06.00 AM</option>
                                  <option value="06:30">06.30 AM</option>
                                  <option value="07:00">07.00 AM</option>
                                  <option value="07:30">07.30 AM</option>
                                  <option value="08:00">08.00 AM</option>
                                  <option value="08:30">08.30 AM</option>
                                  <option value="09:00">09.00 AM</option>
                                  <option value="09:30">09.30 AM</option>
                                  <option value="10:00">10.00 AM</option>
                                  <option value="10:30">10.30 AM</option>
                                  <option value="11:00">11.00 AM</option>
                                  <option value="11:30">11.30 AM</option>
                                  <option value="12:00">12.00 PM</option>
                                  <option value="12:30">12.30 PM</option>
                                  <option value="13:00">01.00 PM</option>
                                  <option value="13:30">01.30 PM</option>
                                  <option value="14:00">02.00 PM</option>
                                  <option value="14:30">02.30 PM</option>
                                  <option value="15:00">03.00 PM</option>
                                  <option value="15:30">03.30 PM</option>
                                  <option value="16:00">04.00 PM</option>
                                  <option value="16:30">04.30 PM</option>
                                  <option value="17:00">05.00 PM</option>
                                  <option value="17:30">05.30 PM</option>
                                  <option value="18:00">06.00 PM</option>
                                  <option value="18:30">06.30 PM</option>
                                  <option value="19:00">07.00 PM</option>
                                  <option value="19:30">07.30 PM</option>
                                  <option value="20:00">08.00 PM</option>
                                  <option value="20:30">08.30 PM</option>
                                  <option value="21:00">09.00 PM</option>
                                  <option value="21:30">09.30 PM</option>
                                  <option value="22:00">10.00 PM</option>
                                  <option value="22:30">10.30 PM</option>
                                  <option value="23:00">11.00 PM</option>
                                  <option value="23:30">11.30 PM</option>
                              </select>
                          </div>
                        </div> --}}
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--job-description">Job Description
                                <span>*</span></label>
                            <textarea id="eidt-post-job-description" placeholder="Explain what skills you are looking for"
                                      required name="description"></textarea>
                        </div>
                        <input type="hidden" id="edit-post-job-post" name="post" value="">
                        <div class="login__form_action_container login__form_action_container--multiple-actions">
                            <button class="btn__secondary--large from__button--floating" data-dismiss="modal"
                                    aria-label="">Back
                            </button>
                            <button class="btn__primary--large from__button--floating" type="submit" aria-label="">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- post an Article -->
<div class="modal fade" id="edit-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Edit Article</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" action="{{ route('post.update') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="upload-photo-profile">
                            <div class="operations-user">
                                <img class="img-size" src="{{ $profile_pic }}" alt="">
                                <div class="box-commented">
                                    <div class="commented-description">
                                        <strong
                                            class="post_name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong>
                                    </div>
                                    <select class="postPrivacy" name="privacy">
                                        <option value="Public" selected> &#xf0ac; &nbsp;&nbsp;<span
                                                style="font-family: 'Lato', sans-serif !important;">Public</span>
                                        </option>
                                        <option value="Friends">&#xf0c0; &nbsp;Friends</option>
                                        <option value="Private">&#xf406; &nbsp; &nbsp;Private</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="form__input--floating" id="edit-post-article-heading">
                            <label class="form__label--floating" id="label--heading">Heading <span>*</span></label>
                            <input type="text" id="edit-post-heading-field-article" placeholder="Enter your heading" name="heading"/>
                        </div>
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="">Description
                                <span>*</span></label>
                            <textarea id="edit-post-description-field-article" placeholder="Write some description"
                                      name="description"></textarea>
                        </div>
                        <div class="form__input--floating upload_pdf">
                            <label for="label__photo" class="form__label--floating">Select PDF or Image File</label>
                            <input id="label__photo" type="file" name="file"
                                   accept="application/pdf,application/vnd.ms-excel,image/*"/>
                            <small>Leave empty if you don't want to change</small>
                        </div>
                        <div class="login__form_action_container login__form_action_container--multiple-actions">
                            <button class="btn__secondary--large from__button--floating" data-dismiss="modal"
                                    aria-label="">Cancel
                            </button>
                            <button class="btn__primary--large from__button--floating" type="submit" aria-label="">
                                Update
                            </button>
                        </div>
                        <input type="hidden" id="edit-post-article-post" name="post" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


