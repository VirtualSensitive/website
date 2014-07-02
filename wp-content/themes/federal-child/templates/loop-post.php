<article id="post-<?php the_ID(); ?>" <?php post_class('frame-blog'); ?>>
	
	<?php global $rb_useMediaHead; ?>
	<?php get_template_part( 'templates/single/content', 'gallery' ); ?>
	<?php
	$rb_blogformat = strtolower( get_post_format() );
	if($rb_blogformat == 'standard' || $rb_blogformat == '') 	$rb_blogformat = 'standard';
	
	$rb_postContentClass = '';
	if(!$rb_useMediaHead) $rb_postContentClass = 'type-quote';
	?>
	<div class="content <?php echo $rb_postContentClass; ?>">
		<div class="title">
			<h3><?php the_title();?></h3>
			<?php get_template_part( 'templates/single/content', 'meta' ); ?>
		</div>
		<div class="message">
			<?php 
			if(is_search() || is_archive()){
				the_excerpt();
			}else{
				global $more; $more=0; the_content('');
			}?>
			<div class="clearfix"></div>
		</div>
		
		<?php 
		$rb_args = array(
			'before'           => '<div class="page-link-number">',
			'after'            => '</div>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => __('Next','rb'),
			'previouspagelink' => __('Prev','rb'),
			'pagelink'         => '%',
			'more_file'        => '',
			'echo'             => 1 );

		wp_link_pages( $rb_args ); 
		?>
		
	</div>
	<div class="readmore">
		<a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Read More', 'rb'); ?></a>
	</div>
</article>