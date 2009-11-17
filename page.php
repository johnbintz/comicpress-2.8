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
				<?php } else { ?>
					<h2 class="pagetitle"><?php the_title() ?></h2>
				<?php } ?>
			<?php } else { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<br class="clear-margins" />
			<div class="entry">
				<?php the_content() ?>
				<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">'.__('Pages:','comicpress').'</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
			</div>
			<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
	</div>
		<?php if ('open' == $post->comment_status) {
			comments_template('', true);
			} ?>
			<?php endwhile; endif; ?>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
