<?php

function comicpress_display_comic_image($searchorder = "comic",$use_post_image = false) {
	global $post;
	if ($use_post_image) {
		if (function_exists('has_post_thumbnail')) {
			if ( has_post_thumbnail($post->ID) ) {
				$comic_image = get_the_post_thumbnail($post->ID,'full');
				$comic_image = preg_replace('#title="([^*]*)"#', 'title="'.the_hovertext().'"', $comic_image);
			} 
		}
	}
	if (!isset($comic_image)) {
		$searchorder = explode(',',$searchorder);
		$requested_archive_image = '';
		foreach ($searchorder as $type) {
			if (($requested_archive_image = get_comic_url($type, $post)) !== false) {
				$comic_image = "<img src=\"$requested_archive_image\" alt=\"".get_the_title()."\" title=\"".the_hovertext()."\" />";
				break;
			}
		}
	}
	return apply_filters('comicpress_display_comic_image',$comic_image);
}


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

function comicpress_display_comic() { 
	global $post, $wp_query, $rascal_says, $comicpress_options, $comic_filename_filters;
	$next_comic = get_next_comic_permalink();
	$comic = explode(".", the_comic_filename()); 
	if ($comic[1] == 'swf') { ?>
		<?php 
			$height = get_post_meta( get_the_ID(), "fheight", true );
			$width = get_post_meta( get_the_ID(), "fwidth", true );
			if (empty($height)) $height = '300';
			if (empty($width)) $width = '100%';
		?>
		<object id="myId" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
		<param name="movie" value="<?php echo get_comic_url(); ?>" />
		<!--[if !IE]>--><object type="application/x-shockwave-flash" data="<?php echo get_comic_url(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"><!--<![endif]-->
			<div>
				<h1>Get Flash!</h1>
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			</div>
		<!--[if !IE]>--></object><!--<![endif]--></object>
		<?php } else {
			if ($comicpress_options['comic_clicks_next']) { 
				$hovertext = get_post_meta( get_the_ID(), "hovertext", true ); 
				if ($comicpress_options['rascal_says'] && !empty($hovertext)) { ?>
					<a href="<?php echo $next_comic; ?>" class="tt"><span class="tooltip"><span class="top"></span><span class="middle"><?php the_hovertext() ?></span><span class="bottom"></span></span><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_title(); ?>" /></a>
				<?php } else { ?>
					<a href="<?php echo $next_comic; ?>"><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" /></a>
				<?php } ?>
			<?php } else { 
				$hovertext = get_post_meta( get_the_ID(), "hovertext", true ); 
				if ($comicpress_options['rascal_says'] && !empty($hovertext)) { ?>
					<a href="#" class="tt"><span class="tooltip"><span class="top"></span><span class="middle"><?php the_hovertext() ?></span><span class="bottom"></span></span><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_title(); ?>" /></a>			
				<?php } else { ?>
					<img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" class="instant itiltleft icolorFFFCE9 ishadow40 historical" />
				<?php } 
		 }
	} 
}

?>