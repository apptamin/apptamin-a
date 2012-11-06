<?php
/*
Plugin Name: Apptamin Recent Tweets
Plugin URI: http://www.apptamin.com/
Description: Displays your recent tweets in a sidebar widget
Version: 0.1
Author: Sylvain Gauchet
Author URI: http://www.apptamin.com
License: GPL2
*/


// Start class diww_my_recent_tweets_widget //

	class diww_my_recent_tweets_widget extends WP_Widget {

// Constructor //

	function diww_my_recent_tweets_widget() {
		$widget_ops = array( 'classname' => 'diww_my_recent_tweets_widget', 'description' => 'Displays your recent tweets using the Twitter profile tool' ); // Widget Settings
		$control_ops = array( 'id_base' => 'diww_my_recent_tweets_widget' ); // Widget Control Settings
		$this->WP_Widget( 'diww_my_recent_tweets_widget', 'Apptamin - Recent Tweets', $widget_ops, $control_ops ); // Create the widget
	}

// Extract Args //

		function widget($args, $instance) {
			extract( $args );
			$title 		= apply_filters('widget_title', $instance['title']); // the widget title
			$tweetnumber 	= $instance['tweet_number']; // the number of tweets to show
			$twitterusername 	= $instance['twitter_username']; // the type of posts to show
			$shellbg	= $instance['shell_bg']; // Shell background color
			$shellcolor 	= $instance['shell_color']; // Shell text color
			$tweetsbg 	= $instance['tweets_bg']; // Tweets background color
			$tweetscolor 	= $instance['tweets_color']; // Tweets text color
			$tweetslinks 	= $instance['tweets_links']; // Tweets links color
			$hashtags   = isset($instance['hashtags']) ? $instance['hashtags'] : false ; // whether or not to show hashtags
			$timestamp   = isset($instance['timestamp']) ? $instance['timestamp'] : false ; // whether or not to show timestamp
			$avatars   = isset($instance['avatars']) ? $instance['avatars'] : false ; // whether or not to show avatars

// Before widget //

		echo $before_widget;

// Title of widget //

		if ( $title ) { echo $before_title . $title . $after_title; }

// Widget output //

		?>
		<script src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
				version: 2,
				type: 'profile',
				rpp: <?php echo $tweetnumber; ?>,
				interval: 6000,
				width: 'auto',
				height: 'auto',
				theme: {
					shell: {
						background: '<?php echo $shellbg; ?>',
						color: '<?php echo $shellcolor; ?>'
					},
					tweets: {
						background: '<?php echo $tweetsbg; ?>',
						color: '<?php echo $tweetscolor; ?>',
						links: '<?php echo $tweetslinks; ?>'
					}
				},
				features: {
					scrollbar: false,
					loop: false,
					live: true,
					<?php if ($hashtags) {
						echo 'hashtags: true,';
					}
					else {
						echo 'hashtags: false,';
					}
					if ($timestamp) {
						echo 'timestamp: true,';
					}
					else {
						echo 'timestamp: false,';
					}
					if ($avatars) {
						echo 'avatars: true,';
					}
					else {
						echo 'avatars: false,';
					} ?>
					behavior: 'all'
  				}
			}).render().setUser('<?php echo $twitterusername; ?>').start();
			</script>
			<?php

// After widget //

		echo $after_widget;
		}

// Update Settings //

 		function update($new_instance, $old_instance) {
 			$instance['title'] = ($new_instance['title']);
 			$instance['tweet_number'] = ($new_instance['tweet_number']);
 			$instance['twitter_username'] = ($new_instance['twitter_username']);
 			$instance['shell_bg'] = ($new_instance['shell_bg']);
 			$instance['shell_color'] = ($new_instance['shell_color']);
 			$instance['tweets_bg'] = ($new_instance['tweets_bg']);
 			$instance['tweets_color'] = ($new_instance['tweets_color']);
 			$instance['tweets_links'] = ($new_instance['tweets_links']);
 			$instance['hashtags'] = ($new_instance['hashtags']);
 			$instance['timestamp'] = ($new_instance['timestamp']);
 			$instance['avatars'] = ($new_instance['avatars']);
 			return $instance;
 		}

// Widget Control Panel //

 		function form($instance) {?>	
		
		<?php
 		$defaults = array( 'title' => 'Apptamin Recent Tweets', 'tweet_number' => 3, 'twitter_username' => '', 'shell_bg' => '#222', 'shell_color' => '#fff', 'tweets_bg' => '#111', 'tweets_color' => '#f5f5f5', 'tweets_links' => '#2a85e8', 'hashtags' => 'on', 'timestamp' => 'on', 'avatars' => false );
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

 		<p>
 			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','apptamin-widgets-text');?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweet_number'); ?>"><?php _e('Number of tweets to display','apptamin-widgets-text'); ?></label>
 			<input id="<?php echo $this->get_field_id('tweet_number'); ?>" name="<?php echo $this->get_field_name('tweet_number'); ?>" type="text" value="<?php echo $instance['tweet_number']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter username','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $instance['twitter_username']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('shell_bg'); ?>"><?php _e('Shell background color','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('shell_bg'); ?>" name="<?php echo $this->get_field_name('shell_bg'); ?>" type="text" value="<?php echo $instance['shell_bg']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('shell_color'); ?>"><?php _e('Shell text color','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('shell_color'); ?>" name="<?php echo $this->get_field_name('shell_color'); ?>" type="text" value="<?php echo $instance['shell_color']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweets_bg'); ?>"><?php _e('Tweets background color','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('tweets_bg'); ?>" name="<?php echo $this->get_field_name('tweets_bg'); ?>" type="text" value="<?php echo $instance['tweets_bg']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweets_color'); ?>"><?php _e('Tweets text color','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('tweets_color'); ?>" name="<?php echo $this->get_field_name('tweets_color'); ?>" type="text" value="<?php echo $instance['tweets_color']; ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('tweets_links'); ?>"><?php _e('Tweets links color','apptamin-widgets-text'); ?></label>
 			<input class="widefat" id="<?php echo $this->get_field_id('tweets_links'); ?>" name="<?php echo $this->get_field_name('tweets_links'); ?>" type="text" value="<?php echo $instance['tweets_links']; ?>" />
 		</p>
		<p>
			<label for="<?php echo $this->get_field_id('hashtags'); ?>"><?php _e('Show hashtags?','apptamin-widgets-text'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['hashtags'], 'on' ); ?> id="<?php echo $this->get_field_id('hashtags'); ?>" name="<?php echo $this->get_field_name('hashtags'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('timestamp'); ?>"><?php _e('Show timestamp?','apptamin-widgets-text'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['timestamp'], 'on' ); ?> id="<?php echo $this->get_field_id('timestamp'); ?>" name="<?php echo $this->get_field_name('timestamp'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('avatars'); ?>"><?php _e('Show avatars?','apptamin-widgets-text'); ?></label>
            <input type="checkbox" class="checkbox" <?php checked( $instance['avatars'], 'on' ); ?> id="<?php echo $this->get_field_id('avatar'); ?>" name="<?php echo $this->get_field_name('avatars'); ?>" />
		</p>
        <?php }

}

// End class diww_my_recent_tweets_widget

//add_action('widgets_init', create_function('', 'return register_widget("diww_my_recent_tweets_widget");'));
register_widget("diww_my_recent_tweets_widget");

?>