jQuery(document).ready(function($){
	$('#post-formats-select input[name="post_format"]').click(function(){
		showPostFormat( $('#post-formats-select input[name="post_format"]:checked').val() );
	});
	showPostFormat( $('#post-formats-select input[name="post_format"]:checked').val() );
	function showPostFormat(rb_post_format){
		$('#post_meta_quote, #post_meta_image, #post_meta_link, #post_meta_video, #post_meta_audio, #post_meta_gallery').hide();
		if(rb_post_format == 'quote')
			$('#post_meta_quote').show();
		if(rb_post_format == 'image')
			$('#post_meta_image').show();
		if(rb_post_format == 'link')
			$('#post_meta_link').show();
		if(rb_post_format == 'video')
			$('#post_meta_video').show();
		if(rb_post_format == 'audio')
			$('#post_meta_audio').show();
		if(rb_post_format == 'gallery')
			$('#post_meta_gallery').show();
	}
	
	$('.geturlfromfilemanager').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var file_manager;
		if (file_manager) {
			file_manager.open();
			return;
		}

		file_manager = wp.media.frames.file_frame = wp.media({
			multiple: false,
			library: {
			  type: 'image, audio'
			},
			title: 'Media Library',
			button: {
				text: 'Choose an Image'
			}
		});

		file_manager.on('select', function() {
			attachment = file_manager.state().get('selection').first().toJSON();
			$this.parent().find('input').val(attachment.url);
		});
		file_manager.open();
	});
});

function setCropPos(obj, pos){
	jQuery('#cpositions a').removeClass('cpselected');
	jQuery(obj).addClass('cpselected');
	if(pos=='t')
		jQuery('#cpositions .tl, #cpositions .tr').addClass('cpselected');
	if(pos=='b')
		jQuery('#cpositions .bl, #cpositions .br').addClass('cpselected');
	if(pos=='l')
		jQuery('#cpositions .tl, #cpositions .bl').addClass('cpselected');
	if(pos=='r')
		jQuery('#cpositions .tr, #cpositions .br').addClass('cpselected');
	
	switch(pos){
		case 'tl': pos = 'top,left'; break;
		case 't':  pos = 'top,center'; break;
		case 'tr': pos = 'top,right';	break;
		case 'l':  pos = 'center,left'; break;
		case 'r':  pos = 'center,right'; break;
		case 'bl': pos = 'bottom,left'; break;
		case 'b':  pos = 'bottom,center'; break;
		case 'br': pos = 'bottom,right'; break;
		default:   pos = 'center,center'; // c and empty
	}
	jQuery('#cropPos').val(pos);
}