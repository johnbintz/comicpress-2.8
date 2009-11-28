<div id="archivesearch" class="<?php if ($tab == 'archivesearch') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Archive &amp; Search Page Options</th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<?php _e('Archive Viewing','comicpress'); ?><br />
						<input name="excerpt_or_content_archive" id="content_archive" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "content") { echo " checked"; } ?> /> <label for="content_archive" class="inline-label"><?php _e('Full Content','comicpress'); ?></label>
						<input name="excerpt_or_content_archive" id="excerpt_archive" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "excerpt") { echo " checked"; } ?> /> <label for="excerpt_archive" class="inline-label"><?php _e('Excerpt','comicpress'); ?></label>
					</th>
					<td>
						<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when viewing the archives?','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" colspan="2">
						<?php _e('Searching','comicpress'); ?><br />
						<input  name="excerpt_or_content_search" id="content_search" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_search'] == "content") { echo " checked"; } ?> /> <label for="content_search" class="inline-label"><?php _e('Full Content','comicpress'); ?></label>
						<input name="excerpt_or_content_search" id="excerpt_search" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_search'] == "excerpt") { echo " checked"; } ?> /> <label for="excerpt_search" class="inline-label"><?php _e('Excerpt','comicpress'); ?></label>
					</th>
					<td>
						<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when searching?','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" colspan="2">
						<label for="archive_display_order"><?php _e('Archive Display Order','comicpress'); ?></label>
						<select name="archive_display_order" id="archive_display_order">
							<option class="level-0" value="asc" <?php if ($comicpress_options['archive_display_order'] == "asc") { ?>selected="selected"<?php } ?>>Oldest to Newest</option>
							<option class="level-0" value="desc" <?php if ($comicpress_options['archive_display_order'] == "desc") { ?>selected="selected"<?php } ?>>Newest to Oldest</option>
						</select>
					</th>
					<td>
						<?php _e('Sets the display order of your archives. <b>Newest to Oldest</b> will display your posts starting with the most recent. <b>Oldest to Newest</b> will start with the first entry in the category, tag, or date range (e.g., Selecting May 20XX will start with May 1, not May 31st.)','comicpress'); ?>
					</td>
				</tr>
	
		<tr>
			<th scope="row"><label for="category_thumbnail_postcount"><?php _e('Number of archived comics to display','comicpress'); ?></label></th>
			<td>
				<label>
				<input type="text" size="3" name="category_thumbnail_postcount" id="category_thumbnail_postcount" value="<?php echo $comicpress_options['category_thumbnail_postcount']; ?>" /><br />
				</label>
			</td>
			<td>
				<?php _e('How many images in the comic category would you like to see in the archive page?','comicpress'); ?>
			</td>
		</tr>
					
		</table>
	</div>
	
	<input name="comicpress_save_archivesearch" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_archivesearch" />
	</form>
</div>
