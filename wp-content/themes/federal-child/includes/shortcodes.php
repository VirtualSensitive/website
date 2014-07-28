<?php
add_shortcode('separator', 'sh_separator');
function sh_separator($attr, $content){
	return '<hr>';
}

add_shortcode('highlight', 'sh_highlight');
function sh_highlight($attr, $content=null){
	return '<span class="font-color">'.$content.'</span>';
}


add_shortcode('video', 'sh_video');
function sh_video($attr, $content=null){
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if(!empty($attr['poster']))
		$extra = array('image'=>$attr['poster']);
	else
		$extra = array();
	$sourceStr = rb_getSource( $attr['url'], $imgW, $imgH, $extra);
	return $sourceStr;
}

add_shortcode('list-group', 'sh_list_group');
function sh_list_group($attr, $content=null){
	$re = '';
	$ul = true;
	$contentArray = rb_sh2array($content);
	foreach($contentArray as $item){
		if($item['shortcode']=='item'){
			$contentText = (!empty($item['content']))?$item['content']:'';
			if(empty($contentText))
			$contentText = (!empty($item['attr']['contenttext']))?$item['attr']['contenttext']:'';

			if(!empty($item['attr']['badge']))
				$re .= "\t".'<li class="list-group-item"><span class="badge">'.$item['attr']['badge'].'</span>'.$contentText.'</li>'."\n";
			elseif(!empty($item['attr']['link'])){
				$ul = false;
				$target = (!empty($item['attr']['target']))?' target="'.$item['attr']['target'].'" ':'';
				$active = (isset($item['attr']['active']) && $item['attr']['active']=='true')?'active':'';

				if(empty($item['attr']['heading']))
					$re .= "\t".'<a href="'.$item['attr']['link'].'" '.$target.' class="list-group-item '.$active.'">'.$contentText.'</a>'."\n";
				else
					$re .= "\t".'<a href="'.$item['attr']['link'].'" '.$target.' class="list-group-item '.$active.'"><h4 class="list-group-item-heading">'.$item['attr']['heading'].'</h4><p class="list-group-item-text">'.$contentText.'</p></a>'."\n";
			}
			else
				$re .= "\t".'<li class="list-group-item">'.$contentText.'</li>'."\n";
		}
	}
	$ret = '';

	$ret .= ($ul)?'<ul class="list-group">'."\n":'<div class="list-group">'."\n";
	$ret .= $re;
	$ret .= ($ul)?'</ul>'."\n":'</div>'."\n";
	return $ret;
}

add_shortcode('item', 'sh_return_empty');


add_shortcode('map','sh_map');
function sh_map($attr, $content=null)
{
$content = trim($content);
//defaults
$width = '';
$height = '';
$zoom = 11; // 0,7 to 18
$controls = 'false';
$maptype = 'HYBRID'; // ROADMAP | SATELLITE | TERRAIN
if(!empty($attr['zoom']))
	$zoom = $attr['zoom'];
if(!empty($attr['controls']))
	$controls = $attr['controls'];
if(!empty($attr['maptype']))
	$type = $attr['maptype'];
if(!empty($attr['width']))
	$width = $attr['width'];
if(!empty($attr['height']))
	$height = $attr['height'];

$mapID = createRandomKey(5);

$re  = '<div class="gmap" data-width="'.$width.'" data-height="'.$height.'" data-lat="'.$attr['lat'].'" data-lng="'.$attr['lng'].'" data-zoom="'.$zoom.'" data-controls="'.$controls.'" data-maptype="'.$type.'" >';
if(!empty($content))
	$re .= '<span>'.$content.'</span>';
$re .= '</div>';
	return $re;
}


function createRandomKey($amount){
	$keyset  = "abcdefghijklmABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$randkey = "";
	for ($i=0; $i<$amount; $i++)
		$randkey .= substr($keyset, rand(0, strlen($keyset)-1), 1);
	return $randkey;
}

function sh_button($attr, $content = null)
{
	$content = (!empty($content))?$content:'';
	if(empty($content))
	$content = (@!empty($attr['title']))?$attr['title']:'';
	$size = (isset($attr['size']))?$attr['size']:'';
	$color = (isset($attr['color']))?$attr['color']:'';
	$block = (isset($attr['block']) && $attr['block']=='true')?'btn-block':'';
	switch($size){
		case 'small': 	$size = 'btn-sm'; break;
		case 'xsmall': 	$size = 'btn-xs'; break;
		case 'large': 	$size = 'btn-lg'; break;
		default: 		$size = '';
	}
	switch($color){
		case 'primary': 	$color = 'btn-primary'; break;
		case 'success': 	$color = 'btn-success'; break;
		case 'info': 		$color = 'btn-info'; break;
		case 'warning': 	$color = 'btn-warning'; break;
		case 'danger': 		$color = 'btn-danger'; break;
		case 'link': 		$color = 'btn-link'; break;
		default: 			$color = 'btn-default';
	}
	$target = (!empty($attr['target']))?' target="'.$attr['target'].'" ':'';
	$re = '<a href="'.$attr['link'].'" '.$target.' role="button" class="btn btn-margin '.$color.' '.$size.' '.$block.'">'.$content.'</a>';
	return $re;
}
add_shortcode('button','sh_button');




