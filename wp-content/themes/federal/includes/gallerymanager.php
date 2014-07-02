<?php
/*
functions required; @getMediaType @getParamsFromUrl @sh2array
*/
/* main ajax functions */

add_shortcode('rb_gallery', 'sh_rb_gallery');
function sh_rb_gallery($attr, $content=null){ return ''; }
	
if(is_admin())
{
	add_action('wp_ajax_rb_g_get_thumnail_url', 'rb_g_get_thumnail_url');
	function rb_g_get_thumnail_url(){
		$thumbnail = $_POST['thumburl'];
		if(function_exists('wpthumb'))
			$thumbnail = wpthumb($thumbnail,'width=200&resize=true');
		$ret = array('thumbnail'=>$thumbnail);
		echo json_encode($ret);
		die();
	}

	add_action('wp_ajax_rb_g_get_video_thumbnail_url', 'rb_g_get_video_thumbnail_url');
	function rb_g_get_video_thumbnail_url(){
		$itemurl = trim($_POST['itemurl']);
		$itemtype = rb_getMediaType($itemurl);
		$mediaParams = rb_getParamsFromUrl($itemurl);
		$thumb = '';
		if($itemtype=='youtube')
			$thumb = 'http://img.youtube.com/vi/'.$mediaParams['v'].'/1.jpg';
		elseif($itemtype=='vimeo'){
			WP_Filesystem();
			global $wp_filesystem;
			$hash = $wp_filesystem->get_contents("http://vimeo.com/api/v2/video/".$mediaParams['v'].".php");
			$thumb = '';
			if(!empty($hash)){
				$hash = unserialize($hash);
				$thumb = $hash[0]['thumbnail_large'];
			}
		}
		$thumbnail = trim($thumb);
		if(!empty($thumbnail) && function_exists('wpthumb'))
			$thumbnail = wpthumb($thumbnail,'width=200&resize=true');
		$ret = array('thumburl'=>$thumb, 'thumbnail'=>$thumbnail);
		echo json_encode($ret);
		die();
	}
}

// gallery post type
function rb_create_gallery_post_type() {
	register_post_type( 'rb-gallery',
		array(
			'labels' => array(
				'name' => __('Galleries','rb'),
				'singular_name' => __('Galleries', 'rb'),
				'add_new' => __('Add Gallery Item', 'rb'),
				'edit_item' => __('Edit Gallery Item', 'rb'),
				'new_item' => __('New Gallery Item', 'rb'),
				'view_item' => __('View Gallery Item', 'rb'),
				'search_items' => __('Search Gallery Item', 'rb'),
				'not_found' => __('Not found any gallery item.', 'rb'),
				'not_found_in_trash' => __('Not found any gallery item in trash', 'rb')
			),
			'public' => true,
			'exclude_from_search' => true,
			'supports' => array(
				'editor',
				'title',
				'thumbnail'
				),
			'has_archive' => false,
			'rewrite' => array('slug' => 'gallery'),
			'taxonomies' => array(),
			'menu_position' => 8
		)
	);
}

/* Short Code */
function sh_rb_gallery_item($attr, $content = null){	return ''; }
add_shortcode('rb_gallery_item', 'sh_rb_gallery_item');

