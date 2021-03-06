<?php
//* Code goes here

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

function customThemeEnqueues(){
    wp_enqueue_script('jquery');
      wp_enqueue_style('timepickerCDN', '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css', array(), '1.3.5', 'all');
      wp_enqueue_script('timepickerCDNScript', '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js', array('jquery'), '1.3.5', true);

      wp_enqueue_script('customScript', get_stylesheet_directory_uri() . '/customScript.js', array('jquery'), '1.0.1', true);
}

add_action('wp_enqueue_scripts', 'customThemeEnqueues', 11);

/* WooCommerce: The Code Below Removes Checkout Fields */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
    function custom_override_checkout_fields( $fields ) {
    // unset($fields['billing']['billing_first_name']);
    // unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    // unset($fields['billing']['billing_phone']);
    // unset($fields['order']['order_comments']);
    // unset($fields['billing']['billing_email']);
    unset($fields['account']['account_username']);
    unset($fields['account']['account_password']);
    unset($fields['account']['account_password-2']);
    return $fields;
}


add_filter( 'woocommerce_get_order_item_totals', 'add_pickup_time_to_emails', 10, 2 );

function add_pickup_time_to_emails( $total_rows, $myorder_obj ) {
    $total_rows['pickup_time'] = array(
       'label' => __( 'Pick Up Time', 'woocommerce' ),
       'value'   => get_post_meta($myorder_obj->get_id())['_billing_pickuptime'][0]
    );

return $total_rows;
}

function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    unset( $tabs['description'] );
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );
