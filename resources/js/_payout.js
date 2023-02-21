/**
 * Created by PC on 9/3/2017.
 */

$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});

$('.pay-now').on('click',function(){
    if($('.pay-card').hasClass('disabled')){
        $('.pay-card').removeClass('disabled');
    }
    $('[href="#pay-card"]').tab('show');
});

$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
});

$(function() {
    var $form = $('#payment-form');
    $form.submit(function(event) {
        // Disable the submit button to prevent repeated clicks:
        $form.find('.btn').prop('disabled', true);

        // Request a token from Stripe:
        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from being submitted:
        return false;
    });
});

function stripeResponseHandler(status, response) {
    // Grab the form:
    var $form = $('#payment-form');

    if (response.error) { // Problem!

        // Show the errors on the form:
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.btn').prop('disabled', false); // Re-enable submission

    } else { // Token was created!

        // Get the token ID:
        var token = response.id;

        // Insert the token ID into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken">').val(token));

        // Submit the form:
        $form.get(0).submit();

        // For this demo, we're simply showing the token:
        //alert("Token: " + token);
    }
};


//var stripe = Stripe('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9');
//$(function() {
//    $('form.require-validation').bind('submit', function(e) {
//        var $form         = $(e.target).closest('form'),
//            inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]',
//                'textarea'].join(', '),
//            $inputs       = $form.find('.required').find(inputSelector),
//            $errorMessage = $form.find('div.error'),
//            valid         = true;
//
//        $errorMessage.addClass('hide');
//        $('.has-error').removeClass('has-error');
//        $inputs.each(function(i, el) {
//            var $input = $(el);
//            if ($input.val() === '') {
//                $input.parent().addClass('has-error');
//                $errorMessage.removeClass('hide');
//                e.preventDefault(); // cancel on first error
//            }
//        });
//    });
//});
//$form = $('#payment-form');
//$form.on('submit', function(e) {


    //if (!$form.data('cc-on-file')) {
    //    e.preventDefault();
        //Stripe.setPublishableKey($form.data('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9'));
        //Stripe('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9');
        //var elements = stripe.elements({
        //    locale: 'en',
        //    fonts:array('weight')
        //});
        //var stripe = Stripe('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9');
        //var elements = stripe.elements();
        //
        //var card = elements.create('card');
        //card.mount('#payment-form');
        //
        //var promise = stripe.createToken(card);
        //promise.then(function(result) {
            // result.token is the card token.
        //});
        //stripe.createToken({
        //    number: $('.card-number').val(),
        //    cvc: $('.card-cvc').val(),
        //    exp_month: $('.card-expiry-month').val(),
        //    exp_year: $('.card-expiry-year').val()
        //}, stripeResponseHandler);
    //}

    //stripe.card.create($form, funciton(status, response)){
        //var token = response.id;
        //$form.append($('<input type="hidden" name="stripe-token" /> ').val(token));
        //$form.get(0).submit();

        //console.log(token);
//    })
//});




//var $form = $('#payment-form');
//var stripe = Stripe('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9');

//$('#payment-form').submit(function(e){
//    $form = $(this);
//    //alert(stripe);
//
//        stripe.createToken($form, function(status, response){
//
//            var card = elements.create('card');
//            var cardNumber = elements.create('cardNumber');
//            var cardExpiry = elements.create('cardExpiry');
//            var cardCvc = elements.create('cardCvc');
//            var postalCode = elements.create('postalCode');
//        });
//        var token = response.id;
//            alert(token);
//
//        //$form.append($('<input type="hidden" name="stripe_token"/>').val(token));
//        $form.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
//        $form.get(0).submit();
//
//      //alert(stripe);
//
//        console.log('token');
//    //
//        console.log(token);
//    });
//
//    return false;
//});


// Create a Stripe client
//var stripe = Stripe('pk_test_1SpzA6pYxSwsNJhLUTqSkuE9');


// Create an instance of Elements
//var elements = stripe.elements();
//
//// Custom styling can be passed to options when creating an Element.
//// (Note that this demo uses a wider set of styles than the guide below.)
//var style = {
//    base: {
//        color: '#32325d',
//        lineHeight: '24px',
//        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
//        fontSmoothing: 'antialiased',
//        fontSize: '16px',
//        '::placeholder': {
//            color: '#aab7c4'
//        }
//    },
//    invalid: {
//        color: '#fa755a',
//        iconColor: '#fa755a'
//    }
//};
//
//// Create an instance of the card Element
//var card = elements.create('card', {style: style});
//
//// Add an instance of the card Element into the `card-element` <div>
//card.mount('#card-element');
//
//// Handle real-time validation errors from the card Element.
//card.addEventListener('change', function(event) {
//    var displayError = document.getElementById('card-errors');
//    if (event.error) {
//        displayError.textContent = event.error.message;
//    } else {
//        displayError.textContent = '';
//    }
//});
//
//// Handle form submission
//var form = document.getElementById('payment-form');
//form.addEventListener('submit', function(event) {
//    event.preventDefault();
//
//    stripe.createToken(card).then(function(result) {
//        if (result.error) {
//            // Inform the user if there was an error
//            var errorElement = document.getElementById('card-errors');
//            errorElement.textContent = result.error.message;
//        } else {
//            // Send the token to your server
//            //stripeTokenHandler(result.token);
//            console.log(result.token);
//        }
//    });
//});













