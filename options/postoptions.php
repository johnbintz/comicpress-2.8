	<div id="postoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-transcript_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Show transcript in post area?','comicpress'); ?></strong><br /><br /><?php _e('When enabled, if the comic has a transcript, the transcript will be displayed inside the post for the comic.','comicpress'); ?></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('The transcript is text that that you can have of your comics speech.   When you add a transcript of the comic to the post-edit or when you upload your comic you can enable this and a transcript box will appear *in* that comics post area, alternatively you can set the transcript widget and have it placed anywhere *in* the same area of the comic.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-moods_directory": 
				$current_directory = get_option($value['id']);
				if (empty($current_directory)) $current_directory = 'default';
					
				$count = count($results = glob(get_template_directory() . '/images/moods/'.$current_directory.'/*'));
				$mood_directories = glob(get_template_directory() . '/images/moods/*');
			?>
				<tr>
				<th scope="row"><strong><?php _e('Moods Directory','comicpress'); ?></strong><br /><br /><?php _e('Choose a directory to get the post moods from.','comicpress'); ?><br /><br /><?php _e('Set this to "none" to turn off use.','comicpress'); ?><br /></th>
				<td valign="top">
						<label>
								<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option class="level-0" value="none" <?php if ($current_directory == "none") { ?>selected="selected"<?php } ?>>none</option>

				<?php
					foreach ($mood_directories as $mood_dirs) {
						if (is_dir($mood_dirs)) { 
							$mood_dir_name = basename($mood_dirs); ?>
							<option class="level-0" value="<?php echo $mood_dir_name; ?>" <?php if ($current_directory == $mood_dir_name) { ?>selected="selected"<?php } ?>><?php echo $mood_dir_name; ?></option>
					<?php }
					}
				?>
							</select>
						</label>
				</td>
				<td valign="top">
					<?php _e('Found:','comicpress'); ?> <?php echo $count; ?> <?php _e('moods in the','comicpress'); ?> "<?php echo $current_directory; ?>" <?php _e('directory.','comicpress'); ?><br />
					<br />
			<?php _e('Mood directories are found in your theme directory/images/moods/* to create your own custom moods just create a directory
					under images/moods/ and place ONLY image files inside of it.  The name of the image file represents what the mood is.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_related_comics": ?>
				<tr>
				<th scope="row"><strong><?php _e('Put Related Comics in comic posts?','comicpress'); ?></strong><br /><br /><?php _e('Related comics on the list will be related by "tags" that you create for each comic post.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('When creating tags for your comics, include *only* the subject material and possibly cast.   Do not use tags that can relate to the entire archive or storyline the post is on.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_related_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Put Related Posts in blog posts?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Like the related posts for comics, the related posts for blog post checked with other blog posts comparing the tags.  Do no use tags that relate to a massive amount of other things, make sure you stick to only using 1-5 tags total, the less the better.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_post_calendar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Add graphic calendar to blog posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will display a calendar image on your posts.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('The graphic calendar is an image that has the date of the post overlayed on top of it.  This option is for the blog posts.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-enable_post_author_gravatar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Display a gravatar of the post author on blog posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will show a gravatar of the post author based on the authors email.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>.  <?php _e('They are pictures of you, your cat of whatever you want to represent yourself.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-enable_comic_post_calendar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Add graphic calendar to comic posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will display a calendar image on your posts.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('The graphic calendar is an image that has the date of the post overlayed on top of it.  This option is for the comic posts, and yes this was cut and pasted from the other one just the word "blog" was changed to "comic".','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-enable_comic_post_author_gravatar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Display a gravatar of the post author on comic posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will show a gravatar of the post author based on the authors email.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>.  <?php _e('They are pictures of you, your cat of whatever you want to represent yourself.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-disable_categories_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable showing categories in posts?','comicpress'); ?></strong><br /><br /><?php _e('The categories that are shown by default are the ones the post in set to.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Categores != Tags','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-disable_tags_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable showing tags in posts?','comicpress'); ?></strong><br /><br /><?php _e('Tags are "descriptive keywords" describing the content of the post.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Tags != Categories','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-blogposts_with_comic": ?>
				<tr>
				<th scope="row"><strong><?php _e('Show all blog posts up until the next comic post on single pages?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('All the blog posts that are on the same day and greater to the next comic post on the comic your viewing will appear.','comicpress'); ?>
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
