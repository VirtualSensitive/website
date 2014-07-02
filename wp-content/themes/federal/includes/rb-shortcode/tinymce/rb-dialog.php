<?php 
$rb_absolute_path = __FILE__;
$rb_path_to_file = explode( 'wp-content', $rb_absolute_path );
$rb_path_to_wp = $rb_path_to_file[0];

//Access WordPress
require_once( $rb_path_to_wp.'/wp-load.php' );

include '../shortcodeUsage.php';
include '../fontawesome.php';
include '../rb-shortcode-config.php';

$rb_title = '';
if(!empty($_REQUEST['code'])){
	$rb_codeName = trim($_REQUEST['code']);
}elseif(!empty($_REQUEST['content'])){
	$rb_contentArr = rb_sh2array(stripcslashes($_REQUEST['content']));
	if(is_array($rb_contentArr)){
		$rb_codeAttrs = $rb_contentArr[0]['attr'];
		$rb_codeContent = $rb_contentArr[0]['content'];
		$rb_codeName = trim($rb_contentArr[0]['shortcode']);
	}
}

$rb_title = $rb_shorcodesUsage[ $rb_codeName ]['label'];
                   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $rb_title; ?></title>
</head>
<body>
<div id="rb-dialog" data-codeparams="<?php echo rb_createJSData($rb_codeName); ?>" data-code="<?php echo $rb_codeName; ?>">
<div class="bscontainer">
	<?php echo rb_createShForm($rb_codeName); ?>
</div>
</div><!-- .rb-dialog -->
</body>
</html>
<?php
/* JS DATA */
function rb_createJSData($code){
	global $rb_shorcodesUsage;
	$re = '';
	if($rb_shorcodesUsage[$code]){
		$sh = $rb_shorcodesUsage[$code];
			$re .= htmlentities (json_encode($sh));
	}
	return $re;
}

/* FORM */
function rb_createShForm($code){
	global $rb_shorcodesUsage, $rb_codeContent;
	$re = '';
	if($rb_shorcodesUsage[$code]){
		$re .= '<form class="insertcode">';
		$sh = $rb_shorcodesUsage[$code];
		if(@is_array($sh['params'])){
			$params = $sh['params'];
			foreach($params as $param_name => $param){
				$re .= rb_getShParam($param_name, $param);
			}
		}
		$re .= '</form>';
	}
	
	if($rb_shorcodesUsage[$code]['content']=='html'){
		if(empty($rb_codeContent))
			$editor_content = '';
		else
			$editor_content = $rb_codeContent;
		$re .= '<div class="row rb-dialog-margin"><div class="col-md-12">'.rb_get_wp_editor('shcontent_'.$_REQUEST['dialogID'], $editor_content).'<div></div>';
	}elseif($rb_shorcodesUsage[$code]['content']=='shortcode'){
		if($rb_shorcodesUsage[$code]['contentType']=='orderlist'){
			$re .= '<div class="row rb-dialog-margin orderListWrapper"><div class="col-md-12">
			<button type="button" class="btn btn-primary addOrderListItem" data-shortcode="'.$rb_shorcodesUsage[$code]['contentShortCode'].'" data-shortcode-label="'.$rb_shorcodesUsage[$code]['contentShortCode'].'"><i class="fa fa-plus"></i></button> '.__('You can add item','rb').'
			<ul class="list-group">
			</ul>
			<div></div>';
		}
	}elseif($rb_shorcodesUsage[$code]['content']=='text'){
		$re .= '<div class="row rb-dialog-margin">';
		$re .= '<div class="col-md-6">';
		$re .= '<input type="text" class="form-control shcontentText">';
		$re .= '</div>';
		$re .= '<div class="col-md-6">';
		$re .= '<strong>'.__('Content', 'rb').'</strong>';
		$re .= '</div>';
		$re .= "</div><!-- .row -->";
	}elseif($rb_shorcodesUsage[$code]['content']=='textarea'){
		$re .= '<div class="row rb-dialog-margin">';
		$re .= '<div class="col-md-6">';
		$re .= '<textarea class="form-control shcontentTextarea"></textarea>';
		$re .= '</div>';
		$re .= '<div class="col-md-6">';
		$re .= '<strong>'.__('Content', 'rb').'</strong>';
		$re .= '</div>';
		$re .= "</div><!-- .row -->";
	}
	
	return $re;
}

