<?php
/*
Plugin Name: RenkliBeyaz Flickr Widget
Description: This widget bundle of a theme on Themeforest.net
Version: 1.0
Author: RenkliBeyaz
Author URI: http://themeforest.net/user/RenkliBeyaz
*/
add_action('widgets_init','rb_flickr_widget_register');
function rb_flickr_widget_register()
{
	register_widget('rb_flickr_widget');
}
class rb_flickr_widget extends WP_Widget 
{
	public function __construct() {
		parent::__construct(
			'rb_flickr_widget', 
			__('RB Flickr Widget', 'rb'), 
			array( 'description' => __( 'Display flickr images', 'rb' ), )
		);
	}
	public function widget($args, $instance) 
	{
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$count = (int) empty($instance['count']) ? 3 : apply_filters('widget_title', $instance['count']);
		$user = empty($instance['user']) ? 3 : apply_filters('widget_title', $instance['user']);
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		echo '<div class="widget-content widget-flickr-images" data-userid="'.$user.'" data-limit="'.$count.'"><div class="row"></div></div>';
		
		echo $args['after_widget'];
	}
	public function update($new_instance, $old_instance) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		$instance['user'] = ( ! empty( $new_instance['user'] ) ) ? strip_tags( $new_instance['user'] ) : '';

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
		if ( isset( $instance[ 'user' ] ) ) {
			$user = $instance[ 'user' ];
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
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e( 'User:','rb'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo esc_attr( $user ); ?>" />
		</p>
		<?php 

	}
}
?>