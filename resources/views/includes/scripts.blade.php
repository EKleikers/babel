<script src="/myadmin/resources/themes/vuexy/vendors/js/vendors.min.js"></script>
@yield('vendor-script')
@yield('page-script')
<script src="/myadmin/resources/themes/vuexy/js/scripts/pages/app-ecommerce.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
    $('.toast-basic').toast('show');
})
</script>
<!-- <script src="{{ asset('resources/js/products_script.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/js/custom-logic.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/js/payout.js') }}" type="text/javascript"></script> 
<script src="https://js.stripe.com/v3/" type="text/javascript"></script>-->
<script>
    // your publish key
    // let stripe = Stripe('pk_test_51JmbMzIK1JOCQ0oR4fQ4FmcWB0CIyeLBTVSk2HfT4AcvMopSm6urx1ZkbwF3ATIN8a1FSgT8p0HGJGT8TCp4hve500kMKj3ent');
    // let elements = stripe.elements()
    // let style = {
    //     base: {
    //         color: 'white',
    //         fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    //         fontSmoothing: 'antialiased',
    //         fontSize: '14px',
    //         '::placeholder': {
    //             color: '#aab7c4'
    //         }
    //     },
    //     invalid: {
    //         color: 'red',
    //         iconColor: 'red'
    //     }
    // }
    // let card = elements.create('card', {hidePostalCode: true, style: style})
    // card.mount('#card-element')
    // let paymentMethod = null
    // $('.card-form').on('submit', function (e) {
    //     $('button.pay').attr('disabled', true)
    //     if (paymentMethod) {
    //         return true
    //     }
    //     stripe.confirmCardSetup(
    //         "{{ $intent->client_secret }}",
    //         {
    //             payment_method: {
    //                 card: card,
    //                 billing_details: {name: $('.card_holder_name').val()}
    //             }
    //         }
    //     ).then(function (result) {
    //         if (result.error) {
    //             $('#card-errors').text(result.error.message)
    //             $('button.pay').removeAttr('disabled')
    //         } else {
    //             paymentMethod = result.setupIntent.payment_method
    //             $('.payment-method').val(paymentMethod)
    //             $('.card-form').submit()
    //         }
    //     })
    //     return false
    // })
</script>

<script>
    // function addToCart(product_id, qty = 1) {

    //     var http = new XMLHttpRequest();
    //     var url = window.location.href + 'cart/add/' + product_id + "/" + qty;
    //     // var params = product_id + "/" + qty;
    //     http.open('POST', url, true);

    //     // Send the proper header information along with the request
    //     // http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    //     http.onreadystatechange = function() { //Call a function when the state changes.
    //         if (http.readyState == 4 && http.status == 200) {
    //             window.location.href = window.location.href + 'cart'
    //         }
    //     }
    //     http.send();
    //}

    function notRegisteredUsers() {

        if (!alert("<?php echo (trans("blender.notregisteredusers")) ?>")) document.location = '/register';

    }
</script>