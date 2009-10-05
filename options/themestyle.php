
	<script language="javascript">
		function showimage(sel,pic)
		{
		if (!document.images) 
		return
		document.getElementById(pic).src = '<?php echo get_bloginfo('stylesheet_directory'); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
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
								<option class="level-0" value="gn" <?php if (get_option($value['id'])=='gn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel Left','comicpress'); ?></option>
								<option class="level-0" value="rgn" <?php if (get_option($value['id'])=='rgn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel Right','comicpress'); ?></option>
								<option class="level-0" value="v" <?php if (get_option($value['id'])=='v') { ?>selected="selected" <?php } ?>><?php _e('Vertical','comicpress'); ?></option>
								<option class="level-0" value="v3c" <?php if (get_option($value['id'])=='v3c') { ?>selected="selected" <?php } ?>><?php _e('Vertical 3 Column','comicpress'); ?></option>
							</select>
						</label>
					</td>
					<td valign="top">
						<img id="cpthemestyle" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/options/<?php echo get_option($value['id']); ?>.png" alt="ComicPress Theme Style" />
					</td>
				</tr>
				
				<?php break;
			case "comicpress-themepack_directory": 
				$current_themepack_directory = get_option($value['id']);
				if (empty($current_themepack_directory)) $current_themepack_directory = 'silver';
					
				$count = count($results = glob(get_template_directory() . '/themepack/'.$current_themepack_directory.'/*'));
				$themepack_directories = glob(get_template_directory() . '/themepack/*');
				
			?>
				<tr>
				<th scope="row"><strong><?php _e('Themepack','comicpress'); ?></strong><br /><br /><?php _e('Choose a Themepack to use.','comicpress'); ?><br /></th>
				<td valign="top">
					<label>
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option class="level-0" value="none" <?php if ($current_themepack_directory == "none") { ?>selected="selected"<?php } ?>>none</option>
				<?php
					foreach ($themepack_directories as $themepack_dirs) {
						if (is_dir($themepack_dirs)) { 
							$themepack_dir_name = basename($themepack_dirs); ?>
							<option class="level-0" value="<?php echo $themepack_dir_name; ?>" <?php if ($current_themepack_directory == $themepack_dir_name) { ?>selected="selected"<?php } ?>><?php echo $themepack_dir_name; ?></option>
					<?php }
					}
				?>
						</select>
					</label>
				</td>
				</tr>
				<tr>
				<td></td>
				<td valign="top" colspan="5">
				<?php 
					foreach ($themepack_directories as $themepack_dirs) {
						if (is_dir($themepack_dirs)) { 
							$themepack_dir_name = basename($themepack_dirs); ?>
							<div style="width: 100%; padding: 2px;">
								<div style="width: 180px; float: left;">
							<?php if (file_exists(get_template_directory() .'/themepack/'.$themepack_dir_name.'/screenshot.png')) { ?>
									<img src="<?php bloginfo('stylesheet_directory'); ?>/themepack/<?php echo $themepack_dir_name; ?>/screenshot.png" width="180" alt="<?php echo $themepack_dir_name; ?>" />
							<?php }	?>
								</div>
							<?php if (file_exists(get_template_directory() .'/themepack/'.$themepack_dir_name.'/notes.php')) { ?>
								<div style="float: left; margin-left: 10px;">
									<?php include(get_template_directory() . '/themepack/'.$themepack_dir_name.'/notes.php'); ?>
								</div>
								<?php } ?>
								<div style="clear:both;"></div>
							</div>
					<?php }
					}
				?>		
				</td>
				</tr>
				
			<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Style" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>
