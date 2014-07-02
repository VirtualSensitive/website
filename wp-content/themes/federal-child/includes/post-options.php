<?php
// custom categories for portfolio post types
function rb_add_custom_taxonomies_portfolio() {
	register_taxonomy('rb-portfolio-categories', 'rb-portfolio', array(
		'labels' => array(
			'name' => __('Portfolio Categories', 'rb'),
			'singular_name' => __('Portfolio Category', 'rb'),
			'search_items' =>  __( 'Search Portfolio Categories', 'rb' ),
			'all_items' => __( 'All Portfolio Categories', 'rb' ),
			'parent_item' => __( 'Parent Portfolio Category', 'rb' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'rb' ),
			'edit_item' => __( 'Edit Portfolio Category', 'rb' ),
			'update_item' => __( 'Update Portfolio Category', 'rb' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'rb' ),
			'new_item_name' => __( 'New Portfolio Category', 'rb' ),
			'menu_name' => __( 'Portfolio Categories', 'rb' ),
		),
		'rewrite' => array(
			'slug' => 'portfolio-category',
			'with_front' => false, 
		),
		'hierarchical' => true
	));
}

// portfolio post type
function rb_create_portfolio_post_type() {
	register_post_type( 'rb-portfolio',
		array(
			'labels' => array(
				'name' => __('Portfolios','rb'),
				'singular_name' => __('Portfolios', 'rb'),
				'add_new' => __('Add Portfolio Item', 'rb'),
				'edit_item' => __('Edit Portfolio Item', 'rb'),
				'new_item' => __('New Portfolio Item', 'rb'),
				'view_item' => __('View Portfolio Item', 'rb'),
				'search_items' => __('Search Portfolio Item', 'rb'),
				'not_found' => __('Not found any portfolio item.', 'rb'),
				'not_found_in_trash' => __('Not found any portfolio item in trash', 'rb')
			),
			'public' => true,
			'supports' => array(
				'editor',
				'title',
				'excerpt',
				'custom-fields',
				'thumbnail',
				'post-formats'
				),
			'has_archive' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'portfolio'),
			'taxonomies' => array('rb-portfolio-categories'),
			'menu_position' => 6
		)
	);
}



// Portfolio Post Formats
function rb_postformatPortfolio()
{
    $post_ID = (int) @$_GET['post'];
    $postType = get_post_type( $post_ID );
	
    if( @$_GET['post_type']=='rb-portfolio' || $postType == 'rb-portfolio' )
    {
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'video' ) );
        add_post_type_support( 'portfolio', 'post-formats' );
    }
}

$Rb_meta_box[] = array(
	'id' => 'post_meta_image',
	'title' => __('Large Size Image URL','rb'),
	'post_type' => array('post','rb-portfolio'),
	'post_format' => 'image',
	'func' => 'postMetaImage',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Lager Image URL','rb'),
			'desc' => __('(Optional) URL of the large image','rb'),
			'id' => 'rb_format_big_image_url', 
			'type' => 'imageuploadbutton',
			'default' => ''
			)
		)
);


$Rb_meta_box[] = array(
	'id' => 'post_meta_video',
	'title' => __('Video for The Post','rb'),
	'post_type' => array('post','rb-portfolio'),
	'post_format' => 'video',
	'func' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Video URL','rb'),
			'desc' => __('(Required) You can enter a url like youtube, vimeo or self hosted video file.','rb'),
			'id' => 'rb_format_video_url', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Video Width','rb'),
			'desc' => __('(Required) As an integer','rb'),
			'id' => 'rb_format_video_width', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Video Height','rb'),
			'desc' => __('(Required) As an integer','rb'),
			'id' => 'rb_format_video_height', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Poster Image URL','rb'),
			'desc' => __('(Optional) For self hosted video','rb'),
			'id' => 'rb_format_video_poster', 
			'type' => 'imageuploadbutton',
			'default' => ''
			)
		)
);

$Rb_meta_box[] = array(
	'id' => 'post_meta_audio',
	'title' => __('Audio for The Post','rb'),
	'post_type' => 'post',
	'post_format' => 'audio',
	'func' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Audio File URL or shortcode of SoundCloud','rb'),
			'desc' => __('(Required) You can enter a url of your file or sortcode of SoundCloud. Supported .aac, .m4a, .f4a, .ogg, .oga and .mp3','rb'),
			'id' => 'rb_format_audio_url', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Poster Image URL','rb'),
			'desc' => __('(Optional) For self hosted audio files','rb'),
			'id' => 'rb_format_audio_poster', 
			'type' => 'imageuploadbutton',
			'default' => ''
			)
		)
);

$Rb_meta_box[] = array(
	'id' => 'post_meta_gallery',
	'title' => __('Gallery for The Post','rb'),
	'post_type' => array('post','rb-portfolio'),
	'post_format' => 'gallery',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Gallery Name','rb'),
			'desc' => __('(Required)','rb'),
			'id' => 'rb_format_gallery_id', 
			'type' => 'galleryid',
			'default' => ''
			)
		)
);

