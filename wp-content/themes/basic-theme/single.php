<?php get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post(); ?>

			<section class="container" id="post-<?php the_ID(); ?>">
				<article class="col-xs-12">
					<header>
						<h1><?= the_title(); ?></h1>
						<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
					</header>

					<?php the_content(); ?>

					<footer>
						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
						<?php the_tags( 'Tags: ', ', ', ''); ?>
					</footer>
				</article>
			</section>

		<?php endwhile;
	endif;

get_footer(); ?>