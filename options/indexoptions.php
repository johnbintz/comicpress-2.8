	<div id="indexoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-disable_comic_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable Comic On Frontpage?</strong><br /><br />Set to &quot;Yes&quot; and the comic will not display on the index page/front page of your site.</th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top" width="400">
					Note: You can use the Latest Thumbnail widget to display your comic in a sidebar.  Make sure you set the archive-thumbnail size to under 200px.
					Turning this off and using the GN style turns ComicPress into a Blog.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_comic_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable the comic blog on the index and single pages?</strong><br /><br />Set to &quot;Yes&quot; and the blog portion of the comic will not display on the index page/front page of your site.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top">
				*Some* people,.. not naming names ..do not like to have a comic post let alone showing on the index page.  You can use the comic blog post widget and place it anywhere around the comic.   IF there is no content in the post it will not display.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable the blog on the index page?</strong><br /><br />Set to &quot;Yes&quot; and the blog area will not display on the index page/front page of your site.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top">
				This feature is quite handy actually.  If you disable this you can add a page to your menubar and associate it to the "blog" template, still keeping your blog, .. just not on the index page.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_lrsidebars_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable the left and right sidebars on the index page?</strong><br /><br />Set to &quot;Yes&quot; and the index page/front page of your site will not display the left and right sidebars.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top">
				Minimalists dream.  Best not to use with theme styles that have one of the styles that are to the side of the comic.
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
	