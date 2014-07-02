<div class="gallery">
	<?php 
	global $rb_useMediaHead;
	$rb_useMediaHead =  false;
	$rb_blogformat = strtolower( get_post_format() );
	if($rb_blogformat == 'standard' || $rb_blogformat == '') 	$rb_blogformat = 'standard';
	
	
	$rb_figure_class = 'type-link image-hover';
	if($rb_blogformat=='image') $rb_figure_class = 'type-link image-hover';
	if($rb_blogformat=='gallery') $rb_figure_class = 'type-gallery';
	if($rb_blogformat=='audio') $rb_figure_class = 'type-sound';
	
	$rb_blogTypeIcon = 'pencil';
	if(get_post_type()=='post'){
		if($rb_blogformat=='image' || $rb_blogformat=='gallery') $rb_blogTypeIcon = 'picture-o';
		if($rb_blogformat=='video') $rb_blogTypeIcon = 'play';
		if($rb_blogformat=='audio') $rb_blogTypeIcon = 'music';
	}elseif(get_post_type()=='page'){
		$rb_blogTypeIcon = 'file-o';
	}elseif(get_post_type()=='rb-portfolio'){
		$rb_blogTypeIcon = 'folder-open-o';
	}
	?>
	<figure class="<?php echo $rb_figure_class; ?>">
		<?php 
		if( has_post_thumbnail() && ($rb_blogformat=='image' || $rb_blogformat=='standard')){
		$rb_useMediaHead = true;
		$rb_thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id());
		?>
		
		<?php if($rb_blogformat=='image'){ ?>
		<div class="wrapper"></div>
		<a href="<?php the_permalink(); ?>" class="fa fa-link font-white link bg-color"></a>
		<?php } ?>
		
		<img src="<?php echo $rb_thumbnail_src; ?>" alt="<?php the_title(); ?>">
		<?php } ?>
		
		<?php if($rb_blogformat=='audio'){
			$rb_audiocode 		= '';
			$rb_audioUrl		= get_post_meta(get_the_ID(), "rb_format_audio_url", true);
			$rb_audioPoster 	= get_post_meta(get_the_ID(), "rb_format_audio_poster", true);
			if(strpos($rb_audioUrl, '[soundcloud')!== false){
				$rb_useMediaHead = true;
				$rb_audiocode = do_shortcode($rb_audioUrl);
				?> <div class="sound"><?php echo $rb_audiocode; ?></div> <?php
			}elseif(!empty($rb_audioUrl)){
				$rb_sourceType = rb_getMediaType($rb_audioUrl);
				if($rb_sourceType=='embedaudioplayer'){
					$rb_useMediaHead = true;
					if(!empty($rb_audioPoster))
						$rb_audiocode = rb_getSource($rb_audioUrl, 600, 24, array('image'=>$rb_audioPoster));
					else
						$rb_audiocode = rb_getSource($rb_audioUrl, 600, 24);
					?> <div class="sound"><?php echo $rb_audiocode; ?></div> <?php
				}
			}
		} ?>
		
		<?php if($rb_blogformat=='video'){
			$rb_videocode 		= '';
			$rb_videoUrl		= get_post_meta(get_the_ID(), "rb_format_video_url", true);
			$rb_videoWidth		= (int) get_post_meta(get_the_ID(), "rb_format_video_width", true);
			$rb_videoHeight		= (int) get_post_meta(get_the_ID(), "rb_format_video_height", true);
			$rb_videoPoster 	= trim(get_post_meta(get_the_ID(), "rb_format_video_poster", true));
			if(!empty($rb_videoUrl) && $rb_videoHeight>0){
				$rb_sourceType = rb_getMediaType($rb_videoUrl);
				if($rb_sourceType=='youtube' || $rb_sourceType=='vimeo' || $rb_sourceType=='embedplayer'){
					$rb_useMediaHead = true;
					if($rb_sourceType=='embedplayer' && !empty($rb_videoPoster))
						$rb_videocode = rb_getSource($rb_videoUrl, $rb_videoWidth, $rb_videoHeight, array('image'=>$rb_videoPoster));
					else
						$rb_videocode = rb_getSource($rb_videoUrl, $rb_videoWidth, $rb_videoHeight);
					?> <div class="video"><?php echo $rb_videocode; ?></div> <?php
				}
			}
		} ?>
		
		<?php
		if($rb_blogformat=='gallery'){
			$rb_slidercode		= '';
			$rb_galleryid		= (int)get_post_meta(get_the_ID(), "rb_format_gallery_id", true);
			if($rb_galleryid>0){
				$rb_useMediaHead = true;
				$rb_slidercode = do_shortcode('[flexslider id="'.$rb_galleryid.'"]')."\n";
				echo $rb_slidercode;
			}
		}
		?>
		
		<div class="icon-type"><span class="fa fa-<?php echo $rb_blogTypeIcon; ?>"></span></div>
		<?php if(get_post_type()=='post'): ?>
		<figcaption class="date"><span class="month"><?php echo strtoupper(get_the_time('M')); ?></span><span class="day"><?php the_time('d'); ?></span></figcaption>
		<?php endif; ?>
	</figure>
</div>