	<div id="customheader" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
		<?php
		foreach ($options as $value) {
			switch ( $value['type'] ) {
			case "comicpress-enable_custom_image_header": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Custom Image Header panel?','comicpress'); ?></strong><br /><br /><?php _e('Setting to &quot;Yes&quot; will set a new option in your Dashboard -> Appearance menu.','comicpress'); ?><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Setting to "Yes" will set a new option in your Dashboard -> Appearance menu.   Setting to "Yes" will set a new option in your Dashboard -> Appearance menu.   Setting to "No" will not set a new option in your Dashboard -> Appearance menu.   Setting to "Yes" will set a new option in your Dashboard -> Appearance menu.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
				case "comicpress-custom_image_header_height": ?>
					<tr>
					<th scope="row"><b><?php _e('Header Image Height','comicpress'); ?></b><br /><br /><?php _e('Set the <b>height</b> of the image you want to use in the Custom Image Header panel.','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top">
					<?php _e('This space intentionally left blank.','comicpress'); ?>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-custom_image_header_width": ?>
					<tr>
					<th scope="row"><b><?php _e('Header Image Width','comicpress'); ?></b><br /><br /><?php _e('Set the <b>width</b> of the image you want to use in the Custom Image Header panel.','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top" rowspawn="5">
					<?php _e('The Standard and V styles use <b>760</b> px width, while the 3C, GN, RGN and V3C use <b>980</b> px width.  This is configurable in case you set the #page, #page-width widths in the CSS to something different than the default while using the Custom Header panel.','comicpress'); ?>
					</td>
					</tr>
					
					<?php break;
			}
		}
		?>
		</table>
		<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
		<input type="hidden" name="action" value="comicpress_save" />
		</form>
		</div>
		</div>
