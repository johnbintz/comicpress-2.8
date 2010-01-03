<div id="comicpress-menubar">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Menubar','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_default_menubar"><?php _e('Disable default Menubar','comicpress'); ?></label></th>
					<td>
						<input id="disable_default_menubar" name="disable_default_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_default_menubar']); ?> />
					</td>
					<td>
						<?php _e('Allows you to customize the location of the Menubar via Widgets.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_search_in_menubar"><?php _e('Enable Search Form','comicpress'); ?></label></th>
					<td>
						<input id="enable_search_in_menubar" name="enable_search_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_search_in_menubar']); ?> />
					</td>
					<td>
						<?php _e('Searchforms can be fun when you have something to search for.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_rss_in_menubar"><?php _e('Enable RSS Link','comicpress'); ?></label></th>
					<td>
						<input id="enable_rss_in_menubar" name="enable_rss_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_rss_in_menubar']); ?> />
					</td>
					<td>
					<?php _e('Adds an RSS link icon to your menubar on the right side.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_navigation_in_menubar"><?php _e('Enable mini navigation','comicpress'); ?></label></th>
					<td>
						<input id="enable_navigation_in_menubar" name="enable_navigation_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_navigation_in_menubar']); ?> />
					</td>
					<td>
						<?php _e('Mini Navigation adds small previous and next arrows arrow to the right side of your Menubar.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="contact_in_menubar"><?php _e('Enable Contact/custom links','comicpress'); ?></label></th>
					<td>
						<input id="contact_in_menubar" name="contact_in_menubar" type="checkbox" value="1" <?php checked(true, $comicpress_options['contact_in_menubar']); ?> />
					</td>
					<td>
					<?php _e('Adds a Contact button to the Menubar associated with your admin email.  You can also create a links category called <i>Menubar</i> and whatever links you add to that will appear in the Menubar.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_dynamic_menubar_links"><?php _e('Disable auto-generated WordPress links','comicpress'); ?></label></th>
					<td>
						<input id="disable_dynamic_menubar_links" name="disable_dynamic_menubar_links" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_dynamic_menubar_links']); ?> />
					</td>
					<td>
						<?php _e('Disable creation of the pages from the wordpress core.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_blogroll_off_links"><?php _e('Enable the blogroll to appear as a dropdown off the Links page','comicpress'); ?></label></th>
					<td>
						<input id="enable_blogroll_off_links" name="enable_blogroll_off_links" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_blogroll_off_links']); ?> />
					</td>
					<td>
						<?php _e('Allows you to show a dropdown of your blogroll off the page created Links.  When creating the links page, the name must be a capital-L lowercase inks for it to work.','comicpress'); ?>
					</td>
				</tr>
			</table>

		</div>

		<div class="comicpress-options-save">
			<div id="major-publishing-actions">
				<div id="publishing-action">
					<input name="comicpress_save_menubar" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_menubar" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
