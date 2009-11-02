<?php if (comicpress_check_themepack_file('footer') == false) { ?>
<div id="footer">
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="footerpwad">
			<center>
			<?php the_project_wonderful_ad('footer'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('footer'); ?>
	<?php global $disable_footer_text, $wpmu_version; if ($disable_footer_text != 'yes') { ?>
		<p>
			<span class="footer-copyright"><?php echo cp_copyright(); ?> <?php if (empty($wpmu_version)) { ?><?php echo the_author_meta('firstname',1); echo "&nbsp;"; echo the_author_meta('lastname',1); ?><span class="footer-pipe"> | </span><?php } ?></span>
			<span class="footer-powered"><?php bloginfo('name'); ?> <?Php _e('Powered by','comicpress'); ?> <a href="http://wordpress.org/">WordPress</a> <?php _e('with','comicpress'); ?> <a href="http://comicpress.org/">ComicPress</a><span class="footer-pipe"> | </span></span>
			<span class="footer-subscribe">Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS Feed</a><span class="footer-pipe"> | </span></span>
			<span class="footer-uptotop"><a href="#outside" onclick="scrollup(); return false;"><?php _e('Back to Top &uarr;','comicpress'); ?></a></span>
			<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. -->
		</p>
	<?php } ?>
</div>
<?php } ?>
 
<?php global $disable_page_restraints; if ($disable_page_restraints == 'no') { ?>
	</div><!-- Ends "page/page-wide" -->
</div><!-- Ends "page-wrap" -->
<?php } ?>
<div id="page-foot"></div>

<?php wp_footer() ?>
</body>
</html>
