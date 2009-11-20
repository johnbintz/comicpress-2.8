
	<script language="javascript">
		function showimage(sel,pic)
		{
		if (!document.images) 
		return
		document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
		}
	</script>
	
	<div id="themestyle" class="show">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-cp_theme_layout": ?>
				<tr>
					<th scope="row"><strong><?php _e('Choose which theme layout you want to use.','comicpress'); ?></strong><br /><br /><?php _e('This is the layout in which your theme will be presented.'); ?><br /><br /></th>
					<td valign="top">
						<label>
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="code" onchange="showimage(this,'cpthemestyle')">
								<option class="level-0" value="standard" <?php if (get_option($value['id'])=='standard') { ?>selected="selected" <?php } ?>><?php _e('Standard','comicpress'); ?></option>
								<option class="level-0" value="3c" <?php if (get_option($value['id'])=='3c') { ?>selected="selected" <?php } ?>><?php _e('3 Column','comicpress'); ?></option>
								<option class="level-0" value="3c2r" <?php if (get_option($value['id'])=='3c2r') { ?>selected="selected" <?php } ?>><?php _e('3 Column, Sidebars Right','comicpress'); ?></option>
								<option class="level-0" value="gn" <?php if (get_option($value['id'])=='gn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel Left','comicpress'); ?></option>
								<option class="level-0" value="rgn" <?php if (get_option($value['id'])=='rgn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel Right','comicpress'); ?></option>
								<option class="level-0" value="v" <?php if (get_option($value['id'])=='v') { ?>selected="selected" <?php } ?>><?php _e('Vertical','comicpress'); ?></option>
								<option class="level-0" value="v3c" <?php if (get_option($value['id'])=='v3c') { ?>selected="selected" <?php } ?>><?php _e('Vertical 3 Column','comicpress'); ?></option>
							</select>
						</label>
					</td>
					<td valign="top">
						<img id="cpthemestyle" src="<?php echo get_template_directory_uri(); ?>/images/options/<?php echo get_option($value['id']); ?>.png" alt="ComicPress Theme Style" />
					</td>
					<td valign="top">
						Standard and Vertical themes are 780px, 3 Column, Graphic Novel and Vertical 3 Column are 980px wide.
					</td>
				</tr>
				
				<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Layout" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>
