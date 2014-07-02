<?php 
global $rb_content;
?>

<div class="single-blog">
	<?php global $rb_useMediaHead; ?>
	<?php get_template_part( 'templates/single/content', 'gallery' ); ?>

	<?php
	$rb_blogformat = strtolower( get_post_format() );
	if($rb_blogformat == 'standard' || $rb_blogformat == '') 	$rb_blogformat = 'standard';
	
	$rb_postContentClass = '';
	if(!$rb_useMediaHead) $rb_postContentClass = 'type-quote';
	//if(!has_post_thumbnail() && ($rb_blogformat=='aside' || $rb_blogformat=='standard')) $postContentClass = 'type-quote';
	?>
	<div class="content <?php echo $rb_postContentClass; ?>">
		<div class="title">
			<?php 
			$rb_title = get_the_title();
			if(!empty($rb_title)){
			?>
			<h3><?php echo $rb_title; ?></h3>
			<?php } ?>
			<?php get_template_part( 'templates/single/content', 'meta' ); ?>
			<?php if(empty($rb_title)){ echo do_shortcode('[vspace height="30px"]'); } ?>
		</div>
		<div class="message">
			<?php echo $rb_content;  ?>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<?php 
	$rb_args = array(
		'before'           => '<div class="page-link-next-prev">',
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'next',
		'nextpagelink'     => '<div class="next">'.__('Continue Reading','rb').'</div>',
		'previouspagelink' => '<div class="prev">'.__('Go Back','rb').'</div>',
		'pagelink'         => '%',
		'more_file'        => '',
		'echo'             => 1 );

	wp_link_pages( $rb_args ); 
	?>
	
	<div class="comment">
	<?php comments_template( '', true ); ?>
	</div>

</div>