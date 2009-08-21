<div class="clear"></div><!-- Clears floated columns and sidebars -->

<div id="footer">
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="footerpwad">
			<center>
			<?php the_project_wonderful_ad('footer'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('footer'); ?>
		<p>
			&copy; <?php echo date('Y'); ?> <?php echo the_author_meta('firstname',0); echo "&nbsp;"; echo the_author_meta('lastname'); ?>. <?php bloginfo('name') ?> is powered by <a href="http://wordpress.org/">WordPress</a> with <a href="http://comicpress.org/">ComicPress</a>
			| Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS Feed</a> | <a href="#outside" onclick="scrollup(); return false;">Return to Top &nbsp;</a><br />
			<a href="http://english-156752579142.spampoison.com"><img src="http://pics4.inxhost.com/images/sticker.gif" alt="Spam Poison" border="0" width="80" height="15"/></a><br />
			<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. -->
		</p>
</div>
 
<?php global $disable_page_restraints; if ($disable_page_restraints == 'no') { ?>
</div><!-- Ends "page" -->
<?php } ?>
 
<?php wp_footer() ?>

</body>

</html>