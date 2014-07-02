<div class="description">
	<span><?php _e('By:','rb') ?></span><span class="font-color"> <?php the_author(); ?> | </span>
	<span><?php	
	$rb_commentCount = get_comments_number();
	if($rb_commentCount==0)
		echo __('No Comment', 'rb');
	elseif($rb_commentCount==1)
		echo __('1 Comment', 'rb');
	else
		echo $rb_commentCount.' '.__('Comments', 'rb');
	?> </span>
	<?php if(count(get_the_category())){ ?>
	<span> | <?php echo get_the_category_list( ', ' ); ?> </span>
	<?php } ?>
	<?php if(get_the_tags()): ?>
	<span> | <?php echo get_the_tag_list(__('with ','rb'),', ',''); ?> </span>
	<?php endif; ?>
</div>