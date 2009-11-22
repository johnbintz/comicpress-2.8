<div id="membersoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
		<?php
		foreach ($comicpress_options as $value) {
			switch ( $value['type'] ) {
				case "members_post_category": ?>
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
	</div>
	<div class="inside">
	Usage:<p>Edit the user with <b>Dashboard -> Users -> Authors & Users</b> and flag the user you want to be a member with the option at the bottom.</p>
<p>
Inside posts, add [members] content you only want members to see [/members]</p>
<p>
When setting a 'members' category, you *cannot* use an existing comic category, uncategorized, or blog category!</p>
<p>
You MUST create a whole new category and called it "members", then you select that category here and create a page called "Members" or something equivelant and associate the Member's Only template to it.</p>
<p>
This will make it so that that category is only seen as blogposts inside that area and not anywhere else on the site unless the user has the members flag.</p>
	<br />
	</div>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
</div>
