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
				<th scope="row"><strong>Would you like to have users see the entire content or just an excerpt when viewing the archives?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-excerpt" type="radio" value="excerpt"<?php if ( get_option( $value['id'] ) == "excerpt") { echo " checked"; } ?> />Excerpt</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-content" type="radio" value="content"<?php if ( get_option( $value['id'] ) == "content") { echo " checked"; } ?> />Content</label>
				</td>
				<td valign="top">
				</td>
				</tr>
				<?php break;
			case "comicpress-excerpt_or_content_search": ?>
				<tr>
				<th scope="row"><strong>Would you like to have users see the entire content or just an excerpt when searching?</strong><br /><br /></th>
				<td valign="top" width="160">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-excerpt" type="radio" value="excerpt"<?php if ( get_option( $value['id'] ) == "excerpt") { echo " checked"; } ?> />Excerpt</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-content" type="radio" value="content"<?php if ( get_option( $value['id'] ) == "content") { echo " checked"; } ?> />Content</label>
				</td>
				<td valign="top">
				</td>
				</tr>
				<?php break;
			case "comicpress-archive_display_order": ?>
				<tr>
				<th scope="row"><strong>Display Archive in Ascending or Descending order?</strong><br /><br />Long time ago or most recent displays first?<br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option class="level-0" value="asc" <?php if ($value['id'] == "asc") { ?>selected="selected"<?php } ?>>Ascending</option>
							<option class="level-0" value="desc" <?php if ($value['id'] == "desc") { ?>selected="selected"<?php } ?>>Descending</option>
						</select>
					</label>
				</td>
				</tr>
			<?php break;
			case "comicpress-category_thumbnail_postcount": ?>
				<tr>
					<th scope="row"><b>Thumbnail PostCount (Archive)</b><br /><br />How many images in the comic category would you like to see in the archive page?</th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top">
						If you set this to -1 it will display *all* available thumbnails for the comic category that is chosen to view.
					</td>
				</tr>
			<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Style" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>
