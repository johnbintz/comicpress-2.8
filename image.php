<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post() ?>
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page" id="post-<?php the_ID() ?>">
			<?php if (function_exists('the_post_image')) {
				if ( has_post_image() ) { ?>
					<div class="post-page-image">
					<?php the_post_image('full'); ?>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if (!$comicpress_options['disable_page_titles']) { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<br class="clear-margins" />
			<div class="gallery-image">
				<a href="<?php echo wp_get_attachment_url($post->ID) ?>" target="_blank" title="<?php _e('Click for full size.','comicpress'); ?>" ><img src="<?php echo wp_get_attachment_url($post->ID) ?>" alt="<?php the_title() ?>" /></a>
			</div>
			<div class="gallery-caption">
				<?php the_excerpt() ?>
			</div>
			<div class="imagenav-wrap">
				<div class="imagenav">
					<div class="imagenav-bg">
						<?php previous_image_link() ?>
					</div>
					<div class="imagenav-arrow">
						&lsaquo;
					</div>
					<div class="imagenav-link">
						<?php previous_image_link() ?>
					</div>
				</div>
				<div class="imagenav-center">
					<a href="<?php echo wp_get_attachment_url($post->ID) ?>" target="_blank" title="Click for full size." class="imagetitle"><?php the_title() ?></a><br />
					<a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php _e('&larr; Back to Gallery','comicpress'); ?></a>
				</div>
				<div class="imagenav">
					<div class="imagenav-bg">
						<?php next_image_link() ?>
					</div>
					<div class="imagenav-arrow">
						&rsaquo;
					</div>
					<div class="imagenav-link">
						<?php next_image_link() ?>
					</div>
				</div>					
				<div class="clear"></div>
			</div>
			<?php the_content() ?>
		<?php if ('open' == $post->comment_status) {
			comments_template('', true);
			} ?>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
	</div>
	<?php endwhile; else: ?>
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page">
			<p><?php _e('Sorry, no image matched your criteria.','comicpress'); ?></p>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
	</div>
	<?php endif; ?>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>