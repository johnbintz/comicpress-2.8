<?php

/**
 * Retrieve the avatar for a user who provided a user ID or email address.
 *
 * @since 2.5
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @param int $size Size of the avatar image
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternate text to use in image tag. Defaults to blank
 * @return string <img> tag for the user's avatar
*/
function comicpress_get_avatar( $id_or_email, $size = '64', $alt = false) {
	global $avatar_directory;
	if ( ! get_option('show_avatars') )
		return false;

	if ( false === $alt)
		$safe_alt = '';
	else
		$safe_alt = attribute_escape( $alt );

	if ( !is_numeric($size) )
		$size = '96';

	$email = '';
	if ( is_numeric($id_or_email) ) {
		$id = (int) $id_or_email;
		$user = get_userdata($id);
		if ( $user )
			$email = $user->user_email;
	} elseif ( is_object($id_or_email) ) {
		if ( isset($id_or_email->comment_type) && '' != $id_or_email->comment_type && 'comment' != $id_or_email->comment_type )
			return false; // No avatar for pingbacks or trackbacks

		if ( !empty($id_or_email->user_id) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_userdata($id);
			if ( $user)
				$email = $user->user_email;
		} elseif ( !empty($id_or_email->comment_author_email) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}
	
	if ($avatar_directory != 'none' || empty($default)) $default = comicpress_random_default_avatar((string)$id_or_email);
		
	if ( empty($default) ) {
		$avatar_default = get_option('avatar_default');
		if ( empty($avatar_default) )
			$default = 'mystery';
		else
			$default = $avatar_default;	
	}

	if ( 'mystery' == $default )
		$default = "http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s={$size}"; // ad516503a11cd5ca435acc9bb6523536 == md5('unknown@gravatar.com')
	elseif ( 'blank' == $default )
		$default = includes_url('images/blank.gif');
	elseif ( !empty($email) && 'gravatar_default' == $default )
		$default = '';
	elseif ( 'gravatar_default' == $default )
		$default = "http://www.gravatar.com/avatar/s={$size}";
	elseif ( empty($email) )
		$default = "http://www.gravatar.com/avatar/?d=$default&amp;s={$size}";
	elseif ( strpos($default, 'http://') === 0 )
		$default = add_query_arg( 's', $size, $default );

	if ( !empty($email) ) {
		$out = 'http://www.gravatar.com/avatar/';
		$out .= md5( strtolower( $email ) );
		$out .= '?s='.$size;
		$out .= '&amp;d=' . urlencode( $default );

		$rating = get_option('avatar_rating');
		if ( !empty( $rating ) )
			$out .= "&amp;r={$rating}";

		$avatar = "<img alt='{$safe_alt}' src='{$out}' class='avatar avatar-{$size} photo instant nocorner itxtalt' height='{$size}' width='{$size}' title='{$safe_alt}' />";
	} else {
		$avatar = "<img alt='{$safe_alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default instant nocorner itxtalt' height='{$size}' width='{$size}' title='{$safe_alt}' />";
	}

	return apply_filters('comicpress_get_avatar', $avatar, $id_or_email, $size, $default, $alt);
}

function comicpress_random_default_avatar($id_or_email = '') {
	$current_avatar_directory = get_option('comicpress-avatar_directory');
	
	if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
	
	$count = count($results = glob(get_template_directory() . '/images/avatars/'.$current_avatar_directory.'/*'));
	
	if ($count) { 
		$default = '';
		
		$checknum = hexdec(substr(md5($id_or_email),0,5)) % $count;
		if ($count > 0) {
			$default = basename($results[(int)$checknum]); 
		} else {
			return false;
		}
		return get_bloginfo('stylesheet_directory').'/images/avatars/'.$current_avatar_directory.'/'.$default;
	}
	return false;
}

?>