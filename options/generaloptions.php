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
				<th scope="row"><strong>Enable Sidebar CSS?</strong><br /><br />Enabling this will use the standard CSS styling of the sidebars for all the widget areas.<br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					If not enabled it will use the .customwidgetarea user made styling only and only the Sidebar-left and Sidebar-right will use sidebar styling.<br />
				</td>
				</tr>
				<?php break;
			case "comicpress-enable_numbered_pagination": ?>
				<tr>
				<th scope="row"><strong>Enable numbered pagination?</strong><br /><br />Setting to &quot;Yes&quot; will make the Previous Entries and Next Entries turn into numbered pages to click on.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
				Numbered pagination appears on the home(index) page, the authors page the blog template and comments/single when there are more then the set # of comments per page.  It's default is off, it is styled like the menubar.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_page_restraints": ?>
				<tr>
				<th scope="row"><strong>Disable the #page / #page-wide restraints?</strong><br />
				<br />
				Turning this option to Yes will make it so that the divs for #page and #page-wide will not load.<br />
				<br />
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					What you can do with this is use the entire browser for your canvas instead of the 780px/980px that the two elements keep you in.</th>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-comic_clicks_next": ?>
				<tr>
				<th scope="row"><strong>Make the comic an Href that goes to next comic?</strong><br /><br />In doing this if someone clicks the comic it will go to the next comic (if possible)<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
				When a user or yourself puts their mouse cursor over the comic that is displayed on either the index or single page the action that happens next is the first step in the larger, bigger, more astonishing consequence of actually having any the other things you place your mouse cursor over and click.  You click, it goes to the next comic.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-rascal_says": ?>
				<tr>
				<th scope="row"><strong>Enable Rascal the ComicPress Mascot?</strong><br /><br />Enabling this option will make a comic bubble appear over the comic and write out what you put in the hovertext.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					You can add hovertext when uploading your comic with ComicPress Manager.  To change the graphics for this you should probably know CSS quite well.  If you don't good luck with it.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-graphicnav_directory": 
				$current_gnav_directory = get_option($value['id']);
				if (empty($current_gnav_directory)) $current_gnav_directory = 'default';
					
				$count = count($results = glob(get_template_directory() . '/images/nav/'.$current_gnav_directory.'/*'));
				$gnav_directories = glob(get_template_directory() . '/images/nav/*');
				
			?>
				<tr>
				<th scope="row"><strong>Graphic Navigation Directory</strong><br /><br />Choose a directory to get the graphic navigation styling from.<br /></th>
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
					<?php echo get_template_directory() . '/images/nav/'; ?>
					Graphic Navigation directories are found in your theme directory/images/nav/* to create your own custom graphic navigation menu buttons just create a directory
					under images/nav/ and place your image files inside of it and create a navstyle.css file to determine the style of your navigation display.
				</td>
				</tr>
				
			<?php break;
			case "comicpress-calendar_directory": 
				$current_cal_directory = get_option($value['id']);
				if (empty($current_cal_directory)) $current_cal_directory = 'default';
					
				$count = count($results = glob(get_template_directory() . '/images/cal/'.$current_cal_directory.'/*'));
				$cal_directories = glob(get_template_directory() . '/images/cal/*');
				
			?>
				<tr>
				<th scope="row"><strong>Calendar Directory</strong><br /><br />Choose a directory to get the Archive Calendar styling from.<br /></th>
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
					To not have calendar graphics, set this as "none".<br />
					<br />
					<?php echo get_template_directory() . '/images/cal/'; ?>
					Calendar directories are found in your theme directory/images/cal/* to create your own custom archive calendar images just create a directory
					under images/cal/ and place your image files inside of it.
				</td>
				</tr>
				
			<?php break;
			case "comicpress-disable_footer_text": ?>
				<tr>
				<th scope="row"><strong>Disable the default text in the footer?</strong><br /><br />Set to &quot;Yes&quot; and the text in the footer will not show.<br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top">
				Footer text that shows up in the #footer area can be simply removed this way.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-avatar_directory": 
				$current_avatar_directory = get_option($value['id']);
				if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
					
				$count = count($results = glob(get_template_directory() . '/images/avatars/'.$current_avatar_directory.'/*'));
				$avatar_directories = glob(get_template_directory() . '/images/avatars/*');
				
			?>
				<tr>
				<th scope="row"><strong>Avatar (no Gravatar) Directory</strong><br /><br />Choose a directory to get the avatars for default gravatars if someone doesnt have one.<br /></th>
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
			case "comicpress-disable_comment_note": ?>
				<tr>
				<th scope="row"><strong>Disable the comment notes?</strong><br /><br />Disabling this will remove the note text that displays with more options for adding to comments (html).<br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
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
	