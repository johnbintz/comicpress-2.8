<div id="customheader" class="<?php if ($tab == 'customheader') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Custom Header Options</h3>
		<table class="form-table" style="width: auto;">
		
		<tr>
			<th scope="row"><?php _e('Use Custom Header?','comicpress'); ?></th>
			<td valign="top" width="100">
				<input name="enable_custom_image_header" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_custom_image_header']); ?> />
			</td>
			<td valign="top">
				<?php _e('Adds Custom Header option under Dashboard -> Appearance.  Allows you to add your own header image and customize or hide the default text.','comicpress'); ?>
			</td>
		</tr>
					
		<tr>
			<th scope="row"><?php _e('Width','comicpress'); ?></th>
			<td valign="top">
				<label>
					<input type="text" size="5" name="custom_image_header_width" id="custom_image_header_width" value="<?php echo $comicpress_options['custom_image_header_width']; ?>" /><br />
				</label>
			</td>
			<td valign="top" rowspawn="5">
				<?php _e('Sets the <b>width</b> of the image you want to use for Custom Header.  Defaults widths are <b>780px</b> or <b>980px</b> depending on the layout. Refer to the width of the layout you chose and any custom changes you have made to site width in the CSS.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Height','comicpress'); ?></th>
			<td valign="top">
				<label>
					<input type="text" size="5" name="custom_image_header_height" id="custom_image_header_height" value="<?php echo $comicpress_options['custom_image_header_height']; ?>" />
				</label>
			</td>
			<td valign="top">
				<?php _e('Sets the <b>height</b> of the image you want to use for Custom Header.  Recommended maximum height is <b>120px</b>, but if your logo/image demands it you can set it higher.','comicpress'); ?>
			</td>
		</tr>
		
		</table>
	</div>
	<input name="comicpress_save_customheader" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_customheader" />
	</form>
</div>