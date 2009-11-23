<div id="buyprintoptions" class="<?php if ($tab == 'buyprint') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Custom Header Options</h3>
		<table class="form-table" style="width: auto;">
		
		<tr>
			<th scope="row">
				<?php _e('Paypal Email Address','comicpress'); ?><br />
				<input type="text" size="25" name="buy_print_email" id="buy_print_email" value="<?php echo $comicpress_options['buy_print_email']; ?>" />
			</th>
			<td valign="top" colspan="2">
				<span style="color: #ff0000;"><?php _e('* This must be correct, you do not want other people getting your money.','comicpress'); ?></span><br />
				<?php _e('The Email address you registered with Paypal and that your store is associated with.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row">
				<?php _e('Url Page of the Template','comicpress'); ?><br />
				<input type="text" size="25" name="buy_print_url" id="buy_print_url" value="<?php echo $comicpress_options['buy_print_url']; ?>" />
			</th>
			<td valign="top" colspan="2">
					<span style="color: #ff0000;"><?php _e('* This must be correct, the form needs some place to go.','comicpress'); ?></span><br />
					<?php _e('The URL address to which you associated the buy print template.','comicpress'); ?><br />
					<?php _e('Examples"','comicpress'); ?><br />
					http://yourdomain.com/?p=233<br />
					http://yourdomain.com/shop/<br />
					/?p=233<br />
					/shop/<br />
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Add shipping to each item?','comicpress'); ?></th>
			<td valign="top">
				<input name="buy_print_add_shipping" type="checkbox" value="1" <?php checked(true, $comicpress_options['buy_print_add_shipping']); ?> />
			</td>
			<td valign="top">
				<?php _e('Enabling this option will make it so that shipping costs will be added to each item purchased.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Print Cost (US/Canada)','comicpress'); ?></th>
			<td valign="top">
				<label>
					<input type="text" size="7" name="buy_print_us_amount" id="buy_print_us_amount" value="<?php echo $comicpress_options['buy_print_us_amount']; ?>" />
				</label>
			</td>
			<td valign="top">
				<?php _e('How much does a print cost for people in the United States and Canada?','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Shipping Cost (US/Canada)','comicpress'); ?></th>
			<td valign="top">
			<label>
				<input type="text" size="7" name="buy_print_us_ship" id="buy_print_us_ship" value="<?php echo $comicpress_options['buy_print_us_ship']; ?>" />
			</label>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Print Cost (International)','comicpress'); ?></th>
			<td valign="top">
				<label>
					<input type="text" size="7" name="buy_print_int_amount" id="buy_print_int_amount" value="<?php echo $comicpress_options['buy_print_int_amount']; ?>" />
				</label>
			</td>
			<td valign="top">
				<?php _e('How much does a print cost for people *NOT* in the United States and Canada (International)','comicpress'); ?>
			</td>
		</tr>
					
		<tr>
			<th scope="row"><?php _e('Shipping Cost (International)','comicpress'); ?></th>
			<td valign="top">
				<label>
					<input type="text" size="7" name="buy_print_int_ship" id="buy_print_int_ship" value="<?php echo $comicpress_options['buy_print_int_ship']; ?>" />
				</label>
			</td>
		</tr>
		
		</table>
	</div>
	<input name="comicpress_save_buyprint" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_buyprint" />
	</form>
</div>