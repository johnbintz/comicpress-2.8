<?php global $comicpress_options;
if (comicpress_is_active_sidebar('Header')) { ?>
<div id="sidebar-header" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header') ) : ?><?php endif; ?>
</div>
<?php } ?>