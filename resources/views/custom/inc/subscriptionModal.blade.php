
    <div class="modal fade" id="subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Please buy privilege package for consultation</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="content">
                    <form class="login__form popup__form" id="payment-form" action="{{ route('subscription') }}" method="post">
                        @csrf
                      <div class="form__input--floating radio-btn">
                        <div class="radiogroup">
                            <input type="radio" name="consult_type" value="Virtual" checked="checked" id="label--online" required/>
                            <label class="form__label--floating" for="label--online">Basic Subscription</label>
                            <p class="cost-session">Subscription: <span>(1 month in 50$)</span></p>
                        </div>
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
                        <a href="javascript:void(0)" class="btn__secondary--large from__button--floating p-2" data-dismiss="modal" aria-label="">Back</a>
                        <input type="submit" class="btn__primary--large from__button--floating" style="padding:0 5px;" value="Subscribe">
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
