<?php
/*
Template Name: Comic Calendar Archive
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
<?php remove_filter('pre_get_posts','comicpress_members_filter'); ?>
<?php

$dayWidth = 22; //set to .cpcal-day total width in pixels including: width, left & right border, left & right margin, left & right padding

	if (isset($_GET['archive_year'])) { 
		$archive_year = (int)$_GET['archive_year']; 
	} else { 
		$latest_comic = get_terminal_post_in_category(get_all_comic_categories_as_cat_string(),true); 
		$archive_year = get_post_time('Y', false, $latest_comic, true); 
	}
	if (empty($archive_year)) $archive_year = date('Y'); 


$firstDayMargins = array();
for ($i = 1; $i <= 12; ++$i) {
	$dateInfo = getdate(mktime(0,0,0,$i,1,$archive_year));
	$firstDayMargins[$i] = $dateInfo['wday'] * $dayWidth;
}

$tempPost = $post;
$comicArchive = new WP_Query(); $comicArchive->query('&showposts=1000&cat='.get_all_comic_categories_as_cat_string().'&year='.$archive_year);
while ($comicArchive->have_posts()) : $comicArchive->the_post();
	$calTitle = get_the_title();
	$calLink = get_permalink();
	$calDay = get_the_time('j');
	$calMonth = get_the_time('F');
	$calComic[$calMonth.$calDay] = array('link' => $calLink, 'title' => $calTitle);
endwhile;
$post = $tempPost;

function leapYear($yr) {
	if ($yr % 4 != 0) {
		return 28;
	} else {
		if ($yr % 100 != 0) {
			return 29;
		} else {
			if ($yr % 400 != 0) {
				return 28;
            } else {
				return 29;
			}
		}
	}
}
$leapYear = leapYear($archive_year);

$month['1'] = array('month' => __('January','comicpress'), 'days' => '31');
$month['2'] = array('month' => __('February','comicpress'), 'days' => $leapYear);
$month['3'] = array('month' => __('March','comicpress'), 'days' => '31');
$month['4'] = array('month' => __('April','comicpress'), 'days' => '30');
$month['5'] = array('month' => __('May','comicpress'), 'days' => '31');
$month['6'] = array('month' => __('June','comicpress'), 'days' => '30');
$month['7'] = array('month' => __('July','comicpress'), 'days' => '31');
$month['8'] = array('month' => __('August','comicpress'), 'days' => '31');
$month['9'] = array('month' => __('September','comicpress'), 'days' => '30');
$month['10'] = array('month' => __('October','comicpress'), 'days' => '31');
$month['11'] = array('month' => __('November','comicpress'), 'days' => '30');
$month['12'] = array('month' => __('December','comicpress'), 'days' => '31');

?>

<?php while (have_posts()) : the_post() ?>

	<?php comicpress_display_post(); ?>

<?php endwhile; ?>

<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
		<div class="archive-yearlist">| 
<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC");
foreach ( $years as $year ) {
				if ($year != (0) ) { ?>	
				<a href="<?php echo add_query_arg('archive_year', $year) ?>"><strong><?php echo $year ?></strong></a> |
			<?php } } ?>
		</div>
		<div class="cpcal-cals">
		<?php $i=1; while($i<=12) { 
			$calendar_directory = $comicpress_options['calendar_directory'];
			if (!empty($calendar_directory) && $calendar_directory != 'none') { ?>
				<div class="cpcal-month" style="height: 257px;" id="<?php echo $month[$i]['month'] ?>">
				<?php if (file_exists(get_stylesheet_directory() . '/images/cal') && $calendar_directory != 'default') { ?>

					<?php if (file_exists(get_stylesheet_directory().'/images/cal/'.$calendar_directory.'/'.$archive_year)) { ?>
						<?php if (count($monthfile = glob(get_stylesheet_directory().'/images/cal/'.$calendar_directory.'/'.$archive_year.'/'.strtolower($month[$i]['month']).'.*')) > 0) { 
							if (is_array($monthfile)) $monthfile = reset($monthfile); ?>
							<img class="cpcal-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cal/<?php echo $calendar_directory; ?>/<?php echo $archive_year; ?>/<?php echo basename($monthfile); ?>" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } else { ?>
							<img class="cpcal-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cal/default.png" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } ?>
					<?php } else { ?>
						<?php if (count($monthfile = glob(get_stylesheet_directory().'/images/cal/'.$calendar_directory.'/'.strtolower($month[$i]['month']).'.*')) > 0) { 
							if (is_array($monthfile)) $monthfile = reset($monthfile); ?>
							<img class="cpcal-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cal/<?php echo $calendar_directory; ?>/<?php echo basename($monthfile); ?>" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />				
						<?php } else { ?>
							<img class="cpcal-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cal/default.png" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } ?>
					<?php } ?>		
				
				<?php } else { ?>
				

					<?php if (file_exists(get_template_directory().'/images/cal/'.$calendar_directory.'/'.$archive_year)) { ?>
						<?php if (count($monthfile = glob(get_template_directory().'/images/cal/'.$calendar_directory.'/'.$archive_year.'/'.strtolower($month[$i]['month']).'.*')) > 0) { 
							if (is_array($monthfile)) $monthfile = reset($monthfile); ?>
							<img class="cpcal-image" src="<?php echo get_template_directory_uri(); ?>/images/cal/<?php echo $calendar_directory; ?>/<?php echo $archive_year; ?>/<?php echo basename($monthfile); ?>" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } else { ?>
							<img class="cpcal-image" src="<?php echo get_template_directory_uri(); ?>/images/cal/default.png" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } ?>
					<?php } else { ?>
						<?php if (count($monthfile = glob(get_template_directory().'/images/cal/'.$calendar_directory.'/'.strtolower($month[$i]['month']).'.*')) > 0) { 
							if (is_array($monthfile)) $monthfile = reset($monthfile); ?>
							<img class="cpcal-image" src="<?php echo get_template_directory_uri(); ?>/images/cal/<?php echo $calendar_directory; ?>/<?php echo basename($monthfile); ?>" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />				
						<?php } else { ?>
							<img class="cpcal-image" src="<?php echo get_template_directory_uri(); ?>/images/cal/default.png" alt="<?php echo $month[$i]['month'] ?>" title="<?php echo $month[$i]['month'] ?>" />
						<?php } ?>
					<?php } ?>
					
				<?php } ?>
			<?php } else { ?>
					<div class="cpcal-month" style="height: 137px;" id="<?php echo $month[$i]['month'] ?>">
			<?php } ?>
						<div class="cpcal-monthtitle"><?php echo $month[$i]['month']." ".$archive_year ?></div>
				<?php foreach(array("S", "M", "T", "W", "T", "F", "S") as $dow) { ?>
							<div class="cpcal-dayletter"><?php echo $dow ?></div>		
				<?php } ?>
							<div class="clear"></div>
				<?php $day=1; while($day<=$month[$i]['days']) {
					if ($day == 1) { ?>
						<div style="width:<?php echo $firstDayMargins[$i]; ?>px;height:15px;float:left;"></div>
					<?php } ?>
					<div class="cpcal-day">
						<?php if (isset($calComic[$month[$i]['month'].$day])) { ?>
							<a href="<?php echo $calComic[$month[$i]['month'].$day]['link'] ?>" title="<?php echo $calComic[$month[$i]['month'].$day]['title'] ?>"><?php echo $day ?></a>
		<?php } else {
			echo $day." ";
						} ?>
					</div>
		<?php ++$day;
	}
				++$i ?>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class="post-foot"></div>
</div>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>