add_shortcode('tooltip','sh_tooltip');
function sh_tooltip($attr, $content=null){
	$position = (!empty($attr['position']))?$attr['position']:'top';
	$link = (!empty($attr['link']))?$attr['link']:'#';
	$target = (!empty($attr['target']))?' target="'.$attr['target'].'"':'';
	return '<a href="'.$link.'" '.$target.' data-toggle="tooltip" data-placement="'.$position.'" title="'.$attr['text'].'">'.$content.'</a>';
}

add_shortcode('popover','sh_popover');
function sh_popover($attr, $content=null){
	$position = (!empty($attr['position']))?$attr['position']:'top';
	$link = (!empty($attr['link']))?$attr['link']:'javascript:void(0);';
	$target = (!empty($attr['target']))?' target="'.$attr['target'].'"':'';
	return '<a class="jsaction" href="'.$link.'" '.$target.' data-toggle="popover" data-placement="'.$position.'" data-content="'.$attr['text'].'" data-container="body">'.$content.'</a>';
}

add_shortcode('message-box','sh_message_box');
function sh_message_box($attr, $content=null){
	$re = '';
	$color = (!empty($attr['color']))?$attr['color']:'success';
	$dismissable = (isset($attr['dismissable']) && $attr['dismissable']=='true')?true:false;
	$dismissableClass = '';
	if($dismissable) $dismissableClass = 'alert-dismissable';
	$re .= '<div class="alert alert-'.$color.' '.$dismissableClass.'">';
	if($dismissable)
		$re .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	$re .= $content.'</div>';
	return $re;
}

add_shortcode('progress-bar', 'sh_progress_bar');
function sh_progress_bar($attr, $content=null){
	$re = '';
	$min = (!empty($attr['min']))?$attr['min']:'0';
	$max = (!empty($attr['max']))?$attr['max']:'100';
	$percent = @$attr['percent'];
	$color = (!empty($attr['color']))?'progress-bar-'.$attr['color']:'';
	$re .= '<div class="progress-bar '.$color.'" role="progressbar" aria-valuenow="60" aria-valuemin="'.$min.'" aria-valuemax="'.$max.'" style="width:'.$percent.'%;">';
	$re .= '<span class="sr-only">'.$percent.'% '.__('Complete', 'rb').'</span>';
	$re .= '</div>';
	return $re;
}

add_shortcode('progress', 'sh_progress');
function sh_progress($attr, $content=null){
	$striped = (isset($attr['striped']) && $attr['striped']=='true')?'progress-striped':'';
	$active = (isset($attr['active']) && $attr['active']=='true')?'active':'';
	$re  = '<div class="progress '.$striped.' '.$active.'">'.do_shortcode($content).'</div>';
	return $re;
}

add_shortcode('panel', 'sh_panel');
function sh_panel($attr, $content=null){
	$body = '';
	$header = (isset($attr['header']))?$attr['header']:'';
	$footer = (isset($attr['footer']))?$attr['footer']:'';
	$re = '';
	$color = (!empty($attr['color']))?$attr['color']:'default';

	$re .= '<div class="panel panel-'.$color.'">';
	if(!empty($header)){
		$re .= '<div class="panel-heading">';
		$re .= '<h3 class="panel-title">'.$header.'</h3>';
		$re .= '</div>';
	}
	$re .= '<div class="panel-body">';
    $re .= do_shortcode($content);
	$re .= '</div>';

	if(!empty($footer))
		$re .= '<div class="panel-footer">'.$footer.'</div>';
	$re .= '</div>';
	return $re;
}
add_shortcode('panel-header', 'sh_return_empty');
add_shortcode('panel-footer', 'sh_return_empty');

add_shortcode('lightbox', 'sh_lightbox');
function sh_lightbox($attr, $content){
	return '<div class="lightbox">'.do_shortcode($content).'</div>';
}

add_shortcode('clear', 'sh_clear');
function sh_clear($attr, $content = null){ 	return '<div class="clearfix"></div>'; }


