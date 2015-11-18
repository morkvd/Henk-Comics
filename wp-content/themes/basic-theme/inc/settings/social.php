<div class="wrap">
	<?php if ($this->updated == true) echo '<div class="updated" ><p>Thema instellingen zijn opgslagen.</p></div>'; ?>

	<form method="post" action="<?php admin_url('themes.php?page=theme-settings'); ?>">
		<table class="form-table">
			<tr>
				<th><label for="social[facebook]">Facebook:</label></th>
				<td>
					<input type="text" name="social[facebook]" id="social[facebook]" value="<?= !empty($this->currentSettings['social']['facebook']) ? esc_html( stripslashes($this->currentSettings['social']['facebook']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="social[instagram]">Instagram:</label></th>
				<td>
					<input type="text" name="social[instagram]" id="social[instagram]" value="<?= !empty($this->currentSettings['social']['instagram']) ? esc_html( stripslashes($this->currentSettings['social']['instagram']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="social[youtube]">Youtube:</label></th>
				<td>
					<input type="text" name="social[youtube]" id="social[youtube]" value="<?= !empty($this->currentSettings['social']['youtube']) ? esc_html( stripslashes($this->currentSettings['social']['youtube']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="social[twitter]">Twitter:</label></th>
				<td>
					<input type="text" name="social[twitter]" id="social[twitter]" value="<?= !empty($this->currentSettings['social']['twitter']) ? esc_html( stripslashes($this->currentSettings['social']['twitter']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="social[linkedin]">LinkedIn:</label></th>
				<td>
					<input type="text" name="social[linkedin]" id="social[linkedin]" value="<?= !empty($this->currentSettings['social']['linkedin']) ? esc_html( stripslashes($this->currentSettings['social']['linkedin']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="analytics">Analytics:</label></th>
				<td>
					<textarea name="analytics" id="analytics" cols="40" rows="5"><?= !empty($this->currentSettings['analytics']) ? esc_html( stripslashes($this->currentSettings['analytics']) ) : null; ?></textarea>
				</td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" name="updateSettings" class="button-primary" value="Instellingen opslaan" />
			<input type="hidden" name="updateSettings" value="Y" />
		</p>
	</form>
</div>