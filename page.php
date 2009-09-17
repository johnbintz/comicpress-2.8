<?php get_header();  ?>

<div id="content-wrapper-top"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>

	<?php if (is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
<?php if (is_cp_theme_layout('3c,v')) {  ?>
	<div id="area-wrapper">
<?php } ?>
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>

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
	
<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

<?php if (is_cp_theme_layout('3c,v')) {  ?>
		<div class="clear"></div>
	</div>
<?php } ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>

</div>
<div id="content-wrapper-bottom"></div>
<?php get_footer() ?>