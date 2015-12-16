<nav class="categories col-md-3">
	<header>
		<h2>Store</h2>
	</header>

	<a href="<?= WC()->cart->get_cart_url(); ?>" class="cart" title="<?php _e( 'View your shopping cart' ); ?>">
		<img class="cart-img" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/cart.png" alt="shopping basket">
		<span class="amount-in-cart"><?= WC()->cart->cart_contents_count; ?></span>
	</a>

	<?php
	$categories = get_categories( array(
		'taxonomy' => 'product_cat',
		'orderby' => 'term_group',
		'order' => 'ASC',
		'hide_empty' => 0
	));

	if( $categories ) : ?>
		<ul>
			<?php foreach( $categories as $cat ) : ?>
				<li>
					<a href="/products/<?= $cat->category_nicename; ?>" <?= strpos($_SERVER['REQUEST_URI'], $cat->category_nicename) !== false ? ' class="active"' : null; ?>>
						<span><?= $cat->name; ?></span>
						<span class="fa fa-chevron-circle-right"></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</nav>