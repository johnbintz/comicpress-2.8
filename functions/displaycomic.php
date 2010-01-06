<?php

function comicpress_display_comic_area() {
	global $post, $wp_query, $comicpress_options;
	if (comicpress_check_child_file('partials/displaycomic') == false) { ?>
		<div id="comic-wrap">
			<div id="comic-head"><?php get_sidebar('over'); ?></div>
			<div class="clear"></div>
			<?php get_sidebar('comicleft'); ?>
			<div id="comic"><?php comicpress_display_comic(); ?></div>
			<?php get_sidebar('comicright'); ?>
			<div class="clear"></div>
			<div id="comic-foot"><?php get_sidebar('under'); ?></div>
		</div>
<?php }	
}

function comicpress_display_comic_image($searchorder = "comic",$use_post_image = false, $override_post = null, $title = null) {
	global $post;
	$post_to_use = !is_null($override_post) ? $override_post : $post;
	$title_to_use = !is_null($title) ? $title : the_hovertext($post_to_use);
	if ($use_post_image) {
		if (function_exists('has_post_thumbnail')) {
			if ( has_post_thumbnail($post_to_use->ID) ) {
				$comic_image = get_the_post_thumbnail($post_to_use->ID,'full');
				$comic_image = preg_replace('#title="([^*]*)"#', 'title="'.$title_to_use.'"', $comic_image);
			} 
		}
	}
	if (!isset($comic_image)) {
		$searchorder = explode(',',$searchorder);
		$requested_archive_image = '';
		foreach ($searchorder as $type) {
			if (($requested_archive_image = get_comic_url($type, $post_to_use)) !== false) {
				$comic_image = "<img src=\"$requested_archive_image\" alt=\"".get_the_title($post_to_use)."\" title=\"".$title_to_use."\" class=\"instant itiltleft icolorFFFCE9 ishadow40 historical\" />";
				break;
			}
		}
	}
	return apply_filters('comicpress_display_comic_image',$comic_image);
}

function comicpress_display_comic_swf() {
	global $post;
	$height = get_post_meta( get_the_ID(), "fheight", true );
	$width = get_post_meta( get_the_ID(), "fwidth", true );
	if (empty($height)) $height = '300';
	if (empty($width)) $width = '100%';
	$output = "<object id=\"myId\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"{$width}\" height=\"{$height}\">\r\n";
	$output .= "	<param name=\"movie\" value=\"".get_comic_url()."\" />\r\n";
	$output .= "<!--[if !IE]>--><object type=\"application/x-shockwave-flash\" data=\"".get_comic_url()."\" width=\"{$width}\" height=\"{$height}\"><!--<![endif]-->\r\n";
	$output .= "		<div>\r\n";
	$output .= "			<h1>Get Flash!</h1>\r\n";
	$output .= "				<p><a href=\"http://www.adobe.com/go/getflashplayer\"><img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" /></a></p>\r\n";
	$output .= "		</div>\r\n";
	$output .= "<!--[if !IE]>--></object><!--<![endif]--></object>\r\n";
	return apply_filters('comicpress_display_comic_swf',$output);
}

function comicpress_display_comic() {
	global $post;
	$comic = explode(".", the_comic_filename()); 
	switch (strtolower($comic[1])) {
		case 'swf':
			$output = comicpress_display_comic_swf();
			break;
		case 'png':
		case 'gif':
		case 'jpg':
			$output = comicpress_display_comic_image('comic', false, $post, the_hovertext());
		default:
	}
	echo apply_filters('comicpress_display_comic', $output);
}

function comicpress_comic_clicks_next($output) {
	global $post, $comicpress_options;
	$next_comic = get_next_comic_permalink();
	$output = "<a href=\"{$next_comic}\">{$output}</a>\r\n";
	return $output;
}

function comicpress_rascal_says($output) {
	global $post, $wp_query, $comicpress_options;
	$hovertext = get_post_meta( get_the_ID(), "hovertext", true ); 
	if (!empty($hovertext)) {
		$output = preg_replace('#title="([^*]*)"#', '', $output);
		$href_to_use = "#";

		$output = "<span class=\"tooltip\"><span class=\"top\">&nbsp;</span><span class=\"middle\">{$hovertext}</span><span class=\"bottom\">&nbsp;</span></span>{$output}</a>\r\n";
	}
	if ($comicpress_options['comic_clicks_next']) {
		$href_to_use = get_next_comic_permalink();
		$output = "<a href=\"{$href_to_use}\" class=\"tt\">{$output}</a>";
	} else {
		$output = "<a href=\"{$href_to_use}\">{$output}</a>";
	}
	return apply_filters('comicpress_rascal_says',$output);
}

// global $comicpress_options, $post;

if ($comicpress_options['rascal_says']) {
	add_filter('comicpress_display_comic_image', 'comicpress_rascal_says');
}

if ($comicpress_options['comic_clicks_next'] && !$comicpress_options['rascal_says']) { 
	add_filter('comicpress_display_comic_image', 'comicpress_comic_clicks_next'); 
}



?>