function rb_getShParam($param_name, $param){
	$fullwidthTypes = array('iconname');
	$re = '<div class="row rb-dialog-margin">';
	if(!in_array($param['type'], $fullwidthTypes))
		$re .= '<div class="col-md-6">';
	else{
		$re .= '<div class="col-md-12">';
		$re .= rb_getShLabel($param_name, $param);
	}
	switch($param['type']){
		case 'text': 
			$re .= rb_getShTextParam($param_name, $param);
			break;
		case 'color': 
			$re .= rb_getShColorParam($param_name, $param);
			break;
		case 'select': 
			$re .= rb_getShSelectParam($param_name, $param);
			break;
		case 'listcreator': 
			$re .= rb_getShListCreatorParam($param_name, $param);
			break;
		case 'group': 
			$re .= rb_getShGroupParam($param_name, $param);
			break;
		case 'gallerylist': 
			$re .= rb_getShGalleryListParam($param_name, $param);
			break;
		case 'pagelist': 
			$re .= rb_getShPageListParam($param_name, $param);
			break;
		case 'singleimage': 
			$re .= rb_getShSingleImageParam($param_name, $param);
			break;
		case 'iconname': 
			$re .= rb_getShIconParam($param_name, $param, 'name');
			break;
	}
	if(!in_array($param['type'], $fullwidthTypes)){
		$re .= '</div>';
		$re .= '<div class="col-md-6">'. rb_getShLabel($param_name, $param).'</div>';
	}else
		$re .= '</div>';
	$re .= "</div><!-- .row -->";
	return $re;
}

function rb_getShLabel($param_name, $param){
	$re = '';
	if(!empty($param['label']))
		$re .= '<strong>'.$param['label'].'</strong>';
	if(!empty($param['help']))
		$re .= '<br>'.$param['help'];
	return $re;
}

function rb_getShTextParam($param_name, $param){
	$default = rb_getDefaultValue($param_name, $param);
	$placeholder = '';
	if(isset($param['placeholder']))
		$placeholder = (!empty($param['placeholder']))?$param['placeholder']:'';
	elseif(isset($param['label']))
		$placeholder = $param['label'];
	$validation = rb_getValidationParams($param);
	return '<input type="text" class="form-control" name="'.$param_name.'" placeholder="'.$placeholder.'" value="'.$default.'" '.$validation.'>';
}

function rb_getShColorParam($param_name, $param){
	$default = rb_getDefaultValue($param_name, $param);
	$validation = rb_getValidationParams($param);
	return '<input type="text" class="form-control colorPickerField" name="'.$param_name.'" value="'.$default.'" '.$validation.' >';
}

function rb_getShSelectParam($param_name, $param){
	$default = rb_getDefaultValue($param_name, $param);
	$re = '';		
	$re .= '<select class="form-control" name="'.$param_name.'">';
	$re .= '<option value="">'.__('Choose an option', 'rb').'</option>';
	if(isset($param['sequential'])){
		for($i=$param['sequential'][0]; $i<=$param['sequential'][1]; $i+=$param['sequential'][2]){
			$re .= '<option value="'.$i.'" '.(($i==$default)?'selected':'').'>'.$i.'</option>';
		}
	}elseif(isset($param['values'])){
		if(rb_is_associative_array($param['values'])){
			foreach($param['values'] as $k => $v){
				$re .= '<option value="'.$v.'" '.(($v==$default)?'selected':'').'>'.$k.'</option>';
			}
		}else{
			foreach($param['values'] as $v){
				$re .= '<option class="classic" value="'.$v.'" >'.$v.'</option>';
			}
		}
	}
	$re .= '</select>';
	return $re;
}

