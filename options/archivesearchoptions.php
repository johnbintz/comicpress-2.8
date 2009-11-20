	<div id="archivesearch" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-excerpt_or_content_archive": ?>
				<tr>
				<th scope="row"><strong><?php _e('Archive Viewing','comicpress'); ?></strong><br /><br /></th>
				<td valign="top">
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-content" type="radio" value="content"<?php if ( get_option( $value['id'] ) == "content") { echo " checked"; } ?> />Full Content</label>
				&nbsp;&nbsp;
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-excerpt" type="radio" value="excerpt"<?php if ( get_option( $value['id'] ) == "excerpt") { echo " checked"; } ?> />Excerpt</label>
				</td>
				<td valign="top">
				<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when viewing the archives?','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "comicpress-excerpt_or_content_search": ?>
				<tr>
				<th scope="row"><strong><?php _e('Searching','comicpress'); ?></strong><br /><br /></th>
				<td valign="top" width="160">
				
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-content" type="radio" value="content"<?php if ( get_option( $value['id'] ) == "content") { echo " checked"; } ?> />Full Content</label>
				&nbsp;&nbsp;
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-excerpt" type="radio" value="excerpt"<?php if ( get_option( $value['id'] ) == "excerpt") { echo " checked"; } ?> />Excerpt</label>


				</td>
				<td valign="top">
				<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when searching?','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "comicpress-archive_display_order": ?>
				<tr>
				<th scope="row"><strong><?php _e('Archive Display Order','comicpress'); ?></strong><br /><br /><?php _e('Sets the display order of your archives.','comicpress'); ?><br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option class="level-0" value="asc" <?php if (get_option($value['id']) == "asc") { ?>selected="selected"<?php } ?>>Oldest to Newest</option>
							<option class="level-0" value="desc" <?php if (get_option($value['id']) == "desc") { ?>selected="selected"<?php } ?>>Newest to Oldest</option>
						</select>
					</label>
				</td>
					<td valign="top">
						<?php _e('<b>Newest to Oldest</b> will display your posts starting with the most recent. <b>Oldest to Newest</b> will start with the first entry in the category, tag, or date range (e.g., Selecting May 20XX will start with May 1, not May 31st.)','comicpress'); ?>
					</td>
				</tr>
			<?php break;
			case "comicpress-category_thumbnail_postcount": ?>
				<tr>
					<th scope="row"><b><?php _e('Number of archived comics to display','comicpress'); ?></b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top">
						<?php _e('How many images in the comic category would you like to see in the archive page?','comicpress'); ?>
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
