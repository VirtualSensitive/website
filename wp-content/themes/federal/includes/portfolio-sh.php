<?php
add_shortcode('rb_portfolio', 'sh_rb_portfolio');
function sh_rb_portfolio($attr, $content=null)
{
	extract( shortcode_atts( array(
		'cats' => '',
		'type' => 'filter',
		'post__not_in' => '',
		'postperpage' => -1,
		'imagewidth' => 300,
		'imageheight' => 300,
		'use_global_query' => 'false',
	), $attr ) );
	
	global $post, $paged, $more, $wpdb, $wp_query;
	$re = '';
	
	$cat = trim($cats);
	$type = strtolower($type);
	$postperpage = (int) $postperpage;
	
	if(!empty($cat))
		$cats = explode(',', $cat);
	else
		$cats = array();
	
	// @post__not_in parameter used only related portfolio items
	$post__not_in = (int) $post__not_in;
	$post__not_in = ($post__not_in>0)?array($post__not_in):array();
	
	$imageW = (int) $imagewidth;
	$imageH = (int) $imageheight;
	 
	$re .= '<div class="container speacing-box window-portfolio"></div>'; 
	
	$re .= '<div class="portfolio-wrapper">';
	
	$catResults = get_terms( 'rb-portfolio-categories', array(
		'orderby'    => 'count',
		'hide_empty' => 1,
		'include' => $cats
	));
	
	$paged = ($paged==0)?1:$paged;
	
	if( ($type=='filter') && sizeof($catResults)>0){
		$addtionalClass = '';
		
		$re .= '<div class="container box-speacing-type-minimal isotope-navigation">
			<header class="text-center">
				<nav>
					<ul class="pagination">';
		$re .= '<li><a href="#" class="active" data-filter="*">'.__('All', 'rb').'</a></li>';
		
		foreach($catResults as $catRow)
			$re .= '<li><a  href="#"  data-filter="'.'.cat'.$catRow->term_id.'" >'.$catRow->name.'</a></li>';
		$re .= '</ul>
				</nav>
			</header>
		</div>';
	}
	
	if(sizeof($cats)>0){
		$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'rb-portfolio-categories',
					'field' => 'id',
					'terms' => $cats,
					'operator' => 'IN'
				)
			);
	}else{
		$tax_query = array();
	}
	$wp_res = new WP_Query(array(
				'post_type'			=> 'rb-portfolio', 
				'post__not_in'		=> $post__not_in,
				'posts_per_page'	=> $postperpage,
				'paged' 			=> $paged,
				'tax_query'			=> $tax_query
				));
	if($use_global_query=='true')
		$wp_res = $wp_query;
		
	$nextpage = ($wp_res->query_vars['paged']<$wp_res->max_num_pages)?1:0;
			
	$re .= '<div class="isotope-container box-speacing-type-minimal" data-cats="'.implode(',',$cats).'" data-imagewidth="'.$imageW.'" data-imageheight="'.$imageH.'" data-postperpage="'.$postperpage.'" data-paged="'.$paged.'"  data-nextpage="'.$nextpage.'">'."\n";
	$re .= '<div class="row box-speacing-type-minimal">';
	if($wp_res->have_posts())
	{
		$i=0;
		while($wp_res->have_posts())
		{
			$i++;
			$wp_res->the_post();		
				
			$cropPos 	= get_post_meta($post->ID, "cropPos", true);
			$cropPos	= ($cropPos=='')?'center,center':$cropPos;
			
			$dataCalss='';
			if($type=='filter')
			{
				foreach(wp_get_post_terms($post->ID, 'rb-portfolio-categories', array("fields" => "ids")) as $categoryid)
					$dataCalss .= 'cat'.$categoryid.' ';
			}
			
			
			$re .= '<div class="thumbnail-portfolio '.$dataCalss.'">';
			$re .= '<figure>';
			$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 			
			if(function_exists('wpthumb'))
				$thumbnail_url = wpthumb($thumbnail_src,'height='.$imageH.'&width='.$imageW.'&resize=true&crop=1&crop_from_position='.$cropPos);
			else
				$thumbnail_url = $thumbnail_src;
					
			
			$votedClass = '';
			if(rb_hasAlreadyVoted($post->ID)) $votedClass = 'votedIcon';
			$voteCount = get_post_meta($post->ID, "votes_count", true);
			$voteCount = (empty($voteCount))?0:$voteCount;
			
			$catNames = '';
			$term_list = wp_get_object_terms($post->ID, 'rb-portfolio-categories');
			foreach($term_list as $term)
				$catNames .= $term->name.', ';
			$catNames = substr($catNames, 0, -2);
			
			
			$re .= '<img src="'.$thumbnail_url.'"  alt="'.get_the_title().'">';
			$re .= '<div class="wrapper-black"></div>';
			$re .= '<div class="textholder"><div class="textVerticalCenter">';
			$re .= '<a href="'.get_permalink().'" class="viewproject opento">'.__('VIEW PROJECT', 'rb').'</a>';
			$re .= '<h3>'.get_the_title().'</h3>';
			$re .= '<p class="categories">'.$catNames.'</p>';
			$re .= '<a href="#" class="fa fa-heart '.$votedClass.'" data-post-id="'.$post->ID.'"></a>';
			//$re .= '<span class="fa fa-heart '.$votedClass.'" ></span>';
			$re .= '<span class="voteCount">'.$voteCount.'</span>';
			
			//$re .= '<div class="button-portfolio"><a href="#" class="fa fa-heart font-color" data-post-id="'.$post->ID.'"></a><a href="'.get_permalink().'" class="fa fa-search font-color opento"></a></div>';
			//$re .= '<div class="figcaption">';
			//$re .= '<div class="like">';
			//$re .= '<span class="fa fa-heart '.$votedClass.'" ></span>';
			//$re .= '<p class="font-color">'.$voteCount.'</p>';
			//$re .= '</div>';
			//$re .= '<div class="caption">';
			//$re .= '<h4 class="font-white">'.get_the_title().'</h4>';
			//$re .= '<p class="font-white">'.$catNames.'</p>';
			//$re .= '</div>';
			$re .= '</div></div><!-- .textholder -->';
			$re .= '</figure>';
			$re .= '</div>';
			
		}
	}
	wp_reset_postdata();
	
	$re .= '</div> <!-- .isotope-portfolio -->';
	$re .= '<div class="portfolio-load-more text-center">';
	if($nextpage!=0)
		$re .= ' <a href="javascript:void(0);" class="loadMorePortfolioItems animatedButton1 animatedButton1Active">'.__('Load More','rb').'</a>';
	$re .=	'</div>';

	$re .= '</div> <!-- .prortfolio-wrapper -->';
	
	return rb_clean_spaces($re);
}

?>