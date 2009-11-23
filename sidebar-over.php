<?php if (comicpress_is_active_sidebar('Over Comic')) { ?>
<div id="sidebar-overcomic" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Over Comic') ) : ?><?php endif; ?>
</div>
<?php } ?>
