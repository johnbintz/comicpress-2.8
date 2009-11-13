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


add_filter('pre_get_posts','comicpress_members_filter');

function comicpress_members_filter($query) {
	global $members_post_category, $current_user;
	if ($members_post_category != 'none' && !empty($members_post_category) && !$query->is_search && !$query->is_page && !$query->is_archive) {
		$oldset = $query->get('cat');
		$is_member = '';
		
		if (!empty($oldset)) {
			$excludeset = $oldset.',-'.$members_post_category;
		} else {
			$excludeset = '-'.$members_post_category;
		}
		
		if ( !empty($current_user->ID) ) {
			$is_member = get_usermeta($current_user->ID,'comicpress-is-member');
		}
		if ($is_member != 'yes' || empty($is_member)) {
			$query->set('cat',$excludeset);
		}
	}
	return $query;
}

function shortcode_for_comicpress_members_only( $atts, $content = null ) {
	global $post, $userdata, $profileuser, $current_user, $errormsg;
	$returninfo = '<div class="non-member">'.__('There is Members Only content here.<br />To view this content you need to be a member of this site.','comicpress').'</div>';
	if ( !empty($current_user->ID) ) {
		$is_member = get_usermeta($current_user->ID,'comicpress-is-member');
		if ($is_member == 'yes' || current_user_can('publish_posts')) {
			$returninfo = '<div class="members-only">'.$content.'</div>';
		}
	}
	return $returninfo;
}

function comicpress_profile_members_only() { 
	global $profileuser, $current_user, $errormsg; 
	$comicpress_is_member = get_usermeta($profileuser->ID,'comicpress-is-member');
	if (empty($comicpress_is_member)) $comicpress_is_member = 'no';
	?>
	<h3><?php _e('Member of','comicpress'); ?> <?php bloginfo('name'); ?></h3>
	<table class="form-table">
	<tr>
	<th><label for="Memberflag"><?php _e('Member?','comicpress'); ?></label></th>
		<td> 
		<?php 
			if (current_user_can('manage_options')) { ?>
		<label><input name="comicpress-is-member" id="comicpress-is-member-yes" type="radio" value="yes"<?php if ( get_usermeta($profileuser->ID,'comicpress-is-member') == "yes") { echo " checked"; } ?> /><?php _e('Yes','comicpress'); ?></label>
				&nbsp;&nbsp;
		<label><input  name="comicpress-is-member" id="comicpress-is-member-no" type="radio" value="no"<?php if ( get_usermeta($profileuser->ID,'comicpress-is-member') != "yes" ) { echo " checked"; } ?> /><?php _e('No','comicpress'); ?></label>

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

/**
 * Return true if the current post is in the members category.
 */
function in_members_category() {
	global $post, $category_tree, $members_post_category;

	$members_post_category_array = array();
	$members_post_category_array = explode($members_post_category);

	return (count(array_intersect($members_post_category, wp_get_post_categories($post->ID))) > 0);
}

function comicpress_is_member() {
	global $user_ID;
	if (!empty($user_ID)) {
		$is_member = get_usermeta($user_ID,'comicpress-is-member');
		if ($is_member == 'yes' || current_user_can('publish_posts')) {
			return true;
		}
	}
	return false;	
}

?>