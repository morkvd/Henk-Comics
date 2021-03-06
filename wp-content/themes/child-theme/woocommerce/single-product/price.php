<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */
if( !defined('ABSPATH') ) exit; // Exit if accessed directly

global $product;
?>

<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<span><?= $product->get_price_html(); ?></span>

	<meta itemprop="price" content="<?= esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?= esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?= $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
</div>
