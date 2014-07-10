<?php
$rb_footer_pattern = get_option('footerPattern', 'false');
$rb_footer_type = get_option('footerType', 'classic');
$rb_footer_image = get_option('footerImage', '');
?>


		<nav class='footer-wrapper'>
			<div class='container'>
				<div class='left'>
					<p>Copyright © VirtualSensitive 2014</p>
				</div>
				<div class='right'>
					<?php
					if (has_nav_menu('footermenu')) {
						echo strip_tags(wp_nav_menu(array(
							'theme_location' => 'footermenu',
							'echo' => false,
							'container' => false,
							'menu_class' => 'footer-nav',
							'walker'=> new Description_Walker,
							'depth' => 4
						)), '<a>');
					}
					?>
				</div>
			</div>
		</nav>
	</body>
	<?php
	$rb_analyticsCode = rb_opt('googlecode', '');
	if (!empty($rb_analyticsCode)) {
		?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo trim($rb_analyticsCode); ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<?php
	}
	wp_footer();
	?>
</html>
