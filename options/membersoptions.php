<div id="membersoptions" class="hide">
	<h3>Main</h3>
	<div class="stuffbox" style="background: #ebf8ff;">
		<form method="post" id="myForm" name="template" enctype="multipart/form-data">
		<?php wp_nonce_field('update-options') ?>

		<table class="form-table" style="width: auto;">

					<tr>	
					<th scope="row">Members Category</th>
					<td valign="top">
						<label>
						<?php 
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=0&orderby=name&echo=0&selected='.$comicpress_options['members_post_category']); 
							$select = preg_replace('#<select([^>]*)>#', '<select name="members_post_category" id="members_post_category">', $select);
							
							echo $select;
						?>
						</label>
					</td>
					<td valign="top">
						The category that is designated to show members only content.
					</td>
					</tr>

		</table>
	</div>
	<div class="inside">
		Usage:<p>Edit the user with <b>Dashboard -> Users -> Authors & Users</b> and flag the user you want to be a member with the option at the bottom.</p>
		<p>Inside posts, add [members] content you only want members to see [/members]</p>
		<p>When setting a 'members' category, you *cannot* use an existing comic category, uncategorized, or blog category!</p>
		<p>You MUST create a whole new category and called it "members", then you select that category here and create a page called "Members" or something equivelant and associate the Member's Only template to it.</p>
		<p>This will make it so that that category is only seen as blogposts inside that area and not anywhere else on the site unless the user has the members flag.</p>
		<br />
	</div>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
</div>
