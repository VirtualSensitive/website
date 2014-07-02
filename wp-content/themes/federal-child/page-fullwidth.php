<?php 
/**
 * Template Name: Page Fullwidth Template
 */
get_header();
	if(have_posts())
	{
		have_posts();
		the_post();
		$rb_postID	= get_the_ID();
		
		$rb_content = get_the_content();
		$rb_content = apply_filters('the_content', $rb_content);
		$rb_title = get_the_title();
		?>
		<section class="pageSection">
			<article class="speacing-box effect-waypoint">
				<?php echo $rb_content ?>
			</article>
		</section>
		<?php
		
	}
get_footer(); 
?>