<?php 

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


add_action( 'woocommerce_after_add_to_cart_quantity', 'dustrix_quantity_plus_sign' );

function dustrix_quantity_plus_sign() {
echo '<button type="button" class="plus" >+</button>';
}

add_action( 'woocommerce_before_add_to_cart_quantity', 'dustrix_quantity_minus_sign' );

function dustrix_quantity_minus_sign() {
echo '<button type="button" class="minus" >-</button>';
}

add_action( 'wp_footer', 'dustrix_quantity_plus_minus' );

function dustrix_quantity_plus_minus() {
// To run this on the single product page
if ( ! is_product() ) return;
?>
<script type="text/javascript">

jQuery(document).ready(function($){

$('form.cart').on( 'click', 'button.plus, button.minus', function() {

// Get current quantity values
var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
var val = parseFloat(qty.val());
var max = parseFloat(qty.attr( 'max' ));
var min = parseFloat(qty.attr( 'min' ));
var step = parseFloat(qty.attr( 'step' ));

// Change the value if plus or minus
if ( $( this ).is( '.plus' ) ) {
if ( max && ( max <= val ) ) {
qty.val( max );
}
else {
qty.val( val + step );
}
}
else {
if ( min && ( min >= val ) ) {
qty.val( min );
}
else if ( val > 1 ) {
qty.val( val - step );
}
}

});

});

</script>
<?php
}