/* Post Options */
function rb_add_gallery_manager_box(){
	add_meta_box('gallery-manager', __('Gallery Manager','rb'), 'rb_galleryManager',  'rb-gallery', 'normal', 'high');	
}
function rb_galleryManager(){
	global $post;
	$tmpurl = get_template_directory_uri();
	?>
	<style>
	#postdivrich{ display:none; }
	.gwrapper{ padding:20px;}
	.gItem{ padding-bottom:10px; border-bottom:1px solid #eeeeee; margin-bottom:10px; }
	.gImage{ width:200px; }
	.gImageWrapper{ position:relative; }
	.gTypeIcon{ position:absolute; left:0; top:0; background-color:#fff; }
	.gImageActions{ position:absolute; left:0; bottom:0; }
	</style>
	<script type='text/javascript'>
	jQuery(document).ready(function($){
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  e.target
		  e.relatedTarget
		});
		
		var gImageModal;
		$('#gChooseImageBtn').unbind('click');
		$('#gChooseImageBtn').click(function(e){
			e.preventDefault();
	 
			if (gImageModal) {
				gImageModal.open();
				return;
			}
	 
			gImageModal = wp.media.frames.file_frame = wp.media({
				multiple: true,
				library: {
				  type: 'image'
				},
				title: 'Choose an Image',
				button: {
					text: 'Choose an Image'
				}
			});
			
			gImageModal.on('select', function() {
				var selection = gImageModal.state().get('selection');
				var urls = new Array();
				selection.map( function( attachment ) {
				  attachment = attachment.toJSON();
				  urls.push(attachment.url);
				});
				if(urls.length>0){
					for(var i=0; i<urls.length; i++){
						addNewItemtoG(urls[i], 'image');
					}
					gItemToShortCode();
					gAllThumbnails();
					addBehaviors();
				}
			});
			gImageModal.open();
		});
		
		$('#gAddVideoBtn').unbind('click');
		$('#gAddVideoBtn').click(function(e){
			e.preventDefault();
			var mediaurl = $.trim($('#gMediaUrl').val()),
			mediaW = parseInt($('#gMediaWidth').val()),
			mediaH = parseInt($('#gMediaHeight').val());
			if(mediaurl.length<4 || isNaN(mediaW) || isNaN(mediaH) )
				alert('Please enter a corrent url, width and height value');
			else{
				addNewItemtoG(mediaurl, 'video', {width:mediaW, height:mediaH});
				$('#gMediaUrl').val('');
				$('#gMediaWidth').val('');
				$('#gMediaHeight').val('');
				gAllThumbnails();
				gItemToShortCode();
				addBehaviors();
			}
		});
		
		function gAllThumbnails(){
			$('#gItemList .gItem').each(function(){
				gUpdateThumbnail($(this));
			});
		}
		
		function gUpdateThumbnail($obj){
			var thumburl = $.trim($obj.find('input[name=gImageThumnail]').val());
			var itemtype = $.trim($obj.find('input[name=gItemTpe]').val());
			var itemurl = $.trim($obj.find('input[name=gImageOrginal]').val());
			if(thumburl.length>0){
				$.post(ajaxurl, {action:'rb_g_get_thumnail_url', thumburl:thumburl},function(data){
					data = $.parseJSON(data);
					$obj.find('.gImage').attr('src', data.thumbnail);
				});
			}else if(thumburl.length == 0 && itemtype=='video'){
				$.post(ajaxurl, {action:'rb_g_get_video_thumbnail_url', itemurl:itemurl},function(data){
					data = $.parseJSON(data);
					$obj.find('.gImage').attr('src', data.thumbnail);
					$obj.find('input[name=gImageThumnail]').val(data.thumburl);
				});
			}
		}
		
		function gItemToShortCode(){
		$('#content-html').trigger('click');
			setTimeout(function()
			{
				var allCode = '';
				allCode += '[rb_gallery imagewidth="300" imageheight="300"]';
				$('#gItemList .gItem').each(function(){
					var caption = $(this).find('input[name="gCaption"]').val();
					caption = caption.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;");
					allCode += '[rb_gallery_item ';
					allCode += 'type="'+			$(this).find('input[name="gItemTpe"]').val()+'" ';
					allCode += 'url="'+				$(this).find('input[name="gImageOrginal"]').val()+'" ';
					allCode += 'thumbnail="'+		$(this).find('input[name="gImageThumnail"]').val()+'" ';
					allCode += 'crop="'+			$(this).find('input[name="gImageCrop"]').val()+'" ';
					allCode += 'caption="'+			caption+'" ';
					if($(this).find('input[name="gItemTpe"]').val() == 'video'){
						allCode += 'width="'+			$(this).find('input[name="gImageWidth"]').val()+'" ';
						allCode += 'height="'+			$(this).find('input[name="gImageHeight"]').val()+'" ';
					}
					allCode += ']';
					allCode += $(this).find('textarea[name="gDescription"]').val()
					allCode += '[/rb_gallery_item]';
				});
				allCode += '[/rb_gallery]';
				$('#content.wp-editor-area').val(allCode);
			},10);
		}
		
		function setImageUrl($el, updateThums){
			var file_manager;
			if (file_manager) {
				file_manager.open();
				return;
			}
	 
			file_manager = wp.media.frames.file_frame = wp.media({
				multiple: false,
				library: {
				  type: 'image'
				},
				title: 'Choose an Image',
				button: {
					text: 'Choose an Image'
				}
			});
	 
			file_manager.on('select', function() {
				attachment = file_manager.state().get('selection').first().toJSON();
				$el.val(attachment.url);
				if(updateThums)
					gUpdateThumbnail($el.parents('.gItem'));
				gItemToShortCode();
			});
			file_manager.open();
		}
		
		function addNewItemtoG(url, type, extra){
			extra = (typeof extra == 'undefined')?'':extra;
			var thumburl = (typeof extra.thumburl == 'undefined')?'':extra.thumburl;
			var width = (typeof extra.width == 'undefined')?0:extra.width;
			var height = (typeof extra.height == 'undefined')?0:extra.height;
			var crop = (typeof extra.crop == 'undefined')?'center,center':extra.crop;
			var caption = (typeof extra.caption == 'undefined')?'':extra.caption;
			var description = (typeof extra.description == 'undefined')?'':extra.description;
			if(type=='image') thumburl = url;
			
			var itemStructure = '<div class="row gItem">\
					<div class="col-md-4">\
						<input type="hidden" name="gItemTpe" value="'+type+'" >\
						<div class="gImageWrapper">\
							<input type="hidden" name="gImageOrginal" value="'+url+'" >\
							<input type="hidden" name="gImageThumnail" value="'+thumburl+'" >\
							<input type="hidden" name="gImageWidth" value="'+width+'" >\
							<input type="hidden" name="gImageHeight" value="'+height+'" >\
							<input type="hidden" name="gImageCrop" value="'+crop+'" >\
							<img src="<?php echo $tmpurl; ?>/includes/adminimages/noimage.jpg" class="gImage">';
			if(type=='image')
			itemStructure += '<i class="gTypeIcon fa fa-picture-o fa fa-border"></i>';
			if(type=='video')
			itemStructure += '<i class="gTypeIcon fa fa-film fa fa-border"></i>';
			itemStructure += '<div class="btn-group gImageActions">\
								<button type="button" class="btn btn-danger">Action</button>\
								<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">\
									<span class="caret"></span>\
									<span class="sr-only">Toggle Dropdown</span>\
								</button>\
								<ul class="dropdown-menu" role="menu">\
									<li><a class="gItemRemoveBtn" href="#">Remove</a></li>\
									<li><a class="gItemThumbBtn" href="#">Choose a Thumbnail</a></li>\
									<li><a class="gItemShowOrginalBtn" href="#">Show Orginal</a></li>';
			if(type=='image')
			itemStructure += '		<li><a class="gItemOrginalBtn" href="#">Change the Image</a></li>';
			itemStructure += '		<li class="divider"></li>\
									<li><a href="#" class="cropitem" data-crop="top,left">		'+addCropIcon(crop, 'top,left')+' 			Crop Top, Left</a></li>\
									<li><a href="#" class="cropitem" data-crop="top,center">	'+addCropIcon(crop, 'top,center')+' 		Crop Top, Center</a></li>\
									<li><a href="#" class="cropitem" data-crop="top,right">		'+addCropIcon(crop, 'top,right')+'			Crop Top, Right</a></li>\
									<li><a href="#" class="cropitem" data-crop="center,left">	'+addCropIcon(crop, 'center,left')+' 		Crop Center, Left</a></li>\
									<li><a href="#" class="cropitem" data-crop="center,center">	'+addCropIcon(crop, 'center,center')+'	 	Crop Center, Center</a></li>\
									<li><a href="#" class="cropitem" data-crop="center,right">	'+addCropIcon(crop, 'center,right')+' 		Crop Center, Right</a></li>\
									<li><a href="#" class="cropitem" data-crop="bottom,left">	'+addCropIcon(crop, 'bottom,left')+' 		Crop Bottom, Left</a></li>\
									<li><a href="#" class="cropitem" data-crop="bottom,center">	'+addCropIcon(crop, 'bottom,center')+' 		Crop Bottom, Center</a></li>\
									<li><a href="#" class="cropitem" data-crop="bottom,right">	'+addCropIcon(crop, 'bottom,right')+' 		Crop Bottom, Right</a></li>\
								</ul>\
							</div>\
						</div>\
					</div>\
					<div class="col-md-8">\
						  <div class="form-group">\
							<input type="text" class="form-control" name="gCaption" placeholder="Caption" value="'+caption+'">\
						  </div>\
						  <div class="form-group">\
							<textarea class="form-control" name="gDescription" placeholder="Description">'+description+'</textarea>\
						  </div>\
					</div>\
				</div>';
		
			$('#gItemList').append(itemStructure);
		}
		function addCropIcon(crop, data){
			return (crop==data)?'<i class="fa fa-check-square"></i> ':'<i class="fa fa-square-o"></i>';
		}
		
		
		function addBehaviors(){
			$('.gItemRemoveBtn').unbind('click');
			$('.gItemRemoveBtn').click(function(e){
				e.preventDefault();
				pResult = window.confirm('Are you sure to remove this item?');
				if(pResult){
					$(this).parents('.gItem').remove();
					gItemToShortCode();
				}
			});
			$('.cropitem').unbind('click');
			$('.cropitem').click(function(e){
				e.preventDefault();
				$(this).parents('.gImageActions').find('.fa').removeClass('fa-check-square').addClass('fa-square-o');
				$(this).find('i').addClass('fa-check-square');
				$(this).parents('.gItem').find('input[name="gImageCrop"]').val($(this).data('crop'));
				gItemToShortCode();
			});
			
			$('.gItemThumbBtn').unbind('click');
			$('.gItemThumbBtn').click(function(e){
				e.preventDefault();
				setImageUrl($(this).parents('.gItem').find('input[name="gImageThumnail"]'), true);
			});
			
			$('.gItemOrginalBtn').unbind('click');
			$('.gItemOrginalBtn').click(function(e){
				e.preventDefault();
				setImageUrl($(this).parents('.gItem').find('input[name="gImageOrginal"]'), false);
			});
			
			$('.gItemShowOrginalBtn').unbind('click');
			$('.gItemShowOrginalBtn').click(function(e){
				e.preventDefault();
				window.open($(this).parents('.gItem').find('input[name="gImageOrginal"]').val(),'_blank');
			});
			
			$('input[name="gCaption"], textarea[name="gDescription"]').unbind('blur');
			$('input[name="gCaption"], textarea[name="gDescription"]').blur(function(){
				gItemToShortCode();
			});
			
			$('#gItemList').sortable({
				start:function(event, ui){
					ui.item.addClass('activeMove');
				},
				stop:function(event, ui){
					ui.item.removeClass('activeMove');
					gItemToShortCode();
				},
				cancel: 'input, textarea'
			});
			$('#gItemList').find('input, textarea').bind('click.sortable mousedown.sortable',function(ev){
				ev.target.focus();
			});

		}
		
		<?php
		//add visual items
		$contentArray = rb_sh2array($post->post_content);
		if(count($contentArray)>0){
			if($contentArray[0]['shortcode'] == 'rb_gallery'){
				$contentItemArray = $contentArray[0]['content'];
				foreach($contentItemArray as $item){
					if($item['shortcode']=='rb_gallery_item'){
						$attr =$item['attr'];
						if($attr['type']=='image')
							echo 'addNewItemtoG("'.$attr['url'].'", "'.$attr['type'].'", {thumburl:"'.$attr['thumbnail'].'", crop:"'.$attr['crop'].'", caption:"'.$attr['caption'].'", description:"'.htmlspecialchars($item['content']).'"})'."\n";
						elseif($attr['type']=='video')
							echo 'addNewItemtoG("'.$attr['url'].'", "'.$attr['type'].'", {thumburl:"'.$attr['thumbnail'].'", crop:"'.$attr['crop'].'", caption:"'.$attr['caption'].'", description:"'.htmlspecialchars($item['content']).'", width:"'.$attr['width'].'", height:"'.$attr['height'].'"})'."\n";
					}
				}
				if(sizeof($contentItemArray)>0){
					echo "\n gAllThumbnails();
					addBehaviors();\n";
				}
			}
		}
		?>
		
	});
	</script>
	<div class="bscontainer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#gAddImage" data-toggle="tab" ><i class="fa fa-picture-o fa-fw"></i> Add Image</a></li>
				  <li><a href="#gAddVideo" data-toggle="tab"><i class="fa fa-video-camera fa-fw"></i> Add Video</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane fade in active" id="gAddImage">
					<div class="gwrapper">
						<button type="button" class="btn btn-primary btn-lg" id="gChooseImageBtn">
						  <i class="fa fa-folder-open-o fa-fw"></i> Choose Image
						</button>
					</div>
				  </div>
				  <div class="tab-pane fade" id="gAddVideo">
					<div class="gwrapper">
						<div class="row" id="gAddVideoForm">
						  <div class="col-xs-5">
							<input type="text" class="form-control" id="gMediaUrl" placeholder="Url of the media">
						  </div>
						  <div class="col-xs-2">
							<input type="text" class="form-control" id="gMediaWidth" placeholder="Width">
						  </div>
						  <div class="col-xs-2">
							<input type="text" class="form-control" id="gMediaHeight" placeholder="Height">
						  </div>
						  <div class="col-xs-3">
							<button id="gAddVideoBtn" class="btn btn-primary"><i class="fa fa-video-camera fa-fw"></i>  Add Media</button>
						  </div>
						</div>
					</div>
				  </div>
				</div>
				</div>
			</div>
			
			<div class="row gwrapper">
				<h2> Gallery </h2>
				<hr>
				<div class="col-md-12" id="gItemList">
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
