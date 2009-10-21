	<div id="menubaroptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-disable_default_menubar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the default menubar?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('This will let you use the menubar widget to place the menubar in other sidebars.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_search_in_menubar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Search Form in Menubar?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Searchforms can be fun when you have something to search for.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_rss_in_menubar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable RSS Link in Menubar?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
					<td valign="top">
					<?php _e('It is a link, it links to the RSS.  It does *not* link to your the winning lottory numbers.','comicpress'); ?>
					</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_navigation_in_menubar": ?>
				<tr>
				<th scope="row"><strong><?Php _e('Enable mini navigation buttons in the Menubar?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Mini Navigation arrows reside on the right side of the menubar, just the previous and next arrows.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-contact_in_menubar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Contact Link in Menubar','comicpress'); ?></strong><br /><br /><?php _e('Setting to &quot;Yes&quot will put [&nbsp;CONTACT&nbsp;] in the menubar and associate it with your admin email.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('You can also create a links category called "menubar" and whatever link you add to that will appear in the menubar.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_dynamic_menubar_links": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the dynamically generated wordpress links?','comicpress'); ?></strong><br /><br /><?php _e('Setting this to Yes will turn off the dynamic links in your menubar.','comicpress'); ?><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Setting this to yes will allow you to use the links category menulinks to create specific menu links for customizing the menubar, mostly used for making graphic images as links.','comicpress'); ?>
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
