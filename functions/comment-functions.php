<?php

/**
* Better display of avatars in comments
* Should only be used in comment sections (may update in future)
* Checks for false empty commenter URLs 'http://' w/registered users
* Adds the class 'photo' to the image
* Adds a call to 'images/trackback.jpg' for trackbacks
* Adds a call to 'images/pingback.jpg' for pingbacks
*
* Filters should only return a string for an image URL for the avatar with class $avatar
* They should not get the avatar as this is done after the filter
*
* @since 0.2
* @filter
*/
function comicpress_avatar() {
	global $comment;

	$url = get_comment_author_url();

	$comment_type = get_comment_type();

	if($comment_type == 'trackback') :
		$avatar = '/images/trackback.png';

	elseif($comment_type == 'pingback') :
		$avatar = '/images/pingback.png';

	elseif(get_settings('avatar_default')):
		$avatar = get_settings('avatar_default');

	endif;

//	$avatar = apply_filters('comicpress_avatar', $avatar);
	if($url == true && $url != 'http://')
		echo '<a href="' . $url . '" rel="external nofollow" title="' . wp_specialchars(get_comment_author(), 1) . '">';
	$id_or_email = get_comment_author_email();
	if (empty($id_or_email)) $id_or_email = get_comment_author();
	if(function_exists('comicpress_get_avatar') && $comment_type != 'pingback' && $comment_type != 'trackback' ) { 
		echo str_replace("alt='", "alt='".wp_specialchars(get_comment_author(), 1)."' title='".wp_specialchars(get_comment_author(), 1), comicpress_get_avatar($id_or_email, 64));
	} else {
		if ($comment_type == 'pingback' || $comment_type == 'trackback') {
			echo '<img src="'.get_template_directory_uri().'/'.$avatar.'" class="photo trackping" />';
		} else {
			echo '<img src="'.get_template_directory_uri().'/'.$avatar.'" class="avatar photo" />';
		}
	}
	
	if($url == true && $url != 'http://')
		echo '</a>';
}

/**
* Properly displays comment author name/link
* bbPress and other external systems sometimes don't set a display name for registrations
* WP has problems if no display name is set
* WP gives registered users URL of 'http://' if none is set
*
* @since 0.2.2
*/
function comicpress_comment_author() {
	global $comment;

	$author = get_comment_author();
	$url = get_comment_author_url();

	/*
	* Registered members w/o URL defaults to 'http://'
	*/
	if($url == 'http://')
		$url = false;

	/*
	* Registered through bbPress sometimes leaves no display name
	* Bug with bbPress 0.9 series and WP 2.5 (no later testing)
	* 'Anonymous' should be localized according to WP, not the theme
	*/
	if($comment->user_id > 0) :
		$user = get_userdata($comment->user_id);
		if($user->display_name)
			$author = $user->display_name;
		elseif($user->user_nickname)
			$author = $user->nickname;
		elseif($user->user_nicename)
			$author = $user->user_nicename;
		else
			$author = $user->user_login;
	endif;

	/*
	* Display link and cite if URL is set
	* Also properly cites trackbacks/pingbacks
	*/
	if($url) :
		$output = '<cite title="' . $url . '">';
		$output .= '<a href="' . $url . '" title="' . wp_specialchars($author, 1) . '" class="external nofollow">' . $author . '</a>';
		$output .= '</cite>';
	else :
		$output = '<cite>';
		$output .= $author;
		$output .= '</cite>';
	endif;

	echo $output;
}

/**
* Displays individual comments
* Uses the callback parameter for wp_list_comments
* Overwrites the default display of comments
*
* @since 0.2.3
*
* @param $comment The comment variable
* @param $args Array of arguments passed from wp_list_comments
* @param $depth What level the particular comment is
*/
function comicpress_comments_callback($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	?>
	
	<li id="comment-<?php comment_ID(); ?>" class="<?php comicpress_comment_class(); ?>">
	
		<?php comicpress_avatar(); // Avatar filter ?>
	
		<div class="comment-meta-data">
			
			<div class="comment-author vcard">
				<?php comicpress_comment_author(); ?><br />
			</div>
	
			<span class="comment-time" title="<?php comment_date(__('l, F jS, Y, g:i a','comicpress')); ?>">
				<?php printf(__('%1$s at %2$s','comicpress'), get_comment_date(), get_comment_time()); ?>
			</span> 
	
			<span class="separator">|</span> <a class="permalink" href="#comment-<?php echo str_replace('&', '&amp;', get_comment_ID()); ?>" title="<?php _e('Permalink to comment','comicpress'); ?>"><?php _e('Permalink','comicpress'); ?></a>
	<?php
	if((get_option('thread_comments')) && ($args['type'] == 'all' || get_comment_type() == 'comment')) :
		$max_depth = get_option('thread_comments_depth');
		echo comment_reply_link(array(
					'reply_text' => __('Reply','comicpress'), 
					'login_text' => __('Log in to reply.','comicpress'),
					'depth' => $depth,
					'max_depth' => $max_depth, 
					'before' => '<span class="separator">|</span> <span class="comment-reply-link">', 
					'after' => '</span>'
					));
	endif;
	?>
	<?php edit_comment_link('<span class="edit">'.__('Edit','comicpress').'</span>',' <span class="separator">|</span> ',''); ?> 
	
	<?php if($comment->comment_approved == '0') : ?>
		<div class="comment-moderated"><em><?php _e('Your comment is awaiting moderation.','comicpress'); ?></em></div>
		<?php endif; ?>
	
	</div>

	<?php if (get_comment_type() == 'comment') { ?>
		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
	<?php } ?>
		<div class="clear"></div>
<?php }

/**
* Ends the display of individual comments
* Uses the callback parameter for wp_list_comments
* Needs to be used in conjunction with comicpress_comments_callback
* Not needed but used just in case something is changed
*
* @since 0.2.3
*/
function comicpress_comments_end_callback() {
	echo '</li>';
}

/**
* Sets a class for each comment
* Sets alt, odd/even, and author/user classes
* Adds author, user, and reader classes
*
* @since 0.2
*/
function comicpress_comment_class() {
	global $comment;
	static $comment_alt;
	$classes = array();
	
	if(function_exists('get_comment_class'))
		$classes = get_comment_class();
	
	$classes[] = get_comment_type();;
	
	/*
	* User classes
	*/
	if($comment->user_id > 0 && $user = get_userdata($comment->user_id)) :
		
		$classes[] = 'user user-' . $user->user_nicename;
		
		if($post = get_post($post_id)) :
			if($comment->user_id === $post->post_author)
				$classes[] = 'author author-' . $user->user_nicename;
		endif;
	else :
		$classes[] = 'reader';
	endif;
	
	/*
	* http://microid.org
	*/
	$email = get_comment_author_email();
	$url = get_comment_author_url();
	if(!empty($email) && !empty($url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$email).sha1($url));
		$classes[] = $microid;
	}
	$classes = join(' ', $classes);
	echo $classes;
}

function list_pings($comment, $args, $depth) {       
	$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>">
		<?php comicpress_comment_author(); ?></li>
<?php } 

?>