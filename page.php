<?php get_header();  ?>

<?php if (is_cp_theme_style('gn,v3c,v')) { ?>
	<div id="content-wrapper">
<?php } ?>

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
			<h2 class="pagetitle"><?php the_title() ?></h2>
			<div class="entry">
				<?php the_content() ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')) ?>
			</div>
			<?php edit_post_link('Edit this page.', '<p>', '</p>') ?>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
		<?php if ('open' == $post->comment_status) {
			comments_template('', true);
			} ?>
			<?php endwhile; endif; ?>
			<div class="clear"></div>
		</div>
	</div>
	
<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>
	<div class="clear"></div>
</div> <!-- end pageright-wrapper / content-wrapper -->

<?php get_footer() ?>