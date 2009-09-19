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
					<th scope="row"><b>Paypal Email Address</b><span style="color: #ff0000;">*</span><br /><br />The Email address you registered with Paypal and that your store is associated with.</th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;">* This must be correct, you don't want other people getting your money.</span>
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_url": ?>
					<tr>
					<th scope="row"><b>Url Page of the Template</b><span style="color: #ff0000;">*</span><br /><br />The URL address to which you associated the buy print template.</th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;">* This must be correct, the form needs some place to go.</span><br />
					<b>Examples</b>:<br />
					http://yourdomain.com/?p=233<br />
					http://yourdomain.com/shop/<br />
					/?p=233<br />
					/shop/<br />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_us_amount": ?>
					<tr>
					<th scope="row"><b>Print Cost (US/Canada)</b><br /><br />How much does a print cost for people in the United State and Canada?</th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_us_ship": ?>
					<tr>
					<th scope="row"><b>Shipping Cost (US/Canada)</b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
				
					<?php break;
				case "comicpress-buy_print_int_amount": ?>
					<tr>
					<th scope="row"><b>Print Cost (International)</b><br /><br />How much does a print cost for people *NOT* in the United States and Canda (International)</th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_int_ship": ?>
					<tr>
					<th scope="row"><b>Shipping Cost (International)</b><br /><br /></th>
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
