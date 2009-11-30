<div id="membersoptions" class="<?php if ($tab == 'members') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="2"><?php _e('Members Only Content','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row">
						<label for="members_post_category"><?php _e('Members category','comicpress'); ?></label>
						<?php 
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=0&orderby=name&echo=0&selected='.$comicpress_options['members_post_category']); 
							$select = preg_replace('#<select([^>]*)>#', '<select name="members_post_category" id="members_post_category">', $select);
							echo $select;
						?>
					</th>
					<td>
						<?php _e('The category that is designated to show members only content.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p><?php _e('USAGE: Edit the user with <em>Dashboard -> Users -> Authors & Users</em> and flag the user you want to be a member with the option at the bottom.','comicpress'); ?></p>
						<p><?php _e('Inside posts, add [members] content you only want members to see [/members]','comicpress'); ?></p>
						<p><?php _e('When setting a \'members\' category, you *cannot* use an existing comic category, uncategorized, or blog category!','comicpress'); ?></p>
						<p><?php _e('You MUST create a whole new category and called it "members", then you select that category here and create a page called "Members" or something equivelant and associate the Member\'s Only template to it.','comicpress'); ?></p>
						<p><?php _e('This will make it so that that category is only seen as blogposts inside that area and not anywhere else on the site unless the user has the members flag.','comicpress'); ?></p>
					</td>
				</tr>
			</table>

		</div>

		<div id="comicpress-options-save">
			<div id="major-publishing-actions">
				<div id="publishing-action">
					<input name="comicpress_save_members" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_members" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
