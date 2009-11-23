<div id="postoptions" class="<?php if ($tab == 'post') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Post</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Show transcript in post area?','comicpress'); ?></th>
			<td valign="top">
				<input name="transcript_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['transcript_in_posts']); ?> />					
			</td>
			<td valign="top">
				<?php _e('When enabled, if the comic has a transcript, the transcript will be displayed inside the comic post.  The transcript is text that that you can have of the dialog in your comic.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Put Related Comics in comic posts?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_related_comics" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_comics']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Comics will be related by "tags" that you create for each comic post.  When creating tags for your comics, include *only* the subject material and possibly cast. Do not use tags that can relate to the entire archive or storyline the post is in.','comicpress'); ?>
			</td>
		</tr>

		<tr>
		<th scope="row"><?php _e('Put Related Posts in blog posts?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_related_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_posts']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Blog posts will be related by "tags" that you create for each blog post.  Like the related posts for comics, the related posts for blog post checks with other blog posts comparing the tags. Try to only use 1-5 tags total; the less the better.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Disable WordPress default content formatting?','comicpress'); ?></th>
			<td valign="top">
				<input name="remove_wptexturize" type="checkbox" value="1" <?php checked(true, $comicpress_options['remove_wptexturize']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Prevents WordPress from reformatting any specially formatted content you may add. Generally, you want to leave the WordPress formatting enabled, but it some special cases you may prefer to preserve non-WP formatting.','comicpress'); ?>
			</td>
		</tr>
		
		</table>
	</div>

	<div class="stuffbox" style="background: #edffeb;">
		<h3>Authors/Avatars/Moods</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Two author blog? ','comicpress'); ?></th>
			<td valign="top">
				<input name="split_column_in_two" type="checkbox" value="1" <?php checked(true, $comicpress_options['split_column_in_two']); ?> />					
			</td>
			<td valign="top">
				<?php _e('When enabled, it will make 2 seperate columns to have two seperate columns available to two different post authors.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Author for Column one?','comicpress'); ?><br />
			<br />
				<label>
				<?php
					$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $comicpress_options['author_column_one']);
					$selected = wp_dropdown_users($args);
					$selected = preg_replace('#<select([^>]*)>#', '<select name="author_column_one" id="author_column_one">', $selected);

					echo $selected;
				?>
				</label>
			</th>
			<td></td>
			<td valign="top">
				<?php _e('If column is split in two.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Author for Column two?','comicpress'); ?><br />
			<br />
				<label>
		<?php
		$args = array('echo' => '0', 'show' => 'display_name', 'selected' => $comicpress_options['author_column_two']);
		$selected = wp_dropdown_users($args);
		$selected = preg_replace('#<select([^>]*)>#', '<select name="author_column_two" id="author_column_two">', $selected);

		echo $selected;
						?>
				</label>
			</th>
			<td></td>
			<td valign="top">
				<?php _e('If column is split in two.  This is the name of the author for the 2nd column.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Comic post author Gravatar?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_comic_post_author_gravatar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comic_post_author_gravatar']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Enabling this option will show a gravatar of the comic post author based on the author email address.  Gravatars are associated by your email address and you can create them at','comicpress'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>. 
			</td>
		</tr>
		
		<tr>
			<th scope="row"><?php _e('Blog post author Gravatar?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_post_author_gravatar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_post_author_gravatar']); ?> />					
			</td>
			<td valign="top">
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
			<th scope="row"><?php _e('Avatar (no Gravatar) Directory','comicpress'); ?><br />
			<br />
				<label>
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
				</label>
			</th>
			<td></td>
			<td valign="top">
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
		<tr>
			<th scope="row"><?php _e('Moods Directory','comicpress'); ?><br />
			<br />
				<label>
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
				</label>
			</th>
			<td></td>
			<td valign="top">
				<?php _e('Choose a directory to get the post moods from.  Set this to "none" to turn off use.  Mood directories are found in your theme directory/images/moods/* to create your own custom moods just create a directory under images/moods/ and place ONLY image files inside of it. The name of the image file represents what the mood is.','comicpress'); ?>
			</td>
		</tr>
		</table>
	</div>
	
	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Calendar</h3>
		<table class="form-table" style="width: auto;">
		<?php
		$current_cal_directory = $comicpress_options['calendar_directory'];
		if (empty($current_cal_directory)) $current_cal_directory = 'default';

		$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
		$cal_directories = array();
		foreach ($dirs_to_search as $dir) { $cal_directories = array_merge($cal_directories,glob("${dir}/images/cal/*")); }
		?>
		<tr>
			<th scope="row"><?php _e('Calendar Directory','comicpress'); ?><br />
			<br />
				<label>
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
				</label>
			</th>
			<td></td>
			<td valign="top">
				<?php _e('Choose a directory to get the Archive Calendar styling from.  To not have calendar graphics, select "none". Calendar directories are found in your theme directory/images/cal/* to create your own custom archive calendar images just create a directory under images/cal/ and place your image files inside of it.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Add graphic calendar to comic posts?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_comic_post_calendar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comic_post_calendar']); ?> />					
			</td>
			<td valign="top">
				<?php _e('The graphic calendar is an image that has the date of the comic blog post overlayed on top of it.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Add graphic calendar to blog posts?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_post_calendar" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_post_calendar']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Enabling this option will display a calendar image on your blog posts. The graphic calendar is an image that has the date of the blog post overlayed on top of it.','comicpress'); ?>
			</td>
		</tr>
		
		</table>
	</div>

	<div class="stuffbox" style="background: #edffeb;">
		<h3>Tags/Categories</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Disable display of tags in posts?','comicpress'); ?><br /><br /></th>
			<td valign="top">
				<input name="disable_tags_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_tags_in_posts']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Tags != Categories, Tags are "descriptive keywords" of content in a post.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Disable display of categories in posts?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_categories_in_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_categories_in_posts']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Categories != Tags, The categories that are shown by default are the ones the post in set to.','comicpress'); ?>
			</td>
		</tr>
		
		</table>
	</div>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Pages & Blog Loop</h3>
		<table class="form-table" style="width: auto;">

		<tr>
			<th scope="row"><?php _e('Show all blog posts up until the next comic post on single pages?','comicpress'); ?></th>
			<td valign="top">
				<input name="blogposts_with_comic" type="checkbox" value="1" <?php checked(true, $comicpress_options['blogposts_with_comic']); ?> />					
			</td>
			<td valign="top">
				<?php _e('All the blog posts that are on the same day and greater to the next comic post on the comic your viewing will appear.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Blog loop stays with all the single pages?','comicpress'); ?></th>
			<td valign="top">
				<input name="static_blog" type="checkbox" value="1" <?php checked(true, $comicpress_options['static_blog']); ?> />					
			</td>
			<td valign="top">
				<?php _e('Blog will stay with the single pages, good to use with comments disabled in the settings.','comicpress'); ?>
			</td>
		</tr>
				
		<tr>
			<th scope="row"><?php _e('Disable the titles on pages?','comicpress'); ?><br /><br /></th>
			<td valign="top">
				<input name="disable_page_titles" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_page_titles']); ?> />					
			</td>
			<td valign="top">
				<?php _e('If you disable the titles no pages you can add a post-page-image in the page editor.','comicpress'); ?>
			</td>
		</tr>

		</table>
	</div>
	<input name="comicpress_save_post" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_post" />
	</form>
</div>