function rb_getShListCreatorParam($param_name, $param){
	$default = rb_getDefaultValue($param_name, $param);
	$re = '<div class="listcreator">';
	$re .= '<div class="row">
			<div class="col-xs-9">';		
	$re .= '<select class="sourcebox form-control input-sm" name="'.$param_name.'_values">';
	if(isset($param['values'])){
		if(rb_is_associative_array($param['values'])){
			
			foreach($param['values'] as $k => $v){
				$re .= '<option value="'.$v.'" >'.$k.'</option>';
			}
		}else{
			//
		}
	}elseif(isset($param['function'])){
		$values = call_user_func('rb_value_function_'.$param['function']);
		foreach($values as $k => $v){
			$re .= '<option value="'.$v.'" >'.$k.'</option>';
		}
	}
	$re .= '</select>';
	$re .= '</div>';
	$re .= '<div class="col-xs-3">';
	$re .= '<button type="button" class="btn btn-success btn-block btn-sm addlistcreator">'.__('Add', 'rb').'</button>';
	$re .= '</div></div>';
	
	$re .= '<select multiple class="targetbox form-control input-sm" name="'.$param_name.'">';
	if(!empty($default)){
		$defValues = explode(',', $default);
		foreach($defValues as $def){
			$def = trim($def);
			if(!empty($def)){
				$def_name = rb_getDefNameFromArray($param['values'], $def);
				$def_name = (!empty($def_name))?$def_name:$def;
				$re .= '<option value="'.$def.'" >'.$def_name.'</option>';
			}
		}
	}
	$re .= '</select>';
	$re .= '<button type="button" class="btn btn-warning btn-sm removelistcreator">'.__('Remove', 'rb').'</button>';
	$re .= '<button type="button" class="btn btn-danger btn-sm removealllistcreator">'.__('Remove All', 'rb').'</button>';
	$re .= '</div><!-- .listcreator -->';
	return $re;
}
function rb_getDefNameFromArray($arr, $val){
	foreach($arr as $kk => $vv){
		if($vv==$val)
			return $kk;
	}
	return '';
}
function rb_value_function_blog_categories(){
	$catResults = get_terms( 'category', array(
		'orderby'    => 'count',
		'hide_empty' => 0
	));
	$values = array();
	foreach($catResults as $cat)
		$values['('.$cat->count.') '.$cat->name] = $cat->term_id;
	return $values;
}
function rb_value_function_portfolio_categories(){
	$catResults = get_terms( 'rb-portfolio-categories', array(
		'orderby'    => 'count',
		'hide_empty' => 0
	));
	$values = array();
	foreach($catResults as $cat)
		$values[$cat->name.' ('.$cat->count.')'] = $cat->term_id;
	return $values;
}
function rb_value_function_project_categories(){
	$catResults = get_terms( 'rb-project-categories', array(
		'orderby'    => 'count',
		'hide_empty' => 0
	));
	$values = array();
	foreach($catResults as $cat)
		$values[$cat->name.' ('.$cat->count.')'] = $cat->term_id;
	return $values;
}

function rb_getShGroupParam($param_name, $param){
	$default = rb_getDefaultValue($param_name, $param);
	
	$re = '';
	$re .= '<div class="btn-group" data-toggle="buttons">';
	if(rb_is_associative_array($param['values'])){
		foreach($param['values'] as $k => $v){
			$re .= '<label class="btn btn-primary '.(($v==$default)?'active':'').'">';
			$re .= '<input type="radio" name="'.$param_name.'" value="'.$v.'" '.(($v==$default)?'checked':'').'>'. $k;
			$re .= '</label>';
		}
	}
	$re .= '</div>';
	return $re;
}

function rb_getShSingleImageParam($param_name, $param){
	global $RbShortcodePluginUrl;
	$re = '';
	$default = rb_getDefaultValue($param_name, $param);
	$validation = rb_getValidationParams($param);
	$re .= '<div class="singleimage">';
	$re .= '<input type="hidden" name="'.$param_name.'" value="" '.$validation.'>';
	$re .= '<img class="img-responsive" src="'.$RbShortcodePluginUrl.'/img/noimage.jpg" style="margin-bottom:20px;">';
	$re .= '<button type="button" class="btn btn-primary singleimagechoose">'.__('Choose a Photo', 'rb').'</button>';
	$re .= '</div>';
	return $re;
}

