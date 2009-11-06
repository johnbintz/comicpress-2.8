	<div id="generaloptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-enable_widgetarea_use_sidebar_css": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Sidebar CSS in non-left/right sidebars?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this will use the standard CSS styling of the sidebars for all the sidebar areas.','comicpress'); ?><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('If not enabled it will use the .customwidgetarea user made styling only and only the Sidebar-left and Sidebar-right will use sidebar styling.','comicpress'); ?><br />
				</td>
				</tr>
				<?php break;
			case "comicpress-enable_numbered_pagination": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable numbered pagination?','comicpress'); ?></strong><br /><br /><?php _e('Setting to &quot;Yes&quot; will make the Previous Entries and Next Entries turn into numbered pages to click on.','comicpress'); ?></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Numbered pagination appears on the home(index) page, the authors page the blog template and comments/single when there are more then the set # of comments per page.  The default is off, it is styled like the menubar.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_page_restraints": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the #page / #page-wide restraints?','comicpress'); ?></strong><br />
				<br />
				<?php _e('Turning this option to Yes will make it so that the divs for #page and #page-wide will not load.','comicpress'); ?><br />
				<br />
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('What you can do with this is use the entire browser for your canvas instead of the 780px/980px that the two elements keep you in.','comicpress'); ?></th>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-comic_clicks_next": ?>
				<tr>
				<th scope="row"><strong><?php _e('Make the comic an Href that goes to next comic?','comicpress'); ?></strong><br /><br /><?php _e('In doing this if someone clicks the comic it will go to the next comic (if possible)','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('When a user or yourself puts their mouse cursor over the comic that is displayed on either the index or single page the action that happens next is the first step in the larger, bigger, more astonishing consequence of actually having any the other things you place your mouse cursor over and click.  You click, it goes to the next comic.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-rascal_says": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Rascal the ComicPress Mascot?','comicpress'); ?></strong><br /><br /><?php _e('Enabling this option will make a comic bubble appear over the comic and write out what you put in the hovertext.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('You can add hovertext when uploading your comic with ComicPress Manager.  To change the graphics for this you should probably know CSS quite well.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_footer_text": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the default text in the footer?','comicpress'); ?></strong><br /><br /><?php _e('Set to &quot;Yes&quot; and the text in the footer will not show.','comicpress'); ?><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('Footer text that shows up in the #footer area can be simply removed this way.','comicpress'); ?>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_comment_note": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the comment notes?','comicpress'); ?></strong><br /><br /><?php _e('Disabling this will remove the note text that displays with more options for adding to comments (html).','comicpress'); ?><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				</td>
				</tr>
				<?php break;
			case "comicpress-graphicnav_directory": 
				$current_gnav_directory = get_option($value['id']);
				if (empty($current_gnav_directory)) $current_gnav_directory = 'default';
				$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
				$gnav_directories = array();
				foreach ($dirs_to_search as $dir) { $gnav_directories = array_merge($gnav_directories,glob("${dir}/images/nav/*")); }
			?>
				<tr>
				<th scope="row"><strong><?php _e('Graphic Navigation Directory','comicpress'); ?></strong><br /><br /><?php _e('Choose a directory to get the graphic navigation styling from.','comicpress'); ?><br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php
					foreach ($gnav_directories as $gnav_dirs) {
						if (is_dir($gnav_dirs)) { 
							$gnav_dir_name = basename($gnav_dirs); ?>
							<option class="level-0" value="<?php echo $gnav_dir_name; ?>" <?php if ($current_gnav_directory == $gnav_dir_name) { ?>selected="selected"<?php } ?>><?php echo $gnav_dir_name; ?></option>
					<?php }
					}
				?>
						</select>
					</label>
				</td>
				<td valign="top">
					<br />
			<?php _e('Graphic Navigation directories are found in your theme directory/images/nav/* to create your own custom graphic navigation menu buttons just create a directory
					under images/nav/ and place your image files inside of it and create a navstyle.css file to determine the style of your navigation display.','comicpress'); ?>
				</td>
				</tr>
				
			<?php break;
			case "comicpress-calendar_directory": 
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
			<?php _e('Calendar directories are found in your theme directory/images/cal/* to create your own custom archive calendar images just create a directory
					under images/cal/ and place your image files inside of it.','comicpress'); ?>
				</td>
				</tr>
				
			<?php break;
			case "comicpress-avatar_directory": 
				$current_avatar_directory = get_option($value['id']);
				if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
				$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
				$avatar_directories = array();
				foreach ($dirs_to_search as $dir) { $avatar_directories = array_merge($avatar_directories,glob("${dir}/images/avatars/*")); }
				?>
				<tr>
				<th scope="row"><strong><?php _e('Avatar (no Gravatar) Directory','comicpress'); ?></strong><br /><br /><?php _e('Choose a directory to get the avatars for default gravatars if someone doesnt have one.','comicpress'); ?><br /></th>
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
	