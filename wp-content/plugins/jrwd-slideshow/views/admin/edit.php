<?php
$buttons = unserialize($this->item->buttons);
$inputs = count($buttons['text']);
?>

<script type='text/javascript'>
	var buttonCount = <?= $inputs - 1; ?>;
</script>

<div class="wrap jrwd">
    <h2>Slide aanpassen</h2>

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
            <input type="text" name="title" id="title" placeholder="Een title voor de afbeelding" value="<?= !empty($this->item->title) ? $this->item->title : null; ?>" />
        </fieldset>

        <fieldset>
            <label for="alt">Beschrijving</label>
            <input type="text" name="alt" id="alt" placeholder="Een beschrijving (alt tekst) voor de afbleeding" value="<?= !empty($this->item->alt) ? $this->item->alt : null; ?>" />
        </fieldset>

        <fieldset>
            <label for="selectFile">Bestand</label>
            <input type="button" name="selectFile" id="selectFile" class="button-secondary" value="Kiezen" />
            <span id="fileName"><?= !empty($this->item->file) ? $this->item->file : 'Selecteer een bestand..'; ?></span>

            <input type="hidden" name="file" id="file" value="<?= !empty($this->item->file) ? $this->item->file : null; ?>" />
        </fieldset>

	    <fieldset>
		    <label for="hideOverlying">Verbergen</label>
		    <label style="font-weight: normal;">
			    <input type="checkbox" id="hideOverlying" name="hideOverlying" value="<?= !empty($this->item->hideOverlying) ? $this->item->hideOverlying : 'N'; ?>" <?= !empty($this->item->hideOverlying) && $this->item->hideOverlying == 'Y' ? 'checked' : null; ?> />
			    Alle elementen over de afbeelding heen verbergen?
		    </label>
	    </fieldset>

	    <div <?= !empty($this->item->hideOverlying) && $this->item->hideOverlying == 'Y' ? 'style="display:none;"' : null;?>>
		    <?php if ($this->settings['colors'] == 'Y') : ?>
			    <fieldset>
				    <label for="colorPickerField">Kleur</label>
				    <input type="text" name="color" maxlength="6" id="colorPickerField" value="<?= !empty($this->item->color) ? $this->item->color : 'ffffff'; ?>">
			    </fieldset>
		    <?php else : ?>
			    <input type="hidden" name="color" value="ffffff">
		    <?php endif; ?>

	        <?php if ($this->settings['buttons'] == 'Y') : ?>
	            <fieldset>
	                <label for="buttons">Buttons</label>
	                <?php for ($i = 0; $i < $inputs; $i++) : ?>
	                    <input type="text" name="buttons[text][<?= $i; ?>]" class="buttonText" value="<?= $buttons['text'][$i]; ?>" placeholder="Tekst voor de button" />
	                    <input type="text" name="buttons[url][<?= $i; ?>]" class="buttonUrl" value="<?= $buttons['url'][$i]; ?>" placeholder="URL van de button" />
	                <?php endfor; ?>
	            </fieldset>

		        <div>
			        <a href="#" class="addButton">
				        Nieuw button
			        </a>

			        <a href="#" class="deleteButton">
				        Verwijder button
			        </a>
		        </div>
	        <?php else : ?>
		        <input type="hidden" name="buttons" value="">
	        <?php endif; ?>
	    </div>

	    <div class="toggleHideOverlying hidden" <?= !empty($this->item->hideOverlying) && $this->item->hideOverlying == 'Y' ? 'style="display:block;"' : null;?>>
		    <fieldset>
			    <label for="link">Link</label>
			    <input type="text" id="link" name="link" placeholder="Link naar een interne of externe pagina" value="<?= !empty($this->item->link) ? $this->item->link : null; ?>">
		    </fieldset>
	    </div>

		<fieldset>
            <?php submit_button('Slide aanpassen', 'primary', 'editItem', false); ?>
		</fieldset>
    </form>
</div>