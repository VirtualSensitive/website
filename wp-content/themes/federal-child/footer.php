<?php
$rb_footer_pattern = get_option('footerPattern', 'false');
$rb_footer_type = get_option('footerType', 'classic');
$rb_footer_image = get_option('footerImage', '');
?>


			<?php if(!empty($rb_footer_image) && $rb_footer_type=='parallax'){ ?>
			<section id="page-footer" class="parallax-background" data-background="<?php  echo $rb_footer_image; ?>" data-parallaxspeed=".2" >
			<?php }elseif(!empty($rb_footer_image) && $rb_footer_type=='classic'){ ?>
			<section id="page-footer" class="normal-background" data-background="<?php  echo $rb_footer_image; ?>" >
			<?php }else{ ?>
			<section id="page-footer" >
			<?php } ?>


				<?php if( $rb_footer_type!='parallax' && $rb_footer_pattern=='true' ){ ?>
				<div class="pattern-overlay1"></div>
				<?php } ?>

				<?php
					if( !empty($rb_footer_image  ) ){ ?>

					<?php if( empty($rb_footer_type) || $rb_footer_type=='classic'){ ?>
					<img class="footer-background" alt="background" src="<?php  echo $rb_footer_image; ?> " >
					<?php } ?>

					<?php if( $rb_footer_type=='rainy'){ ?>
					<img class="rainy-background" src="" data-src="<?php  echo $rb_footer_image; ?>" >
					<?php } ?>

				<?php } ?>


					<article class="box-contact">
					<?php if($rb_footer_pattern=='true' && $rb_footer_type=='parallax'){ ?>
						<div class="pattern-overlay"></div>
					<?php } ?>

					<div class="speacing-box effect-waypoint">
						<div class="container">
							<?php
							$rb_footer_header = get_option('footerHeader', '');
							$rb_footer_header_sub = get_option('footerHeaderSub', '');
							if( !empty($rb_footer_header) || !empty($rb_footer_header_sub) ){
							?>
							<div class="row speacing-box-contact">
								<div class="col-xs-12">
									<div class="title center">
										<h2 class="heading">
											<?php echo $rb_footer_header; ?>
										</h2>
										<div class="description">
											<?php echo $rb_footer_header_sub; ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>

							<?php if( get_option('footerContactForm', 'false')=='true' ){ ?>
							<!-- form contact -->
							<div class="row speacing-box-mini">
								<form class="form-contact" method='post' action=''>
									<div class=" speacing-box-mini">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<input type="text" name="sendername" class="name" placeholder="<?php _e('Name', 'rb'); ?>">
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<input type="text" name="email" class="email" placeholder="<?php _e('Email', 'rb'); ?>">
										</div>
									</div>
									<div class=" speacing-box-mini">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<input type="text" name="phone" class="phone" placeholder="<?php _e('Phone', 'rb'); ?>">
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<input type="text" name="website" class="website" placeholder="<?php _e('Website', 'rb'); ?>">
										</div>
									</div>
									<div class=" speacing-box-mini">
										<div class="col-lg-12 col-xs-12">
											<textarea name="message" class="message-contact" placeholder="<?php _e('Message', 'rb'); ?>"></textarea>
										</div>
									</div>
									<div class=" speacing-box-mini">
										<div class="col-lg-12 col-xs-12 text-center">
											<input type="submit" value="<?php _e('Send Message', 'rb'); ?>">
										</div>
									</div>
								</form>
								<div class="loading"><?php _e('Sending your message...', 'rb'); ?></div>
								<div class="success"></div>
							</div>
							<?php } ?>

							<!-- pin contact -->
							<div class="row speacing-box-mini">
							<?php
							$rb_fWidgets = (int) get_option('footerColumns', '4');
							for($rb_wc=1; $rb_wc<=$rb_fWidgets; $rb_wc++){
								echo '<div class="col-sm-'.(12/$rb_fWidgets).'">';
								if(is_active_sidebar('footer-wa-'.$rb_wc))
									dynamic_sidebar('footer-wa-'.$rb_wc);
								echo '</div>';
							}
							?>
							</div>

							<?php
							$rb_footer_socials = '';

							$rb_fSocials = array('Facebook', 'Google', 'Twitter', 'Linkedin', 'Vimeo', 'Pinterest');
							$rb_fs=0;
							foreach($rb_fSocials as $rb_fSocial){
								$rb_fSocial_link = trim(get_option('menuSocial'.str_replace(' ','',$rb_fSocial), ''));
								if(!empty($rb_fSocial_link))
									$rb_footer_socials .= '<span><a href="'.$rb_fSocial_link.'" target="_blank" >
								<img src="'.get_template_directory_uri().'/images/social-icon/'.strtolower(str_replace(' ', '', $rb_fSocial)).'.png" alt="social">
								</a><span>';
								$rb_fs++;
							}

							if(!empty($rb_footer_socials)){ ?>
							<!-- Social Contact -->
							<div class="social-contact text-center">
								<?php echo $rb_footer_socials; ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</article>
				<?php if(rb_opt('copyrighttext','')!=''){ ?>
				<article class="copyright">
					<div class="close-contact">
						<div class="arrow">
							<span class="fa fa-angle-double-up font-color">
							</span>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-xs-12 font-raleway">
								<?php echo do_shortcode(stripslashes(rb_opt('copyrighttext',''))); ?>
							</div>
						</div>
					</div>
				</article>
				<?php } ?>
			</section>
		</div> <!-- .body-wrapper -->
		<div class="body-loading">
			<div>
				<div class="bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>
			</div>
		</div>
		<?php
		$rb_analyticsCode = rb_opt('googlecode','');
		if(!empty($rb_analyticsCode)){ ?>
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
		<?php } ?>
		<?php wp_footer();?>
	</body>
</html>
