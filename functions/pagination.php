<?php

function comicpress_pagination() {
	global $post, $wp_query;
	if(function_exists('wp_pagenavi')) { ?>
		<?php wp_pagenavi('<div id="wp-paginav">', '<div class="clear"></div></div>'); ?>
	<?php } else { ?>
		<div id="pagenav">
		<div class="pagenav-right"><?php previous_posts_link(__('Newer Entries &uarr;','comicpress')) ?></div>
		<div class="pagenav-left"><?php next_posts_link(__('&darr; Previous Entries','comicpress')) ?></div>
		<div class="clear"></div>
		</div>
	<?php }
} 

?>
