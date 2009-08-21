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
<?php
$tmp_search = new WP_Query($query_string.'&order=desc&show_posts=-1&posts_per_page=-1');
$count = $tmp_search->post_count;
    ?>
		<?php if (!$count) $count = "no"; ?>
		<div class="searchresults">Found <?php echo $count; ?> result<?php if ($count !== 1) { echo "s"; } ?>.</div>

	<?php if (have_posts()) : ?>
		<?php $posts = query_posts($query_string.'&order=desc'); ?>
		<div class="post-page-head"></div>
		<div class="post-page">	
	
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* Category Archive */ if (is_category()) { ?>
				<div class="content"><h2 class="pagetitle">Archive for &#8216;<?php single_cat_title() ?>&#8217;</h2></div>
			<?php /* Tag Archive */ } elseif( is_tag() ) { ?>
				<div class="content"><h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title() ?>&#8217;</h2></div>
			<?php /* Daily Archive */ } elseif (is_day()) { ?>
				<div class="content"><h2 class="pagetitle">Archive for <?php the_time('F jS, Y') ?></h2></div>
			<?php /* Monthly Archive */ } elseif (is_month()) { ?>
				<div class="content"><h2 class="pagetitle">Archive for <?php the_time('F, Y') ?></h2></div>
			<?php /* Yearly Archive */ } elseif (is_year()) { ?>
				<div class="content"><h2 class="pagetitle">Archive for <?php the_time('Y') ?></h2></div>
			<?php /* Author Archive */ } elseif (is_author()) { ?>
				<div class="content"><h2 class="pagetitle">Author Archive</h2></div>
			<?php /* Paged Archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<div class="content"><h2 class="pagetitle">Archives</h2></div>
			<?php } ?>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>



		<?php while (have_posts()) : the_post() ?>

			<?php global $archive_comic_width; if (in_comic_category()) { ?>

				<div class="post-comic-head"></div>
				<div class="post-comic">
					<div class="post-info">
						<div class="post-date">
							<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
						</div>
						<div class="post-text">
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<small> - By <?php the_author(); ?> on <?php the_time('F jS, Y'); ?></small><br />
						</div>
						<div class="clear"></div>
					</div>
					<div class="post-extras">
						<div class="tags">
							<?php the_tags('&#9492; Tags: ',', ','<br />'); ?> Posted in: <?php the_category(','); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="comicarchiveframe" style="width:<?php echo $archive_comic_width; ?>px;">
						<a href="<?php the_permalink() ?>"><img src="<?php the_comic_archive() ?>" alt="<?php the_title() ?>" title="Click for full size." width="<?php echo $archive_comic_width ?>" /></a><br />
					</div>
					<br class="clear-margins" />
				</div>
				<div class="post-comic-foot"></div>

			<?php } else { ?>

				<div class="post-head"></div>
				<div class="post">
					<div class="post-info">
						<div class="post-date">
							<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
						</div>
						<div class="post-text">
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<small> - By <?php the_author(); ?> on <?php the_time('F jS, Y'); ?></small><br />
						</div>
						<div class="clear"></div>
					</div>
					<?php the_excerpt() ?>
					<br class="clear-margins" />
					<div class="post-extras">
						<div class="tags">
							<?php the_tags('&#9492; Tags: ',',','<br />');?> Posted in: <?php the_category(','); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="post-foot"></div>

			<?php } ?>			

		<?php endwhile; ?>

	<?php else : ?>

		<div class="post-head"></div>
		<div class="post">
			<h3>No entries found.</h3>
			<p>Try another search?</p>
			<p><?php include(get_template_directory() . '/searchform.php') ?></p>
			<br class="clear-margins" />
		</div>
		<div class="post-foot"></div>

	<?php endif; ?>
		
		<?php if(function_exists('wp_pagenavi')) { ?>
			<div class="paginav">
				<?php wp_pagenavi(); ?>
			</div>
			<?php } else { ?>
			<div class="pagenav">
				  <div class="pagenav-right"><?php previous_posts_link('Newer Entries &uarr;') ?></div>
				  <div class="pagenav-left"><?php next_posts_link('&darr; Previous Entries') ?></div>
				<div class="clear"></div>
			</div>
		<?php } ?>
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