<div class="wrap">
	<?php if ($this->updated == true) echo '<div class="updated" ><p>Thema instellingen zijn opgslagen.</p></div>'; ?>

	<form method="post" action="<?php admin_url('themes.php?page=theme-settings'); ?>">
		<em>Er zijn nog geen algemene instellingen.</em>
	</form>
</div>