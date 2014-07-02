<?php
function rb_getParamsFromUrl($mediaURL){
	$params = array();
	$urlSections = explode('/', $mediaURL);
	$lastSection = end($urlSections);
	$qmPosition = stripos($lastSection,'?');
	if(stripos($mediaURL, '?')!==false)
		$params['vurl'] = substr($mediaURL, 0, stripos($mediaURL, '?')); 
	else
		$params['vurl'] = $mediaURL;
		
	if($qmPosition>-1){
		$params['v'] = substr($lastSection, 0, $qmPosition);
		$queryString = substr($lastSection, $qmPosition+1);
		$qsSections = explode('&', $queryString);
		for($i=0; $i<sizeof($qsSections); $i++){
			$keyValue = explode('=', $qsSections[$i]);
			if(sizeof($keyValue)==2)
				$params[$keyValue[0]] = $keyValue[1];
		}
	}else{
		$params['v'] = $lastSection;
	}
	return $params;
}

function rb_is_assoc($array) {
  return (bool)count(array_filter(array_keys($array), 'is_string'));
}

function rb_getSource($sourceData, $imageW, $imageH, $addParams=null)
{
	if(!empty($sourceData))
	{
		$embedCode = '';
		$sourceType = rb_getMediaType(trim($sourceData));
		$ext = rb_getMediaType(trim($sourceData), 'ext');
		$mediaParams = rb_getParamsFromUrl(trim($sourceData));
		if(empty($sourceType))
			return '';
	
			if($sourceType=='vimeo')
				$embedCode = '<iframe class="iframevideo" src="http://player.vimeo.com/video/'.$mediaParams['v'].'?title=0&amp;byline=0&amp;portrait=0" width="'.$imageW.'" height="'.$imageH.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			elseif($sourceType=='youtube')
				$embedCode = '<iframe class="iframevideo" width="'.$imageW.'" height="'.$imageH.'" src="http://www.youtube.com/embed/'.$mediaParams['v'].'?wmode=transparent&amp;rel=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>';
			elseif($sourceType=='embedplayer' || $sourceType=='embedaudioplayer')
			{
				$rand = createRandomKey(5);

				if($sourceType=='embedaudioplayer'){
					$imageW = '100%';
					$imageH = '100px';
				}

				$embedprefixe = 'embedplayer';
				$poster = (!empty($addParams['image']))?$addParams['image']:'';
				$mediatype = ($sourceType=='embedaudioplayer')?'audio':'video';
				if($sourceType=='embedaudioplayer') $embedprefixe = 'embedaudioplayer';
				$embedCode = '<video id="'.$embedprefixe.'_'.$rand.'" class="video-js embed-videojs vjs-default-skin" controls preload="none" width="'.$imageW.'" height="'.$imageH.'"
					  poster="'.$poster.'"
					  data-setup="{}">
					<source src="'.$mediaParams['vurl'].'" type="'.$mediatype.'/'.$ext.'" />
				  </video>';
			}
			return $embedCode;
	}
}

function rb_getMediaType($mediaUrl, $type='type'){
	if (stripos($mediaUrl, 'youtu.be')!==false || stripos($mediaUrl, 'youtube.com/watch')!==false)
		return 'youtube';
	else if(stripos($mediaUrl,'vimeo.com')!==false)
		return 'vimeo';
	else{
		$extensions = explode('.',$mediaUrl);
		if(sizeof($extensions)>1)
		{
			$qmPosition = stripos(end($extensions),'?');
			if($qmPosition>0)
				$le = substr(end($extensions), $qmPosition);
			else
				$le = end($extensions);
			$le = strtolower($le);
			
			if($type=='type'){
				if($le=='flv' || $le=='f4v' || $le=='m4v' || $le=='mp4' || $le=='mov' || $le=='webm')
					return 'embedplayer';
				else if($le=='aac' || $le=='m4a' || $le=='f4a' || $le=='ogg' || $le=='oga' || $le=='mp3')
					return 'embedaudioplayer';
				else if($le=='swf')
					return 'flash';
				else
					return '';
			}else{
				return $le;
			}
		}else
			return '';
	}
}

