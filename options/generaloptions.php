	<div id="generaloptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">

<tr><td><h2>- Main -</h2></td></tr>	
	
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-disable_page_restraints": ?>
				<tr>
				<th scope="row"><strong><?php _e('Dynamic or Fixed width site?','comicpress'); ?></strong><br /><?php _e('Allows the width of your site to either be <b>Dynamic</b> (fills browser window) or <b>Fixed</b> (width is specified, e.g., 980px, 780px, etc.)','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('If <b>Dynamic</b> is enabled #page and #page-wide will not load. This allow you to use the entire browser for your canvas instead of the 780px/980px that the two elements limit you to by default.','comicpress'); ?></th>
				</td>
				</tr>




				<?php break;
			case "comicpress-rascal_says": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Rascal the ComicPress Mascot?','comicpress'); ?></strong><br /><?php _e('Enable this option to make a comic bubble appear over the comic and write out what you put in the hovertext, along with a friendly face.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('You can add the hovertext when uploading your comic with ComicPress Manager. To change the graphics for this will need to be well-versed in CSS.','comicpress'); ?>
				</td>
				</tr>
				
				


				<?php break;
			case "comicpress-disable_comment_note": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the comment notes?','comicpress'); ?></strong><br /><?php _e('Disabling this will remove the note text that displays with more options for adding to comments (html).','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				</td>
				</tr>



<tr><td><h2>- Navigation -</h2></td></tr>


				<?php break;
			case "comicpress-enable_numbered_pagination": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable numbered pagination?','comicpress'); ?></strong><br /><?php _e('Previous Entries and Next Entries buttons are replaced by a bar of numbered pages.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('Numbered pagination appears on the Home page, the author(s) page, the blog template, and comments/single when there are more then the set number of comments per page. Uses the same styling as the Menubar.','comicpress'); ?>
				</td>
				</tr>



				<?php break;

			case "comicpress-comic_clicks_next": ?>
				<tr>
				<th scope="row"><strong><?php _e('Click comic to go next?','comicpress'); ?></strong><br /><?php _e('Allows users to click the comic itself to go to the next comic (unless on the latest comic).','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('The allows you to offer a more convenient option for your archive readers to proceed to the next comic, and the next, etc. Any enabled hover options will continue to function even with this enabled.','comicpress'); ?>
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
				<th scope="row"><strong><?php _e('Graphic Navigation Directory','comicpress'); ?></strong><br /><?php _e('Choose a directory to get the graphic navigation styling from.','comicpress'); ?><br /></th>
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
			<?php _e('To create your own custom graphic navigation menu buttons just create a directory under <i>images/nav/</i> and place your image files inside of it and create a navstyle.css file to determine the style of your navigation display.','comicpress'); ?>
				</td>
				</tr>




<tr><td><h2>- Sidebars -</h2></td></tr>




		<?php break; 
			case "comicpress-enable_widgetarea_use_sidebar_css": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable main Sidebar CSS for all sidebars?','comicpress'); ?></strong><br /><?php _e('Uses default CSS styling of the sidebars for all sidebar areas.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('If disabled it will use the .customwidgetarea user-made styling and only Sidebar-left and Sidebar-right will use sidebar styling.','comicpress'); ?><br />
				</td>
				</tr>


				<?php break;
			case "comicpress-disable_lrsidebars_frontpage": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable home page sidebars?','comicpress'); ?></strong><br /><?php _e('Your home page will not display the default left/right sidebars.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e("Minimalist's dream. WARNING: Not recommended for use with Graphic Novel layouts.",'comicpress'); ?>
				</td>
				</tr>


<tr><td><h2>- Footer -</h2></td></tr>

				
				<?php break;
			case "comicpress-disable_footer_text": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the default text in the footer?','comicpress'); ?></strong><br /><?php _e('Default text in the footer will not display.','comicpress'); ?><br /><br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('Enable this if you do not want any text in the footer. If you wish to add you own custom content, you may do so via Appearance -> Widgets-> Footer.', 'comicpress'); ?>
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
	