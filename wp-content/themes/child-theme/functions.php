<?php
	/**----/ Load parent stylesheet
	 *
	 * First load parent stylesheet and make sure
	 * child stylesheet is loaded after it.
	 *
	 * @codex http://codex.wordpress.org/Child_Themes
	 */
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		/*wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array('parent-style')
		); */
	}


	/**----/ Load editor styles
	 *
	 * For styling elements in the editor
	 */
	function my_theme_add_editor_styles() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
	add_action( 'admin_init', 'my_theme_add_editor_styles' );


	/**----/ Woocommerce
	 *
	 * Adding theme support for Woocommerce
	 */
	add_theme_support( 'woocommerce' );