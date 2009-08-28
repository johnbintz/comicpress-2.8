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
			<?php global $wpmu_version; if (empty($wpmu_version)) { ?>&copy;<?php echo cp_copyright_year(); ?> <?php echo the_author_meta('firstname',1); echo "&nbsp;"; echo the_author_meta('lastname',1); ?>.<?php } ?><?php bloginfo('name') ?> is powered by <a href="http://wordpress.org/">WordPress</a> with <a href="http://comicpress.org/">ComicPress</a>
			| Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS Feed</a> | <a href="#outside" onclick="scrollup(); return false;">Back to Top &uarr;</a><br />
			<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. -->
		</p>
</div>
 
<?php global $disable_page_restraints; if ($disable_page_restraints == 'no') { ?>
</div><!-- Ends "page" -->
<?php } ?>
 
<?php wp_footer() ?>

</body>

</html>