<?php get_header();

if (have_posts()) :
	$post = $posts[0];

	if (is_category())
		echo '<h2>Archive for the &#8216;'. single_cat_title(null, false) .'&#8217; Category</h2>';
	elseif (is_tag())
		echo '<h2>Posts Tagged &#8216;'. single_tag_title(null, false) .'&#8217;</h2>';
	elseif (is_day())
		echo '<h2>Archive for '. the_time('F jS, Y') .'</h2>';
	elseif (is_month())
		echo '<h2>Archive for '. the_time('F, Y') .'</h2>';
	elseif (is_year())
		echo '<h2 class="pagetitle">Archive for '. the_time('Y') .'</h2>';
	elseif (is_author())
		echo '<h2 class="pagetitle">Author Archive</h2>';
	elseif (isset($_GET['paged']) && !empty($_GET['paged']))
		echo '<h2 class="pagetitle">Blog Archives</h2>';

	// Loop trough posts
	while (have_posts()) :
		the_post(); ?>

		<div <?php post_class() ?>>

			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</div>

	<?php endwhile;

	if (get_previous_posts_link() || get_next_posts_link()) : ?>

		<nav class="page-nav archive">
			<?php if ($prev = get_previous_posts_link()) : ?>
				<div class="alignleft">
					<span class="fo icons-angle-circled-left"></span>
					<span><?php previous_posts_link( 'Nieuwe berichten' ); ?></span>
				</div>
			<?php endif;

			if ($next = get_next_posts_link()) : ?>
				<div class="alignright">
					<span><?php next_posts_link( 'Oudere berichten' ); ?></span>
					<span class="fo icons-angle-circled-right"></span>
				</div>
			<?php endif; ?>
		</nav>

	<?php endif;

else :
	echo 'Er zijn geen berichten gevonden.';
endif;

get_footer(); ?>