function rb_getDefaultValue($param_name, $param){
	global $rb_codeAttrs;
	if(!empty($rb_codeAttrs[$param_name]))
		$default = $rb_codeAttrs[$param_name];
	else
		$default = (!empty($param['default']))?$param['default']:'';
	return $default;
}

function rb_getShGalleryListParam($param_name, $param){
	global $wpdb;
	$default = rb_getDefaultValue($param_name, $param);
	$re = '';
	$re .= '<select class="form-control" name="'. $param_name . '" >';
	$galleryPostsQuery = "
	SELECT *
	FROM $wpdb->posts
	WHERE $wpdb->posts.post_type = 'rb-gallery'
	AND $wpdb->posts.post_status = 'publish'
	ORDER BY $wpdb->posts.post_date DESC
	";
	$galleryPosts = $wpdb->get_results($galleryPostsQuery, OBJECT);
	if ($galleryPosts) {
		foreach ($galleryPosts as $postdata) {
			$re.= '<option value="'.$postdata->ID.'" '. ( $default == $postdata->ID ? ' selected="selected"' : '' ) . '>'. $postdata->post_title .'</option>';
		}
	}
	$re .= '</select>';
	return $re;
}

function rb_getShPageListParam($param_name, $param){
	global $wpdb;
	$default = rb_getDefaultValue($param_name, $param);
	$re = '';
	$re .= '<select class="form-control" name="'. $param_name . '" >';
	$pagesQuery = "
	SELECT *
	FROM $wpdb->posts
	WHERE $wpdb->posts.post_type = 'page'
	AND $wpdb->posts.post_status = 'publish'
	ORDER BY $wpdb->posts.post_date DESC
	";
	$pages = $wpdb->get_results($pagesQuery, OBJECT);
	if ($pages) {
		foreach ($pages as $page) {
			$re.= '<option value="'.$page->post_name.'" '. ( $default == $page->post_name ? ' selected="selected"' : '' ) . '>'. $page->post_title .'</option>';
		}
	}
	$re .= '</select>';
	return $re;
}

function rb_getShIconParam($param_name, $param, $type){
	global $rb_fontawesomeIcons;
	$default = rb_getDefaultValue($param_name, $param);
	$validation = rb_getValidationParams($param);
	$re  = '<div class="iconlistwrapper">';
	$re .= '<input type="hidden" name="'.$param_name.'" value="'.$default.'" '.$validation.'>';
	$re .= '<div class="iconlist" data-type="'.$type.'">';
	foreach($rb_fontawesomeIcons as $iconname => $iconcode){
		if($type == 'name')
			$selected = ($default==$iconname)?'class="selected"':'';
		else
			$selected = ($default==$iconcode)?'class="selected"':'';
		$re .= '<span '.$selected.' data-name="'.$iconname.'" data-code="'.$iconcode.'"><i class="fa fa-'.$iconname.' fa-lg"></i></span>';
	}
	$re .= '</div>';
	$re .= '</div>';
	return $re;
}

function rb_is_associative_array($array) {
    return (is_array($array) && !is_numeric(implode("", array_keys($array))));
}

function rb_get_wp_editor($editor_id, $editor_content){
	ob_start();
	wp_editor($editor_content, $editor_id, array('editor_class'=>'rb-tinymce'));
	$re = ob_get_clean();
	return $re;
}

function rb_getValidationParams($param){
	$re = '';
	if(!empty($param['validation'])){
		$re .= 'data-validation="'.$param['validation'].'"';
		$re .= (!empty($param['validationAllowing']))?' data-validation-allowing="'.$param['validationAllowing'].'"':'';
		$re .= (!empty($param['validationOptional']))?' data-validation-optional="'.$param['validationOptional'].'"':'';
		$re .= (!empty($param['validationIfChecked']))?' data-validation-if-checked="'.$param['validationIfChecked'].'"':'';
	}
	return $re;
}
?>
