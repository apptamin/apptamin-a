<?php
class At_Author_Data_Widget extends WP_Widget {
	function At_Author_Data_Widget() {
		$widget_ops = array(
		'description' => 'A widget that displays author info on single posts.'
		);
		$this->WP_Widget('at_author_data', 'Apptamin - Author Data', $widget_ops);
	}


	function form($instance) {

		$title = esc_attr($instance['title']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:
				<input class="widefat"
					id="<?php echo $this->get_field_id('title'); ?>"
					name="<?php echo $this->get_field_name('title'); ?>"
					type="text"
					value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<?php

	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		if (is_single()) {
		echo $before_widget;
		$title = apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<div class="author-data">';
		echo get_avatar(get_the_author_meta('user_email'), 150);
		echo '<h4>' . the_author_meta('display_name') . '</h4>';
		// Is there an author description?
		if (get_the_author_meta('description')) {
		echo '<div class="description"><p>'
		. get_the_author_meta('description')
		. '</p></div>';
		}
		echo '</div>';
		echo $after_widget;
		}
	}
}
register_widget('At_Author_Data_Widget');
?>