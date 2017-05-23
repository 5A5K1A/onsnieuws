<?php

/**
 * WooCommerce Extra Feature
 * --------------------------
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 */
function woo_related_products_limit() {
	global $product;
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', function( $args ) {
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
});


add_filter( 'woocommerce_localisation_address_formats', function( $formats ) {
	$formats['NL']  = "{address_1}\n{address_2}\n{postcode} {city}\n{country}";
	return $formats;
}, 20 );

add_filter('woocommerce_checkout_fields', function( $fields ) {
    $order = array(
        'billing_first_name',
        'billing_last_name',
        // 'billing_company',
        'billing_address_1',
        // 'billing_address_2',
        'billing_postcode',
        'billing_city',
        'billing_country',
        'billing_email',
        'billing_phone'
    );
    foreach( $order as $field ) { $ordered_fields[$field] = $fields['billing'][$field]; }
    $fields['billing'] = $ordered_fields;
    $fields['billing']['billing_postcode']['class'][0] = 'form-row-first';
    $fields['billing']['billing_city']['class'][0] = 'form-row-last';
    return $fields;
});

