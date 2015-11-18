<div class="wrap jrwd">
    <h2><?= get_admin_page_title(); ?></h2>

	<?php
	if (!empty($this->message)) :
		echo sprintf('
			<div class="updated"><p>%s</p></div>
		', $this->message);
	endif;
	?>

    <form method="POST" action="">
	    <fieldset>
		    <label for="theme">Thema</label>
		    <select id="theme" name="theme">
			    <?php foreach ($this->files as $theme) : ?>
				    <option value="<?= $theme; ?>" <?= isset($this->settings['theme']) && $this->settings['theme'] == $theme ? 'selected' : null; ?>>
					    <?= ucfirst( str_replace('-', ' ', $theme) ); ?>
				    </option>
			    <?php endforeach; ?>
		    </select>
	    </fieldset>

	    <fieldset>
		    <label for="animation">Animatie</label>
		    <select id="animation" name="animation">
			    <option value="fade" <?= !isset($this->settings['animation']) || isset($this->settings['animation']) && $this->settings['animation'] == 'fade' ? 'selected' : null; ?>>
				    Fade in/uit
			    </option>

			    <option value="slide" <?= isset($this->settings['animation']) && $this->settings['animation'] == 'slide' ? 'selected' : null; ?>>
				    Slide links/rechts
			    </option>
		    </select>
	    </fieldset>

        <fieldset>
            <label for="intervalTime">Interval tijd (milliseconde)</label>
            <input type="text" name="intervalTime" id="intervalTime" placeholder="Default is 5000 (5s)" value="<?= !empty($this->settings['intervalTime']) ? $this->settings['intervalTime'] : '6000'; ?>" />
        </fieldset>

        <fieldset>
            <label for="timer">Timer balk</label>

            <label>
                <input type="radio" name="timer" value="Y" <?= isset($this->settings['timer']) && $this->settings['timer'] == 'Y' ? 'checked' : null; ?> /> Aan
            </label>

            <label>
                <input type="radio" name="timer" value="N" <?= !isset($this->settings['timer']) || $this->settings['timer'] == 'N' ? 'checked' : null; ?> /> Uit
            </label>
        </fieldset>

        <fieldset>
            <label for="controls">Navigatie controls</label>

            <label>
                <input type="radio" name="controls" value="Y" <?= isset($this->settings['controls']) && $this->settings['controls'] == 'Y' ? 'checked' : null; ?> /> Aan
            </label>

            <label>
                <input type="radio" name="controls" value="N" <?= !isset($this->settings['controls']) || $this->settings['controls'] == 'N' ? 'checked' : null; ?> /> Uit
            </label>
        </fieldset>

        <fieldset>
            <label for="buttons">Buttons</label>

            <label>
                <input type="radio" name="buttons" value="Y" <?= isset($this->settings['buttons']) && $this->settings['buttons'] == 'Y' ? 'checked' : null; ?> /> Aan
            </label>

            <label>
                <input type="radio" name="buttons" value="N" <?= !isset($this->settings['buttons']) || $this->settings['buttons'] == 'N' ? 'checked' : null; ?> /> Uit
            </label>
        </fieldset>

	    <fieldset>
		    <label for="colors">Kleuren</label>

		    <label>
			    <input type="radio" name="colors" value="Y" <?= isset($this->settings['colors']) && $this->settings['colors'] == 'Y' ? 'checked' : null; ?> /> Aan
		    </label>

		    <label>
			    <input type="radio" name="colors" value="N" <?= !isset($this->settings['colors']) || $this->settings['colors'] == 'N' ? 'checked' : null; ?> /> Uit
		    </label>
	    </fieldset>

	    <fieldset>
            <?php submit_button('Wijzigingen opslaan', 'primary', 'saveSettings'); ?>
	    </fieldset>
    </form>
</div>