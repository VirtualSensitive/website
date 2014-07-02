<?php
get_header();
if(have_posts())
{
	if(have_posts())
	{
		the_post();
		$rb_postID	= get_the_ID();
		$rb_content = get_the_content();
        $rb_content = apply_filters('the_content', $rb_content);
	}
}

get_template_part( 'templates/portfolio/content');

rb_setPostViews($rb_postID); 
get_footer();
?>