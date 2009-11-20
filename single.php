<?php get_header();  ?>

<div id="content-wrapper-head"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>

	<?php if (is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>

	<?php while (have_posts()) : the_post(); 
		if (in_comic_category()) { ?>
			<?php if (comicpress_check_child_file('partials/displaycomic') == false) { ?>
			<div id="comic-wrap">
				<div id="comic-head"><?php get_sidebar('over'); ?></div>
				<div class="clear"></div>
				<?php get_sidebar('comicleft'); ?>
				<div id="comic"><?php display_comic(); ?></div>
				<?php get_sidebar('comicright'); ?>
				<div class="clear"></div>
				<div id="comic-foot"><?php get_sidebar('under'); ?></div>
			</div>
			<?php } ?>
	<?php } endwhile; ?>
	
<?php if (is_cp_theme_layout('3c,standard,3c2r')) {  ?>
	<div id="subcontent-wrapper-head"></div>
		<div id="subcontent-wrapper">
<?php } ?>

	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c,rgn')) get_sidebar('left'); ?>

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
				global $disable_comic_blog_single;
				if ($disable_comic_blog_single != 'yes') {
					display_comic_post();
					$cur_date = mysql2date('Y-m-j', $post->post_date);
					$next_comic = get_next_comic();
					$next_comic = (array)$next_comic;
					$next_date = mysql2date('Y-m-j', $next_comic['post_date']);
					$blog_query = 'showposts='.$blog_postcount.'&order=asc&cat=-'.exclude_comic_categories();
				}
			} else { 
				display_blog_post();			
			} 
		endwhile; 
		
		global $blogposts_with_comic;
		
		if ($blogposts_with_comic == 'yes') {
			
			$temppost = $post;
			$temp_query = $wp_query;		
			
			if (in_comic_category() && !empty($blog_query)) {
				function filter_where($where = '') {
					global $cur_date, $next_date;
					$where .= " AND post_date >= '".$cur_date."' AND post_date < '".$next_date."'";
					return $where;
				}
				add_filter('posts_where', 'filter_where');
				$posts = query_posts($blog_query);
				if (have_posts()) { while (have_posts()) : the_post();
						display_blog_post();
				endwhile; }
			} 
			$post = $temppost; $wp_query = $temp_query; $temppost = null; $temp_query = null;
		}
		if ('open' == $post->comment_status) {
			comments_template('', true);
		} ?>
		
	<?php else: ?>
	<?php get_sidebar('underblog'); ?>	
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-head"></div>
		<div class="post">
			<p><?php _e('Sorry, no posts matched your criteria.','comicpress'); ?></p>
			<div class="clear"></div>
		</div>
		<div class="post-foot"></div>
	</div>
	
	<?php endif; ?>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
