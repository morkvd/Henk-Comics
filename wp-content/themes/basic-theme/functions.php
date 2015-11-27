<?php
	/**----/ Clean up the <head> **/
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');


    /**----/ Avoid double jQuery version files **/
    function removejQuery() {
        wp_deregister_script('jquery');
    }
    if (!is_admin()) add_action('wp_enqueue_scripts', 'removejQuery');


    /**----/ Register navigation menu
     *
     * Register two menus for header and footer
     *
     * @codex http://codex.wordpress.org/Function_Reference/register_nav_menu
     **/
    add_action( 'after_setup_theme', 'register_menus' );
    function register_menus() {
        register_nav_menus( array(
            'primary' => 'Header (Primary) menu',
            'footer' => 'Footer (Secondary) menu',
        ) );
    }

    /**----/ Register sidebar
     *
     * @codex http://codex.wordpress.org/Function_Reference/register_sidebar
     **/
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Default Widgets',
    		'id'   => 'default-widgets',
    		'description'       => 'The default sidebar for the website.',
    		'before_widget'     => '<article id="%1$s" class="widget gradient %2$s"><header>',
    		'after_widget'      => '</article>',
    		'before_title'      => '<h3>',
    		'after_title'       => '</h3>',
    		'before_list'       => '<li id="%1$s" class="widget %2$s">',
    		'after_list'        => '</li>'
    	));
    }


    /**----/ Featured image
     *
     * Enables featured images for pages instead it's only aviable for posts
     *
     * @author Ronny Rook / Just Right Webdesign
     **/
    function get_the_post_thumbnail_src($img) {
        return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : false;
    }
    add_theme_support('post-thumbnails', array( 'post', 'page' ));


	/**----/ Add excerpt to pages
	 *
	 * @author Ronny Rook / Just Right Webdesign
	 **/
	function addExcerptsToPages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'addExcerptsToPages' );


	/**----/ Add post thumbnails for every post type **/
	add_theme_support('post-thumbnails');


	/**----/ Remove image links
	 *
	 * Stop addings links to images by default
	 *
	 * @author Ronny Rook / Just Right Webdesign
	 **/
	function removeImageLinks() {
		$image_set = get_option( 'image_default_link_type' );

		if ($image_set !== 'none')
			update_option('image_default_link_type', 'none');
	}
	add_action('admin_init', 'removeImageLinks', 10);


    /**----/ Theme settings
     *
     * Creates theme settings array: Appearance > Voorkeuren
     *
     * @requires settings.php (in folder /basic-theme)
     * @author Ronny Rook / Just Right Webdesign
     **/
    if (is_admin()) include_once('settings.php');
    $GLOBALS['settings'] = get_option('jrwd_theme_settings');


    /**----/ Custom user role
     *
     * Creates a custom user role for so the website owner
     * is seeing a custom admin panel for easy use
     *
     * @author Ronny Rook / Just Right Webdesign
     * @codex http://codex.wordpress.org/Roles_and_Capabilities
     **/
    $result = add_role( 'jrwd_client', __('Klant Just Right Webdesign', 'Client Just Right Webdesign'), array(
        'read'                  => true,
        'read_private_pages'    => true,
        'read_private_posts'    => true,

        'edit_posts'            => true,
        'edit_pages'            => true,
        'edit_published_posts'  => true,
        'edit_published_pages'  => true,
        'edit_others_posts'     => true,
        'edit_others_pages'     => true,
        'edit_theme_options'    => true,

        'delete_published_pages'=> true,
        'delete_published_posts'=> true,
        'delete_others_pages'   => true,
        'delete_others_posts'   => true,
        'delete_pages'          => true,
        'delete_posts'          => true,

        'create_posts'          => true,
        'create_pages'          => true,
        'publish_posts'         => true,
        'publish_pages'         => true,

        'upload_files'          => true,
        'manage_categories'     => true,

        'moderate_comments'     => false,
        'edit_themes'           => false,
        'switch_themes'         => false,
        'install_plugins'       => false,
        'update_plugin'         => false,
        'update_core'           => false,
        'promote_users'         => false
    ) );


    /**----/ Custom login screen
     *
     * Change the logo on login screen
     * Click on logo returns to homepage
     *
     * @author Ronny Rook / Just Right Webdesign
     * @codex http://codex.wordpress.org/Customizing_the_Login_Form
     **/
    function my_login_logo()
    {
        echo sprintf('
            <style type="text/css">
                body.login div#login h1 a {
                    background-image: url(\'%s\');
                    padding-bottom: 20px;
                }
            </style>
        ', get_template_directory_uri(). '/assets/images/login-logo.png');
    }
    add_action( 'login_enqueue_scripts', 'my_login_logo' );

    function my_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'my_login_logo_url' );


	/**----/ Custom admin footer **/
	function remove_footer_admin () {
		echo sprintf('
			&copy; %s - <a href="http://www.justrightwebdesign.nl" target="_blank">Just Right Webdesign</a>
		', date('Y'));
	}
	add_filter('admin_footer_text', 'remove_footer_admin');


	/**----/ Remove dashboard widgets **/
	add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');
	function wpc_dashboard_widgets() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
	}


	/**----/ Remove emoji bullshit **/
	function disable_wp_emojicons() {
		// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis
		add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	}
	add_action('init', 'disable_wp_emojicons');
	remove_filter('the_content', 'convert_smilies');

	function disable_emojicons_tinymce( $plugins ) {
		return is_array($plugins) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	}


	/**----/ Remove comments admin menu **/
	function wptutsplus_remove_comments_menu_item() {
		$user = wp_get_current_user();
		if (!$user->has_cap('manage_options'))
			remove_menu_page('edit-comments.php');
	}
	add_action('admin_menu', 'wptutsplus_remove_comments_menu_item');


	/**----/ Remove WP logo from toolbor in admin **/
	function remove_wp_logo($wp_admin_bar) {
		$wp_admin_bar->remove_node('wp-logo');
	}
	add_action('admin_bar_menu', 'remove_wp_logo', 999);


	/**----/ Separate media categories **/
	add_filter( 'wpmediacategory_taxonomy', create_function( '', 'return "category_media";' ) );  //requires PHP 4.0.1 or newer


    /**----/ Include: Walkers **/
    include_once( 'inc/walkers/PrimaryArrowWalker.php' );