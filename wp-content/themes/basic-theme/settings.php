<?php
class themeSettings
{
    public $currentSettings;

    public $themeData;

    public $tabs;

    public $settingsPage;

    public $updated;

    public function __construct()
    {
        $this->currentSettings = get_option('jrwd_theme_settings');
        $this->themeData = wp_get_theme('child-theme');

        $this->updated = false;

        $this->tabs = array(
            'general' => 'Algemeen',
            'social' => 'Social media',
            'contact' => 'Contact'
        );

        if (empty($this->currentSettings))
            add_option('jrwd_theme_settings', $this->currentSettings, '', 'yes');
    }

    /**
     * Create admin menu
     *
     * @since 1.0.0
     *
     * @uses object $this->settingsPage Public object of this page.
     */
    public function createSettingsPage()
    {
        $this->settingsPage = add_theme_page(
            'Thema instellingen',
            'Voorkeuren',
            'edit_theme_options',
            'theme-settings',
            array($this, 'renderSettingsPage')
        );
    }

    /**
     * Define tabs on top of page
     *
     * @since 1.0.0
     *
     * @param string $current Make current tab active. Default is general.
     *
     * @uses array $this->themeData Array containing all theme data. Defined in __construct
     * @uses array $this->tabs Array of all possible tabs. Defined in __construct
     */
    public function defineTabs($current = 'general')
    {
        echo sprintf('
            <h2>%s - Instellingen</h2>
            <h2 class="nav-tab-wrapper">
        ', $this->themeData['Name']);

        foreach ($this->tabs as $tab => $name) :
            echo sprintf('
                <a class="nav-tab %s" href="?page=theme-settings&tab=%s">
                    %s
                </a>
            ', $tab == $current ? 'nav-tab-active' : null, $tab, $name);
        endforeach;

        echo '</h2>';
    }

    public function renderSettingsPage()
    {
        global $pagenow;

        if (isset($_POST['updateSettings']) && $_POST['updateSettings'] == 'Y') :
            $this->updateSettings();
            $this->updated = true;
        endif;

        if ($pagenow == 'themes.php' && isset($_GET['page']) && $_GET['page'] == 'theme-settings') :
            isset ($_GET['tab'])
                ? $this->defineTabs($_GET['tab'])
                : $this->defineTabs('general');

            wp_nonce_field('jrwd-settings-page');

            isset($_GET['tab'])
                ? $switchTab = $_GET['tab']
                : $switchTab = 'general';

            switch ($switchTab) :
                case 'general':
                    $this->render('general');
                    break;
                case 'social':
                    $this->render('social');
                    break;
                case 'contact':
                    $this->render('contact');
                    break;
            endswitch;
        endif;
    }

    public function updateSettings()
    {
        global $pagenow;
        $this->currentSettings = get_option('jrwd_theme_settings');

        if ($pagenow == 'themes.php' && $_GET['page'] == 'theme-settings') :
            isset($_GET['tab'])
                ? $tab = $_GET['tab']
                : $tab = 'general';

            switch ($tab) :
                case 'general':
	                foreach ($_POST['general'] as $field => $val)
		                $this->currentSettings['general'][$field] = $val;
                    break;

                case 'social':
	                $this->currentSettings['analytics'] = $_POST['analytics'];

                    foreach ($_POST['social'] as $field => $val)
                        $this->currentSettings['social'][$field] = $val;
                    break;

                case 'contact':
                    foreach ($_POST['contact'] as $field => $val)
                        $this->currentSettings['contact'][$field] = ($field == 'address') ? nl2br($val) : $val;
                    break;
            endswitch;

            update_option('jrwd_theme_settings', $this->currentSettings);

        endif;
    }

    /**
     * Render file to display
     *
     * @since 1.0.0
     *
     * @param string $file Required. Name of the file from views folder
     */
    public function render($file)
    {
        ob_start();
        include 'inc/settings/' . $file . '.php';
        $content = ob_get_clean();

        echo $content;
    }
}

$themeSettings = new themeSettings();
add_action( 'admin_menu', array(&$themeSettings, 'createSettingsPage') );