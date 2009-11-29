<div id="customheader" class="<?php if ($tab == 'customheader') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">
	
		<table class="widefat">
			<thead>
				<tr>
					<th colspan="3">Custom Header</th>
				</tr>
			</thead>
			<tr class="alternate">
				<th scope="row"><label for="enable_custom_image_header"><?php _e('Use Custom Header','comicpress'); ?></label></th>
				<td>
					<input id="enable_custom_image_header" name="enable_custom_image_header" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_custom_image_header']); ?> />
				</td>
				<td>
					<?php _e('Adds Custom Header option under Dashboard -> Appearance.  Allows you to add your own header image and customize or hide the default text.','comicpress'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="custom_image_header_width"><?php _e('Width','comicpress'); ?></label></th>
				<td>
					<input type="text" size="5" name="custom_image_header_width" id="custom_image_header_width" value="<?php echo $comicpress_options['custom_image_header_width']; ?>" /><br />
				</td>
				<td>
					<?php _e('Sets the <b>width</b> of the image you want to use for Custom Header.  Defaults widths are <b>780px</b> or <b>980px</b> depending on the layout. Refer to the width of the layout you chose and any custom changes you have made to site width in the CSS.','comicpress'); ?>
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"><label for="custom_image_header_height"><?php _e('Height','comicpress'); ?></label></th>
				<td>
					<input type="text" size="5" name="custom_image_header_height" id="custom_image_header_height" value="<?php echo $comicpress_options['custom_image_header_height']; ?>" />
				</td>
				<td>
					<?php _e('Sets the <b>height</b> of the image you want to use for Custom Header.  Recommended maximum height is <b>120px</b>, but if your logo/image demands it you can set it higher.','comicpress'); ?>
				</td>
			</tr>
		</table>
		
	</div>
	
	<div id="comicpress-options-save">
			<div id="major-publishing-actions">
				<div id="publishing-action">
					<input name="comicpress_save_customheader" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_customheader" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
	
	</form>
	
</div>
