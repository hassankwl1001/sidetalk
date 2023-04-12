
    <div class="modal fade" id="consultation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form class="login__form popup__form" id="payment-form" action="{{ route('setMeeting') }}" enctype="multipart/form-data" method="post">
                        @csrf
                      {{-- <div class="form__heading">
                          <h4>Usman Ahmed</h4>
                      </div> --}}
                      <div class="form__input--floating radio-btn">
                        <div class="radiogroup">
                            <input type="radio" name="consult_type" value="Virtual" checked="checked" id="label--online" required/>
                            <label class="form__label--floating" for="label--online">Virtual Consultation</label>
                            <p class="cost-session">Cost per session: <span id="cost_per_session">(30-60 mints)</span></p>
                        </div>
                        <div class="radiogroup">
                            <input type="radio" name="consult_type" value="Physical" id="label--meeting" required/>
                            <label class="form__label--floating" for="label--meeting">Physical Consultation</label>
                            <p class="cost-session">Cost per day: <span id="physical_cost_per_house">(6 hrs)</span></p>
                            <h6>*Travel expense and logistics shall be paid separately.</h6>
                        </div>
                      </div>
                      {{-- <div class="show_physical_box" id="Physical">
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--city">City/District <span>*</span></label>
                            <input id="input--city" type="text" placeholder="Lahore" name="city">
                        </div>
                        <div class="form__input--floating">
                            <label class="form__label--floating" id="label--country">Country/Region <span>*</span></label>
                            <input id="input--country" type="text" placeholder="Pakistan" name="country">
                        </div>
                      </div> --}}
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--subject">Matter of Subject <span>*</span></label>
                        <textarea id="input--subject" placeholder="Explain what skills you are looking for" name="desc" required></textarea>
                      </div>
                      <div class="form__attached_file">
                          {{-- <label for="file-input">
                            <i class="fas fa-plus-circle"></i>
                          </label> --}}

                          <input type="file" name="file" id="file-input">
                          <span>Attach files</span>
                      </div>
                      <div class="form__input--floating">
                        <label class="form__label--floating" id="label--time">Time of Consultation <span>*</span></label>
                        <div class="form__label--dropdown">
                            <input type="date" name="date" class="form-control" required>
                            <select name="time" id="input--time" required>
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
                          <div class="form__input--floating">


                                  <div class="form-group mt-3"> <!-- Added -->

                                      <label for="card-element">
                                          Credit or debit card
                                      </label>

                                      <div id="card-element">
                                          <!-- A Stripe Element will be inserted here. -->
                                      </div>

                                      <!-- Used to display Element errors. -->
                                      <div class="mt-2" style="color:red" id="card-errors" role="alert"></div>

                                  </div> <!-- Added -->


                          </div>
                      </div>
                      <input type="hidden" name="consult_with" id="consult_with" value="">
                      <div class="login__form_action_container login__form_action_container--multiple-actions">
                        <a href="javascript:void(0)" class="btn__secondary--large from__button--floating" data-dismiss="modal" aria-label="">Back</a>
                        {{-- <a href="consultant-thread.html" class="btn__primary--large from__button--floating" type="submit" aria-label="">Send</a> --}}
                        <input type="submit" class="btn__primary--large from__button--floating" value="Send">
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var stripe = Stripe('pk_test_51LokHfFPy6qhi114IwBX5PAPuBKrrUV0rOScHE6aywhiZvHBlNd0hxwkq0L3q0c7dR1MvN0yrPdZawPy26DuMWDF00DsaQEq4h');
        var elements = stripe.elements();
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'CardToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
