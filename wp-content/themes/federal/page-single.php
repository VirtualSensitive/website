<?php 
/**
 * Template Name: Single Page Template
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
	
	echo $rb_content;
}
get_footer(); 
?>