if(!function_exists('rb_get_dynamic_sidebar')){
	function rb_get_dynamic_sidebar($index = 1)
	{
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}

function rb_pageTitle(){
	global $post;
	$Rb_pageTitle = '';
	if(is_search()) {
		 if(have_posts()){
			$Rb_pageTitle .= __('Results for ','rb').'"'.get_search_query().'"';
		}else{ 
			$Rb_pageTitle .= __('Not found for ','rb').'"'.get_search_query().'"';
		}
	}elseif(is_page()){
		if(have_posts()){
			$Rb_pageTitle .= get_the_title();
		}else{
			$Rb_pageTitle .= __('Page request could not be found.','rb');
		}
	}elseif(is_tag()){
		if(have_posts()){
			$Rb_pageTitle .= __('Tag, ','rb').single_tag_title('',false);
		 }else{ 
			$Rb_pageTitle .= __('Tag request could not be found.','rb');
		 }
	
	}elseif(is_category()){
		if(have_posts()){
			$Rb_pageTitle .= __('Category, ','rb').single_tag_title('',false);
		}else{
			$Rb_pageTitle .= __('Category request could not be found.','rb');
		}
	
	}elseif(is_archive()){
		if(have_posts()){
			$Rb_pageTitle .='';
			if(is_day())
				$Rb_pageTitle .= __('Daily Archives, ','rb').get_the_date();
			elseif(is_month())
				$Rb_pageTitle .= __('Monthly Archives, ','rb').get_the_date('F Y');
			elseif(is_year())
				$Rb_pageTitle .= __('Yearly Archives, ','rb').get_the_date('Y');
			elseif(is_tax('rb-project-categories')){
				$Rb_pageTitle .= __('Project Category, ','rb');
				$term = get_term_by( 'name', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$Rb_pageTitle .= $term->name;
			}
			elseif(is_tax('rb-portfolio-categories')){
				$Rb_pageTitle .= __('Portfolio Category, ','rb');
				$term = get_term_by( 'name', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$Rb_pageTitle .= $term->name;
			}
			else
				$Rb_pageTitle .= __('Blog Archives','rb');
			$Rb_pageTitle .= '';
		}else{
			$Rb_pageTitle .= __('Archive request could not be found.','rb');
		}
	}elseif(is_404()){
			$Rb_pageTitle .= __('You may find your requested page by searching.','rb');
	}else{
		$Rb_pageTitle .= get_the_title(); 
	}
	return $Rb_pageTitle;
}

function rb_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function rb_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function rb_getPinterestInfo($postID){
	$blogformat = strtolower( get_post_format($postID) );
	$attachment_url = wp_get_attachment_url(get_post_thumbnail_id($postID)); 
	$imageurl = '';
	if( ($blogformat == 'standart' || $blogformat == '') && !empty($attachment_url) ){
		$imageurl = $attachment_url;
	}elseif($blogformat == 'image'){
		$imageformaturl = get_post_meta($postID, "rb_format_big_image_url", true);
		if(!empty($imageformaturl))
			$imageurl = $imageformaturl;
		elseif(!empty($attachment_url))
			$imageurl = $attachment_url;
	}elseif($blogformat == 'gallery'){
		if(!empty($attachment_url))
			$imageurl = $attachment_url;
	}
	if(!empty($imageurl)){
		return array('image'=>$imageurl, 'description'=>rb_get_excerpt(200, 'content', $postID));
	}else
		return false;
}

function rb_get_excerpt($limit, $source = null, $postID = 0){
    if($source == "content"){
		if($postID>0){
			$content_post = get_post($postID);
			$excerpt = $content_post->post_content;
		}else{
			$excerpt = get_the_content();
		}
	}else{
		$excerpt = get_the_excerpt();
	}
    
    return rb_excerpt_text($excerpt, $limit);
}

function rb_excerpt_text($excerpt, $limit){
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

function rb_getSettingsItem($itemid){
	global $Rb_SettingsOptions;
	$re = false;
	foreach($Rb_SettingsOptions as $sm){
		if($sm['type']=='fields'){
			foreach($sm['fields'] as $field){
				if($field['id']==$itemid){
					$re = $field;
					break;
				}
			}
		}
	}
	return $re;
}

if(!function_exists('rb_sh2array')){
	function rb_sh2array($content, $depth=0)
	{	
		$pattern = get_shortcode_regex();
		$depth ++;
		preg_match_all( "/$pattern/s", $content , $matches);
		$return = array();
		foreach($matches[3] as $key => $value)
		{
			$return[$key]['shortcode'] 	= $matches[2][$key];
			$return[$key]['attr'] 		= shortcode_parse_atts( $value ); 
			
			if(preg_match("/$pattern/s", $matches[5][$key]) && $depth)
				$return[$key]['content'] 	= rb_sh2array($matches[5][$key], $depth);
			else
				$return[$key]['content'] 	= $matches[5][$key];
		}
		return $return;
	}
}

function rb_getFont($name, $type='url', $opt='')
{
	$fonts = json_decode(get_option('fonts'));
	$font;
	for($i=0; $i<sizeof($fonts->items); $i++)
	{
		if($fonts->items[$i]->family==$name)
		{
			$font = $fonts->items[$i];
			break;
		}
	}
	
	if($type=='url' && isset($font))
	{
		$url = 'http://fonts.googleapis.com/css?family='.urlencode($font->family);
		
		if(sizeof($font->variants)>1){
			$url .= ':'.implode(',',$font->variants);
		}
		
		if(sizeof($font->subsets)>1){
			$url .= '&subset='.implode(',',$font->subsets);
		}
		return $url;
	}
	
	if($type=='variants' && isset($font))
	{
		return $font->variants;
	}
	
	if($type=='collation' && isset($font)){
		$collation = '';
		if($font->category=='display' || $font->category=='handwriting')
			$collation = 'cursive';
		else
			$collation = $font->category;
			
		return $font->family.', '.$collation;
	}
}

function rb_opt($v, $def)
{
	if($v=='contentFontFull' || $v=='headerFontFull')
	{
		$v = str_replace('Full','', $v);
		return rb_getFont(rb_opt($v,''),'url',$v);
	}
	elseif($v=='contentFontCollation' || $v=='headerFontCollation'){
		$v = str_replace('Collation','', $v);
		return rb_getFont(rb_opt($v,''),'collation',$v);
	}else{
		$val = get_option($v, $def);
		return $val;
	}
}
function rb_eopt($v, $def)
{
	echo rb_opt($v, $def);
}

function addionalCharacter($URL){
	if(strpos($URL, '/')===false){
		$pageName = $URL;
	}else{
		$pageName = end(explode('/',$URL));
	}
	if(strpos($URL, '?')===false)
		return '?';
	else
		return '&';
}

function rb_get_pagination($wp_res=null){
	if(!$wp_res){
		global $wp_query;
		$wp_res = $wp_query;
	}
	$re = '';
	if(function_exists('wp_pagenavi')){			
		$navHtml = wp_pagenavi( array( 'query' => $wp_res, 'echo' => false, 'options'=>array('first_text'=>' ', 'last_text'=>' ', 'prev_text'=>' ', 'next_text'=>' ') ));
		$navHtml = str_replace('&#038;info=page','',$navHtml);
		$navHtml = str_replace('?info=page','',$navHtml);
		$re .= $navHtml;
	}else{
		if($wp_res->found_posts > $wp_res->query_vars['posts_per_page'])
		{
			$re .= '<div class="element-pagination">';
			$big = 999999999; // need an unlikely integer
			$pLinks = paginate_links( array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> '?paged=%#%',
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $wp_res->max_num_pages,
				'type'         	=> 'array',
				'prev_text'    => __('Previous', 'rb'),
				'next_text'    => __('Next', 'rb'),
			) );
			$re .= '<ul class="pagination">';
			foreach($pLinks as $plink){
				$re .= '<li>'.$plink.'</li>';
			}
			$re .= '</ul>';
			$re .= '</div>';
		}
	}
	return $re;
}

function rb_clean_spaces($content){
	$content = str_replace("\r", ' ', $content); 
	$content = str_replace("\n", ' ', $content); 
	$content = str_replace("\t", ' ', $content);
	$content = force_balance_tags($content);
	return $content;
}

function rb_get_top_section(){
	if(is_front_page())
		$rb_topsection = rb_opt('topsectionhome', 'none');
	else
		$rb_topsection = rb_opt('topsectionother', 'none');
		
	$rb_top = rb_find_top_section($rb_topsection);
	rb_show_top_section($rb_top[0], $rb_top[1]);
}

function rb_find_top_section($rb_topsection){
	$type = 'none';
	$content = '';
	if(! (empty($rb_topsection) || $rb_topsection=='none')){
		$pos = strpos($rb_topsection, 'revslider::');
		if($pos===false){
			$pos = strpos($rb_topsection, 'page::');
			if($pos===false){
				$type = 'none';
			}else{
				$type = 'page';
				$content = substr($rb_topsection, $pos+6);
			}
		}else{
			$type = 'revslider';
			$content = substr($rb_topsection, $pos+11);
		}
	}
	return array($type, $content);
}

function rb_show_top_section($type, $content){
	if($type=='revslider' && function_exists('putRevSlider') && !empty($content)){
		echo '<div class="paralax-revslider">';
		putRevSlider($content);
		echo '</div>';
	}
	elseif($type=='page' && !empty($content) ){
		$page = get_post( $content );
		if(isset($page)){
			$pageContent = apply_filters('the_content', $page->post_content );
			$pageContent = '<section id="top_section" class="effect-waypoint">'.$pageContent.'</section>';
			$pageContent = rb_clean_spaces($pageContent);
			$pageContent = wpautop($pageContent);
			echo $pageContent;
		}
	}else{
		// topsection is none
	}
}
?>