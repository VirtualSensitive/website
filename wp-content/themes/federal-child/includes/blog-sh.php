<?php
add_shortcode('rb_blog', 'rb_sh_blog');
function rb_sh_blog($attr, $content=null){
	extract( shortcode_atts( array(
		'cats' => '',
		'postperpage' => 10,
		'ids'=> '',
	), $attr ) );
	$re = '';
	
	global $paged, $wpdb, $more, $wp_query;
	$paged = ($paged==0)?1:$paged;
	wp_reset_postdata();

	if(is_array($ids) && count($ids)>0){
		$the_query_arr = array(
			'post_type' => 'post',
			'posts_per_page' => $postperpage,
			'paged' => $paged,
			'post__in' => $ids
		);
	}else{
		$the_query_arr = array(
			'post_type' => 'post',
			'posts_per_page' => $postperpage,
			'paged' => $paged,
			'cat' => $cats
		);
	}
	$the_query = new WP_Query($the_query_arr);
	
	
	$nextpage = ($the_query->query_vars['paged']<$the_query->max_num_pages)?1:0;
	
	$rowno=0;
	ob_start();
	while($the_query->have_posts()){
		$rowno++;
		$the_query->the_post();
		get_template_part( 'templates/loop', 'post' );
	}
	$re .= ob_get_clean();
	
	$re .= rb_get_pagination($the_query);
	wp_reset_postdata();
	
	return $re;
}
?>