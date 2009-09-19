<div id="membersoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
		<?php
		foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "comicpress-members_post_category": ?>
					<tr>	
					<th scope="row"><strong>Members Category</strong><br /><br />The category that is disignated to show members only content.<br /><br /></th>
					<td valign="top">
						<label>
						<?php 
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=1&orderby=name&echo=0&selected='.get_option( $value['id'] )); 
							$select = preg_replace('#<select([^>]*)>#', '<select name="'.$value['id'].'" id="'.$value['id'].'">', $select);
							
							echo $select;
						?>
						</label>
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