//Meta Boxes for Portfolio Formats
$Rb_meta_box[] = array(
	'id' => 'portfolio_meta_general2',
	'title' => __('Portfolio Client and Link','rb'),
	'post_type' => array('rb-portfolio'),
	'post_format' => '',
	'func' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Client','rb'),
			'desc' => __('(Optional)','rb'),
			'id' => 'rb_format_portfolio_client', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Task','rb'),
			'desc' => __('(Optional)','rb'),
			'id' => 'rb_format_portfolio_task', 
			'type' => 'text',
			'default' => ''
			),
		array(
			'name' => __('Link','rb'),
			'desc' => __('(Optional)','rb'),
			'id' => 'rb_format_portfolio_plink', 
			'type' => 'text',
			'default' => ''
			),
		)
);

// Meta Creation Functions
function rb_generalMetaCreator($post, $metadata){
	$meta = rb_getPostMetaFromID($metadata['id']);
	rb_createMetaForm($meta);
}

function rb_postMetaGeneral(){
	global $post;
	
	$meta = rb_getPostMeta('rb_postMetaGeneral');
	?>
	<style>
	#cpositions{
		width:111px; 
		height:111px; 
		padding:3px; 
		border:1px solid #eee;
	}
	.cposition{
		display:block;
		float:left;
		margin-right:3px;
		margin-bottom:3px;
		width:33px; 
		height:33px; 
		border:1px solid #ddd;
	}
	.cpselected{
		border-color:#ff0000;
	}
	</style>
	
	
	<div style="width:50%; float:left;">
		<input type="checkbox" name="useInDetail" id="useInDetail" value="use"  <?php echo (get_post_meta( $post->ID,"useInDetail",true)=='use')?'checked':''; ?> /> 
		<?php _e('Show in Detail Page','rb'); ?>
	</div>
	<div style="clear:both;"></div>
	<?php
}

function rb_portfolioMetaGeneral(){
	global $post;
	
	$meta = rb_getPostMeta('rb_portfolioMetaGeneral');
	?>
	<style>
	#cpositions{
		width:111px; 
		height:111px; 
		padding:3px; 
		border:1px solid #eee;
	}
	.cposition{
		display:block;
		float:left;
		margin-right:3px;
		margin-bottom:3px;
		width:33px; 
		height:33px; 
		border:1px solid #ddd;
	}
	.cpselected{
		border-color:#ff0000;
	}
	</style>	
		<div style="width:50%; float:left;">
			<?php _e('Select a Crop Position','rb'); ?>
			<?php $cp = get_post_meta($post->ID,"cropPos",true); 
			switch($cp){
				case 'top,left'		: $cp = 'tl';	break;
				case 'top,center'	: $cp = 't'; 	break;
				case 'top,right'	: $cp = 'tr';	break;
				case 'center,left'	: $cp = 'l'; 	break;
				case 'center,right'	: $cp = 'r'; 	break;
				case 'bottom,left'	: $cp = 'bl'; 	break;
				case 'bottom,center': $cp = 'b'; 	break;
				case 'bottom,right'	: $cp = 'br';	break;
				default:   $cp = 'c'; // c and empty
			}
			?>
			<div id="cpositions">
				<a class="cposition tl <?php echo ($cp=='tl' || $cp=='t' || $cp=='l')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'tl');" ></a>
				<a class="cposition t <?php echo  ($cp=='t')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 't');" ></a>
				<a class="cposition tr <?php echo ($cp=='tr' || $cp=='t' || $cp=='r')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'tr');" style="margin-right:0px;"></a>
				
				<a class="cposition l <?php echo  ($cp=='l')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'l');" ></a>
				<a class="cposition c <?php echo  ($cp=='c' || $cp=='')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'c');" ></a>
				<a class="cposition r <?php echo  ($cp=='r')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'r');" style="margin-right:0px;"></a>
				
				<a class="cposition bl <?php echo ($cp=='bl' || $cp=='b' || $cp=='l')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'bl');" ></a>
				<a class="cposition b <?php echo  ($cp=='b')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'b');" ></a>
				<a class="cposition br <?php echo ($cp=='br' || $cp=='b' || $cp=='r')?'cpselected':''; ?>" href="javascript:void(0);" onclick="setCropPos(this, 'br');" style="margin-right:0px;"></a>
			</div>
			
			<input type="hidden" name="cropPos" id="cropPos" value="<?php echo (get_post_meta($post->ID,"cropPos",true)=='')?'center,center':get_post_meta( $post->ID,"cropPos",true); ?>" />
		</div>
	<div style="clear:both;"></div>
	<?php
}

add_action('admin_menu', 'rb_add_box');
add_action('save_post', 'rb_save_data');

