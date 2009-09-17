<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post() ?>
	<div class="<?php comicpress_blogpost_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page" id="post-<?php the_ID() ?>">
			<h2 class="pagetitle"><?php the_title() ?></h2>
			<div class="entry">
				<?php the_content() ?>
				<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
			</div>
			<?php edit_post_link('Edit this page.', '<p>', '</p>') ?>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
	</div>
		<?php if ('open' == $post->comment_status) {
			comments_template('', true);
			} ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>