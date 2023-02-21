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
