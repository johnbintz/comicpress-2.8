<?php global $comicpress_options;
if (comicpress_is_active_sidebar('Blog')) { ?>
<div id="sidebar-blog" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog') ) : ?><?php endif; ?>
</div>
<?php } ?>
