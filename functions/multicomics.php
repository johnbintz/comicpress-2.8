<?php

/**
 * function display_comics_multi
 * July 26th, 2009
 * Philip M. Hofer (Frumph)
 * 
 * Displays multiple comics based on the array return with get_comic_path ($folder, $override_post, $filter, #) 0=no array, 1=array;
 */
function display_comics_multi() {
	global $post;
	if (($result = get_comic_path($folder, $override_post, $filter, 1)) !== false) {
		foreach ($result as $pathto_comic) { ?>
			<div class="comicdisp">
			<img src="<?php echo get_option('home'). '/' .$pathto_comic; ?>" alt="<?php the_title(); ?>" title="<?php the_hovertext(); ?>" />
			</div>
		<?php }
	} else {
		if (($folder == 'archive' || $folder == 'rss')) {
			if (($result = get_comic_path('comic', $override_post, $filter, 1)) !== false) {
				foreach ($result as $pathto_comic) { ?>
					<div class="comicdisp">
					<img src="<?php echo get_option('home'). '/' .$pathto_comic; ?>" alt="<?php the_title(); ?>" title="<?php the_hovertext(); ?>" />
					</div>
				<?php }
			}
		}
	}
	return false;
}



?>