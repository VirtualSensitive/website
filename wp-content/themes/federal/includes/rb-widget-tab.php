<?php
/*
Plugin Name: RenkliBeyaz Tab Widget
Description: This widget bundle of a theme on Themeforest.net
Version: 1.0
Author: RenkliBeyaz
Author URI: http://themeforest.net/user/RenkliBeyaz
*/
add_action('widgets_init','rb_tab_widget_register');
function rb_tab_widget_register()
{
	register_widget('rb_tab_widget');
}
class rb_tab_widget extends WP_Widget 
{
	public function __construct() {
		parent::__construct(
			'rb_tab_widget', 
			__('RB Tab Widget', 'rb'), 
			array( 'description' => __( 'Display populer posts, recent comments and posts', 'rb' ), )
		);
	}
	public function widget($args, $instance) 
	{
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$count = (int) empty($instance['count']) ? 3 : apply_filters('widget_title', $instance['count']);
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		?>
		<ul class="nav nav-tabs">
		  <li class="active"><a class="jsaction" href="#tab-populer" data-toggle="tab" ><?php _e('Populer', 'rb'); ?></a></li>
		  <li><a class="jsaction" ref="#tab-posts" data-toggle="tab"><?php _e('New', 'rb'); ?></a></li>
		  <li><a class="jsaction" href="#tab-comments" data-toggle="tab"><?php _e('Comments', 'rb'); ?></a></li>
		</ul>
		<div class="tab-content">
		  <div class="tab-pane fade in active" id="tab-populer">
			<?php
			query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page='.$count.'&post_status=publish');
			if (have_posts()){ 
				while (have_posts())
				{
				the_post();
				$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
				$content_class = 'tag_widget_content_without_thumbnail';
				if(function_exists('wpthumb')){
					$thumbnail_src = wpthumb($thumbnail_src,'height=50&width=50&resize=true&crop=1&crop_from_position=center,center');
				}
				?>
				
				<div class="row thumbnails">
					<?php if(!empty($thumbnail_src)): ?>
					<div class="images">
						<a href="<?php the_permalink(); ?>">  <img src="<?php echo $thumbnail_src; ?>" alt="<?php the_title(); ?>" >  </a>
					</div>
					<?php endif; ?>
					<div class="label text-left">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<div class="date"><?php the_time('F j, Y'); ?></div>
					</div>
				</div>
				
				<?php
				}
			}
			wp_reset_query();
			?>
		  </div>
		  <div class="tab-pane fade" id="tab-posts">
			<?php
			query_posts('orderby=date&order=ASC&posts_per_page='.$count.'&post_status=publish');
			if (have_posts()){ 
				while (have_posts())
				{
				the_post();
				$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
				$content_class = 'tag_widget_content_without_thumbnail';
				if(function_exists('wpthumb')){
					$thumbnail_src = wpthumb($thumbnail_src,'height=50&width=50&resize=true&crop=1&crop_from_position=center,center');
				}
				?>
				
				<div class="row thumbnails">
					<?php if(!empty($thumbnail_src)): ?>
					<div class="images">
						<a href="<?php the_permalink(); ?>">  <img src="<?php echo $thumbnail_src; ?>" alt="<?php the_title(); ?>" >  </a>
					</div>
					<?php endif; ?>
					<div class="label text-left">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<div class="date"><?php the_time('F j, Y'); ?></div>
					</div>
				</div>
				
				
				<?php
				}
			}
			wp_reset_query();
			?>
		  </div>
		  <div class="tab-pane fade" id="tab-comments">
			<?php
			$comments = get_comments('status=approve&number='.$count);
			foreach($comments as $comm)
			{
			?>
				<div class="row thumbnails">
					<div class="images">
						<a href="<?php echo get_permalink($comm->comment_post_ID  ); ?>#comment-<?php echo $comm->comment_ID; ?>">  <?php echo get_avatar( $comm, '50' ); ?>  </a>
					</div>
					<div class="label text-left">
						<a href="<?php echo get_permalink($comm->comment_post_ID  ); ?>#comment-<?php echo $comm->comment_ID; ?>"><?php echo wp_html_excerpt( $comm->comment_content, 35 ); ?></a>
						<div class="date"><?php echo __('by','rb').' '.strip_tags($comm->comment_author); ?></div>
					</div>
				</div>
			
			<?php } ?>
		  </div>
		</div>
		<?php
		echo $args['after_widget'];
	}
	public function update($new_instance, $old_instance) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}
	public function form($instance) 
	{
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'count' ] ) ) {
			$count = $instance[ 'count' ];
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','rb'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:','rb'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
		<?php 

	}
}
?>