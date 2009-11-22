	<div id="postoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">

<tr><td><h2>- Main -</h2></td></tr>

	<?php
	foreach ($comicpress_options as $value) {
		switch ( $value['type'] ) {
			case "transcript_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Show transcript in post area?','comicpress'); ?></strong><br /><br /><?php _e('When enabled, if the comic has a transcript, the transcript will be displayed inside the comic post.','comicpress'); ?></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('The transcript is text that that you can have of the dialog in your comic.','comicpress'); ?>
				</td>
				</tr>

				<?php break;
			case "enable_related_comics": ?>
				<tr>
				<th scope="row"><strong><?php _e('Put Related Comics in comic posts?','comicpress'); ?></strong><br /><br /><?php _e('Comics will be related by "tags" that you create for each comic post.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('When creating tags for your comics, include *only* the subject material and possibly cast. Do not use tags that can relate to the entire archive or storyline the post is in.','comicpress'); ?>
				</td>
				</tr>

				<?php break;
			case "enable_related_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Put Related Posts in blog posts?','comicpress'); ?></strong><br /><?php _e('Blog posts will be related by "tags" that you create for each blog post.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Like the related posts for comics, the related posts for blog post checks with other blog posts comparing the tags. Try to only use 1-5 tags total; the less the better.','comicpress'); ?>
				</td>
				</tr>

				<?php break;
			case "remove_wptexturize": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable WordPress default content formatting?','comicpress'); ?></strong><br /><?php _e('Prevents WordPress from reformatting any specially formatted content you may add.','comicpress'); ?><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Generally, you want to leave the WordPress formatting enabled, but it some special cases you may prefer to preserve non-WP formatting.','comicpress'); ?>
				</td>
				</tr>

<tr><td><h2>- Authors/Avatars/Moods -</h2></td></tr>

				<?php break;
			case "split_column_in_two": ?>
				<tr>
				<th scope="row"><strong><?php _e('Two author blog? ','comicpress'); ?></strong><br /><?php _e('When enabled, it will make 2 seperate columns to have two seperate columns available to two different post authors.','comicpress'); ?><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				</td>
				</tr>

				<?php break;
			case "author_column_one": ?>
				<tr>
				<th scope="row"><strong><?php _e('Author for Column one?','comicpress'); ?></strong><br /><br /><?php _e('If column is split in two.','comicpress'); ?></th>
				<td valign="top" width="100">
					<label>
					<?php
						$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $author_column_one);
						$selected = wp_dropdown_users($args);
						$selected = preg_replace('#<select([^>]*)>#', '<select name="'.$value['id'].'" id="'.$value['id'].'">', $selected);

						echo $selected;
					?>
					</label>
				</td>
				<td valign="top">
				</td>
				</tr>

				<?php break;
			case "author_column_two": ?>
				<tr>
				<th scope="row"><strong><?php _e('Author for Column two?','comicpress'); ?></strong><br /><br /><?php _e('If column is split in two.','comicpress'); ?></th>
				<td valign="top" width="100">
					<label>
			<?php
			$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $author_column_two);
			$selected = wp_dropdown_users($args);
			$selected = preg_replace('#<select([^>]*)>#', '<select name="'.$value['id'].'" id="'.$value['id'].'">', $selected);

			echo $selected;
							?>
					</label>
				</td>
				<td valign="top">
				</td>
				</tr>

				<?php break;
			case "enable_comic_post_author_gravatar":
			case "enable_post_author_gravatar":
				switch ($value['type']) {
					case "enable_comic_post_author_gravatar":
						$label = __('Comic post author Gravatar?','comicpress');
						break;
					case "enable_post_author_gravatar":
						$label = __('Blog post author Gravatar?','comicpress');
						break;
				} ?>
					<tr>
					<th scope="row"><strong><?php echo esc_html($label); ?></strong><br /><br /><?php _e('Enabling this option will show a gravatar of the post author based on the author email address.','comicpress'); ?></th>
					<td valign="top">
					<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
					&nbsp;&nbsp;
					<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
					</td>
					<td valign="top">
						<?php _e('Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>.  <?php _e('They are pictures of you, your cat of whatever you want to be your representation on your posts and comments.','comicpress'); ?>
					</td>
					</tr><?php
				break;
			case "avatar_directory":
				$current_avatar_directory = get_option($value['id']);
				if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
				$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
				$avatar_directories = array();
				foreach ($dirs_to_search as $dir) { $avatar_directories = array_merge($avatar_directories,glob("${dir}/images/avatars/*")); }
				?>
				<tr>
				<th scope="row"><strong><?php _e('Avatar (no Gravatar) Directory','comicpress'); ?></strong><br /><br /><?php _e('Choose a directory to get the avatars for default gravatars if someone does not have one. ','comicpress'); ?><br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option class="level-0" value="none" <?php if ($current_cal_directory == "none") { ?>selected="selected"<?php } ?>>none</option>
				<?php
					foreach ($avatar_directories as $avatar_dirs) {
						if (is_dir($avatar_dirs)) {
							$avatar_dir_name = basename($avatar_dirs); ?>
							<option class="level-0" value="<?php echo $avatar_dir_name; ?>" <?php if ($current_avatar_directory == $avatar_dir_name) { ?>selected="selected"<?php } ?>><?php echo $avatar_dir_name; ?></option>
					<?php }
					}
				?>
						</select>
					</label>
				</td>
				<td valign="top">
				<?php _e('Choose directory for avatars to display with non-Gravatar users. You will have to make these images yourself, or download them from avatar providers. Then make a new directory on your site server to upload them to and select that directory here.','comicpress'); ?><br />
					<br />
				</td>
				</tr>
				<?php break;
			case "moods_directory":
				$current_directory = get_option($value['id']);
				if (empty($current_directory)) $current_directory = 'default';

				$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
				$mood_directories = array();
				foreach ($dirs_to_search as $dir) { $mood_directories = array_merge($mood_directories,glob("${dir}/images/moods/*")); }
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
			<?php _e('Select "none" to turn off. Mood directories are found in your theme directory/images/moods/* to create your own custom moods just create a directory under images/moods/ and place ONLY image files inside of it. The name of the image file represents what the mood is.','comicpress'); ?>
				</td>
				</tr>

<tr><td><h2>- Calendar -</h2></td></tr>


			<?php break;
			case "calendar_directory":
				$current_cal_directory = get_option($value['id']);
				if (empty($current_cal_directory)) $current_cal_directory = 'default';

				$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
				$cal_directories = array();
				foreach ($dirs_to_search as $dir) { $cal_directories = array_merge($cal_directories,glob("${dir}/images/cal/*")); }
				?>
				<tr>
				<th scope="row"><strong><?php _e('Calendar Directory','comicpress'); ?></strong><br /><br /><?php _e('Choose a directory to get the Archive Calendar styling from.','comicpress'); ?><br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
						<option class="level-0" value="none" <?php if ($current_cal_directory == "none") { ?>selected="selected"<?php } ?>>none</option>
				<?php
					foreach ($cal_directories as $cal_dirs) {
						if (is_dir($cal_dirs)) {
							$cal_dir_name = basename($cal_dirs); ?>
							<option class="level-0" value="<?php echo $cal_dir_name; ?>" <?php if ($current_cal_directory == $cal_dir_name) { ?>selected="selected"<?php } ?>><?php echo $cal_dir_name; ?></option>
					<?php }
					}
				?>
						</select>
					</label>
				</td>
				<td valign="top">
					<?php _e('To not have calendar graphics, set this as "none".','comicpress'); ?><br />
					<br />
			<?php _e('To not have calendar graphics, select "none". Calendar directories are found in your theme directory/images/cal/* to create your own custom archive calendar images just create a directory under images/cal/ and place your image files inside of it.','comicpress'); ?>
				</td>
				</tr>
			<?php break;
			case "enable_comic_post_calendar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Add graphic calendar to comic posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will display a calendar image on your comic posts.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('The graphic calendar is an image that has the date of the comic blog post overlayed on top of it.','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "enable_post_calendar": ?>
				<tr>
				<th scope="row"><strong><?php _e('Add graphic calendar to blog posts?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will display a calendar image on your blog posts.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('The graphic calendar is an image that has the date of the blog post overlayed on top of it.','comicpress'); ?>
				</td>
				</tr>

<tr><td><h2>- Tags/Categories -</h2></td></tr>

				<?php break;
			case "disable_tags_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable display of tags in posts?','comicpress'); ?></strong><br /><br /><?php _e('Tags are "descriptive keywords" of content in a post.','comicpress'); ?></th>
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
			case "disable_categories_in_posts": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable display of categories in posts?','comicpress'); ?></strong><br /><br /><?php _e('The categories that are shown by default are the ones the post in set to.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Categories != Tags','comicpress'); ?>
				</td>
				</tr>

<tr><td><h2>- Pages & Blog Loop -</h2></td></tr>

				<?php break;
			case "blogposts_with_comic": ?>
				<tr>
				<th scope="row"><strong><?php _e('Show all blog posts up until the next comic post on single pages?','comicpress'); ?></strong><br /></th>
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

			case "static_blog": ?>
				<tr>
				<th scope="row"><strong><?php _e('Blog loop stays with all the single pages?','comicpress'); ?></strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Blog will stay with the single pages, good to use with comments disabled in the settings.','comicpress'); ?>
				</td>
				</tr>
				<?php break;

			case "disable_page_titles": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the titles on pages?','comicpress'); ?></strong><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('If you disable the titles no pages you can add a post-page-image in the page editor.','comicpress'); ?>
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
