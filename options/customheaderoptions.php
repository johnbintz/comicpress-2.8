	<div id="customheader" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
		<?php
		foreach ($comicpress_options as $value) {
			switch ( $value['type'] ) {
			case "enable_custom_image_header": ?>
				<tr>
				<th scope="row"><strong><?php _e('Use Custom Header?','comicpress'); ?></strong><br /><?php _e('Adds Custom Header option under Dashboard -> Appearance.','comicpress'); ?><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Allows you to add your own header image and customize or hide the default text.','comicpress'); ?>
				</td>
				</tr>
					
					<?php break;
				case "custom_image_header_width": ?>
					<tr>
					<th scope="row"><b><?php _e('Width','comicpress'); ?></b><br /><?php _e('Sets the <b>width</b> of the image you want to use for Custom Header.','comicpress'); ?><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top" rowspawn="5">
					<?php _e('Defaults widths are <b>780px</b> or <b>980px</b> depending on the layout. Refer to the width of the layout you chose and any custom changes you have made to site width in the CSS.','comicpress'); ?>
					</td>
					</tr>
					
				<?php break;
				case "custom_image_header_height": ?>
					<tr>
					<th scope="row"><b><?php _e('Height','comicpress'); ?></b><br /><?php _e('Sets the <b>height</b> of the image you want to use for Custom Header.','comicpress'); ?><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top">
					<?php _e('Recommended maximum height is <b>120px</b>, but if your logo/image demands it you can set it higher.','comicpress'); ?>
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