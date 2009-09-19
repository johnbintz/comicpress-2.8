	<div id="menubaroptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-enable_search_in_menubar": ?>
				<tr>
				<th scope="row"><strong>Enable Search Form in Menubar?</strong><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					Searchforms can be fun when you have something to search for.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_rss_in_menubar": ?>
				<tr>
				<th scope="row"><strong>Enable RSS Link in Menubar?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
					<td valign="top">
					It's a link, it links to the RSS.  It does *not* link to your the winning lottory numbers.
					</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_navigation_in_menubar": ?>
				<tr>
				<th scope="row"><strong>Enable mini navigation buttons in the Menubar?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					Mini Navigation arrows reside on the right side of the menubar, just the previous and next arrows.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-contact_in_menubar": ?>
				<tr>
				<th scope="row"><strong>Contact Link in Menubar</strong><br /><br />Setting to &quot;Yes&quot will put [&nbsp;CONTACT&nbsp;] in the menubar and associate it with your admin's email.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
				You can also create a links category called "menulinks" and whatever link you add to that will appear in the menubar.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_dynamic_menubar_links": ?>
				<tr>
				<th scope="row"><strong>Disable the dynamically generated wordpress links?</strong><br /><br />Setting this to Yes will turn off the dynamic links in your menubar.<br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					Setting this to yes will allow you to use the links category menulinks to create specific menu links for customizing the menubar, mostly used for making graphic images as links.
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
