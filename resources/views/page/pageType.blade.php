@extends('custom.layouts.app')
@section('content')
@include('custom.inc.loading')
@include('custom.inc.header')

<section class="business-page inner-padding-top">
    <div class="container default-container">
        <div class="row marginleftright">
            <div class="col-12 paddingleftright">
                <div class="section-heading">
                    <h2>Create a Business Page</h2>
                    <p>Connect with clients, employees, and skilledtalk community. To get started, choose a page type.</p>
                </div>
                <ul>
                    <li>
                        <a href="{{ route('page.setup', 1) }}">
                            <div class="business-page-lists">
                                <i class="fas fa-igloo"></i>
                                <h4>Small Business</h4>
                                <p>Fewer than 200 employees</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.setup', 2) }}">
                            <div class="business-page-lists">
                                <i class="fas fa-hotel"></i>
                                <h4>Medium to large business</h4>
                                <p>More than 200 employees</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.setup', 3) }}">
                            <div class="business-page-lists">
                                <i class="fas fa-house-damage"></i>
                                <h4>Showcase page</h4>
                                <p>Sub-pages associated with an existing page</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.setup', 4) }}">
                            <div class="business-page-lists">
                                <i class="fas fa-university"></i>
                                <h4>Educational institution</h4>
                                <p>Schools and universities</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- <div class="modal fade" id="consultation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Consultation</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <div class="form__heading">
                      <h4>Usman Ahmed</h4>
                  </div>
                  <div class="form__input--floating radio-btn">
                    <div class="radiogroup">
                        <input type="radio" name="optradioconsultanting" value="Online" checked="checked" id="label--online"/>
                        <label class="form__label--floating" for="label--online">Virtual Consultation</label>
                        <p class="cost-session">Cost per session: <span>(30-60 mints)</span></p>
                    </div>
                    <div class="radiogroup">
                        <input type="radio" name="optradioconsultanting" value="Physical" id="label--meeting"/>
                        <label class="form__label--floating" for="label--meeting">Physical Consultation</label>
                        <p class="cost-session">Cost per day: <span>(6 hrs)</span></p>
                        <h6>*Travel expense and logistics shall be paid separately.</h6>
                    </div>
                  </div>
                  <div class="show_physical_box" id="Physical">
                    <div class="form__input--floating">
                        <label class="form__label--floating" id="label--city">City/District <span>*</span></label>
                        <input id="input--city" type="text" placeholder="Lahore" name="city">
                    </div>
                    <div class="form__input--floating">
                        <label class="form__label--floating" id="label--country">Country/Region <span>*</span></label>
                        <input id="input--country" type="text" placeholder="Pakistan" name="country">
                    </div>
                  </div>
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--subject">Matter of Subject <span>*</span></label>
                    <textarea id="input--subject" placeholder="Explain what skills you are looking for" name="subject"></textarea>
                  </div>
                  <div class="form__attached_file">
                      <a href=""><i class="fas fa-plus-circle"></i></a>
                      <span>Attach files</span>
                  </div>
                  <div class="form__input--floating">
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
                  </div>
                  <div class="login__form_action_container login__form_action_container--multiple-actions">
                    <a href="javascript:void(0)" class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</a>
                    <a href="consultant-thread.html" class="btn__primary--large from__button--floating" type="submit" aria-label="">Send</a>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Post a photo</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <div class="upload-photo-profile">
                    <div class="operations-user">
                        <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                        <div class="box-commented">
                            <div class="commented-description">
                                <strong class="post_name">Usman Ahmad</strong>
                            </div>
                            <div class="dropdown-lists">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-globe"></i>Anyone
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Anyone from twitter</a>
                                    <a class="dropdown-item" href="#">Anyone from facebook</a>
                                    <a class="dropdown-item" href="#">Anyone from linkedin</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form__input--floating border-none">
                    <input type="text" id="input--text" placeholder="Add Text" name="add_text" />
                  </div>
                  <div class="form__input--floating photo_upload">
                    <label for="label__photo" class="form__label--floating">Select image to share</label>
                    <input type="file" id="label__photo" accept="image/*" onchange="showMyImage(this)" style="display: none;" />
                    <img id="preview_image" src="" alt=""/>
                  </div>
                  <div class="form__input--floating Add_hashtag">
                    <button>Add Hashtag</button>
                  </div>
                  <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                    <button class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</button>
                    <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Post</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-video" tabindex="-1" role="dialog"  style="z-index: 1400;" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Post a Video</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <div class="upload-photo-profile">
                    <div class="operations-user">
                        <img class="img-size" src="assets/img/Ellipse2.png" alt="">
                        <div class="box-commented">
                            <div class="commented-description">
                                <strong class="post_name">Usman Ahmad</strong>
                            </div>
                            <div class="dropdown-lists">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-globe"></i>Anyone
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Anyone from twitter</a>
                                    <a class="dropdown-item" href="#">Anyone from facebook</a>
                                    <a class="dropdown-item" href="#">Anyone from linkedin</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form__input--floating border-none">
                    <input type="text" id="input--text" placeholder="Add Text" name="add_text" />
                  </div>
                  <div class="form__input--floating photo_upload">
                    <label for="label__video" class="form__label--floating">Select video to share</label>
                    <input type="file" id="label__video" accept="video/*" style="display: none;" />
                    <video id="video" controls></video>
                  </div>
                  <div class="form__input--floating Add_hashtag">
                    <button>Add Hashtag</button>
                  </div>
                  <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                    <a href="javascript:void(0)" class="btn__secondary--large from__button--floating" data-toggle="modal" data-target="#myModal2" aria-label="">Back</a>
                    <button class="btn__primary--large from__button--floating">Post</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" style="z-index: 1600;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Discard Draft</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <p>You haven’t finished your post yet. Are you sure you want to leave and discard your draft?</p>
                  <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                    <button class="btn__secondary--large from__button--floating" aria-label="">Back</button>
                    <button class="btn__primary--large from__button--floating" data-dismiss="modal" aria-label="">Discard</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Create a job</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--company">Company <span>*</span></label>
                    <div class="form__label--dropdown">
                        <select class="mr-0" name="company" id="input--company">
                            <option>Select Company</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                  </div>
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--job">Job Title <span>*</span></label>
                    <input type="text" id="input--job" placeholder="Enter a job title" name="job" />
                  </div>
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--location">Location <span>*</span></label>
                    <input type="text" id="input--location" placeholder="Enter a location" name="location" />
                  </div>
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--skills">Skill required <span>*</span></label>
                    <div class="form__label--dropdown">
                        <select class="mr-0" name="skills" id="input--skills">
                            <option>select skills</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                  </div>
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--qualification">Qualification <span>*</span></label>
                    <input type="text" id="input--qualification" placeholder="Enter a qualification" name="qualification" />
                  </div>
                  <div class="form__input--floating">
                    <div class="form__label--dropdown">
                        <label class="form__label--floating" id="label--experience">Experience</label>
                        <select class="mr-0" name="experience-from" id="input--experience-from">
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
                        <select class="mr-0" name="experience-to" id="input--experience-to">
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
                    <label class="form__label--floating" id="label--employment">Employment Type <span>*</span></label>
                    <div class="form__label--dropdown">
                        <select class="mr-0" name="employment" id="input--employment">
                            <option>Full-time</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                  </div>
                  <div class="form__input--floating">
                    <div class="form__label--dropdown">
                        <label class="form__label--floating" id="label--salary-from">Salary</label>
                        <select class="mr-0" name="salary-from" id="input--salary-from">
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
                        <select class="mr-0" name="salary-to" id="input--salary-to">
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
                  <div class="form__input--floating">
                    <label class="form__label--floating" id="label--job-description">Job Description <span>*</span></label>
                    <textarea id="input--description" placeholder="Explain what skills you are looking for" name="description"></textarea>
                  </div>

                  <div class="login__form_action_container login__form_action_container--multiple-actions">
                    <button class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</button>
                    <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Post</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-background-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLongTitle">Add Background Photo</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content">
                <form class="login__form popup__form" action="" method="post">
                  <div class="form__input--floating photo_upload">
                    <label for="label__photo" class="form__label--floating">Select image to upload</label>
                    <input type="file" id="label__photo" accept="image/*" onchange="backgroundImage(this)" style="display: none;" />
                    <img id="background_image" src="" alt=""/>
                  </div>
                  <div class="login__form_icons login__form_action_container login__form_action_container--multiple-actions">
                    <button class="btn__primary--large from__button--floating" type="submit" aria-label="">Upload a photo</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div> --}}

@include('custom.inc.chatWidget')

@endsection
