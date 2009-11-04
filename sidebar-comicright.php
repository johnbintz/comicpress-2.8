<?php if (comicpress_is_active_sidebar('Right of Comic')) { ?>
<div id="sidebar-comicright" class="customsidebar <?php global $enable_if_widgetarea_use_sidebar_css; if ($enable_widgetarea_use_sidebar_css == 'yes') { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right of Comic') ) : ?><?php endif; ?>
</div>
<?php } ?>
