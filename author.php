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
	
<?php 
	if(get_query_var('author_name') ) {
		// NOTE: 2.0 bug requires: get_userdatabylogin(get_the_author_login());
		$curauth = get_userdatabylogin(get_query_var('author_name'));
	} else {
		$curauth = get_userdata(get_query_var('author'));
	}
		if (empty($curauth)) { ?>
			<h2>No such author.</h2>
		<?php } else { ?>
		<div class="<?php comicpress_blogpost_class(); ?>">
			<div class="post-page-head"></div>
			<div class="post-page">
					<div class="userpage-avatar">
						<?php echo str_replace("alt='", "alt='".wp_specialchars($curauth->display_name, 1)."' title='".wp_specialchars($curauth->display_name, 1), get_avatar($curauth->user_email, 64)); ?>
					</div>
					<div class="userpage-info">
						<div class="userpage-bio">
							<h2><?php echo $curauth->display_name; ?></h2>
							Registered on <?php echo date('l \\t\h\e jS \o\f M, Y',strtotime($curauth->user_registered)); ?><br />
							<br />
							<?php if (!empty($curauth->user_url)) { ?>Website: <a href="<?php echo $curauth->user_url; ?>" target="_blank"><?php echo $curauth->user_url; ?></a><br /><?php } ?>
							<?php if (!empty($curauth->aim)) { ?>AIM: <a href="<?php echo $curauth->user_aim; ?>" target="_blank"><?php echo $curauth->aim; ?></a><br /><?php } ?>
							<?php if (!empty($curauth->jabber)) { ?>Jabber/Google Talk: <a href="<?php echo $curauth->jabber; ?>" target="_blank"><?php echo $curauth->jabber; ?></a><br /><?php } ?>
							<?php if (!empty($curauth->yim)) { ?>Yahoo IM: <a href="<?php echo $curauth->jabber; ?>" target="_blank"><?php echo $curauth->jabber; ?></a><br /><?php } ?>

						</div>
						<?php if (!empty($curauth->description)) { ?>
						<div class="userpage-desc">
							<?php echo $curauth->description; ?>
						</div>
						<?php } ?>
					</div>
					<div class="clear"></div>
					<div class="userpage-posts">
						<?php if (have_posts()) { ?>
							<h3>Posts by <?php echo $curauth->nickname; ?> (<?php echo get_usernumposts($curauth->ID); ?>) &not;</h3>
							<?php // this area is a loop that shows what posts the person has done. ?>
							<ol>
									<table class="month-table">
							<?php while (have_posts()) : the_post() ?>
									<tr><td class="archive-date" align="right"><?php the_time('M j, Y') ?></td><td class="archive-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></td>
													
							<?php endwhile; ?>
									</table>
							</ol>
							
							<?php comicpress_pagination(); ?>
						
						<?php } ?>
					</div>
				</div>
				<div class="post-page-foot"></div>
			</div>
		<?php } ?>
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