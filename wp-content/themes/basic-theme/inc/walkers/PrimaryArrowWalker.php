<?php
class PrimaryArrowWalker extends Walker_Nav_Menu
{
	function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		// Output <li>
		$output .= $indent . '<li' . $class_names .'>';

			// Output <a>
			$output .= '<a href="'. $item->url .'">';

				if ($depth === 0 && in_array('menu-item-has-children', $item->classes))
					$output .= $item->title . '<span class="fo icons-angle-down"></span>';
				else
					$output .= $item->title;

			$output .= '</a>';
	}

	function end_el( &$output, $item, $depth = 0, $args = array() )
	{
		$output .= '</li>';
	}
}