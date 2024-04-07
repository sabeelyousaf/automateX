@extends('backend_app.layouts.template')
@section('content')

<div class="layout-page">
    <!-- Navbar -->

    @include('backend_app.layouts.nav')
    <!-- / Navbar -->
   <?php
function format_currency_with_commas($amount) {
    return 'Pkr: ' . number_format($amount);
}
?>


    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->



      <!-- Footer -->
     @include('backend_app.layouts.footer')
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>
  <script>
    function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
var prices = document.querySelectorAll('.price');
prices.forEach(function(priceElement) {
    var price = parseFloat(priceElement.textContent);
    var formattedPrice = number_format(price); // Assuming 2 decimal places
    priceElement.textContent = formattedPrice;
});
  </script>
@endsection
