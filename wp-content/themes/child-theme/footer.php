    </main>

    <footer class="footer">
        <ul>
            <li>&#169; 2011 &ndash; 2015 Comics B.V.</li>
            <li>Geldersekade 96, 1012 BM Amsterdam</li>
            <li>Tel: (020) 4213688</li>
            <li>E&ndash;mail: henk@comics.nl</li>
        </ul>
    </footer>

	<script type="text/javascript" src="/libaries/jquery/jquery.js"></script>
	<script type="text/javascript" src="/libaries/jquery/mobile.js"></script>
    <script type="text/javascript" src="<?= get_stylesheet_directory_uri(); ?>/assets/js/default.js"></script>

    <?php wp_footer();

    if (is_page('Home')) : ?>
        <?php /* Maps */ ?>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=NL"></script>
        <script type="text/javascript" src="<?= get_stylesheet_directory_uri(); ?>/assets/js/contact.js"></script>

        <?php /* Slider */ ?>
	    <script type="text/javascript" src="/wp-content/plugins/jrwd-slideshow/assets/js/fader.min.js"></script>
	    <script type="text/javascript">
            $(document).ready( function() {
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