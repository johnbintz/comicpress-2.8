<div id="configoptions" class="<?php if ($tab == 'config') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="2"><?php _e('Configuration','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row">
						<label for="comiccat"><?php _e('Comic Category','comicpress'); ?></label>
						<?php 
							global $comiccat;
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=0&orderby=name&echo=0&selected='.$comiccat); 
							$select = preg_replace('#<select([^>]*)>#', '<select name="comiccat" id="comicccat">', $select);
							echo $select;
						?>
					</th>
					<td>
						<?php _e('The category that is designated for the primary comic category.','comicpress'); ?>
					</td>
				</tr>
			</table>

		</div>

		<div id="comicpress-options-save">
			<div id="major-publishing-actions">
				<div id="publishing-action">
					<input name="comicpress_save_config" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_members" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
