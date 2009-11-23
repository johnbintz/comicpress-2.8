<?php global $comicpress_options;
if (comicpress_is_active_sidebar('Right of Comic')) { ?>
<div id="sidebar-comicright" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right of Comic') ) : ?><?php endif; ?>
</div>
<?php } ?>
