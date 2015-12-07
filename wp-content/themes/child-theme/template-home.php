<?php /* Template Name: Home */
get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post(); ?>

			<div class="container">
				<section class="content featured">
					<header class="title">
						<h1><b>New</b> items</h1>
					</header>

					<?php
					$getFeaturedProducts = array(
							'post_type' => 'product',
							'meta_key' => '_featured',
							'meta_value' => 'yes'
					);

					$featuredProducts = new WP_Query( $getFeaturedProducts );
					if ($featuredProducts->have_posts()) : ?>

						<section class="gallery">
							<span class="navigate fa fa-chevron-left"></span>
							<span class="navigate fa fa-chevron-right"></span>

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
			</div>

			<section class="openingTime">
				<?php $today = date('D'); ?>
				<ul>
					<li <?= $today == 'Mon' ? 'class="today"' : null; ?>>Monday-11:00-19:00</li>
					<li <?= $today == 'Tue' ? 'class="today"' : null; ?>>Tuesday-11:00-19:00</li>
					<li <?= $today == 'Wed' ? 'class="today"' : null; ?>>Wednesday-11:00-19:00</li>
					<li <?= $today == 'Thu' ? 'class="today"' : null; ?>>Thursday-11:00-19:00</li>
					<li <?= $today == 'Fri' ? 'class="today"' : null; ?>>Friday-11:00-19:00</li>
					<li <?= $today == 'Sat' ? 'class="today"' : null; ?>>Saturday-11:00-19:00</li>
					<li <?= $today == 'Sun' ? 'class="today"' : null; ?>>Sunday-11:00-19:00</li>
				</ul>
			</section>

			<div class="container">
				<section class="content alignleft col-md-7">
					<section class="top-picks">
						<header class="title">
							<h1><b>Top</b> picks of the week</h1>
						</header>

						<div class="img-box alignleft">
							<img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/top-picks_scott-pilgrim.jpg" alt="">
							<img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/top-picks_superman.jpg" alt="">
							<img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/top-picks_comic.jpg" alt="">
						</div>

						<div class="txt alignleft">
							<h2>Scott Pilgrim VS the world</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet.</p>
						</div>

						<a href="" class="btn red">
							<span>To the top picks</span>
							<span class="fa fa-arrow-circle-right"></span>
						</a>
					</section>

					<!-- henks facebook 2 -->
					<section class="henks-facebook">
						<header class="title">
							<h1><b>Henk's</b> facebook</h1>
						</header>

						<div class="row">
							<div class="col-xs-6">
								<h2>Henks 20th anniversary weekend</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt magnam laboriosam harum a dolor, quod eius maiores necessitatibus? dipisicing elit. Deserunt magnam laboriosam harum a dolor,</p>
								<a href="" class="nav-link">Bekijk op facebook <span class="fa fa-arrow-circle-right"></span></a>
							</div>
							<div class="col-xs-6">
								<img src="img/facebook-image.png" alt="">
								<div class="date">
									<span class="date-day">09</span>
									<span class="date-month">november</span>
								</div>
							</div>


						</div>
					</section>
				</section>



			</div>

		<?php endwhile;
	endif;

get_footer(); ?>