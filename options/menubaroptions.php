<div id="menubaroptions" class="hide">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Main</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Disable default Menubar?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_default_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_default_menubar']); ?> />
			</td>
			<td valign="top">
				<?php _e('Allows you to customize the location of the Menubar via Widgets.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Enable Search Form?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_search_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_search_in_menubar']); ?> />
			</td>
			<td valign="top">
				<?php _e('Searchforms can be fun when you have something to search for.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Enable RSS Link?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_rss_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_rss_in_menubar']); ?> />
			</td>
			<td valign="top">
			<?php _e('Adds an RSS link icon to your menubar on the right side.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?Php _e('Enable mini navigation','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_navigation_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_navigation_in_menubar']); ?> />
			</td>
			<td valign="top">
				<?php _e('Mini Navigation adds small previous and next arrows arrow to the right side of your Menubar.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Enable Contact/custom links?','comicpress'); ?></th>
			<td valign="top">
				<input name="contact_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['contact_in_menubar']); ?> />
			</td>
			<td valign="top">
			<?php _e('Adds a <b>Contact</b> button to the Menubar associated with your admin email. You can also create a links category called <i>Menubar</i> and whatever links you add to that will appear in the Menubar.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Disable auto-generated WordPress links?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_dynamic_menubar_links" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_dynamic_menubar_links']); ?> />
			</td>
			<td valign="top">
				<?php _e('Allows you to use the links category <i>menubar</i> (you will need to create this category if it does not already exist) to create custom links on the Menubar (mostly used for making graphic images as links). Otherwise, ALL published pages will appear automatically.','comicpress'); ?>
			</td>
		</tr>
				
		</table>
	</div>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />	
	</form>
</div>	
