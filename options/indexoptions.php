<div id="indexoptions" class="<?php if ($tab == 'index') { ?>show<?php } else { ?>hide<?php } ?>">

	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>

		<table class="widefat">

			<thead>
				<tr>
					<th colspan="3">Post</th>
				</tr>
			</thead>
			<tr class="alternate">
				<td style="width:200px"><?php _e('Disable the blog on the Home page?','comicpress'); ?></td>
				<td>
					<input name="disable_blog_frontpage" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_blog_frontpage']); ?> />					
				</td>
				<td>
					<?php _e('Checkmark this and the blog will not display on the Home page of your site. The features allows to either not have a blog at all, or, if you place a menu link to your blog page, you can maintain your blog within the same site without readers having to see it when they are just trying to read your comic.','comicpress'); ?>
				</td>
			</tr>	

			<thead>
				<tr>
					<th colspan="3">Comic</th>
				</tr>
			</thead>
			<tr class="alternate">
				<td><?php _e('Disable comic on Home page?','comicpress'); ?></td>
				<td>
					<input name="disable_comic_frontpage" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_comic_frontpage']); ?> />					
				</td>
				<td>
					<?php _e('Checkmark this and the comic will not display on the home page of your site. You can use the Latest Thumbnail widget to display your comic in a sidebar. Make sure you set the archive-thumbnail size to under 200px. Note: Turning this off and using the Graphic Novel style turns ComicPress into a blog only.','comicpress'); ?>
				</td>
			</tr>
			<tr>
				<td><?php _e('Disable the comic blog on Home page?','comicpress'); ?></td>
				<td>
					<input name="disable_comic_blog_frontpage" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_comic_blog_frontpage']); ?> />					
				</td>
				<td>
					<?php _e('Checkmark this and the comic blog will not display on the Home Page. Enabling this allows you to either not have a comic blog at all, or you can place it where you want using the comic blog post widget. If there is no content in the post it will not display regardless.','comicpress'); ?>
				</td>
			</tr>
			<tr class="alternate">
				<td><?php _e('Disable the comic blog on the single pages?','comicpress'); ?></td>
				<td>
					<input name="disable_comic_blog_single" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_comic_blog_single']); ?> />					
				</td>
				<td>
					<?php _e('Checkmark this and the blog portion of the comic will not display on the single/archive pages of your site.','comicpress'); ?>
				</td>
			</tr>
			
			<tfoot>
				<tr>
					<th colspan="3">
						<input name="comicpress_save_index" type="submit" class="button-primary" value="Save Settings" />
						<input type="hidden" name="action" value="comicpress_save_index" />
					</td>
				</tr>
			</tfoot>
		
		</table>
	
	</form>
	
</div>		