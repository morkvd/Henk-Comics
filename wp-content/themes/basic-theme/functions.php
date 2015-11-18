<?php
	/**----/ Clean up the <head> */
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

    /**----/ Avoid double jQuery version files */
    function removejQuery() {
        wp_deregister_script('jquery');
    }

    if ( !is_admin() )
        add_action('wp_enqueue_scripts', 'removejQuery');


    /**----/ Register navigation menu
     *
     * Register two menus for header and footer
     *
     * @codex http://codex.wordpress.org/Function_Reference/register_nav_menu
     */
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
     */
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


    /**----/ Clean url
     *
     * @param url string
     * @return string returns clean url
     *
     * @author Ronny Rook / Just Right Webdesign
     */
    function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }


    /**----/ Featured image
     *
     * Enables featured images for pages instead it's only aviable for posts
     *
     * @author Ronny Rook / Just Right Webdesign
     **/
    add_theme_support('post-thumbnails', array( 'post', 'page' ));

    function get_the_post_thumbnail_src($img) {
        return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : false;
    }


    /**----/ Theme settings
     *
     * Creates theme settings array: Appearance > Voorkeuren
     *
     * @requires settings.php (in folder /basic-theme)
     * @author Ronny Rook / Just Right Webdesign
     **/
    if (is_admin())
	    include_once('settings.php');

    $GLOBALS['settings'] = get_option('jrwd_theme_settings');


    /**----/ Shorten title & content
     *
     * Shorten the title or content
     *
     * @param string $title | title that needs to be shorten
     * @param string $slug | prefix of the link
     * @param int $length | how many characters it will be
     * @return string $output | shorter title
     * @author Ronny Rook / Just Right Webdesign
     **/
    function shortenTitle($title, $slug = null, $length = 25, $link = true)
    {
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        if (strlen($title) > $length) {
            if ($link) {
                $output = sprintf('
                    <a href="/%s" title="%s">
                        %s ..
                    </a>
                ', $slug, ucfirst($title), ucfirst(mb_substr($title, 0, $length, 'UTF-8')));
            } else {
                $output = sprintf('
                    <span>%s ..</span>
                ', ucfirst(mb_substr($title, 0, $length, 'UTF-8')));
            }
        } else {
            if ($link) {
                $output = sprintf('
                    <a href="/%s" title="%s">
                        %s
                    </a>
                ', $link.$slug, ucfirst($title), ucfirst($title));
            } else {
                $output = sprintf('
                    <span>%s</span>
                ', ucfirst($title));
            }
        }

        return $output;
    }

    function shortenContent($content, $length)
    {
        if (strlen($content) > $length) {
            $output = sprintf('
                %s ..
            ', substr($content, 0, $length));
        } else {
            $output = sprintf('
                %s ..
            ', $content );
        }

        return $output;
    }

    function excerpt_length($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(' ', $excerpt) .' ..';
        } else $excerpt = implode(' ', $excerpt);

        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        return $excerpt;
    }


    /**----/ Add excerpt to pages
     *
     * @author Ronny Rook / Just Right Webdesign
     **/
    function addExcerptsToPages() {
        add_post_type_support( 'page', 'excerpt' );
    }
    add_action( 'init', 'addExcerptsToPages' );

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



    /**
     * Separate media categories from post categories
     */
	add_filter( 'wpmediacategory_taxonomy', create_function( '', 'return "category_media";' ) );  //requires PHP 4.0.1 or newer



	/**
     * Add post thumbnails for every post type
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * Include: Walkers
     */
    include_once( 'inc/walkers/PrimaryArrowWalker.php' );