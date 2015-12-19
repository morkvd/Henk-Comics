<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined('ABSPATH') ) exit; // Exit if accessed directly ?>

<div class="container">
	<section class="products-page">
		<?php get_template_part('woocommerce/inc/store', 'navigation'); ?>

		<article <?php post_class('products-single col-md-9'); ?> itemscope itemtype="<?= woocommerce_get_product_schema(); ?>">
			<header class="title">
				<?php woocommerce_breadcrumb(); ?>

				<nav class="product-nav">
					<div><?php previous_post_link('<span class="fa fa-chevron-circle-left"></span> %link'); ?></div>
					<div><?php next_post_link('%link <span class="fa fa-chevron-circle-right"></span>'); ?></div>
				</nav>
			</header>

			<div class="summary entry-summary">
				<h1 itemprop="name" class="product-title entry-title">
					<span><?php the_title(); ?></span>
					<?php wc_get_template_part('single-product/price'); ?>
				</h1>

				<div class="row">
					<div class="col-md-7">
						<?php the_content(); ?>
						<?php wc_get_template_part('single-product/product', 'attributes'); ?>
					</div>

					<?php wc_get_template_part('single-product/product', 'image'); ?>
				</div>

				<?php wc_get_template_part('single-product/related'); ?>
			</div>

			<meta itemprop="url" content="<?php the_permalink(); ?>" />
		</article>
	</section>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
