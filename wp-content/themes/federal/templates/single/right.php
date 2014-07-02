<section class="pageSection">
	<article class="container speacing-box-element">
		<?php echo sh_page_header(array('subtext'=>''), get_the_title()); ?>
		<div class="row block-content">
			<div class="col-md-9">
				<?php get_template_part( 'templates/single/content' ); ?>
			</div>
			<div class="col-md-3">
				<?php echo do_shortcode('[sidebar /]'); ?>
			</div>
		</div><!-- .row -->
	</article>
</section>