<?php global $rb_content; ?>
<section class="pageSection">
	<article class="container speacing-box-element portfolio-item">
	
		<div class="row block-content">
			<div class="col-md-12">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php get_template_part( 'templates/portfolio/gallery'); ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 detail-portfolio">
					<header>
						<h3>
							<?php the_title(); ?>
						</h3>
						<p>
							<?php
							$rb_term_list = wp_get_object_terms(get_the_ID(), 'rb-portfolio-categories');
							$rb_terms = '';

							foreach($rb_term_list as $rb_term)
								$rb_terms .= $rb_term->name.', ';
							$rb_terms = substr($rb_terms, 0, -2);
								
							echo $rb_terms;
							?>
						</p>
						<i class="fa fa-times-circle-o fa-2 close">
						</i>
					</header>
					<article class="box-speacing-type-small">
						<?php echo $rb_content; ?>
					</article>
					<div class="clearfix">
					</div>
					<footer class="box-speacing-type-small">
						<?php
							$rb_client = get_post_meta(get_the_ID(), "rb_format_portfolio_client", true); 
							if(!empty($rb_client)):
						?>
						<p>
							<span class="font-hard">
							<?php _e('CLIENT:', 'rb'); ?>
							</span>
							 <?php echo $rb_client; ?>
						</p>
						<?php endif; ?>
						
						
						<?php
							$rb_client_task = get_post_meta(get_the_ID(), "rb_format_portfolio_task", true); 
							if(!empty($rb_client_task)):;
						?>
						<p>
							<span class="font-hard">
							<?php _e('TASKS:', 'rb'); ?>
							</span>
							<?php echo $rb_client_task ?>
						</p>
						<?php endif; ?>
						
						<?php
							$rb_client_plink = get_post_meta(get_the_ID(), "rb_format_portfolio_plink", true); 
							if(!empty($rb_client_plink)):
						?>
						<p>
							<span class="font-hard">
							<?php _e('WEBSITE:', 'rb'); ?>
							</span>
							<?php echo $rb_client_plink; ?>
						</p>
						<?php endif; ?>
					</footer>
					<div class="clearfix"></div>
					<?php if(!empty($rb_client_plink)): ?>
					<div class="box-speacing-type-small">
						<p>
							<a class="button-q" href="<?php  echo $rb_client_plink; ?>">
							<?php _e('Go To Website', 'rb'); ?>
							</a>
						</p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .row -->
		
		
	</article>
</section>