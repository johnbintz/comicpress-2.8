<?php
/**
 * Display Comic
 * Displays the comic.
 * 
 * 
 */

function display_comic() { 
	global $post, $wp_query, $anomaly_says, $comic_clicks_next;
	$next_comic = get_next_comic_permalink();
	
	$comic = explode(".", the_comic_filename()); 
	if ($comic[1] == 'swf') { ?>
		<object id="myId" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo get_post_meta( get_the_ID(), "fwidth", true ); ?>" height="<?php echo get_post_meta( get_the_ID(), "fheight", true ); ?>">
		<param name="movie" value="/<?php echo the_comic_filename(); ?>" />
		<!--[if !IE]>-->
			<object type="application/x-shockwave-flash" data="/<?php echo the_comic_filename(); ?>" width="<?php echo get_post_meta( get_the_ID(), "fwidth", true ); ?>" height="<?php echo get_post_meta( get_the_ID(), "fheight", true ); ?>">
			<!--<![endif]-->
			<div>
				<h1>Get Flash!</h1>
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			</div>
			<!--[if !IE]>-->
			</object>
		<!--<![endif]-->
		</object>
		<?php } else {
			if ($comic_clicks_next == 'yes') { 
				$hovertext = get_post_meta( get_the_ID(), "hovertext", true ); 
				if ($anomaly_says == 'yes' && !empty($hovertext)) { ?>
					<a href="<?php echo $next_comic; ?>" class="tt"><span class="tooltip"><span class="top"></span><span class="middle"><?php the_hovertext() ?></span><span class="bottom"></span></span><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_title(); ?>" /></a>
				<?php } else { ?>
					<a href="<?php echo $next_comic; ?>"><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" /></a>
				<?php } ?>
			<?php } else { 
				$hovertext = get_post_meta( get_the_ID(), "hovertext", true ); 
				if ($anomaly_says == 'yes' && !empty($hovertext)) { ?>
					<a href="#" class="tt"><span class="tooltip"><span class="top"></span><span class="middle"><?php the_hovertext() ?></span><span class="bottom"></span></span><img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_title(); ?>" /></a>			
				<?php } else { ?>
					<img src="<?php the_comic() ?>" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" />
				<?php } 
		 }
	} 
}

?>