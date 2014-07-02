<?php 
$blogformat = strtolower( get_post_format() );
if($blogformat == 'standard' || $blogformat == '') 	$blogformat = 'standard';

?>

<?php // image
if( has_post_thumbnail() && ($blogformat=='image' || $blogformat=='standard')):
$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id());
?>
<img src="<?php echo $thumbnail_src; ?>" alt="<?php the_title(); ?>">
<?php endif; ?>

<?php if($blogformat=='audio'):  // audio
	$audiocode 		= '';
	$audioUrl		= get_post_meta(get_the_ID(), "rb_format_audio_url", true);
	$audioPoster 	= get_post_meta(get_the_ID(), "rb_format_audio_poster", true);
	if(strpos($audioUrl, '[soundcloud')!== false){
		$audiocode = do_shortcode($audioUrl);
	}elseif(!empty($audioUrl)){
		$sourceType = rb_getMediaType($audioUrl);
		if($sourceType=='embedaudioplayer'){
			if(!empty($audioPoster))
				$audiocode = rb_getSource($audioUrl, 600, 24, array('image'=>$audioPoster));
			else
				$audiocode = rb_getSource($audioUrl, 600, 24);
		}
	}
?>
<div class="sound"><?php echo $audiocode; ?></div>
<?php endif; ?>

<?php if($blogformat=='video'): // video
	$videocode 		= '';
	$videoUrl		= get_post_meta(get_the_ID(), "rb_format_video_url", true);
	$videoWidth		= (int) get_post_meta(get_the_ID(), "rb_format_video_width", true);
	$videoHeight	= (int) get_post_meta(get_the_ID(), "rb_format_video_height", true);
	$videoPoster 	= trim(get_post_meta(get_the_ID(), "rb_format_video_poster", true));
	if(!empty($videoUrl) && $videoHeight>0){
		$sourceType = rb_getMediaType($videoUrl);
		if($sourceType=='youtube' || $sourceType=='vimeo' || $sourceType=='embedplayer'){
			if($sourceType=='embedplayer' && !empty($videoPoster))
				$videocode = rb_getSource($videoUrl, $videoWidth, $videoHeight, array('image'=>$videoPoster));
			else
				$videocode = rb_getSource($videoUrl, $videoWidth, $videoHeight);
		}
	}
?>
<div class="video"><?php echo $videocode; ?></div>
<?php endif; ?>

<?php
if($blogformat=='gallery'){ // gallery
	$slidercode		= '';
	$galleryid		= (int)get_post_meta(get_the_ID(), "rb_format_gallery_id", true);
	if($galleryid>0)
		$slidercode = do_shortcode('[flexslider id="'.$galleryid.'"]')."\n";
		
	echo $slidercode;
}
?>