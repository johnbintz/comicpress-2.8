<?php
/*
Template Name: Buy Print
Template Author: Philip M. Hofer (Frumph)
Template URL: http://frumph.net/forum/
Template Author Email: philip@frumph.net
Template Version: 2.14
*/
    if (isset($_REQUEST['comic'])) $comicnum = (int)$_REQUEST['comic'];
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php 
	if (!empty($comicnum)):
	$temppost = $post;
	$post = & get_post( $comicnum ); 
?>
	<div <?php post_class(); ?>>
		<?php comicpress_display_post_thumbnail(); ?>
		<div class="post-head"></div>
		<div class="post-page">
			<?php if (!$comicpress_options['disable_page_titles']) { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<?php _e('Comic ID','comicpress'); ?> - #<?php echo $comicnum; ?><br />
			<?php _e('Title:','comicpress'); ?>	<?php echo the_title(); ?><br />
			<br />
			<?php $post = & get_post( $comicnum ); ?>
				<?php
				foreach (array("archive", "rss", "comic", "mini") as $type) {
					if (($requested_image = get_comic_url($type, $post)) !== false) {
						$image = $requested_image; break;
					}
				}
			?>
			<center>
			<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><br />
			<br />
			<table>
			<tr>
				<td align="left" valign="center">
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="item_name" value="<?php _e('Print','comicpress'); ?>">
						<input type="hidden" name="return" value="<?php echo bloginfo('wpurl'); ?>">
						<input type="hidden" name="amount" value="<?php echo $comicpress_options['buy_print_us_amount']; ?>">
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $comicpress_options['buy_print_email']; ?>">
					<?php if ($comicpress_options['buy_print_add_shipping']) { ?>
						<input type="hidden" name="shipping" value="<?php echo $comicpress_options['buy_print_us_ship']; ?>">
						US/Canada<br>
						$<?php echo $comicpress_options['buy_print_us_amount']; ?> + $<?php echo $comicpress_options['buy_print_us_ship']; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						US/Canada<br>
						$<?php echo $comicpress_options['buy_print_us_amount']; ?><br />
					<?php } ?>					
						<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/buynow_paypal.png" name="submit32" alt="<?php _e('Make payments with PayPal - it is fast, free and secure!','comicpress'); ?>" /> 
						</form>
				</td>
				<td width="40">
				</td>
				<td align="left" valign="center">
					<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="item_name" value="<?php _e('Print','comicpress'); ?>">
						<input type="hidden" name="return" value="<?php echo bloginfo('wpurl'); ?>">
						<input type="hidden" name="amount" value="<?php echo $comicpress_options['buy_print_int_amount']; ?>">
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $comicpress_options['buy_print_email']; ?>">
					<?php if ($comicpress_options['buy_print_add_shipping']) { ?>
						<input type="hidden" name="shipping" value="<?php echo $buy_print_int_ship; ?>">
						International<br>
						$<?php echo $comicpress_options['buy_print_int_amount']; ?> + $<?php echo $comicpress_options['buy_print_int_ship']; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						International<br>
						$<?php echo $comicpress_options['buy_print_int_amount']; ?><br />
					<?php } ?>
						<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/buynow_paypal.png" name="submit32" alt="<?php _e('Make payments with PayPal - it is fast, free and secure!','comicpress'); ?>" />
					</form>
				</td>
			</tr>
			</table>
			<br />
			<?php _e('The purchase of this strip is based on availability.   A Print of this strip is what you are purchasing.','comicpress'); ?><br />
			</center>
			<br />
			<?php $post = $temppost; ?>
			<br class="clear-margins" />
		</div>
		<div class="post-foot"></div>
	</div>
	
<?php else: ?>
	
		<?php while (have_posts()) : the_post() ?>

		<div <?php post_class(); ?>>
			<?php comicpress_display_post_thumbnail(); ?>
			<div class="post-head"></div>
			<div class="post-page">
				<?php if (!$comicpress_options['disable_page_titles']) { ?>
					<h2 class="pagetitle"><?php the_title() ?></h2>
				<?php } ?>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<br class="clear-margins" />
				<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
			</div>
			<div class="post-foot"></div>
		</div>

		<?php endwhile; ?>

		<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>
		
<?php endif; ?>	

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
