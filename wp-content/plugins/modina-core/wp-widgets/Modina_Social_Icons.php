<?php

class Modina_Social_Icons extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname'      				=> 'social_icons_link',
			'description'      				=> __('This is a social icon widgets.'),
			'customize_selective_refresh' 	=> true,
		);
		
		parent::__construct( 'social-page-link', esc_html__( '(Dustrix) Social Icons Link', 'modina-core' ), $widget_ops );
	}

	public function widget($args, $instance) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Never Miss News', 'modina-core' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$f_link   		= !empty( $instance['facebook_link'] ) ? $instance['facebook_link'] : '';
		$t_link   		= !empty( $instance['twitter_link'] ) ? $instance['twitter_link'] : '';
		$lin_link 		= !empty( $instance['instragram_link'] ) ? $instance['instragram_link'] : '';
		$y_link   		= !empty( $instance['youtube_link'] ) ? $instance['youtube_link'] : '';
		$d_link   		= !empty( $instance['dribble_link'] ) ? $instance['dribble_link'] : '';
		$in_link   		= !empty( $instance['linkedin_link'] ) ? $instance['linkedin_link'] : '';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
    ?>

		<div class="social-link">
			<?php if(!empty($f_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($f_link); ?>"><i class="fab fa-facebook-f"></i></a>
			<?php endif; ?>
			<?php if(!empty($lin_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($lin_link); ?>"><i class="fab fa-instagram"></i></a>
			<?php endif; ?>
			<?php if(!empty($t_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($t_link); ?>"><i class="fab fa-twitter"></i></a>
			<?php endif; ?>
			<?php if(!empty($y_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($y_link); ?>"><i class="fab fa-youtube"></i></a>
			<?php endif; ?>
			<?php if(!empty($d_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($d_link); ?>"><i class="fab fa-dribbble"></i></a>
			<?php endif; ?>
			<?php if(!empty($in_link)) : ?>
			<a target="_blank" href="<?php echo esc_url($in_link); ?>"><i class="fab fa-linkedin-in"></i></a>
			<?php endif; ?>
		</div>

	<?php echo $args['after_widget'];
	}

	public function form($instance) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$facebook_link   	= !empty( $instance['facebook_link'] ) ? $instance['facebook_link'] : '';
		$twitter_link   	= !empty( $instance['twitter_link'] ) ? $instance['twitter_link'] : '';
		$instragram_link 	= !empty( $instance['instragram_link'] ) ? $instance['instragram_link'] : '';
		$youtube_link   	= !empty( $instance['youtube_link'] ) ? $instance['youtube_link'] : '';
		$dribble_link   	= !empty( $instance['dribble_link'] ) ? $instance['dribble_link'] : '';
		$linkedin_link   	= !empty( $instance['linkedin_link'] ) ? $instance['linkedin_link'] : '';
	?>
	
	<div class="website_fields" style="padding-top: 15px">
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Widget Title:', 'modina-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
	</div>

	<p>
		<label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Facebook Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('facebook_link'); ?>" value="<?php echo esc_url( $facebook_link); ?>" id="<?php echo $this->get_field_id('facebook_link'); ?>" class="widefat">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e('Twitter Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo esc_url($twitter_link); ?>" id="<?php echo $this->get_field_id('twitter_link'); ?>" class="widefat">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('instragram_link'); ?>"><?php _e('Instagram Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('instragram_link'); ?>" value="<?php echo esc_url($instragram_link); ?>" id="<?php echo $this->get_field_id('instragram_link'); ?>" class="widefat">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('youtube_link'); ?>"><?php _e('Youtube Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('youtube_link'); ?>" value="<?php echo esc_url($youtube_link); ?>" id="<?php echo $this->get_field_id('youtube_link'); ?>" class="widefat">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php _e('LinkedIn Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo esc_url($linkedin_link); ?>" id="<?php echo $this->get_field_id('linkedin_link'); ?>" class="widefat">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('dribble_link'); ?>"><?php _e('Dribble Link', 'modina-core'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('dribble_link'); ?>" value="<?php echo esc_url($dribble_link); ?>" id="<?php echo $this->get_field_id('dribble_link'); ?>" class="widefat">
	</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['facebook_link'] = sanitize_url( $new_instance['facebook_link'] );
		$instance['twitter_link'] = sanitize_url( $new_instance['twitter_link'] );
		$instance['instragram_link'] = sanitize_url( $new_instance['instragram_link'] );
		$instance['youtube_link'] = sanitize_url( $new_instance['youtube_link'] );
		$instance['linkedin_link'] = sanitize_url( $new_instance['linkedin_link'] );
		$instance['dribble_link'] = sanitize_url( $new_instance['dribble_link'] );
		
		return $instance;
	}


}