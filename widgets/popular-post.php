<?php
class At_PopularPost_Widget extends WP_Widget {

	function At_PopularPost_Widget() {
		$widget_ops = array(
		'description' => __('A widget for your footer that displays the most popular posts','apptamin')
		);
		parent::WP_Widget(false, 'Apptamin - Footer Popular Posts');
	}
	
	function form($instance) {
		$title = esc_attr($instance['title']);
		?>
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','apptamin-widgets-text'); ?> 
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
				</p>
		<?php
		$count = esc_attr($instance['count']);
		?>
				<p>
					<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of popular posts to display:','apptamin-widgets-text'); ?> 
					<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3"/></label>
				</p>
		<?php
		?>
				<p>
					<input class="checkbox" type="checkbox" <?php checked( $instance['show_comments'], on ); ?> id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>" />
					<label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e('Display Comments ?','apptamin-widgets-text');?></label>
				</p>
		<?php }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['show_comments'] = $new_instance['show_comments'];
		return $instance;
	}
	
	function widget($args, $instance) {
		$args['title'] = $instance['title'];
		$args['count'] = $instance['count'];
		$args['show_comments'] = $instance['show_comments'];
		At_PopularPost($args);
	}
}

function At_PopularPost($args = array(), $interval = '') {

	global $wpdb;

	
	if (!isset($args['count'])) {
		$args['count'] = '3';
	}
	
	$postCount = $args['count'];
	
	$show_comments = isset( $args['show_comments'] ) ? $args['show_comments'] : false;
	

	$request = 'SELECT *
		FROM ' . $wpdb->posts . '
		WHERE ';

	if ($interval != '') {
		$request .= 'post_date>DATE_SUB(NOW(), ' . $interval . ') ';
	}

	$request .= 'post_status="publish"
			AND comment_count > 0
		ORDER BY comment_count DESC LIMIT 0, ' . $postCount;

	$posts = $wpdb->get_results($request);

	if (count($posts) >= 1) {

		if (!isset($args['title'])) {
			$args['title'] = 'Popular Posts';
		}

		foreach ($posts as $post) {
			wp_cache_add($post->ID, $post, 'posts');
			$popularPosts[] = array(
				'title' => stripslashes($post->post_title),
				'url' => get_permalink($post->ID),
				'comment_count' => $post->comment_count,
			);
		}

		echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
?>

		<ul class="blog">
<?php
		foreach ($popularPosts as $post) {
?>
			<li>
				<a href="<?php echo $post['url'];?>"><?php echo _e($post['title']); ?></a>
<?php
				if ($show_comments) {
?>
				<?php echo '<br/>('.$post['comment_count'] . ' ' . __('comments', 'apptamin-widgets-text').')'; ?>
<?php
				}
?>
			</li>
<?php
		}
?>
		</ul>

<?php
		echo $args['after_widget'];
	}
}
register_widget('At_PopularPost_Widget');

?>
