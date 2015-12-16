<form action="" method="GET" class="alignright">
	<span>Sort on:</span>

	<?php
	$current = isset($_GET['orderby']) ? $_GET['orderby'] : null;
	$options = array(
		'menu_order' => 'Default sorting',
		'popularity' => 'Popularity',
		'date' => 'Newest first',
		'price' => 'Price low - high',
		'price-desc' => 'Price high - low'
	);

	echo '<select name="orderby" class="sorting">';

		foreach( $options as $key => $value ) :
			echo sprintf('
				<option value="%s" %s>%s</option>
			', $key, $current == $key ? 'selected' : null, $value);
		endforeach;

	echo '</select>'; ?>
</form>