//Add meta boxes to post types
function rb_add_box(){
	wp_enqueue_script('postOptionsScript', get_template_directory_uri() . '/includes/js/post-options.js', false, null, false);
	wp_enqueue_style('postOptionsStyle', get_template_directory_uri() . '/includes/css/post-options.css');
	
	global $Rb_meta_box, $post;
	foreach($Rb_meta_box as $value)
	{
		if(isset($value['func']))
			$func_name = (function_exists($value['func']))?$value['func']:'rb_generalMetaCreator';
		else
			$func_name = 'rb_generalMetaCreator';
		if(is_array($value['post_type'])){
			foreach($value['post_type'] as $type){
				add_meta_box($value['id'], $value['title'], $func_name,  $type, $value['context'], $value['priority'], array('id'=>$value['id']) );
			}
		}else{
			add_meta_box($value['id'], $value['title'], $func_name,  $value['post_type'], $value['context'], $value['priority'], array('id'=>$value['id']) );
		}
	}
}



function rb_createMetaForm($metaBox){
	global $post, $wpdb;
	echo '<input type="hidden" name="rb_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';
	
	foreach ($metaBox['fields'] as $field){
	// get current post meta data
	$meta = get_post_meta($post->ID, $field['id'], true);
	
	echo '<tr>'.
		'<th style="width:20%"><label for="'. $field['id'] .'">'.$field['name']. '</label></th>'.
		'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? htmlspecialchars($meta) : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				break;
			case 'imageuploadbutton':
				echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:80%" />
				<button id="'. $field['id'] .'_button" class="button geturlfromfilemanager" type="button" rel="'.$field['id'].'" name="'. $field['id'] .'_button" style="float: right;">Browse</button> <br />'. $field['desc'];
				break;
			case 'hidden':
				echo '<input type="hidden" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" />';
				break;
			case 'textarea':
				echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
				break;
			case 'select':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
				if(rb_is_assoc($field['options']))
					foreach($field['options'] as $optionk => $optionv)
						echo '<option value="'.$optionv.'" '. ( $meta == $optionv ? ' selected="selected"' : '' ) . '>'.$optionk.'</option>';
				else
					foreach($field['options'] as $option)
						echo '<option value="'.$option.'" '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'.$option.'</option>';
				
				echo '</select>';
				break;
			case 'galleryid':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '" style="width:97%" >';
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
						echo '<option value="'.$postdata->ID.'" '. ( $meta == $postdata->ID ? ' selected="selected"' : '' ) . '>'. $postdata->post_title .'</option>';
					}
				}
				echo '</select>';
				break;
			case 'pagegallery':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '" style="width:97%" >';
				echo '<option value="Default" '. ( ($meta == "Default" || $meta=="") ? ' selected="selected"' : '' ) . '>Default Gallery</option>';
				echo '<option value="NoGallery" '. ( $meta == "NoGallery" ? ' selected="selected"' : '' ) . '>No Gallery</option>';
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
						echo '<option value="'.$postdata->ID.'" '. ( $meta == $postdata->ID ? ' selected="selected"' : '' ) . '>'. $postdata->post_title .'</option>';
					}
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
				break;
		}
		echo '<td>'.'</tr>';
	}
	echo '</table>';
}

// Save data from meta box
function rb_save_data($post_id){
	global $Rb_meta_box, $post;
	
	//Verify nonce
	if(isset($_POST['rb_meta_box_nonce']))
		if (!wp_verify_nonce($_POST['rb_meta_box_nonce'], basename(__FILE__)))
			return $post_id;
	
	//Check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	
	//Check quick edit
	if(defined('DOING_AJAX') && DOING_AJAX) return $post_id;
	
	//Check permissions
	if(@isset($_POST['post_type'])){
	if ('page' == $_POST['post_type'])
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	elseif (!current_user_can('edit_post', $post_id)) return $post_id;
	}

	for($y=0; $y<sizeof($Rb_meta_box); $y++){
		foreach ($Rb_meta_box[$y]['fields'] as $field){
			$old = get_post_meta($post_id, $field['id'], true);
			$new = '';
			if(isset($field['id']))
				if(isset($_POST[$field['id']]))
					$new = $_POST[$field['id']];
			if (!empty($new)) update_post_meta($post_id, $field['id'], $new);
			elseif (empty($new) && !empty($old)) delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

function rb_getPostMeta($func){
	global $Rb_meta_box;
	$currentMeta;
	foreach($Rb_meta_box as $value){
		if(@$value['func']==$func){
			$currentMeta = $value;
		}
	}
	if(!is_array($currentMeta))
		return false;
		
	return $currentMeta;
}

function rb_getPostMetaFromID($metaid){
	global $Rb_meta_box;
	$currentMeta;
	foreach($Rb_meta_box as $value){
		if($value['id']==$metaid){
			$currentMeta = $value;
		}
	}
	if(!is_array($currentMeta))
		return false;
		
	return $currentMeta;
}



?>