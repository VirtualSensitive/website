<?php
/*
Plugin Name: RenkliBeyaz Twitter Widget
Description: This widget bundle of a theme on Themeforest.net
Version: 1.0
Author: RenkliBeyaz
Author URI: http://themeforest.net/user/RenkliBeyaz
*/
add_action('widgets_init','rb_twitter_widget_register');
function rb_twitter_widget_register()
{
	register_widget('rb_twitter_widget');
}
class rb_twitter_widget extends WP_Widget 
{
	public function __construct() {
		parent::__construct(
			'rb_twitter_widget', 
			__('RB Twitter Widget', 'rb'), 
			array( 'description' => __( 'Display tweets', 'rb' ), )
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
		
		echo '<div class="twitter-box" data-limit="'.$count.'" data-user="'.$user.'">
					<div class="twitter-holder">
						<div class="b">
							<div class="tweets-container" id="tweets_">
								<ul id="jtwt">
									<li class="jtwt_tweet">
										<p class="jtwt_tweet_text">
											'.__('Tweets are loading...', 'rb').'
										</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<span class="arrow"></span>
			</div>';
		
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