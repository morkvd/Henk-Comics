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
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" placeholder="Een title voor de afbeelding" />
        </fieldset>

        <fieldset>
            <label for="alt">Beschrijving</label>
            <input type="text" name="alt" id="alt" placeholder="Een beschrijving (alt tekst) voor de afbleeding" />
        </fieldset>

        <fieldset>
            <label for="selectFile">Bestand</label>
            <input type="button" name="selectFile" id="selectFile" class="button-secondary" value="Kiezen" />
            <span id="fileName">Selecteer een bestand..</span>

            <input type="hidden" name="file" id="file" />
        </fieldset>

	    <fieldset>
		    <label for="hideOverlying">Verbergen</label>
		    <label style="font-weight: normal;">
		        <input type="checkbox" id="hideOverlying" name="hideOverlying" value="N" /> Alle elementen over de afbeelding heen verbergen?
		    </label>
	    </fieldset>

	    <div>
		    <?php if ($this->settings['colors'] == 'Y') : ?>
			    <fieldset>
				    <label for="colorPickerField">Kleur</label>
				    <input type="text" name="color" maxlength="6" size="6" id="colorPickerField" value="ffffff">
			    </fieldset>
		    <?php else : ?>
			    <input type="hidden" name="color" value="ffffff">
		    <?php endif; ?>

	        <?php if ($this->settings['buttons'] == 'Y') : ?>
	            <script type='text/javascript'>
	                var buttonCount = 0;
	            </script>

	            <fieldset>
	                <label for="buttons">Buttons</label>
	                <input type="text" name="buttons[text][0]" class="buttonText" placeholder="Tekst voor de button" />
	                <input type="text" name="buttons[url][0]" class="buttonUrl" placeholder="URL van de button" />
	            </fieldset>

		        <div>
			        <a href="#" class="addButton">
				        Nieuwe button
			        </a>

			        <a href="#" class="deleteButton">
				        Verwijder button
			        </a>
		        </div>
	        <?php else : ?>
	            <input type="hidden" name="buttons" value="">
	        <?php endif; ?>
	    </div>

	    <div class="toggleHideOverlying hidden">
		    <fieldset>
			    <label for="directURL">Link</label>
			    <input type="text" id="directURL" name="directURL" placeholder="Link naar een interne of externe pagina">
		    </fieldset>
	    </div>

	    <fieldset>
		    <input type="hidden" name="rang" value="<?= $this->numberOfItems; ?>" />
            <?php submit_button('Toevoegen', 'primary', 'addItem', false); ?>
	    </fieldset>
    </form>
</div>