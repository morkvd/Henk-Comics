<?php /* Template Name: Home */
get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post(); ?>

			<section class="content home">
				<?php
				$getFeaturedProducts = array(
					'post_type' => 'product',
					'meta_key' => '_featured',
					'meta_value' => 'yes'
				);

				$featuredProducts = new WP_Query( $getFeaturedProducts );
				if ($featuredProducts->have_posts()) : ?>

					<section class="featured gallery">
						<span class="navigate ui icon-left"></span>
						<span class="navigate ui icon-right"></span>

						<div>
							<?php while ($featuredProducts->have_posts()) :
								$featuredProducts->the_post();
								$product = new WC_Product($featuredProducts->post->ID);  ?>

								<a href="" class="col-md-2">
									<figure>
										<?= $product->get_image(); ?>
									</figure>
									<h1><?= $product->post->post_title; ?></h1>
								</a>

							<?php endwhile; ?>
						</div>
					</section>

				<?php endif;
				wp_reset_query(); // Remember to reset ?>

			</section>

		<?php endwhile;
	endif;

get_footer(); ?>