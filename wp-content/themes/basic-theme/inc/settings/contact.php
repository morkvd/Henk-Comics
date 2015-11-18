<div class="wrap">
	<?php if ($this->updated == true) echo '<div class="updated" ><p>Thema instellingen zijn opgslagen.</p></div>'; ?>

	<form method="post" action="<?php admin_url('themes.php?page=theme-settings'); ?>">
		<table class="form-table">
			<tr>
				<th><label for="contact[address]">Adres:</label></th>
				<td>
					<textarea name="contact[address]" id="contact[address]" cols="40" rows="5"><?= !empty($this->currentSettings['contact']['address']) ? esc_html( stripslashes(preg_replace('/\<br(\s*)?\/?\>/i', '', $this->currentSettings['contact']['address'])) ) : null; ?></textarea>
				</td>
			</tr>

			<tr>
				<th><label for="contact[email]">E-mail adres:</label></th>
				<td>
					<input type="text" name="contact[email]" id="contact[email]" value="<?= !empty($this->currentSettings['contact']['email']) ? esc_html( stripslashes($this->currentSettings['contact']['email']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="contact[phone]">Tel. nummer:</label></th>
				<td>
					<input type="text" name="contact[phone]" id="contact[phone]" value="<?= !empty($this->currentSettings['contact']['phone']) ? esc_html( stripslashes($this->currentSettings['contact']['phone']) ) : null; ?>" />
				</td>
			</tr>

			<tr>
				<th><label for="contact[mobile]">Mobiel:</label></th>
				<td>
					<input type="text" name="contact[mobile]" id="contact[mobile]" value="<?= !empty($this->currentSettings['contact']['mobile']) ? esc_html( stripslashes($this->currentSettings['contact']['mobile']) ) : null; ?>" />
				</td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" name="updateSettings" class="button-primary" value="Instellingen opslaan" />
			<input type="hidden" name="updateSettings" value="Y" />
		</p>
	</form>
</div>