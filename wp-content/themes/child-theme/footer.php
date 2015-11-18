		</div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="col-md-3">
                <h3>&copy; <strong><?= get_bloginfo('name') ?></strong> <?= ' 2014 - '. date('Y'); ?></h3>
            </div>

            <?php
            if (!empty($GLOBALS['settings']['social'])) : ?>
            <nav class="secondary col-md-3 alignright">
                <h3>Social media</h3>

                <ul>
                    <?php foreach ($GLOBALS['settings']['social'] as $key => $val) :
                        if (!empty($val)) :
                            echo sprintf('
                                    <li>
                                        <a href="%s" target="_blank" class="%s">
                                            <span>%s</span>
                                        </a>
                                    </li>
                                ', $val, $key, ucfirst($key));
                        endif;
                    endforeach; ?>
                </ul>
            </nav>
            <?php endif; ?>

            <nav class="secondary col-md-3 alignright">
                <h3>Pagina's</h3>

                <?php
                $secondary = array(
                    'theme_location'  => 'footer',
                    'container' => false,
                    'items_wrap' => '<ul>%3$s</ul>'
                );

                wp_nav_menu($secondary);
                ?>
            </nav>
        </div>
    </footer>

    <script type="text/javascript" src="<?= get_stylesheet_directory_uri(); ?>/assets/js/default.js"></script>

    <?php
	wp_footer();

    if (is_page('Home')) : ?>
	    <script type="text/javascript" src="/wp-content/plugins/jrwd-slideshow/assets/js/fader.min.js"></script>
	    <script type="text/javascript">
	    $(document).ready( function($) {
		    var slider = $('.slider'),
			    slide = slider.find('div.slide');

		    if (slide.length > 1)
			    new Fader(slider, slide, false, false, 5000, 'fade');
	    });
	    </script>
    <?php endif;

    if (!empty($GLOBALS['settings']['analytics'])) :
        echo sprintf('
        <script type="text/javascript">
            %s
        </script>
        ', stripcslashes($GLOBALS['settings']['analytics']));
    endif;
    ?>
</body>
</html>