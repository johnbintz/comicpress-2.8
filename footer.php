<?php global $wpmu_version, $comicpress_options; ?>
<div id="footer">
	<?php if (function_exists('the_project_wonderful_ad')) {
		the_project_wonderful_ad('footer');
	} ?>
	<?php get_sidebar('footer'); ?>
	<?php if (!$comicpress_options['disable_footer_text']) { ?>
		<p>
			<span class="footer-copyright">
				<?php echo comicpress_copyright(); ?>
				<?php if (empty($wpmu_version)) {
					$authorfirstname = get_the_author_meta('firstname',1);
					$authorlastname = get_the_author_meta('lastname',1);
					$blogname = get_bloginfo('title');
					if ( $authorfirstname != "" ) {
						echo $authorfirstname."	".$authorlastname;
					} else {
						echo $blogname;
					}
				} ?>
			</span>
			<span class="footer-powered">
				<span class="footer-pipe">|</span>
				<?php _e('Powered by','comicpress'); ?> <a href="http://wordpress.org/">WordPress</a> <?php _e('with','comicpress'); ?> <a href="http://comicpress.org/">ComicPress</a>
			</span>
			<span class="footer-subscribe">
				<span class="footer-pipe">|</span>
				Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS</a>
			</span>
			<span class="footer-uptotop">
				<span class="footer-pipe">|</span>
				<a href="#outside" onclick="scrollup(); return false;"><?php _e('Back to Top &uarr;','comicpress'); ?></a>
			</span>
			<br /><?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds.
		</p>
	<?php } ?>
</div>
 
<?php if (!$comicpress_options['disable_page_restraints']) { ?>
	</div><!-- Ends "page/page-wide" -->
</div><!-- Ends "page-wrap" -->
<?php } ?>
<div id="page-foot"></div>

<?php wp_footer() ?>
</body>
</html>