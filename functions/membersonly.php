<?php
/**
 * Members Only
 * by Philip M. Hofer (Frumph)
 * http://webcomicplanet.com/
 * 
 * Displays content that only registered users that are marked members can see.
 * 
 * example:  [members]Only members can read this.[/members]
 * 
 * 
 * Still need to do, make it a way to flag someone a site_member TRUE
 * 
 */


add_shortcode( 'members', 'shortcode_for_comicpress_members_only' );
add_shortcode( 'member', 'shortcode_for_comicpress_members_only' );
add_action('show_user_profile', 'comicpress_profile_members_only');
add_action('edit_user_profile', 'comicpress_profile_members_only');
add_action('profile_update', 'comicpress_profile_members_only_save');

function shortcode_for_comicpress_members_only( $atts, $content = null ) {
	global $post, $userdata, $profileuser, $current_user, $errormsg;
	if ( !empty($userdata->ID) ) {
		$is_member = get_usermeta($current_user->ID,'comicpress-is-member');
		if ( ( $is_member == 'yes' || current_user_can( 'publish_posts' ) ) && !is_feed() ) {
			return '<div class="members-only">'.$content.'</div>';
		}
	}
	return '';
}

function comicpress_profile_members_only() { 
	global $profileuser, $current_user, $errormsg; 
	$comicpress_is_member = get_usermeta($profileuser->ID,'comicpress-is-member');
	if (empty($comicpress_is_member)) $comicpress_is_member = 'no';
	?>
	<h3>Member of <?php bloginfo('name'); ?></h3>
	<table class="form-table">
	<tr>
		<th><label for="Memberflag">Member?</label></th>
		<td> 
		<?php 
			if (current_user_can('manage_options')) { ?>
		<label><input name="comicpress-is-member" id="comicpress-is-member-yes" type="radio" value="yes"<?php if ( get_usermeta($profileuser->ID,'comicpress-is-member') == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
		<label><input  name="comicpress-is-member" id="comicpress-is-member-no" type="radio" value="no"<?php if ( get_usermeta($profileuser->ID,'comicpress-is-member') != "yes" ) { echo " checked"; } ?> />No</label>

			<?php } else {
				if ($comicpress_is_member == 'yes') { 
					echo 'Yes';
				} else {
					echo 'No';
				}
			}
		?>
		</td>
	</tr>
	</table>
<?php }


function comicpress_profile_members_only_save() { 
	$id = $_POST['user_id'];
	$comicpress_is_member = $_POST['comicpress-is-member'];
	
	if (!empty($comicpress_is_member)) {
		update_usermeta($id, 'comicpress-is-member', $comicpress_is_member);
	}
}

?>