let quantity = jQuery(".quantity .qty").val();

function remove_checkout_button() {
    jQuery('.cart_totals .wc-proceed-to-checkout a.checkout-button').remove();
}

remove_checkout_button();

jQuery('td.product-remove a.remove').click( function(){
    window.setTimeout('remove_checkout_button()', 2000);
});

