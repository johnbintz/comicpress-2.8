<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
		<input type="text" value="<?php _e('Search Site...','comicpress'); ?>" name="s" id="s-search" onfocus="this.value=(this.value=='<?php _e('Search Site...','comicpress'); ?>') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php _e('Search Site...','comicpress'); ?>' : this.value;" />
		<button type="submit" class="button">&#9658;</button>
	</div>
</form>