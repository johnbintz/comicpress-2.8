<div id="footer">
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="footerpwad">
			<center>
			<?php the_project_wonderful_ad('footer'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('footer'); ?>
	<?php global $disable_footer_text; if ($disable_footer_text != 'yes') { ?>
		<p>
			 <?php echo cp_copyright_year(); ?> | Powered by <a href="http://wordpress.org/">WordPress</a> with <a href="http://comicpress.org/">ComicPress</a>
			| Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS Feed</a> | <a href="#outside" onclick="scrollup(); return false;">Back to Top &uarr;</a><br />
			<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. -->
		</p>
	<?php } ?>
</div>
 
<?php global $disable_page_restraints; if ($disable_page_restraints == 'no') { ?>
	</div><!-- Ends "page/page-wide" -->
</div><!-- Ends "page-wrap" -->
<?php } ?>
<div id="page-bottom"></div>

<?php wp_footer() ?>

</body>
</html>
