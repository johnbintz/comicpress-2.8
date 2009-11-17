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

	<?php if (!empty($comicnum)): ?>
		<?php $temppost = $post; ?>
		<?php $post = & get_post( $comicnum ); ?>
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page">
			<div style="float:right;">
				<br />
				<img src="<?php echo get_template_directory_uri(); ?>/images/paypal.png" alt="<?php _e('Powered by Paypal','comicpress'); ?>" /><br />
			</div>
			<?php if (function_exists('the_post_image')) {
				if ( has_post_image() ) { ?>
					<div class="post-page-image">
					<?php the_post_image('full'); ?>
					</div>
				<?php } else { ?>
					<h2 class="pagetitle"><?php the_title() ?></h2>
				<?php } ?>
			<?php } else { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<br class="clear-margins" />
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
						<input type="hidden" name="amount" value="<?php echo $buy_print_us_amount; ?>">
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $buy_print_email; ?>">
					<?php if ($buy_print_add_shipping == 'yes') { ?>
						<input type="hidden" name="shipping" value="<?php echo $buy_print_us_ship; ?>">
						US/Canada<br>
						$<?php echo $buy_print_us_amount; ?> + $<?php echo $buy_print_us_ship; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						US/Canada<br>
						$<?php echo $buy_print_us_amount; ?><br />
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
						<input type="hidden" name="amount" value="<?php echo $buy_print_int_amount; ?>">
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $buy_print_email; ?>">
					<?php if ($buy_print_add_shipping == 'yes') { ?>
						<input type="hidden" name="shipping" value="<?php echo $buy_print_int_ship; ?>">
						International<br>
						$<?php echo $buy_print_int_amount; ?> + $<?php echo $buy_print_int_ship; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						International<br>
						$<?php echo $buy_print_int_amount; ?><br />
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
			<div class="clear"></div>
		</div>
		<div class="post-page-foot"></div>
	</div>
	<?php else: ?>
	    <?php if (have_posts()) : while (have_posts()) : the_post() ?>
		<div class="<?php comicpress_post_class(); ?>">
		    <div class="post-page-head"></div>
		    <div class="post-page" id="post-<?php the_ID() ?>">
			    <h2 class="pagetitle"><?php the_title() ?></h2>
			    <div class="entry">
				    <?php the_content() ?>
				    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','comicpress').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')) ?>
			    </div>
			    <?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
			    <br class="clear-margins" />
		    </div>
		    <div class="post-page-foot"></div>
		</div>
	    <?php endwhile; endif; ?>
	<?php endif; ?>	

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
