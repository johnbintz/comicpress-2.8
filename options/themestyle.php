<script language="javascript">
	function showimage(sel,pic) {
	if (!document.images) 
	return
	document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
	}
</script>
	
<div id="themestyle" class="show">
		<form method="post" id="myForm" name="template" enctype="multipart/form-data">
		<?php wp_nonce_field('update-options') ?>
		
		<div class="stuffbox" style="background: #ebf8ff;">
			<h3>Layout</h3>
			<table class="form-table" style="width: auto">
			<tr>
				<th scope="row"><strong><?php _e('Choose Layout','comicpress'); ?></strong><br /><br /><?php _e('This is the layout in which your theme will be presented.'); ?><br /><br /></th>
				<td valign="top">
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
				<td valign="top">
					<img id="cpthemestyle" src="<?php echo get_template_directory_uri(); ?>/images/options/<?php echo $comicpress_options['cp_theme_layout']; ?>.png" alt="ComicPress Theme Style" />
				</td>
				<td valign="top">
					<i>Comic Strip - 2 Column</i> and <i>Single Panel - 2 Column</i> themes default width: <b>780px</b>.
					<br/><br/>
					<i>Comic Strip - 3 Column</i>, <i>Single Panel - 3 Column</i>, and <i>Graphic Novel</i> themes default width: <b>980px</b>.
				</td>
			</tr>
			</table>
		</div>
		<input name="comicpress_save_layout" type="submit" class="button-primary" value="Save Layout" />
		<input type="hidden" name="action" value="comicpress_save_layout" />
		</form>
		<br />
		<br />

		<div class="stuffbox">
			<h3>Credits</h3>
			<div class="inside">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="cpadmin-donate">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="7827910">
				<input type="image"
				src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"
				border="0" name="submit" alt="PayPal - The safer, easier way to pay
				online!">
				<img alt="" border="0"
				src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1"
				height="1">
			</form>
			<a href="http://comicpress.org/"><strong>ComicPress 2.9</strong> <small>[ <?php echo $comicpress_options['comicpress_version']; ?> ]</small></a>. <?php _e('Created by','comicpress'); ?> <a href="http://mindfaucet.com/">Tyler Martin</a> <?php _e('with','comicpress'); ?> <a href="http://www.coswellproductions.com/">John Bintz</a><?php _e(',','comicpress'); ?> <a href="http://frumph.net/">Philip M. Hofer</a> <small>(<a href="http://frumph.net/">Frumph</a>)</small> <?php _e('and','comicpress'); ?> <a href="http://www.oycomics.com/">Danny Burleson</a>.<br />
			<?php _e('If you like the ComicPress theme, please donate.  It will help in creating new versions.','comicpress'); ?>
			<br />
			<br />
			<form method="post" id="myForm" name="template" enctype="multipart/form-data">
				<?php wp_nonce_field('update-options') ?>		
				<input name="comicpress_reset" type="submit" class="button" value="Reset All Settings" />
				<input type="hidden" name="action" value="comicpress_reset" />	
			</form>
		</div>
	</div>
</div>
