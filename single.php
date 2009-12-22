<?php get_header(); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
<?php 
if (have_posts()) : while (have_posts()) : the_post();
	if (in_comic_category()) {
		if (!$comicpress_options['disable_comic_blog_single']) {
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
?>
	
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="blogpwad">
			<center>
			<?php the_project_wonderful_ad('blog'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('blog'); ?>
	
	<?php 
	if ($comicpress_options['static_blog'] && in_comic_category()) {
		global $blog_postcount; 
		if (!$comicpress_options['split_column_in_two']) {
			$blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&paged='.$paged; 
			
			$posts = query_posts($blog_query);
		if (have_posts()) { ?>
		
			<?php if (!$comicpress_options['disable_blogheader']) { ?>
				<div id="blogheader"><!-- This area can be used for a heading above your main page blog posts --></div>
			<?php } ?>
			
			<div class="blogindex-head"></div>
			<div class="blogindex">
				<?php while (have_posts()) : the_post();
					
					display_blog_post();	
				
			endwhile; ?>
			</div>
			<div class="blogindex-foot"></div>
			<?php }
			comicpress_pagination();
		} else {
			comicpress_dual_columns();
		}
	} else {
		
		if ($comicpress_options['blogposts_with_comic']) {
			
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
	} 
	
	comments_template('', true);
	 
	?>
		
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
