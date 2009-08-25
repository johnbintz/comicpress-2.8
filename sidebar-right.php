<div id="sidebar-right-top"></div>
<div id="sidebar-right">
	<div class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
				<?php comicpress_comic_bookmark() ?>
				
				<?php if (is_cp_theme_style('standard,v')) { ?>
				<ul>
					<li>
						<?php get_calendar() ?>
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

				<ul><?php wp_list_bookmarks() ?></ul>
				<ul>
				<li>
					<?php include(get_template_directory() . '/searchform.php'); ?>
				</li>
				</ul>
			<?php endif; ?>
	</div>
</div>
<div id="sidebar-right-bottom"></div>