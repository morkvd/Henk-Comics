<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<div class="container">
	<section class="products-page">
		<?php get_template_part('woocommerce/inc/store', 'navigation'); ?>

		<section class="products-overview col-md-9">
		<?php if( have_posts() ) : ?>
			<header class="title">
				<div class="category">
					<h1 class="bboom"><?php woocommerce_page_title(); ?></h1>
					<span><?php wc_get_template_part( 'loop/result', 'count' ); ?></span>
				</div>

				<?php get_template_part('woocommerce/inc/product', 'sorting'); ?>
			</header>

			<?php
			woocommerce_product_loop_start();

			while( have_posts() ) :
				the_post();

				wc_get_template_part( 'content', 'product' );

			endwhile;

			woocommerce_product_loop_end();

			/**
			 * woocommerce_after_shop_loop hook
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
			?>


		<?php elseif( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :

			wc_get_template( 'loop/no-products-found.php' );

		endif; ?>
		</section>

	</section>
</div>

<?php get_footer( 'shop' ); ?>
