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
					<th scope="row"><strong>Members Category</strong><br /><br />The category that is designated to show members only content.<br /><br /></th>
					<td valign="top">
						<label>
						<?php 
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=0&orderby=name&echo=0&selected='.get_option( $value['id'] )); 
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
	<div class="inside">
	Usage:<br />
	<br />
	Edit the user with dashboard -> users -> author & users and flag the user you want to be a member with the option at the bottom.<br />
	<br />
	Inside posts, add [members]   content you only want members to see  [/members]<br />
	<br />
	Setting a 'members' category is a bit tricky.  You *cannot* use a comic category, uncategorized or blog posts category, create a whole new category and called it "members",
	then you set that category here and create a page called "Members" or something equivelant and associate the Member's Only template to it.<br />
	<br />
	This will make it so that that category is only seen as blogposts inside that area and not anywhere else on the site unless the user has the members flag.<br />
	</div>
</div>
