	<div id="buyprintoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">

		<?php
		foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "comicpress-buy_print_email": ?>
					<tr>
					<th scope="row"><b><?php _e('Paypal Email Address','comicpress'); ?></b><span style="color: #ff0000;">*</span><br /><br /><?php _e('The Email address you registered with Paypal and that your store is associated with.','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;"><?php _e('* This must be correct, you do not want other people getting your money.','comicpress'); ?></span>
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_url": ?>
					<tr>
					<th scope="row"><b><?php _e('Url Page of the Template','comicpress'); ?></b><span style="color: #ff0000;">*</span><br /><br /><?php _e('The URL address to which you associated the buy print template.','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;"><?php _e('* This must be correct, the form needs some place to go.','comicpress'); ?></span><br />
					<b><?php _e('Examples','comicpress'); ?></b>:<br />
					http://yourdomain.com/?p=233<br />
					http://yourdomain.com/shop/<br />
					/?p=233<br />
					/shop/<br />
					</label>
					</td>
					</tr>
					
					<?php break;
			case "comicpress-buy_print_add_shipping": ?>
				<tr>
				<th scope="row"><strong><?php _e('Add shipping to each item?','comicpress'); ?></strong><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Enabling this option will make it so that shipping costs will be added to each item purchased.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
				case "comicpress-buy_print_us_amount": ?>
					<tr>
					<th scope="row"><b><?php _e('Print Cost (US/Canada)','comicpress'); ?></b><br /><br /><?php _e('How much does a print cost for people in the United State and Canada?','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_us_ship": ?>
					<tr>
					<th scope="row"><b><?php _e('Shipping Cost (US/Canada)','comicpress'); ?></b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
				
					<?php break;
				case "comicpress-buy_print_int_amount": ?>
					<tr>
					<th scope="row"><b><?php _e('Print Cost (International)','comicpress'); ?></b><br /><br /><?php _e('How much does a print cost for people *NOT* in the United States and Canda (International)','comicpress'); ?></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_int_ship": ?>
					<tr>
					<th scope="row"><b><?php _e('Shipping Cost (International)','comicpress'); ?></b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
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
