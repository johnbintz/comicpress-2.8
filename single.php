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

	<?php while (have_posts()) : the_post(); 
		if (in_comic_category()) { ?>
	
			<div id="comic-head"><?php get_sidebar('over'); ?></div>
			<div class="clear"></div>
			<?php get_sidebar('comicleft'); ?>
			<div id="comic"><?php display_comic(); ?></div>
			<?php get_sidebar('comicright'); ?>
			<div class="clear"></div>
			<div id="comic-foot"><?php get_sidebar('under'); ?></div>
		
	<?php } endwhile; ?>
	
<?php if (is_cp_theme_layout('3c,v')) {  ?>
	<div id="area-wrapper">
<?php } ?>

	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>

	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="blogpwad">
			<center>
			<?php the_project_wonderful_ad('blog'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('blog'); ?>	
	<?php if (have_posts()) : while (have_posts()) : the_post();
		if (in_comic_category()) {
			global $disable_comic_blog_frontpage;
			if ($disable_comic_blog_frontpage != 'yes') {
				display_comic_post();
			}
		} else { 
			display_blog_post();			
		} 
		comments_template('', true); ?>
		
		<center>
			<?php get_sidebar('underblog'); ?>
		</center>		
	<?php endwhile; else: ?>
	<div class="<?php comicpress_blogpost_class(); ?>">
		<div class="post-head"></div>
		<div class="post">
			<p>Sorry, no posts matched your criteria.</p>
			<br class="clear-margins" />
		</div>
		<div class="post-foot"></div>
	</div>
	<?php endif; ?>
	
		<?php get_sidebar('underblog'); ?>
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