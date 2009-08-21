<?php get_header(); ?>

<?php if (is_cp_theme_style('gn,v3c')) get_sidebar('left'); ?>

<?php if (is_cp_theme_style('v3c,v')) { ?>
	<div id="content" class="narrowcolumn">
		<div class="column">
<?php } ?>

<?php if (is_cp_theme_style('gn')) { ?>
	<div id="pagewrap-right">
<?php } ?>

	<?php if (is_cp_theme_style('3c,standard')) { ?>
	<div id="content-wrapper">
	<?php } ?>
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_style('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_style('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } ?>

	<?php if (have_posts()) : while (have_posts()) : the_post() ?>

		<div class="post-page-head"></div>
		<div class="post-page" id="post-<?php the_ID() ?>">
			<h2 class="pagetitle">
				<a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php echo get_the_title($post->post_parent) ?></a>
			</h2>
			<div class="gallery-image">
				<a href="<?php echo wp_get_attachment_url($post->ID) ?>" target="_blank" title="Click for full size." ><img src="<?php echo wp_get_attachment_url($post->ID) ?>" alt="<?php the_title() ?>" /></a>
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
					<a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment">&larr; Back to Gallery</a>
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
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
		
	<?php endwhile; else: ?>

		<div class="post-page-head"></div>
		<div class="post-page">
			<p>Sorry, no image matched your criteria.</p>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>

	<?php endif; ?>
	<div class="clear">
	</div>
</div>

<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right');
} ?>

<?php if (is_cp_theme_style('standard,gn,3c')) { ?>
	<div class="clear"></div>
</div> <!-- end pageright-wrapper / content-wrapper -->
<?php } ?>	

<?php get_footer() ?>