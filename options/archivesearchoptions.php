<div id="archivesearch" class="hide">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Archive and Search Page Options</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Archive Viewing','comicpress'); ?></th>
			<td valign="top">
				<label><input  name="excerpt_or_content_archive" id="excerpt_or_content_archive" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "content") { echo " checked"; } ?> />Full Content</label>
				&nbsp;&nbsp;
				<label><input name="excerpt_or_content_archive" id="excerpt_or_content_archive" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "excerpt") { echo " checked"; } ?> />Excerpt</label>
			</td>
			<td valign="top">
				<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when viewing the archives?','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Searching','comicpress'); ?></th>
			<td valign="top" width="160">				
				<label><input  name="excerpt_or_content_search" id="excerpt_or_content_search" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_search'] == "content") { echo " checked"; } ?> />Full Content</label>
				&nbsp;&nbsp;
				<label><input name="excerpt_or_content_search" id="excerpt_or_content_search" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_search'] == "excerpt") { echo " checked"; } ?> />Excerpt</label>
			</td>
			<td valign="top">
				<?php _e('Would you like to have users see the <b>full content</b> or just an <b>excerpt</b> when searching?','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Archive Display Order','comicpress'); ?></th>
			<td valign="top">
				<label>
					<select name="archive_display_order" id="archive_display_order">
						<option class="level-0" value="asc" <?php if ($comicpress_options['archive_display_order'] == "asc") { ?>selected="selected"<?php } ?>>Oldest to Newest</option>
						<option class="level-0" value="desc" <?php if ($comicpress_options['archive_display_order'] == "desc") { ?>selected="selected"<?php } ?>>Newest to Oldest</option>
					</select>
				</label>
			</td>
			<td valign="top">
				<?php _e('Sets the display order of your archives. <b>Newest to Oldest</b> will display your posts starting with the most recent. <b>Oldest to Newest</b> will start with the first entry in the category, tag, or date range (e.g., Selecting May 20XX will start with May 1, not May 31st.)','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Number of archived comics to display','comicpress'); ?></th>
			<td valign="top">
				<label>
				<input type="text" size="5" name="category_thumbnail_postcount" id="category_thumbnail_postcount" value="<?php echo $comicpress_options['category_thumbnail_postcount']; ?>" /><br />
				</label>
			</td>
			<td valign="top">
				<?php _e('How many images in the comic category would you like to see in the archive page?','comicpress'); ?>
			</td>
		</tr>
					
		</table>
	</div>
	
	<input name="comicpress_save_archivesearch" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_archivesearch" />
	</form>
	</div>
</div>
