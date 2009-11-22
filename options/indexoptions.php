	<div id="indexoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($comicpress_options as $value) {
		switch ( $value['type'] ) {
			case "disable_comic_frontpage": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable comic on Home page?','comicpress'); ?></strong><br /><br /><?php _e('Set to <b>Yes</b> and the comic will not display on the home page of your site.','comicpress'); ?></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top" width="400">
			<?php _e('You can use the Latest Thumbnail widget to display your comic in a sidebar. Make sure you set the archive-thumbnail size to under 200px. Note: Turning this off and using the Graphic Novel style turns ComicPress into a blog only.','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "disable_comic_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the comic blog on Home page?','comicpress'); ?></strong><br /><br /><?php _e('Select <b>Yes</b> and the comic blog will not display on the Home Page.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('Enabling this allows you to either not have a comic blog at all, or you can place it where you want using the comic blog post widget. If there is no content in the post it will not display regardless.','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "disable_comic_blog_single": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the comic blog on the single pages?','comicpress'); ?></strong><br /><br /><?php _e('Select <b>Yes</b> and the blog portion of the comic will not display on the single/archive pages of your site.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				</td>
				</tr>
				<?php break;
			case "disable_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable the blog on the Home page?','comicpress'); ?></strong><br /><br /><?php _e('Select <b>Yes</b> and the blog will not display on the Home page of your site. ','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
				</td>
				<td valign="top">
				<?php _e('The features allows to either not have a blog at all, or, if you place a menu link to your blog page, you can maintain your blog within the same site without readers having to see it when they are just trying to read your comic.','comicpress'); ?>
				</td>
				</tr>
				<?php break;
			case "disable_blogheader": ?>
				<tr>
				<th scope="row"><strong><?php _e('Disable blog header on the Home page?','comicpress'); ?></strong><br /><br /><?php _e('Select <b>Yes</b> and the home page of your site will not display the contents of #blogheader.','comicpress'); ?><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label><br />
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
	