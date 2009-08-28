<?php

function comicpress_pagination() {
	global $post, $wp_query;
	if(function_exists('wp_pagenavi')) { ?>
		<div id="wp-paginav">
			<?php wp_pagenavi(); ?>
			<div class="clear"></div>
		</div>
		<?php } else { ?>
		<div id="pagenav">
			  <div class="pagenav-right"><?php previous_posts_link('Newer Entries &uarr;') ?></div>
			  <div class="pagenav-left"><?php next_posts_link('&darr; Previous Entries') ?></div>
			<div class="clear"></div>
		</div>
	<?php }
} ?>
