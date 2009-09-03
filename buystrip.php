<?php
/*
Template Name: Buy Print
Templete Author: Philip M. Hofer (Frumph)
Templete URL: http://webcomicplanet.com/forum/
Templete Author Email: philip@frumph.net
*/
    if (isset($_REQUEST['comic'])) $comicnum = (int)$_REQUEST['comic'];
?>
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

	<?php if (!empty($comicnum)): ?>
		<?php $temppost = $post; ?>
		<?php $post = & get_post( $comicnum ); ?>
		<div class="post-page-head"></div>
		<div class="post-page">
			<div style="float:right;">
				<br />
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/paypal.png" alt="Powered by Paypal" /><br />
			</div>
			<div style="float:left;">
				<h2 class="pagetitle">Buy Print!</h2>
			</div>
			<div class="clear"></div>
			Comic ID - #<?php echo $comicnum; ?><br />
			Title: 	<?php echo the_title(); ?><br />
			<br />
			<?php $post = & get_post( $comicnum ); ?>
			<center>
			<img src="<?php echo the_comic_archive(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="<?php echo $archive_comic_width; ?>" /><br />
			<br />
			<table>
			<tr>
				<td align="left" valign="center">
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="shipping2" value="<?php echo $buy_print_us_amount; ?>">
						<input type="hidden" name="cn" value="Special Instructions (optional)">
						<input type="hidden" name="cancel_return" value="<?php echo get_bloginfo('url'); ?>">
						<input type="hidden" name="item_name" value="Print">
						<input type="hidden" name="notify_url" value="<?php echo get_bloginfo('url'); ?>">
						<input type="hidden" name="page_style" value="">
						<input type="hidden" name="return" value="<?php echo bloginfo('url'); ?>">
						<input type="hidden" name="amount" value="<?php echo $buy_print_us_amount; ?>">
						<input type="hidden" name="item_number" value="Comic ID (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $buy_print_email; ?>">
						<input type="hidden" name="shipping" value="<?php echo $buy_print_us_ship; ?>">
						US/Canada<br>
						$<?php echo $buy_print_us_amount; ?> + $<?php echo $buy_print_us_ship; ?> shipping<br />
						<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/buynow_paypal.png" name="submit32" alt="Make payments with PayPal - it's fast, free and secure!" /> 
						</form>
				</td>
				<td width="40">
				</td>
				<td align="left" valign="center">
					<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="shipping2" value="<?php echo $buy_print_int_amount; ?>">
						<input type="hidden" name="cn" value="Special Instructions (optional)">
						<input type="hidden" name="cancel_return" value="<?php echo get_bloginfo('url'); ?>">
						<input type="hidden" name="item_name" value="Print">
						<input type="hidden" name="notify_url" value="<?php echo get_bloginfo('url'); ?>">
						<input type="hidden" name="page_style" value="">
						<input type="hidden" name="return" value="<?php echo bloginfo('url'); ?>">
						<input type="hidden" name="amount" value="<?php echo $buy_print_int_amount; ?>">
						<input type="hidden" name="item_number" value="Comic ID (<?php echo $comicnum; ?>) - <?php echo the_title(); ?>">
						<input type="hidden" name="business" value="<?php echo $buy_print_email; ?>">
						<input type="hidden" name="shipping" value="<?php echo $buy_print_int_ship; ?>">
						International<br>
						$<?php echo $buy_print_int_amount; ?> + $<?php echo $buy_print_int_ship; ?> shipping<br />
						<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/buynow_paypal.png" name="submit32" alt="Make payments with PayPal - it's fast, free and secure!" />
					</form>
				</td>
			</tr>
			</table>
			<br />
			</center>
			The purchase of this strip is based on availability.   A Print of this strip is what you are purchasing.<br />
			<br />
			<?php $post = $temppost; ?>
			<div class="clear"></div>
		</div>
	<?php else: ?>
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
	    <?php endwhile; endif; ?>
	<?php endif; ?>	
		</div>
	</div>

<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

	<?php if (is_cp_theme_style('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>

</div> <!-- end pageright-wrapper / content-wrapper -->

<?php get_footer() ?>
