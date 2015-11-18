<?php get_header();

	if (have_posts()) :
	    while (have_posts()) :
	        the_post(); ?>

			<section class="container">
				<article class="col-xs-12">
					<header>
						<h1><?= the_title(); ?></h1>
					</header>

					<?php the_content(); ?>
				</article>
			</section>

		<?php endwhile;
	endif;

get_footer(); ?>