<?php if (comicpress_check_child_file('searchform') == false) { ?>
<form method="get" id="searchform" action="<?php bloginfo('wpurl'); ?>/">
	<div>
		<input type="text" value="<?php _e('Search...','comicpress'); ?>" name="s" id="s-search" onfocus="this.value=(this.value=='<?php _e('Search...','comicpress'); ?>') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php _e('Search...','comicpress'); ?>' : this.value;" />
		<button type="submit">&raquo;</button>
	</div>
</form>
<?php } ?>