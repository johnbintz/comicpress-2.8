<div id="generaloptions" class="<?php if ($tab == 'general') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Main</h3>
		<table class="form-table" style="width: auto;">
		
		<tr>
			<th scope="row"><?php _e('Disable page restraints?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_page_restraints" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_page_restraints']); ?> />
			</td>
			<td valign="top">
				<?php _e('Allows the width of your site to either be <b>Dynamic</b> (fills browser window) or <b>Fixed</b> (width is specified, e.g., 980px, 780px, etc.)  If <b>Dynamic</b> is enabled #page and #page-wide will not load. This allow you to use the entire browser for your canvas instead of the 780px/980px that the two elements limit you to by default.','comicpress'); ?></th>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><?php _e('Enable Rascal the ComicPress Mascot?','comicpress'); ?></th>
			<td valign="top">
				<input name="rascal_says" type="checkbox" value="1" <?php checked(true, $comicpress_options['rascal_says']); ?> />
			</td>
			<td valign="top">
				<?php _e('Enable this option to make a comic bubble appear over the comic and write out what you put in the hovertext, along with a friendly face. You can add the hovertext when uploading your comic with ComicPress Manager. To change the graphics for this will need to be well-versed in CSS.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Disable the comment notes?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_comment_note" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_comment_note']); ?> />
			</td>
			<td valign="top">
				<?php _e('Disabling this will remove the note text that displays with more options for adding to comments (html).','comicpress'); ?>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><?php _e('Disable blog header?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_blogheader" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_blogheader']); ?> />		
			</td>
			<td valign="top">
				<?php _e('Checkmark this and your site will not display the contents of #blogheader.','comicpress'); ?>
			</td>
		</tr>			
		
		</table>
	</div>
	
	<div class="stuffbox" style="background: #edffeb;">
		<h3>Navigation</h3>
		<table class="form-table" style="width: auto">
		<tr>
			<th scope="row"><?php _e('Enable numbered pagination?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_numbered_pagination" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_numbered_pagination']); ?> />
			</td>
			<td valign="top">
				<?php _e('Previous Entries and Next Entries buttons are replaced by a bar of numbered pages. Numbered pagination appears on the Home page, the author(s) page, the blog template, and comments/single when there are more then the set number of comments per page. Uses the same styling as the Menubar.','comicpress'); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Click comic to go next?','comicpress'); ?></th>
			<td valign="top">
				<input name="comic_clicks_next" type="checkbox" value="1" <?php checked(true, $comicpress_options['comic_clicks_next']); ?> />
			</td>
			<td valign="top">
				<?php _e('Allows users to click the comic itself to go to the next comic (unless on the latest comic). This allows you to offer a more convenient option for your archive readers to proceed to the next comic, and the next, etc. Any enabled hover options will continue to function even with this enabled.','comicpress'); ?>
			</td>
		</tr>


		<tr>
			<th scope="row"><?php _e('Disable the default comic post navigation?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_default_comic_nav" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_default_comic_nav']); ?> />
			</td>
			<td valign="top">
				<?php _e('Previous Entries and Next Entries buttons are replaced by a bar of numbered pages. The default comic post navigation is above each comic blog post.','comicpress'); ?>
			</td>
		</tr>
	
<?php 
	$current_gnav_directory = $comicpress_options['graphicnav_directory'];
	if (empty($current_gnav_directory)) $current_gnav_directory = 'default';
	$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
	$gnav_directories = array();
	foreach ($dirs_to_search as $dir) { $gnav_directories = array_merge($gnav_directories,glob("${dir}/images/nav/*")); }
?>
		<tr>
			<th scope="row"><?php _e('Graphic Navigation Directory','comicpress'); ?><br />
			<br />
				<label>
					<select name="graphicnav_directory" id="graphicnav_directory">
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
			<br />
			<br />
			</th>
			<td></td>
			<td valign="top">
				<?php _e('Choose a directory to get the graphic navigation styling from. To create your own custom graphic navigation menu buttons just create a directory under <i>images/nav/</i> and place your image files inside of it and create a navstyle.css file to determine the style of your navigation display.','comicpress'); ?>
			</td>
		</tr>
		</table>
	</div>

	<div class="stuffbox" style="background: #ebf8ff;">
		<h3>Sidebars</h3>
		<table class="form-table" style="width: auto">

		<tr>
			<th scope="row"><?php _e('Enable main Sidebar CSS for all sidebars?','comicpress'); ?></th>
			<td valign="top">
				<input name="enable_widgetarea_use_sidebar_css" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_widgetarea_use_sidebar_css']); ?> />
			</td>
			<td valign="top">
				<?php _e('Uses default CSS styling of the sidebars for all sidebar areas. If disabled it will use the .customwidgetarea user-made styling and only Sidebar-left and Sidebar-right will use sidebar styling.','comicpress'); ?><br />
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Disable home page sidebars?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_lrsidebars_frontpage" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_lrsidebars_frontpage']); ?> />
			</td>
			<td valign="top">
				<?php _e('Your home page will not display the default left/right sidebars. Minimalists dream. WARNING: Not recommended for use with Graphic Novel layouts.','comicpress'); ?>
			</td>
		</tr>		
		
		</table>
	</div>


	<div class="stuffbox" style="background: #edffeb;">
		<h3>Footer</h3>
		<table class="form-table" style="width: auto">
					
		<tr>
			<th scope="row"><?php _e('Disable the default text in the footer?','comicpress'); ?></th>
			<td valign="top">
				<input name="disable_footer_text" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_footer_text']); ?> />
			</td>
			<td valign="top">
				<?php _e('Default text in the footer will not display. Enable this if you do not want any text in the footer. If you wish to add you own custom content, you may do so via Appearance -> Widgets-> Footer.', 'comicpress'); ?>
			</td>
		</tr>
				
		</table>
	</div>
	<div style="clear:both;"></div>
	<input name="comicpress_save_general" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save_general" />
	</form>
</div>
	