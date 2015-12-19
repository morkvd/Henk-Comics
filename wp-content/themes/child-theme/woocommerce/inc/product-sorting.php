<form action="" method="GET" class="alignright">
	<span>Sort on:</span>

	<?php
	$current = isset($_GET['orderby']) ? $_GET['orderby'] : null;
	$options = array(
		'date' => 'Newest first',
		'menu_order' => 'Alphabetical',
		'popularity' => 'Popularity',
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