add_shortcode('sidebar', 'sh_sidebar');
function sh_sidebar($attr, $content = null){
	$re  = '';
	$re .= '<aside class="sidebar-nav">';
	$re .= '<ul>';
	if(is_active_sidebar('first-general-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('first-general-wa').'</li>';

	if(is_front_page() && is_active_sidebar('front-page-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('front-page-wa').'</li>';

	if(is_single() && is_active_sidebar('single-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('single-wa').'</li>';

	if(is_page() && is_active_sidebar('page-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('page-wa').'</li>';

	if(is_category() && is_active_sidebar('category-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('category-wa').'</li>';

	if(is_tag() && is_active_sidebar('tag-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('tag-wa').'</li>';

	if(is_author() && is_active_sidebar('author-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('author-wa').'</li>';

	if(is_date() && is_active_sidebar('date-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('date-wa').'</li>';

	if(is_archive() && is_active_sidebar('archive-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('archive-wa').'</li>';

	if(is_search() && is_active_sidebar('search-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('search-wa').'</li>';

	if(is_active_sidebar('last-general-wa'))
		$re .= '<li>'.rb_get_dynamic_sidebar('last-general-wa').'</li>';

	$re .= '</ul>';
	$re .= '</aside>';
	return $re;
}


/* Bootstrap */
function sh_row($attr, $content = null){
	extract( shortcode_atts( array(
		'space' => 'normal',
	), $attr ) );
	$extra_class = '';
	switch($space){
		case 'less':
			$extra_class = 'box-speacing-type-min';
			break;
		case 'no':
			$extra_class = '';
			break;
		default:
			$extra_class = 'box-speacing';
	}
	return '<div class="row '.$extra_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode('row', 'sh_row');

function sh_inrow($attr, $content = null){ 	return '<div class="row '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('inrow', 'sh_inrow');

function sh_container($attr, $content = null){ 	return '<div class="container '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('container', 'sh_container');

function sh_col1($attr, $content = null){ 	return '<div class="col-sm-1 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col1', 'sh_col1');

function sh_col2($attr, $content = null){ 	return '<div class="col-sm-2 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col2', 'sh_col2');

function sh_col3($attr, $content = null){ 	return '<div class="col-sm-3 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col3', 'sh_col3');

function sh_col4($attr, $content = null){ 	return '<div class="col-sm-4 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col4', 'sh_col4');

function sh_col5($attr, $content = null){ 	return '<div class="col-sm-5 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col5', 'sh_col5');

function sh_col6($attr, $content = null){ 	return '<div class="col-sm-6 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col6', 'sh_col6');

function sh_col7($attr, $content = null){ 	return '<div class="col-sm-7 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col7', 'sh_col7');

function sh_col8($attr, $content = null){ 	return '<div class="col-sm-8 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col8', 'sh_col8');

function sh_col9($attr, $content = null){ 	return '<div class="col-sm-9 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col9', 'sh_col9');

function sh_col10($attr, $content = null){ 	return '<div class="col-sm-10 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col10', 'sh_col0');

function sh_col11($attr, $content = null){ 	return '<div class="col-sm-11 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col11', 'sh_col11');

function sh_col12($attr, $content = null){ 	return '<div class="col-sm-12 '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>'.do_shortcode($content).'</div>'; }
add_shortcode('col12', 'sh_col12');

function rb_get_extra_el_class($attr){
	extract( shortcode_atts( array(
		'animate' => '',
	), $attr ) );
	$re = '';
	if(!empty($animate)){
		$re .= 'wow '.$animate;
	}
	return $re;
}

function rb_get_extra_el_attr($attr){
	extract( shortcode_atts( array(
		'animatedelay' => '',
		'animateduration' => '',
	), $attr ) );
	$re = '';
	if(!empty($animatedelay)){
		$re .= ' data-wow-delay="'.$animatedelay.'" ';
	}
	if(!empty($animateduration)){
		$re .= ' data-wow-duration="'.$animateduration.'" ';
	}
	return $re;
}

add_shortcode('accordition', 'sh_accordition');
function sh_accordition($attr, $content = null){
	$re = '';
	$accordionid = 'accordion_'.createRandomKey(5);
	$re .= '<div class="panel-group accordition-toggle" id="'.$accordionid.'">'."\n";
	$contentArray = rb_sh2array($content);
	foreach($contentArray as $item){
		if($item['shortcode']=='accordition_item'){
			$accordionitemid = 'accordition_item_'.createRandomKey(5);
			$collapsein = (isset($item['attr']['show']) && $item['attr']['show']=='true')?'in':'';
			$active = (isset($item['attr']['show']) && $item['attr']['show']=='true')?'active':'';
			$re .= '<div class="panel panel-default '.$active.'">';
			$re .= '<div class="panel-heading">';
			$re .= '<h4 class="panel-title">';
			$re .= '<a class="jsaction" data-toggle="collapse" data-parent="#'.$accordionid.'" href="#'.$accordionitemid.'">';
			$re .= $item['attr']['title'];
			$re .= '</a>';
			$re .= '</h4>';
			$re .= '<div class="tab-toggle"></div>';
			$re .= '</div>';
			$re .= '<div id="'.$accordionitemid.'" class="panel-collapse collapse '.$collapsein.'">';
			$re .= '<div class="panel-body">'.$item['content'].'</div>';
			$re .= '</div>';
			$re .= '</div>';
		}
	}
	$re .= '</div><!-- .panel-group -->'."\n";
	return $re;
}
add_shortcode('accordition_item', 'sh_return_empty');
function sh_return_empty($attr, $content = null){ return '';}



add_shortcode('tab', 'sh_tab');
function sh_tab($attr, $content = null){
	$tabid = 'tab_'.createRandomKey(5);
	$tabnav = '<ul class="nav nav-tabs" id="'.$tabid.'">';
	$tabcontent = '<div class="tab-content">';
	$contentArray = rb_sh2array($content);
	foreach($contentArray as $item){
		if($item['shortcode']=='tab_item'){
			$tabitemid = 'tab_item_'.createRandomKey(5);
			$activetab = (isset($item['attr']['show']) && $item['attr']['show']=='true')?'in active':'';
			$activenav = (isset($item['attr']['show']) && $item['attr']['show']=='true')?' class="active"':'';
			$tabnav .= '<li'.$activenav.'><a class="jsaction" href="#'.$tabitemid.'" data-toggle="tab">'.$item['attr']['title'].'</a></li>';
			$tabcontent .= '<div class="tab-pane fade '.$activetab.'" id="'.$tabitemid.'">'.$item['content'].'</div>';
		}
	}
	$tabnav .= '</ul>';
	$tabcontent .= '</div>';
	return $tabnav.$tabcontent;
}
add_shortcode('tab_item', 'sh_return_empty');


add_shortcode('testimonial', 'sh_testimonial');
function sh_testimonial($attr, $content = null){
	$re = '';
	$re .= '<div class="Owl-Slider-Sub-None text-center speacing-box '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>';
	$contentArray = rb_sh2array($content);
	foreach($contentArray as $item){
		if($item['shortcode']=='testimonial_item'){
			$re .= '<div class="item"><figure>';

			$re .= '<div class="thumbnail-images">';
			$re .= '<span class="fa fa-2x fa-angle-left mouse-pointer testimonials-arrow hover-font-color"></span>';
			if(isset($item['attr']['image']))
				$re .= '<img src="'.$item['attr']['image'].'" alt="customer">';
			$re .= '<span class="fa fa-2x fa-angle-right mouse-pointer testimonials-arrow hover-font-color"></span>';
			$re .= '</div>';

			$re .= '<figcaption>';
			if(isset($item['attr']['owner']))
				$re .= '<h2 class=" font-color">'.$item['attr']['owner'].'</h2>';

			if(isset($item['attr']['title']))
				$re .= '<p>'.$item['attr']['title'].'</p>';

			if(!empty($item['content'])){
				$re .= '<p class="text-center message-testimonials"><span class="fa fa-quote-left font-color"></span>';
				$itemContent = strip_tags($item['content']);
				$re .= rb_clean_spaces($itemContent);
				$re .= '<span class="fa fa-quote-right font-color"></span></p>';
			}
			$re .= '</figcaption>';
			$re .= '</figure></div>';
		}
	}
	$re .= '</div>';
	return $re;
}
add_shortcode('testimonial_item', 'sh_return_empty');


add_shortcode('icon', 'sh_icon');
function sh_icon($attr, $content = null){
	extract( shortcode_atts( array(
		'size' => '',
		'name' => '',
		'type' => '',
		'highlight' => '',
	), $attr ) );

	if(!empty($type)) $type = 'fa-'.$type;
	if(!empty($size)) $type = 'fa-'.$size;
	if(!empty($highlight)) $highlight = 'highlight';

	return '<i class="fa fa-'.$attr['name'].' '.$size.' '.$type.' '.$highlight.'"></i>';
}



// Addition Slope Shortcodes

add_shortcode('service-item', 'sh_service_item');
function sh_service_item($attr, $content=null){
	extract( shortcode_atts( array(
		'title' => '',
		'link' => '',
		'image' => ''
	), $attr ) );
	$re = '<div class="services text-center">';

	$link = (empty($link))?'javascript:void(0);':$link;
	if(!empty($title))
		$re .= '<h5 class="text-center">'.$title.'</h5>';
	if(!empty($image)){
		$re .= '<a href="'.$link.'" class="animatedImage2">';
		$re .= '<img src="'.$image.'" width="174" height="177" alt="'.$title.'" >';
		$re .= '</a>';
	}
	$re .= '<div class="bottomdivider"></div>';
	if(isset($content) && !empty($content))
		$re .= '<p class="text-left">'.$content.'</p>';
	$re .= '</div> <!-- .service -->';
	return $re;
}

add_shortcode('price-table-item', 'sh_price_table_item');
function sh_price_table_item($attr, $content=null){
	extract( shortcode_atts( array(
		'header' => '',
		'price' => '',
		'price_text' => '',
		'action'=>'',
		'action_link'=>'',
	), $attr ) );
	$re = '<div class="pricetable text-center">';
	$re .= '<div class="pricetable-container">';

	if(!empty($header))
		$re .= '<div class="pt-header">'.$header.'</div>';
	if(!empty($price)){
		$re .= '<div class="pt-price">'.$price;
		$re .= (!empty($price_text))?'<span>'.$price_text.'</span>':'';
		$re .= '</div>';
	}
	$re .= do_shortcode($content);
	if(!empty($action)){
		if(!empty($action_link))
			$action = '<a href="'.$action_link.'">'.$action.'</a>';
		$re .= '<div class="pt-action">'.$action.'</a></div>';
	}
	$re .= '</div> <!-- .pricetable-container -->';
	$re .= '</div> <!-- .pricetable -->';
	return $re;
}
add_shortcode('price-table-row', 'sh_price_table_row');
function sh_price_table_row($attr, $content=null){
	extract( shortcode_atts( array(
		'title' => ''
	), $attr ) );
	return  '<div class="pt-row">'.$title.'</div>';
}

add_shortcode('rb_single_page', 'sh_rb_single_page');
function sh_rb_single_page($attr, $content=null){
	extract( shortcode_atts( array(
		'slider' => '',
	), $attr ) );
	$re = '';
	$re .= do_shortcode($content);
	return $re;
}
add_shortcode('rb_page', 'sh_rb_page');
function sh_rb_page($attr, $content=null){
	extract( shortcode_atts( array(
		'slug' => '',
		'id'=>'',
		'type'=>'boxed',
		'bgimage' => '',
		'parallaxspeed' => '',
		'bgcolor'=>'',
		'pattern'=>'false',
	), $attr ) );
	$re = '';

	if(!empty($id) || !empty($slug)){
		$page_content = '';
		if(!empty($slug)){
			global $wpdb;
			$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$slug."'AND post_type = 'page'");
		}
		if(!empty($id)){
			$page = get_post( $id );
		}
		if(isset($page)){
			$pageContent = apply_filters('the_content', $page->post_content );
			$pageContent = rb_clean_spaces($pageContent);
			$addionalClass = '';
			$pbg = '';

			if(!empty($bgcolor) ){
				if($bgcolor!='firstcolor'){
					$pbg .= ' data-bgcolor="'.$bgcolor.'" ';
					$addionalClass .= 'colorbg ';
				}else{
					$addionalClass .= 'firstcolor ';
				}
			}

			$bgtype = '';
			if($type=='boxedfullbgparallax')
				$bgtype = 'parallax-background';
			elseif(!empty($bgimage))
				$bgtype = 'normal-background';


			if(!empty($bgimage))
				$pbg .= ' data-background="'.$bgimage.'" ';
			if($bgtype=='parallax-background' && !empty($parallaxspeed) )
				$pbg .= ' data-parallaxspeed="'.$parallaxspeed.'" ';


			$addionalClass.= ' '.$bgtype;

			if($type=='boxedfullbg' || $type=='boxedfullbgparallax'){


				$re .= '<section id="'.$page->post_name.'" class="'.$addionalClass.'" '.$pbg.' >';
				$re .= '<article class="sub-box">';
				if($pattern=='true')
					$re .= '<div class="pattern-overlay"></div>';
				$re .= '<div class="around-white speacing-box container text-center effect-waypoint">
					'. $pageContent .'
				</div>
				</article>';
				$re .= '</section>';
			}elseif($type=='fullwidth'){
				$re .= '<section id="'.$page->post_name.'" class="'.$addionalClass.' content-white" '.$pbg.'>';
				$re .= '<article class="speacing-box effect-waypoint">'. $pageContent .'</article>';
				$re .= '</section>';
			}else{
				$re .= '<section id="'.$page->post_name.'" class="'.$addionalClass.' content-white" '.$pbg.'>';
				$re .=  '<article class="container speacing-box effect-waypoint">'. $pageContent .'</article>';
				$re .= '</section>';
			}

		}else{
			// no content
		}
	}
	return $re;
}

// Additional Federal Theme Shortcodes
add_shortcode('page_header', 'sh_page_header');
function sh_page_header($attr, $content=null){
	extract( shortcode_atts( array(
		'subtext' => '',
	), $attr ) );
	$re = '';
	$re .= '<header>';
	if(!empty($content))
		$re .= '<div class="heading text-center '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).'>
			<h2>'.do_shortcode($content).'</h2>
		</div>';
	if(!empty($subtext))
		$re .= '<p class="text-center head-sub">'.$subtext.'</p>';

	$re .= '</header>';
	return $re;
}

add_shortcode('hi_icon', 'sh_hi_icon');
function sh_hi_icon($attr, $content=null){
	extract( shortcode_atts( array(
		'icon' => '',
		'link' => '',
		'subtext' => '',
	), $attr ) );
	$re = '';
	if(empty($link)) $link = 'javascript:void(0);';
	if(!empty($icon)){
		$re .= '<div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a">';
		$re .= '<a href="'.$link.'" class="hi-icon fa fa-'.$icon.'"></a>';
		if(!empty($subtext))
			$re .= '<h3>'.$subtext.'</h3>';
		$re .= '</div>';
	}
	return $re;
}

add_shortcode('icon_text', 'sh_icon_text');
function sh_icon_text($attr, $content=null){
	extract( shortcode_atts( array(
		'icon' => '',
		'title' => '',
		'link' => '#',
	), $attr ) );
	$re = '';
	$re .= '<div class="box-services text-center">';
	if(!empty($icon))
		$re .= '<div class="thumbnail-services"><i class="fa fa-3x fa-'.$icon.'"></i></div>';
	if(!empty($title))
		$re .= '<h4 class="font-normal">'.$title.'</h4>';
	$re .= '<div class="clearfix"></div>';
	if(!empty($content))
		$re .= '<p>'.do_shortcode($content).'</p>';

	if(!empty($link))
		$re .= '<a href="'.$link.'">'.__('Read more...', 'rb').'</a>';
	$re .= '</div>';

	return $re;
}

add_shortcode('thumbnail_icon', 'sh_thumbnail_icon');
function sh_thumbnail_icon($attr, $content=null){
	extract( shortcode_atts( array(
		'icon' => '',
		'title' => '',
	), $attr ) );
	$re = '';
	$re .= '<div class="text-center">';
	$re .= '<div class="thumbnail-icon-about">';
	if(!empty($icon))
		$re .= '<i class="fa fa-'.$icon.'"></i>';
	if(!empty($title))
		$re .= '<h3 class="box-speacing-type-min">'.$title.'</h3>';
	if(!empty($content))
		$re .= '<p>'.$content.'</p>';
	$re .= '</div>';
	$re .= '</div>';
	return $re;
}

add_shortcode('pin_contact', 'sh_pin_contact');
function sh_pin_contact($attr, $content=null){
	extract( shortcode_atts( array(
		'icon' => '',
		'title' => '',
	), $attr ) );
	$re = '';
	$re .= '<div class="pin-contact">';
	if(!empty($icon)){
		$re .= '<div class="label">';
		$re .= '<span class="fa fa-'.$icon.'"></span>';
		$re .= '</div>';
	}
	$re .= '<div class="content">';
	if(!empty($title))
		$re .= '<h4>'.$title.'</h4>';

	$re .= '<p>'.$content.'</p>';
	$re .= '</div>';

	$re .= '</div>';
	return $re;
}


add_shortcode('circle_processbar', 'sh_circle_processbar');
function sh_circle_processbar($attr, $content=null){
	extract( shortcode_atts( array(
		'color' => '#00a8ff',
		'percent' => '50',
		'title' => '',
		'bgcolor' => '#d2d4d8',
	), $attr ) );
	$re = '';
	$re .= '
	<div class="processbar">
		<article class="chart ng-isolate-scope ng-scope"  data-color="'.$color.'" data-bgcolor="'.$bgcolor.'" data-percent="'.$percent.'">
			<div class="percents">
				<span class="percent">
				</span>
				%
			</div>
		</article>';
	if(!empty($title))
		$re .= '<h3 class="font-color">'.$title.'</h3>';
	$re .= '</div>';

	return $re;
}

/*
add_shortcode('person', 'sh_person');
function sh_person($attr, $content=null){
	extract( shortcode_atts( array(
		'skype' => '',
		'facebook'=> '',
		'dribble'=> '',
		'twitter'=> '',
		'linkedin'=> '',
		'youtube'=> '',
		'image'=>'',
		'name'=>'',
		'title'=>'',
	), $attr ) );
	$re = '';
	$themeurl = get_template_directory_uri();

	$re .= '<figure class="text-center ourteam-box"><div class="ourteam-box-thumbnail"><div class="option-social">';
	if(!empty($skype))
		$re .= '<a href="'.$skype.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/skype.png" class="number-1" alt="social"></a>';
	if(!empty($facebook))
		$re .= '<a href="'.$facebook.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/facebook.png" class="number-2" alt="social"></a>';
	if(!empty($dribble))
		$re .= '<a href="'.$dribble.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/dribble.png" class="number-3" alt="social"></a>';
	if(!empty($twitter))
		$re .= '<a href="'.$twitter.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/twitter.png" class="number-4" alt="social"></a>';
	if(!empty($linkedin))
		$re .= '<a href="'.$linkedin.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/linkedin.png" class="number-5" alt="social"></a>';
	if(!empty($youtube))
		$re .= '<a href="'.$youtube.'" target="_blank" ><img src="'.$themeurl.'/images/social-icon/small/youtube.png" class="number-6" alt="social"></a>';
	$re .= '</div> <!-- .option-social -->';

	if(!empty($image))
		$re .= '<div class="thumbnail-img-ourteam"><img src="'.$image.'" class="img-circle" alt="ourteam" draggable="false"></div>';
	$re .= '</div>';
	$re .= '<header>';
	if(!empty($name))
		$re .= '<h4 class="ourteam-name uppercase"><span class="ourteam-name font-hard">'.$name.'</span></h4>';
	if(!empty($title))
		$re .= '<h6 class="ourteam-position uppercase"><span class="ourteam-position font-gray">'.$title.'</span></h6>';
	$re .= '</header>';

	if(!empty($content))
		$re .= '<figcaption><span class="line-div small"></span><p class="ourteam-message">	'.$content.'</p></figcaption>';

	$re .= '</figure>';

	return $re;
} */

add_shortcode('person', 'sh_person');
function sh_person($attr, $content=null){
	extract( shortcode_atts( array(
		'facebook'=> '',
		'twitter'=> '',
		'googleplus'=> '',
		'image'=>'',
		'name'=>'',
		'title'=>'',
	), $attr ) );
	$re = '';
	$themeurl = get_template_directory_uri();

		$re .= '<figure class="text-center ourteam-box">';

		if(!empty($image))
				$re .= '<div class="thumbnail-img-hidden"><img src="'.$image.'" class="" alt="ourteam" draggable="false"></div>';

			$re .= '<div class="ourteam-box-thumbnail">';
				$re .= '<div class="ourteam-box-container">';

					$re .= '<header>';
					if(!empty($name))
						$re .= '<h4 class="ourteam-name uppercase"><span class="ourteam-name font-hard">'.$name.'</span></h4>';
					if(!empty($title))
						$re .= '<h6 class="ourteam-position uppercase"><span class="ourteam-position font-gray">'.$title.'</span></h6>';
					$re .= '</header>';

					if(!empty($content)){
						$re .= '<figcaption>';
						$re .= '<span class="line-div small"></span><p class="ourteam-message">	'.$content.'</p>';
						$re .= '</figcaption>';
					}

			$re .= '</div><!-- .ourteam-box-container -->';
		$re .= '</div><!-- .ourteam-box-thumbnail -->';

		$re .= '<div class="option-social">';
			if(!empty($facebook))
				$re .= '<a class="facebook" href="'.$facebook.'" target="_blank" ></a>';
			if(!empty($twitter))
				$re .= '<a class="twitter" href="'.$twitter.'" target="_blank" ></a>';
			if(!empty($googleplus))
				$re .= '<a class="googleplus" href="'.$googleplus.'" target="_blank" ></a>';
		$re .= '</div> <!-- .option-social -->';

		if(!empty($image))
				$re .= '<div class="thumbnail-img-ourteam"><img src="'.$image.'" class="" alt="ourteam" draggable="false"></div>';

	$re .= '</figure>';

	return $re;
}

add_shortcode('brands', 'sh_brands');
function sh_brands($attr, $content=null){
	extract( shortcode_atts( array(
		'columns' => 4
	), $attr ) );
	$re = '';

	$aniclass = rb_get_extra_el_class($attr);

	$re .= '<section class="speacing-box">';
	$contentArray = rb_sh2array($content);
	$i = 0;
	foreach($contentArray as $item){
		if($item['shortcode']=='brands_item'){

			$i++;
			$extra_class = ($i>$columns)?' not-first-row ':'';
			$extra_class .= ($i%$columns==0)?' last-col ':'';
			if($i%$columns==1) // begin row
				$re .= '<div class="row">';
			$re .= '<div class="col-md-'.((int) 12/$columns).' BRANDS '.$extra_class.' '.$aniclass.'" '. ( (!empty($aniclass))?'data-wow-delay="'.($i*0.3).'s"':'' ).'>';
			if(isset($item['attr']['image'])){
				$alt = '';
				if( isset($item['attr']['title']) ) $alt = $item['attr']['title'];
				$re .= '<img src="'.$item['attr']['image'].'" alt="'.$alt.'">';
			}
			$re .= '</div>';

			if($i%$columns==0) // end row
				$re .= '</div>';
		}
	}
	$re .= '</section>';
	return $re;
}
add_shortcode('brands_item', 'sh_return_empty');

add_shortcode('score', 'sh_score');
function sh_score($attr, $content=null){
	extract( shortcode_atts( array(
		'value' => '',
		'title' => '',
	), $attr ) );
	$re = '';

	$re .= '<div class="about-score text-center">';
	if(!empty($value))
		$re .= '<h3>'.$value.'</h3>';
	if(!empty($title))
		$re .= '<h4>'.$title.'</h4>';
	$re .= '</div>';
	return $re;
}

add_shortcode('twitter_feeds', 'sh_twitter_feeds');
function sh_twitter_feeds($attr, $content=null){
	extract( shortcode_atts( array(
		'user' => '',
		'limit' => 6,
	), $attr ) );
	$re = '';

	$re .= '<div class="twitter_feeds_el '.rb_get_extra_el_class($attr).'" '.rb_get_extra_el_attr($attr).' >';
		$re .= '<div class="speacing-box text-center"><a href="#"><img class="border-white" src="'. get_template_directory_uri().'/images/social-icon/twitter.png" alt="social"></a></div>';

		$re .= '<div class="container text-center">';
			$re .= '<div class="Owl-Slider-Twitter rb-twitter-feed" data-user="'.$user.'" data-limit="'.$limit.'">';
			$re .= '</div>';
		$re .= '</div>';
	$re .= '</div>';
	return $re;
}

add_shortcode('flexslider', 'sh_flexslider');
function sh_flexslider($attr, $content=null){
	extract( shortcode_atts( array(
		'id' => '',
		'thumbnails' => 'true',
	), $attr ) );
	$re = '';

	$rb_gallery_post = get_post($id);
	if($rb_gallery_post){
		$cimg = '';

		$re .= '<div class="slider_flexslider">';
		$re .= '<ul class="slides">';

		$rb_gallery_content = $rb_gallery_post->post_content;
		$rb_gallery_array = rb_sh2array($rb_gallery_content);
		if($rb_gallery_array[0]['shortcode']=='rb_gallery')
		{
			foreach($rb_gallery_array[0]['content'] as $item)
			{
				if($item['shortcode']=='rb_gallery_item'){
					$attr =$item['attr'];
					if($attr['type']=='image'){
						$re .= '<li>';
						$re .= '<img src="'.$attr['thumbnail'].'" >';
						$re .= '</li>';
					}elseif($attr['type']=='video'){
						$video_type = rb_getMediaType($attr['url']);
						$video_id = rb_getParamsFromUrl($attr['url']);

						if($video_type=='vimeo'){
							$re .=  '<li>';
							if($height==0)
								$re .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=7d7d7d" width="'.$attr['width'].'" height="'.$attr['height'].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
							else
								$re .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=7d7d7d" width="100%" height="100%" frameborder="0" class="noVideoFit" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
							$re .= '</li>';
						}elseif($video_type=='youtube'){
							$re .=  '<li><div '.$heightAddDiv.'>';
							if($height==0)
								$re .= '<iframe width="'.$attr['width'].'" height="'.$attr['height'].'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent&amp;rel=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>';
							else
								$re .= '<iframe width="100%" height="100%" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent&amp;rel=0" frameborder="0" class="noVideoFit" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>';
							$re .= '</li>';
						}elseif($video_type=='embedplayer')
							$re .= '<li>'.stripslashes($video_id).'</li>';
					}

					// carousel images
					$cimg .= '<li>';
					$cimg .= '<img src="'.$attr['thumbnail'].'" >';
					$cimg .= '</li>';
				}
			}
		}

		$re .= '</ul>';
		$re .= '</div>';

		if($thumbnails=='true'){
			$re .= '<div class="carousel_flexslider">';
			$re .= '<ul class="slides">';
			$re .= $cimg;
			$re .= '</ul>';
			$re .= '</div>';
		}
	}

	return $re;
}

add_shortcode('highlight2', 'sh_highlight2');
function sh_highlight2($attr, $content=null){
	return '<span class="font-white">'.$content.'</span>';
}

add_shortcode('rainy', 'sh_rainy');
function sh_rainy($attr, $content=null){
	extract( shortcode_atts( array(
		'image' => '',
		'pattern' => 'true',
	), $attr ) );
	$re = '';

	if($pattern=='true')
		$re .= '<div class="pattern-overlay1"></div>';
	$re .= '<div class="rainy-wrapper">';
	$re .= '<img class="rainy-background" src="" data-src="'.$image.'" />';
	$re .= '</div>';

	return $re;
}

add_shortcode('video-parallax', 'sh_video_parallax');
function sh_video_parallax($attr, $content=null){
	extract( shortcode_atts( array(
		'name' => '',
		'video' => '',
		'showcontrols'=>'true',
		'autoplay' => 'true',
		'loop' => 'true',
		'mute' => 'true',
		'showbg' => 'true',
		'soundcontrol' => 'true',
	), $attr ) );
	$re = '';

	$re .= '<div class="video-parallax">';
	$re .= '<div id="bgndVideo" class="player" data-property="{videoURL:\''.$video.'\', containment:\'body\', showControls:'.$showcontrols.', autoPlay:'.$autoplay.', loop:'.$loop.', mute:'.$mute.', startAt:0, opacity:1, addRaster:false, quality:\'default\'}">'.$name.'</div>';
	$re .= '</div>';
	if($showbg=='true')
		$re .= '<div class="wrapper-black"></div>';
	if($soundcontrol=='true')
		$re .= '<div class="control-sound"><img src="'.get_template_directory_uri().'/images/mute.png" class="mute" alt="mute"></div>';
	return $re;
}

add_shortcode('owl-slider', 'sh_owl_slider');
function sh_owl_slider($attr, $content=null){
	$re = '';
	$re .= '<article class="Owl-Slider">';
	$re .= do_shortcode($content);
	$re .= '</article>';
	return $re;
}

add_shortcode('owl-item', 'sh_owl_item');
function sh_owl_item($attr, $content=null){
	extract( shortcode_atts( array(
		'header' => '',
	), $attr ) );
	$re  = '';
	$re .= '<div class="item header-slide"><div class="content text-center"><div class="container"><div class="row"><div class="col-lg-12 font-color">';
	if(!empty($header))
		$re .= '<h1 class="box-speacing-type-min font-white">'.$header.'</h1>';
	$re .= do_shortcode($content);
	$re .= '</div></div></div></div></div>';
	return $re;
}

add_shortcode('owl-item-button', 'sh_owl_item_button');
function sh_owl_item_button($attr, $content=null){
	extract( shortcode_atts( array(
		'link' => '',
		'target' => '',
	), $attr ) );

	$link = (empty($link))?'javascript:void(0);':$link;
	$target = (empty($target))?'_self':$target;

	$re = '';
	$re = '<div class="box-speacing-type-min"><a href="'.$link.'" class="button-q">'.$content.'</a></div>';
	return $re;
}

add_shortcode('vspace', 'sh_vspace');
function sh_vspace($attr, $content = null){
		extract( shortcode_atts( array(
		'height' => '20px',
	), $attr ) );
	return '<div class="vspace" data-vspace="'.$height.'"></div>';
}

// Replace Default Gallery Shortcode
remove_shortcode('gallery');
add_shortcode('gallery', 'parse_gallery_shortcode');
function parse_gallery_shortcode($atts) {

    global $post;
	$re = '';
    if ( ! empty( $atts['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $atts['orderby'] ) )
            $atts['orderby'] = 'post__in';
        $atts['include'] = $atts['ids'];
    }

    extract(shortcode_atts(array(
        'orderby' => 'menu_order ASC, ID ASC',
        'include' => '',
        'id' => $post->ID,
        'itemtag' => 'div',
        'icontag' => 'div',
        'captiontag' => 'div',
        'columns' => 3,
        'size' => 'medium',
        'link' => 'file'
    ), $atts));


    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'orderby' => $orderby
    );

    if ( !empty($include) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }

    $images = get_posts($args);

	$re .= '<div class="rb-wp-gallery" data-col-count="'.$columns.'">'; // begin gallery
	$itemno = 0;
    foreach ( $images as $image ) {
        $caption = trim($image->post_excerpt);

        $description = $image->post_content;
        if($description == '') $description = $image->post_title;

        $image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
		$imgtag = wp_get_attachment_image($image->ID, $size, false,
			array(
				'class'	=>"rb-wp-gallery-image img-responsive attachment-$size",
				'alt'	=> trim(strip_tags( $image_alt ))
			)
		);
		$imgtag = preg_replace( '/(width|height)=\"\d*\"\s/', "", $imgtag );

		$re .= '<div class="rb-wp-gallery-item-container">'; // begin col

        $re .= "<{$itemtag} class='rb-wp-gallery-item'>";
        $re .= "<{$icontag} class='rb-wp-gallery-icon'>";
			if($link=='file')
				$re .= '<a href="'.get_attachment_link($image->ID).'" data-mfp-src="'.wp_get_attachment_url($image->ID).'" data-title="'.trim(strip_tags($caption)).'">';
			$re .= $imgtag;

			if(!empty($caption))
				$re .= "<{$captiontag} class='rb-wp-gallery-caption'>".$caption."</{$captiontag}>";

			if($link=='file')
				$re .= '</a>';

		$re .= "</{$icontag}>";
		$re .= "</{$itemtag}>";

		$re .= '</div>'; // end col;

		$itemno++;
    }
	$re .= '</div>'; // end gallery

	return $re;
}
?>