//function stripeResponseHandler(status, response) {
//    if (response.error) {
//        $('.error')
//            .removeClass('hide')
//            .find('.alert')
//            .text(response.error.message);
//    } else {
//        // token contains id, last4, and card type
//        var token = response['id'];
//        // insert the token into the form so it gets submitted to the server
//        $form.find('input[type=text]').empty();
//        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
//        $form.get(0).submit();
//    }
//}

//
//$form.on('submit', payWithStripe);

/* If you're using Stripe for payments */
//function payWithStripe(e) {
//    e.preventDefault();
//
//    /* Visual feedback */
//    $form.find('[type=submit]').html('Validating <i class="fa fa-spinner fa-pulse"></i>');
//
//    var PublishableKey = 'pk_test_1SpzA6pYxSwsNJhLUTqSkuE9'; // Replace with your API publishable key
//    Stripe.setPublishableKey(PublishableKey);
//
//    /* Create token */
//    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
//    var ccData = {
//        number: $form.find('[name=cardNumber]').val().replace(/\s/g,''),
//        cvc: $form.find('[name=cardCVC]').val(),
//        exp_month: expiry.month,
//        exp_year: expiry.year
//    };
//
//    Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
//        if (response.error) {
//            /* Visual feedback */
//            $form.find('[type=submit]').html('Try again');
//            /* Show Stripe errors on the form */
//            $form.find('.payment-errors').text(response.error.message);
//            $form.find('.payment-errors').closest('.row').show();
//        } else {
//            /* Visual feedback */
//            $form.find('[type=submit]').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
//            /* Hide Stripe errors on the form */
//            $form.find('.payment-errors').closest('.row').hide();
//            $form.find('.payment-errors').text("");
//            // response contains id and card, which contains additional card details
//            console.log(response.id);
//            console.log(response.card);
//            var token = response.id;
//            // AJAX - you would send 'token' to your server here.
//            $.post('/account/stripe_card_token', {
//                token: token
//            })
//                // Assign handlers immediately after making the request,
//                .done(function(data, textStatus, jqXHR) {
//                    $form.find('[type=submit]').html('Payment successful <i class="fa fa-check"></i>').prop('disabled', true);
//                })
//                .fail(function(jqXHR, textStatus, errorThrown) {
//                    $form.find('[type=submit]').html('There was a problem').removeClass('success').addClass('error');
//                    /* Show Stripe errors on the form */
//                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
//                    $form.find('.payment-errors').closest('.row').show();
//                });
//        }
//    });
//}
///* Fancy restrictive input formatting via jQuery.payment library*/
//$('input[name=cardNumber]').payment('formatCardNumber');
//$('input[name=cardCVC]').payment('formatCardCVC');
//$('input[name=cardExpiry').payment('formatCardExpiry');
//
///* Form validation using Stripe client-side validation helpers */
//jQuery.validator.addMethod("cardNumber", function(value, element) {
//    return this.optional(element) || Stripe.card.validateCardNumber(value);
//}, "Please specify a valid credit card number.");
//
//jQuery.validator.addMethod("cardExpiry", function(value, element) {
//    /* Parsing month/year uses jQuery.payment library */
//    value = $.payment.cardExpiryVal(value);
//    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
//}, "Invalid expiration date.");
//
//jQuery.validator.addMethod("cardCVC", function(value, element) {
//    return this.optional(element) || Stripe.card.validateCVC(value);
//}, "Invalid CVC.");
//
//validator = $form.validate({
//    rules: {
//        cardNumber: {
//            required: true,
//            cardNumber: true
//        },
//        cardExpiry: {
//            required: true,
//            cardExpiry: true
//        },
//        cardCVC: {
//            required: true,
//            cardCVC: true
//        }
//    },
//    highlight: function(element) {
//        $(element).closest('.form-control').removeClass('success').addClass('error');
//    },
//    unhighlight: function(element) {
//        $(element).closest('.form-control').removeClass('error').addClass('success');
//    },
//    errorPlacement: function(error, element) {
//        $(element).closest('.form-group').append(error);
//    }
//});
//
//paymentFormReady = function() {
//    if ($form.find('[name=cardNumber]').hasClass("success") &&
//        $form.find('[name=cardExpiry]').hasClass("success") &&
//        $form.find('[name=cardCVC]').val().length > 1) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//$form.find('[type=submit]').prop('disabled', true);
//var readyInterval = setInterval(function() {
//    if (paymentFormReady()) {
//        $form.find('[type=submit]').prop('disabled', false);
//        clearInterval(readyInterval);
//    }
//}, 250);


/*
 https://goo.gl/PLbrBK
 */

