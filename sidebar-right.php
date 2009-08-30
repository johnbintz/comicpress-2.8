<?php global $disable_lrsidebars_frontpage; 
if ($disable_lrsidebars_frontpage == 'yes' && is_home()) { 
} else {  ?>
<div id="sidebar-right-top"></div>
<div id="sidebar-right">
	<div class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
				<?php comicpress_comic_bookmark() ?>
				
				<?php if (is_cp_theme_style('standard,v')) { ?>
				<ul>
					<li>
						<?php $default_image = get_bloginfo('stylesheet_directory').'/images/cal/default.png'; ?>
						<?php comicpress_calendar(array('thumbnail' => $default_image)) ?>
					</li>
				</ul>
				<?php } ?>
				<ul>
					<li>
						<h2>Menu</h2>
						<ul>
							<?php wp_list_pages('title_li=') ?>
						</ul>
					</li>
				</ul>

				<ul><?php wp_list_categories('title_li=<h2>Categories</h2>') ?></ul>

			<?php endif; ?>
	</div>
</div>
<div id="sidebar-right-bottom"></div>
<?php } ?>