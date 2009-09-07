<?php
/**
 * Admin Notes
 * Displays a note that only users with publishing rights can see.
 * 
 * example:  [note]Only the admins can read this.[/note]
 * 
 * This is useful if you have multiple people posting on articles, etc.
 */

add_shortcode( 'note', 'sc_note' );

function sc_note( $atts, $content = null ) {
	if ( current_user_can( 'publish_posts' ) )
		return '<div class="note">'.$content.'</div>';
	return '';
}

?>