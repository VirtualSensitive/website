<?php get_header(); ?>	
	<section class="pageSection">
		<article class="container speacing-box-element">
			<?php echo sh_page_header(array('subtext'=>__('Opst, page not found.','rb')), '404'); ?>
			<div class="row block-content">
				<div class="col-md-9">
					<?php _e('This page may be removed. You may find your requested page by searching.','rb'); ?>
					<hr>
					<?php get_search_form() ?>
				</div>
				<div class="col-md-3">
					<?php echo do_shortcode('[sidebar /]'); ?>
				</div>
			</div><!-- .row -->
		</article>
	</section>
<?php get_footer(); ?>
