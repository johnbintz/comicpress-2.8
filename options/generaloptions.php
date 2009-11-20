	<div id="generaloptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
		
case "comicpress-general_main": ?>
<tr>
<th scope="row"><span style="font-size: 1.5em; font-weight: bold;">- Main -</span>
</th>
</tr>



				<?php break;
			case "comicpress-disable_page_restraints": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the #page / #page-wide restraints?','comicpress'); ?></strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('What you can do with this is use the entire browser for your canvas instead of the 780px/980px that the two elements keep you in.  Not recommended enabling this option unless your an expert in CSS','comicpress'); ?></th>
				</td>
				</tr>




				<?php break;
			case "comicpress-rascal_says": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Rascal the ComicPress Mascot?','comicpress'); ?></strong><br /><?php _e('Enabling this option will make a comic bubble appear over the comic and write out what you put in the hovertext.','comicpress'); ?><br /></th>
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




<?php break; case "comicpress-general_navigation": ?>
<tr>
<th scope="row"><span style="font-size: 1.5em; font-weight: bold;">- Navigation -</span>
</th>
</tr>


				<?php break;
			case "comicpress-enable_numbered_pagination": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable numbered pagination?','comicpress'); ?></strong><br /></th>
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

			case "comicpress-comic_clicks_next": ?>
				<tr>
				<th scope="row"><strong><?php _e('Make the comic an Href that goes to next comic?','comicpress'); ?></strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
				<?php _e('In doing this if someone clicks the comic it will go to the next comic (if possible)','comicpress'); ?>
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





<?php break; case "comicpress-general_sidebars": ?>
<tr>
<th scope="row"><span style="font-size: 1.5em; font-weight: bold;">- Sidebars -</span>
</th>
</tr>


		<?php break; 
			case "comicpress-enable_widgetarea_use_sidebar_css": ?>
				<tr>
				<th scope="row"><strong><?php _e('Enable Sidebar CSS in non-left/right sidebars?','comicpress'); ?></strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>
				</td>
				<td valign="top">
					<?php _e('If enabled, all #sidebars will use .sidebar css','comicpress'); ?><br />
				</td>
				</tr>


				<?php break;
			case "comicpress-disable_lrsidebars_frontpage": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the left and right sidebars on the index page?','comicpress'); ?></strong><br /><?php _e('Set to &quot;Yes&quot; and the index page/front page of your site will not display the left and right sidebars.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('Minimalists dream.  Best not to use with theme styles that have one of the styles that are to the side of the comic.','comicpress'); ?>
				</td>
				</tr>




<?php break; case "comicpress-general_footerheading": ?>
<tr>
<th scope="row"><span style="font-size: 1.5em; font-weight: bold;">- Footer -</span>
</th>
</tr>

				
				<?php break;
			case "comicpress-disable_footer_text": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the default text in the footer?','comicpress'); ?></strong><br /><br /></th>
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
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>
	