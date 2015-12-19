<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header( 'shop' );

	while( have_posts() ) :
		the_post();

		wc_get_template_part( 'content', 'single-product' );
	endwhile;

get_footer( 'shop' );