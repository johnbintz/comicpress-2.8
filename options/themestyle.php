<script language="javascript">
	function showimage(sel,pic) {
	if (!document.images) 
	return
	document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
	}
</script>
	
<div id="themestyle" class="<?php if ($tab == 'themestyle' || empty($tab)) { ?>show<?php } else { ?>hide<?php } ?>">
		<form method="post" id="myForm" name="template" enctype="multipart/form-data">
		<?php wp_nonce_field('update-options') ?>
		

			
			<table class="widefat" cellspacing="0">
				<thead>
					<tr>
						<th colspan="4">Layout</th>
					</tr>
				</thead>
				<tr class="alternate">
					<td><br /><?php _e('Choose Your Desired Website Layout','comicpress'); ?><br />
						<label>
							<select name="cp_theme_layout" id="cp_theme_layout" class="code" onchange="showimage(this,'cpthemestyle')">
								<option class="level-0" value="standard" <?php if ($comicpress_options['cp_theme_layout'] == 'standard') { ?>selected="selected" <?php } ?>><?php _e('2 Column (Standard)','comicpress'); ?></option>
								<option class="level-0" value="3c" <?php if ($comicpress_options['cp_theme_layout'] =='3c') { ?>selected="selected" <?php } ?>><?php _e('3 Column ','comicpress'); ?></option>
								<option class="level-0" value="3c2r" <?php if ($comicpress_options['cp_theme_layout'] =='3c2r') { ?>selected="selected" <?php } ?>><?php _e('3 Column: Sidebars Right','comicpress'); ?></option>
								<option class="level-0" value="v" <?php if ($comicpress_options['cp_theme_layout'] =='v') { ?>selected="selected" <?php } ?>><?php _e('Single Panel (Vertical)','comicpress'); ?></option>
								<option class="level-0" value="v3c" <?php if ($comicpress_options['cp_theme_layout'] =='v3c') { ?>selected="selected" <?php } ?>><?php _e('Single Panel (Vertical) 3 Column','comicpress'); ?></option>	
								<option class="level-0" value="gn" <?php if ($comicpress_options['cp_theme_layout'] =='gn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel: Sidebar Left','comicpress'); ?></option>
								<option class="level-0" value="rgn" <?php if ($comicpress_options['cp_theme_layout'] =='rgn') { ?>selected="selected" <?php } ?>><?php _e('Graphic Novel: Sidebar Right','comicpress'); ?></option>
							</select>
						</label>
					</td>
					<td>
						<img id="cpthemestyle" src="<?php echo get_template_directory_uri(); ?>/images/options/<?php echo $comicpress_options['cp_theme_layout']; ?>.png" alt="ComicPress Theme Style" />
					</td>
					<td style="vertical-align:middle">
						<i>Comic Strip - 2 Column</i> and <i>Single Panel - 2 Column</i> themes default width: <b>780px</b>.
						<br/><br/>
						<i>Comic Strip - 3 Column</i>, <i>Single Panel - 3 Column</i>, and <i>Graphic Novel</i> themes default width: <b>980px</b>.
					</td>
				</tr>
				<tfoot>
					<tr>
						<th colspan="3">
							<input name="comicpress_save_layout" type="submit" class="button-primary" value="Save Layout" />
							<input type="hidden" name="action" value="comicpress_save_layout" />
						</th>
					</tr>
				</tfoot>
			</table>

		

		</form>



</div>
