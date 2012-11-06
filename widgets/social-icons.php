<?php
class At_Social_Icon_Widget extends WP_Widget {
	function At_Social_Icon_Widget() {
		$widget_ops = array(
		'description' => 'A widget that displays your social icons.'
		);
		$this->WP_Widget('at_social_icons', 'Apptamin - Social Icons', $widget_ops);
	}


	function form($instance) {

		$title = esc_attr($instance['title']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ','apptamin-widgets-text'); ?>
				<input class="widefat"
					id="<?php echo $this->get_field_id('title'); ?>"
					name="<?php echo $this->get_field_name('title'); ?>"
					type="text"
					value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter username :','apptamin-widgets-text'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $instance['twitter']; ?>" /></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fb'); ?>"><?php _e('Facebook fan page (full URL):','apptamin-widgets-text'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="text" value="<?php echo $instance['fb']; ?>" /></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Google + page (full URL):','apptamin-widgets-text'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo $instance['gplus']; ?>" /></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS feed (full URL) :','apptamin-widgets-text'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $instance['rss']; ?>" /></label>
		</p>
		
		
		<?php

	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = ($new_instance['twitter']);
		$instance['fb'] = ($new_instance['fb']);
		$instance['gplus'] = ($new_instance['gplus']);
		$instance['rss'] = ($new_instance['rss']);
		return $instance;
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', $instance['title']);
		$twitterusername = $instance['twitter'];
		$fbfanpage = $instance['fb'];
		$gpluspage = $instance['gplus'];
		$rssfeed = $instance['rss'];
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

?>

		<ul class="social">

<?php
			if (!empty($twitterusername)) {
?>
				<li>
					<a class="fol" title="Follow us on Twitter" href="<?php echo "http://twitter.com/".$twitterusername;?>" target="_blank">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_twitter.png" alt="Twitter" />
					</a>
				</li>
<?php
			}

			if (!empty($fbfanpage)) {
?>
				<li>
					<a class="fol" title="Join us on Facebook" href="<?php echo $fbfanpage;?>" target="_blank">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_facebook.png" alt="Facebook" />
					</a>
				</li>
<?php
			}
			
			if (!empty($gpluspage)) {
?>
				<li>
					<a class="fol" title="Our Google + Page" href="<?php echo $gpluspage;?>" target="_blank">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_google.png" alt="Facebook" />
					</a>
				</li>
<?php
			}
			
			if (!empty($rssfeed)) {
?>
				<li id="last">
					<a class="fol" title="RSS" href="<?php echo $rssfeed;?>" target="_blank">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_rss.png" alt="Flux rss" />
					</a>
				</li>
<?php
			}
?>
			

		</ul>

<?php
		echo $after_widget;
	}
}


register_widget('At_Social_Icon_Widget');
?>