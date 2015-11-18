<div class="wrap jrwd">
	<h2>
		<?= get_admin_page_title(); ?>

			<a href="/wp-admin/admin.php?page=jrwd-slideshow-add" class="add-new-h2">
			Nieuwe slide
		</a>
	</h2>

	<?php
	if (!empty($this->message)) :
		echo sprintf('
			<div class="updated"><p>%s</p></div>
		', $this->message);
	endif;
	?>

	<form action="" method="POST">
		<table class="widefat fixed" cellspacing="0">
	        <thead>
	            <tr>
		            <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
	                <th id="columnname" class="manage-column column-columnname" scope="col">Afbeelding</th>
	                <th id="columnname" class="manage-column column-columnname" scope="col">Beschrijving</th>
	            </tr>
	        </thead>

		    <tbody id="withOrder">
		        <?php $row = 0;
		        foreach ($this->items as $item) : ?>

				    <tr <?= $row%2 == 1 ? 'class="alternate"' : null; ?>>
					    <td class="check-column" scope="row">
						    <input type="checkbox" name="deleteItems[]" value="<?= $item->id; ?>" />
						    <span class="move">
							    <img src="<?= JRWD_SLIDESHOW_PLUGIN_URL; ?>/assets/images/move.svg" alt="Move current row" />
						    </span>

						    <input type="hidden" name="id[]" value="<?= $item->id; ?>" />
					    </td>

	                    <td class="image column-columnname">
		                    <a href="?page=jrwd-slideshow-edit&id=<?= $item->id; ?>">
	                            <div style="background-image: url('<?= $item->file; ?>');"></div>
		                    </a>
	                    </td>

					    <td class="column-columnname">
						    <a href="?page=jrwd-slideshow-edit&id=<?= $item->id; ?>">
							    <?= !empty($item->alt) ? $item->alt : 'Geen beschrijving toegevoegd' ?>
						    </a>
					    </td>
	                </tr>

	                <?php $row++;
				endforeach; ?>
	        </tbody>
	    </table>

		<input type="submit" name="updateOrder" class="updateOrder alignleft button-primary" value="Volgorde opslaan">
		<input type="submit" name="deleteItems" class="deleteMore alignright button-primary" value="Verwijder item(s)">
	</form>
</div>