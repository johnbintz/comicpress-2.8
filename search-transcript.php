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
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
			
<?php
$tmp_search = new WP_Query($query_string.'&order=desc&show_posts=-1&posts_per_page=-1');
$count = $tmp_search->post_count;
			?>
		<?php if (!$count) $count = "no"; ?>
		<div class="searchresults">Found <?php echo $count; ?> result<?php if ($count !== 1) { echo "s"; } ?>.</div>
    <h2 class="pagetitle">Transcript search for &lsquo;<?php the_search_query() ?>&rsquo;</h2>
	
  <?php if (have_posts()) : ?>

    <?php $posts = query_posts($query_string.'&order=asc');
    while (have_posts()) : the_post() ?>

        <?php if (in_comic_category()) { ?>
		<div class="<?php comicpress_blogpost_class(); ?>">
			<div class="post-comic-head"></div>
			<div class="post-comic">
		<div class="post-info">
			<?php if ($enable_comic_post_author_gravatar == 'yes') { ?>
				<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),get_avatar(get_the_author_meta('email'), 64)); ?></div>
			<?php } ?>
			<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
			<?php if ($enable_comic_post_calendar == 'yes') { ?>
				<div class="post-date">
					<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
				</div>
			<?php } ?>
			<div class="post-text">
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small> By <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link('Edit Post', ' [ ', ' ] '); ?></small><br />
			</div>
			<div class="clear"></div>
		</div>
				<div class="post-extras">
					<div class="tags">
						<?php the_tags('&#9492; Tags: ',', ','<br />'); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="comicarchiveframe" style="width:<?php echo $archive_comic_width; ?>px;">
					<a href="<?php the_permalink() ?>"><img src="<?php the_comic_archive() ?>" alt="<?php the_title() ?>" title="Click for full size." width="<?php echo $archive_comic_width ?>" /></a><br />
				</div>
				<br class="clear-margins" />
			</div>
			<div class="post-comic-foot"></div>
		</div>
        <?php } else { ?>
		<div class="<?php comicpress_blogpost_class(); ?>">
          <div class="post-head"></div>
          <div class="post">
			<div class="post-info">
					<?php if ($enable_post_author_gravatar == 'yes') { ?>
						<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),get_avatar(get_the_author_meta('email'), 64)); ?></div>
					<?php } ?>
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<?php if ($enable_post_calendar == 'yes') { ?>
						<div class="post-date">
							<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
						</div>
					<?php } ?>
					<div class="post-text">
						<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<small> By <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link('Edit Post', ' [ ', ' ] '); ?></small><br />
						<?php if ($disable_categories_in_posts != 'yes') { ?>
							<small> Posted In: <?php the_category(','); ?></small><br />
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
			<div class="post-extras">
				<div class="tags">
					<?php the_tags('&#9492; Tags: ',', ','<br />'); ?>
				</div>
				<div class="clear"></div>
			</div>
            <?php the_excerpt() ?>
            <br class="clear-margins" />
          </div>
          <div class="post-foot"></div>
		</div>
        <?php } ?>

    <?php endwhile; ?>

  <?php else : ?>
<div class="<?php comicpress_blogpost_class(); ?>">
    <div class="post-page-head"></div>
    <div class="post-page">
      <h3>No transcripts found.</h3>
      <p>Try another search?</p>
      <p><?php include(get_template_directory() . '/searchform-transcript.php') ?></p>
      <br class="clear-margins" />
    </div>
    <div class="post-page-foot"></div>
</div>
  <?php endif; ?>

			<?php comicpress_pagination(); ?>
		</div>
	</div>

<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>
	</div>
</div>
<div id="content-wrapper-bottom"></div>
<?php get_footer() ?>