<div id="postoptions" class="<?php if ($tab == 'post') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<div id="comicpress-options">
		
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Post</th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="transcript_in_posts"><?php _e('Show transcript in post area?','comicpress'); ?></label></th>
					<td>
						<input id="transcript_in_posts" name="transcript_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['transcript_in_posts']); ?> />					
					</td>
					<td>
						<?php _e('When enabled, if the comic has a transcript, the transcript will be displayed inside the comic post.  The transcript is text that that you can have of the dialog in your comic.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_related_comics"><?php _e('Put Related Comics in comic posts?','comicpress'); ?></label></th>
					<td>
						<input id="enable_related_comics" name="enable_related_comics" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_comics']); ?> />					
					</td>
					<td>
						<?php _e('Comics will be related by "tags" that you create for each comic post.  When creating tags for your comics, include *only* the subject material and possibly cast. Do not use tags that can relate to the entire archive or storyline the post is in.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_related_posts"><?php _e('Put Related Posts in blog posts?','comicpress'); ?></label></th>
					<td>
						<input id="enable_related_posts" name="enable_related_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_posts']); ?> />					
					</td>
					<td>
						<?php _e('Blog posts will be related by "tags" that you create for each blog post.  Like the related posts for comics, the related posts for blog post checks with other blog posts comparing the tags. Try to only use 1-5 tags total; the less the better.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="remove_wptexturize"><?php _e('Disable WordPress default content formatting?','comicpress'); ?></label></th>
					<td>
						<input id="remove_wptexturize" name="remove_wptexturize" type="checkbox" value="1" <?php checked(true, $comicpress_options['remove_wptexturize']); ?> />					
					</td>
					<td>
						<?php _e('Prevents WordPress from reformatting any specially formatted content you may add. Generally, you want to leave the WordPress formatting enabled, but it some special cases you may prefer to preserve non-WP formatting.','comicpress'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Authors/Avatars/Moods</th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="split_column_in_two"><?php _e('Two author blog? ','comicpress'); ?></label></th>
					<td>
						<input id="split_column_in_two" name="split_column_in_two" type="checkbox" value="1" <?php checked(true, $comicpress_options['split_column_in_two']); ?> />					
					</td>
					<td>
						<?php _e('When enabled, it will make 2 seperate columns to have two seperate columns available to two different post authors.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" colspan="2">
						<label for="author_column_one"><?php _e('Author for column one?','comicpress'); ?></label>
						<?php
							$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $comicpress_options['author_column_one']);
							$selected = wp_dropdown_users($args);
							$selected = preg_replace('#<select([^>]*)>#', '<select name="author_column_one" id="author_column_one">', $selected);

							echo $selected;
						?>
					</th>
					<td>
						<?php _e('For two author blogs. Choose the author for the first column.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<label for="author_column_two"><?php _e('Author for column two?','comicpress'); ?></label>
						<?php
							$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $comicpress_options['author_column_two']);
							$selected = wp_dropdown_users($args);
							$selected = preg_replace('#<select([^>]*)>#', '<select name="author_column_two" id="author_column_two">', $selected);
							echo $selected;
						?>
					</th>
					<td>
						<?php _e('For two author blogs. Choose the author for the second column.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_comic_post_author_gravatar"><?php _e('Comic post author Gravatar?','comicpress'); ?></label></th>
					<td>
						<input id="enable_comic_post_author_gravatar" name="enable_comic_post_author_gravatar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comic_post_author_gravatar']); ?> />					
					</td>
					<td>
						<?php _e('Enabling this option will show a gravatar of the comic post author based on the author email address.  Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>. 
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_post_author_gravatar"><?php _e('Blog post author Gravatar?','comicpress'); ?></label></th>
					<td>
						<input id="enable_post_author_gravatar" name="enable_post_author_gravatar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_post_author_gravatar']); ?> />					
					</td>
					<td>
						<?php _e('Enabling this option will show a gravatar of the post author based on the author email address.  Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>. 
					</td>
				</tr>
				<?php
					$current_avatar_directory = $comicpress_options['avatar_directory'];
					if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
					$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
					$avatar_directories = array();
					foreach ($dirs_to_search as $dir) { $avatar_directories = array_merge($avatar_directories,glob("${dir}/images/avatars/*")); }
				?>
				<tr>
					<th scope="row" colspan="2">
						<label for="avatar_directory"><?php _e('Avatar Directory','comicpress'); ?></label>
						<select name="avatar_directory" id="avatar_directory">
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
					</th>
					<td>
						<?php _e('Choose a directory to get the avatars for default gravatars if someone does not have one.  You will have to make these images yourself, or download them from avatar providers. Then make a new directory on your site server to upload them to and select that directory here.','comicpress'); ?><br />
					</td>
				</tr>
				<?php
					$current_directory = $comicpres_options['moods_directory'];
					if (empty($current_directory)) $current_directory = 'default';
					$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
					$mood_directories = array();
					foreach ($dirs_to_search as $dir) { $mood_directories = array_merge($mood_directories,glob("${dir}/images/moods/*")); }
				?>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<label for="moods_directory"><?php _e('Moods Directory','comicpress'); ?></label>
						<select name="moods_directory" id="moods_directory">
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
					</th>
					<td>
						<?php _e('Choose a directory to get the post moods from.  Set this to "none" to turn off use.  Mood directories are found in your theme directory/images/moods/* to create your own custom moods just create a directory under images/moods/ and place ONLY image files inside of it. The name of the image file represents what the mood is.','comicpress'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Calendar</th>
					</tr>
				</thead>
				<?php
					$current_cal_directory = $comicpress_options['calendar_directory'];
					if (empty($current_cal_directory)) $current_cal_directory = 'default';
					$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
					$cal_directories = array();
					foreach ($dirs_to_search as $dir) { $cal_directories = array_merge($cal_directories,glob("${dir}/images/cal/*")); }
				?>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<label for="calendar_directory"><?php _e('Calendar Directory','comicpress'); ?></label>
						<select name="calendar_directory" id="calendar_directory">
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
					</th>
					<td>
						<?php _e('Choose a directory to get the Archive Calendar styling from.  To not have calendar graphics, select "none". Calendar directories are found in your theme directory/images/cal/* to create your own custom archive calendar images just create a directory under images/cal/ and place your image files inside of it.','comicpress'); ?>
					</td>
				</tr>	
				<tr>
					<th scope="row"><label for="enable_comic_post_calendar"><?php _e('Add graphic calendar to comic posts?','comicpress'); ?></label></th>
					<td>
						<input id="enable_comic_post_calendar" name="enable_comic_post_calendar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comic_post_calendar']); ?> />					
					</td>
					<td>
						<?php _e('The graphic calendar is an image that has the date of the comic blog post overlayed on top of it.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_post_calendar"><?php _e('Add graphic calendar to blog posts?','comicpress'); ?></label></th>
					<td>
						<input id="enable_post_calendar" name="enable_post_calendar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_post_calendar']); ?> />					
					</td>
					<td>
						<?php _e('Enabling this option will display a calendar image on your blog posts. The graphic calendar is an image that has the date of the blog post overlayed on top of it.','comicpress'); ?>
					</td>
				</tr>
			</table>
		
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Tags/Categories</th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_tags_in_posts"><?php _e('Disable display of tags in posts?','comicpress'); ?></label></th>
					<td>
						<input id="disable_tags_in_posts" name="disable_tags_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_tags_in_posts']); ?> />					
					</td>
					<td>
						<?php _e('Tags != Categories, Tags are "descriptive keywords" of content in a post.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_categories_in_posts"><?php _e('Disable display of categories in posts?','comicpress'); ?></label></th>
					<td>
						<input id="disable_categories_in_posts" name="disable_categories_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_categories_in_posts']); ?> />					
					</td>
					<td>
						<?php _e('Categories != Tags, The categories that are shown by default are the ones the post in set to.','comicpress'); ?>
					</td>
				</tr>
			</table>
	
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3">Pages &amp; Blog Loop</th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="blogposts_with_comic"><?php _e('Show all blog posts up until the next comic post on single pages?','comicpress'); ?></label></th>
					<td>
						<input id="blogposts_with_comic" name="blogposts_with_comic" type="checkbox" value="1" <?php checked(true, $comicpress_options['blogposts_with_comic']); ?> />					
					</td>
					<td>
						<?php _e('All the blog posts that are on the same day and greater to the next comic post on the comic your viewing will appear.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="static_blog"><?php _e('Blog loop stays with all the single pages?','comicpress'); ?></label></th>
					<td>
						<input id="static_blog" name="static_blog" type="checkbox" value="1" <?php checked(true, $comicpress_options['static_blog']); ?> />					
					</td>
					<td>
						<?php _e('Blog will stay with the single pages, good to use with comments disabled in the settings.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_page_titles"><?php _e('Disable the titles on pages?','comicpress'); ?></label></th>
					<td>
						<input id="disable_page_titles" name="disable_page_titles" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_page_titles']); ?> />					
					</td>
					<td>
						<?php _e('If you disable the titles no pages you can add a post-page-image in the page editor.','comicpress'); ?>
					</td>
				</tr>
			</table>
			
		</div>
	
		<div id="comicpress-options-save">
			<div id="major-publishing-actions">
				<div id="publishing-action">
						<input name="comicpress_save_post" type="submit" class="button-primary" value="Save Settings" />
						<input type="hidden" name="action" value="comicpress_save_post" />
					</div>
				<div class="clear"></div>
			</div>
		</div>
	
	</form>
	
</div>	