<?php
/*
Plugin Name: Just Right Webdesign - Slideshow
Plugin URI: http://www.justrightwebdesign.nl
Description: Custom plug-in voor het beheren en tonen van een slideshow.
Version: 1.0.0
Author: Ronny Rook / Just Right Webdesign
Author URI: http://www.justrightwebdesign.nl/
License: GPL3
*/

define( 'JRWD_SLIDESHOW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'JRWD_SLIDESHOW_PLUGIN_NAME', trim( dirname( JRWD_SLIDESHOW_PLUGIN_BASENAME ), '/' ) );
define( 'JRWD_SLIDESHOW_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
define( 'JRWD_SLIDESHOW_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

require_once(JRWD_SLIDESHOW_PLUGIN_DIR. '/model.php');
class JRWDSlideshowPlugin extends SlideshowModel
{
    public $wpdb;


    /**----- Database table name
     *
     * @since 1.0.0
     *
     * @var $wpdb->prefix
     */
    public $table;


    /**----- Display message
     *
     * In files from the 'views' directory
     *
     * @since 1.0.0
     */
    public $message;


    /**----- Contains plug-in settings
     *
     * @since 1.0.0
     */
    public $settings;



	/** @TODO 4. readme.txt toevoegen a.d.h.v. codex: https://codex.wordpress.org/Writing_a_Plugin */
	/** @TODO TOEKOMST ~~ meerdere slideshow kunnen aanmaken en oproepen met shortcode */

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->table = $wpdb->prefix. 'jrwd_slideshow';
        $this->message = false;

        $this->settings = get_option('jrwd_slideshow_settings');

        // Add menu to admin
        add_action( 'admin_menu', array(&$this, 'adminMenu') );

	    // Activation and deactivation
        register_activation_hook( __FILE__, array(&$this, 'install') );
        register_deactivation_hook( __FILE__, array(&$this, 'uninstall') );

	    // Enqueue scripts and styles for admin and front-end
        add_action( 'admin_enqueue_scripts',  array(&$this, 'enqueueAdmin') );

        add_action( 'wp_footer', array(&$this, 'enqueueFrontEndFooter') );
    }


	/**----- Check is loaded page is part of plug-in
	 *
	 * Using slug defined in adminMenu()
	 * JS and CSS are not loaded if false
	 *
	 * @since 1.0.0
	 * @return bool
	 */
    public function isPlugin()
    {
        $server_uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        foreach (array('jrwd-slideshow') as $allowURI)
            if (stristr($server_uri, $allowURI)) return true;

        return false;
    }


	/**----- Enqueue scripts & styles
	 *
	 * For both; Wordpress admin and website front-end.
	 *
	 * @since 1.0.0
	 *
	 * @action Admin ~ admin_enqueue_scripts
	 * @action Front-end ~ wp_footer
	 */
    public function enqueueAdmin()
    {
        if ($this->isPlugin()) {
            if (function_exists('wp_enqueue_media'))
                wp_enqueue_media();

	        // JS
	        wp_register_script('colorPicker', JRWD_SLIDESHOW_PLUGIN_URL.'/assets/js/colorpicker.js');
	        wp_enqueue_script('colorPicker');

            wp_register_script('jrwdSlideshow', JRWD_SLIDESHOW_PLUGIN_URL.'/assets/js/jrwdSlideshow.js');
            wp_enqueue_script('jrwdSlideshow');

	        // CSS
	        wp_register_style('colorPicker', JRWD_SLIDESHOW_PLUGIN_URL.'/assets/css/colorpicker.css');
	        wp_enqueue_style('colorPicker');

            wp_register_style('jrwdSlideshow', JRWD_SLIDESHOW_PLUGIN_URL.'/assets/css/jrwdSlideshow.css');
            wp_enqueue_style('jrwdSlideshow');

            wp_enqueue_style('media');
        }
    }

    public function enqueueFrontEndFooter()
    {
        wp_register_script('faderJS', JRWD_SLIDESHOW_PLUGIN_URL.'/assets/js/fader.js', array('jquery'));
        wp_enqueue_script('faderJS');
    }

    /**----- Create menu in Wordpress admin
     *
     * @since 1.0.0
     *
     * @var $this
     * @action admin_menu
     */
    public function adminMenu() {
        add_menu_page(null, 'Slideshow', 'edit_posts', 'jrwd-slideshow', null);

        add_submenu_page('jrwd-slideshow', 'Overzicht slides', 'Alle slides', 'edit_posts', 'jrwd-slideshow-overview', array(&$this, 'dashboard'));
        add_submenu_page('jrwd-slideshow', 'Slide toevoegen', 'Nieuwe slide', 'edit_posts', 'jrwd-slideshow-add', array(&$this, 'add'));
        add_submenu_page('jrwd-slideshow', 'Instellingen', 'Instellingen', 'edit_posts', 'jrwd-slideshow-settings', array(&$this, 'settings'));

        // Add submenu to edit (but don't show in menu)
        add_submenu_page(null, 'Aanpassen', 'Slide aanpassen', 'edit_posts', 'jrwd-slideshow-edit', array(&$this, 'edit'));

        // Remove automatic added submenu of add_menu_page (Slideshow)
        remove_submenu_page('jrwd-slideshow', 'jrwd-slideshow');
    }


	/*--------- VIEWS ---------*/
	/**----- Overview of all items
	 *
	 * Delete one, or multiple items
	 * Update the order by dragging items
	 *
	 * @since 1.0.0
	 */
	public function dashboard()
	{
		// Delete selected participant
		if (isset($_GET['deleteItems'])) {
			foreach (explode(',', $_GET['deleteItems']) as $row)
				$this->deleteItem($row);

			$this->message = 'Slide(s) zijn verwijderd!';
		}

		// Edit order of the items; with CASE query
		if (isset($_POST['updateOrder'])) {
			$string = 'UPDATE '. $this->table .' SET `rang` = CASE `id` ';

			foreach ($_POST['id'] as $order => $id)
				$string .= 'WHEN '. $id . ' THEN '. $order .' ';

			$string .= 'END';

			// Execute query
			$this->dbQuery($string);
			$this->message = 'Volgorde is aangepast!';
		}

        $this->items = $this->getAll(null, 'rang ASC');
        $this->render('admin/dashboard');
    }


	/** @TODO 3. toevoegen van buttons makkelijker maken (selecteren pagina's, openen nieuw tabblad) */
	/**----- Add a new item
	 *
	 * Possible to upload an image or a video
	 *
	 * @since 1.0.0
	 */
	public function add()
	{
		if (isset($_POST['addItem'])) {
			unset($_POST['addItem']);

			$_POST['buttons'] = isset($_POST['buttons']) ? serialize($_POST['buttons']) : null;
			$_POST['hideOverlying'] = !isset($_POST['hideOverlying']) ? 'N' : $_POST['hideOverlying'];

			$this->addItem( $_POST );
			$this->message = 'Slide is toegevoegd!';
		}

		$this->numberOfItems = count( $this->getAll() );
		$this->render('admin/add');
	}


	/**----- Update an item
	 *
	 * @since 1.0.0
	 */
	public function edit()
	{
		if (isset($_POST['editItem'])) {
			unset($_POST['editItem']);

			$_POST['buttons'] = isset($_POST['buttons']) ? serialize($_POST['buttons']) : null;
			$_POST['hideOverlying'] = !isset($_POST['hideOverlying']) ? 'N' : $_POST['hideOverlying'];

			$this->editItem( $_GET['id'], $_POST );
			$this->message = 'Slide is aangepast!';
		}

		$this->item = $this->getItem($_GET['id']);
		$this->render('admin/edit');
	}


	/**----- Edit plug-in settings
	 *
	 * @since 1.0.0
	 */
    public function settings()
    {
        if (isset($_POST['saveSettings'])) {
            unset($_POST['saveSettings']);
            foreach ($_POST as $field => $val)
                $this->settings[$field] = $val;

            update_option('jrwd_slideshow_settings', $this->settings);
	        $this->message = 'Instellingen zijn opgeslagen!';
        }

	    // Search all files from frontEnd directory to create themes
	    $this->files = array();
	    if ($handle = opendir( dirname(__FILE__) .'/views/frontEnd' )) {
		    while (false !== ($entry = readdir($handle))) {
			    if ($entry != '.' && $entry != '..')
				    $this->files[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
		    }

		    closedir($handle);
	    }

        $this->render('admin/settings');
    }


	/**----- Display slideshow
	 *
	 * Show items in fornt-end usign a theme template
	 * While no theme selected, render default theme
	 *
	 * @since 1.0.0
	 */
    public function displayHTML()
    {
	    $theme = isset($this->settings['theme']) ? $this->settings['theme'] : 'default';

	    $this->items = $this->getAll(null, 'rang ASC');
        $this->render('frontEnd/'. $theme);
    }


	/**----- Render file to display
	 *
	 * @since 1.0.0
	 *
	 * @param string $file ~ Required. Name of the file from views folder
	 */
	public function render($file)
	{
		ob_start();
		include 'views/' . $file . '.php';

		$content = ob_get_clean();
		echo $content;
	}
}


$slideshow = new JRWDSlideshowPlugin();
add_shortcode( 'JRWD_slideshow', array(&$slideshow, 'displayHTML') );
// do_shortcode('[JRWD_slideshow]')