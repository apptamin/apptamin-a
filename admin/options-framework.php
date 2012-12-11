<?php
/*
Description: A framework for building theme options.
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Basic plugin definitions */

define('OPTIONS_FRAMEWORK_VERSION', '1.0');

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little extension, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'optionsframework_rolescheck' );

function optionsframework_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'optionsframework_add_page');
		add_action( 'admin_init', 'optionsframework_init' );
		add_action( 'admin_init', 'optionsframework_mlu_init' );
	}
}

/* Loads the file for option sanitization */

add_action('init', 'optionsframework_load_sanitization' );

function optionsframework_load_sanitization() {
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
}

/* 
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function optionsframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
	
	// Loads the options array from the theme
	if ( $optionsfile = locate_template( array('options.php') ) ) {
		require_once($optionsfile);
	}
	else if (file_exists( dirname( __FILE__ ) . '/options.php' ) ) {
		require_once dirname( __FILE__ ) . '/options.php';
	}
	
	$optionsframework_settings = get_option('optionsframework' );
	
	// Updates the unique option id in the database if it has changed
	optionsframework_option_name();
	
	// Gets the unique id, returning a default if it isn't defined
	if ( isset($optionsframework_settings['id']) ) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	}
	
	// If the option has no saved data, load the defaults
	if ( ! get_option($option_name) ) {
		optionsframework_setdefaults();
	}
	
	// Registers the settings fields and callback
	register_setting( 'optionsframework', $option_name, 'optionsframework_validate' );
}

/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function optionsframework_page_capability( $capability ) {
	return 'edit_theme_options';
}

/* 
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function optionsframework_setdefaults() {
	
	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */
	
	if ( isset($optionsframework_settings['knownoptions']) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option('optionsframework', $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option('optionsframework', $optionsframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = optionsframework_options();
	
	// If the options haven't been added to the database yet, they are added now
	$values = of_get_default_values();
	
	if ( isset($values) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'optionsframework_add_page' ) ) {

	function optionsframework_add_page() {
		$of_page = add_theme_page('Theme Options', __('Apptamin Theme Options','apptamin'), 'edit_theme_options', 'options-framework','optionsframework_page');
		
		// Load the required CSS and javscript
		add_action('admin_enqueue_scripts', 'optionsframework_load_scripts');
		add_action( 'admin_print_styles-' . $of_page, 'optionsframework_load_styles' );
	}
	
}

/* Loads the CSS */

function optionsframework_load_styles() {
	wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY.'css/admin-style.css');
	wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/colorpicker.css');
}	

/* Loads the javascript */

function optionsframework_load_scripts($hook) {

	if ( 'appearance_page_options-framework' != $hook )
        return;
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'js/colorpicker.js', array('jquery'));
	wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY.'js/options-custom.js', array('jquery'));
	
	// Inline scripts from options-interface.php
	add_action('admin_head', 'of_admin_head');
}

function of_admin_head() {

	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'optionsframework_page' ) ) {
	function optionsframework_page() {
		settings_errors();
?>

	<div class="wrap">
    <?php screen_icon( 'themes' ); ?>
    <h2 class="nav-tab-wrapper">
        <?php echo optionsframework_tabs(); ?>
    </h2>

    <div class="metabox-holder">
		<div id="optionsframework" class="postbox">
			<form action="options.php" method="post">
			<?php settings_fields('optionsframework'); ?>

			<?php optionsframework_fields(); /* Settings */ ?>

			<div id="optionsframework-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options' ); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!' ) ); ?>' );" />
				<div class="clear"></div>
			</div>
			</form>
		</div> <!-- / #container -->
	</div>
	
	<!-- This adds the Apptamin Admin Sidebar -->
	<div class="apptamin-admin-sidebar">
		<div class="apptamin-admin-sidebar-content">
			<a id="logo" href="http://www.apptamin.com" title="Apptamin.com"></a>
			
			<h3 id="video" class="icon"><?php _e('Get a promo video for your app !',"apptamin-admin-text-sidebar");?></h3>
			<p><?php _e('Apptamin also provides awesome app videos and app trailers, so you can show the world what your app is all about. <a href="http://www.apptamin.com/app-videos/" title="Get a video">Tempting, huh ?</a>',"apptamin-admin-text-sidebar");?></p>
		
			<h3><?php _e('Tips and Ressources',"apptamin-admin-text-sidebar");?></h3>
			<?php _e("Receive our FREE updates and monthly wrap-up and don't miss out on our theme updates, new resources and blog posts! No Spam, promise.","apptamin-admin-text-sidebar");?>
			<div class="notif">
				<!-- Begin MailChimp Signup Form -->
				<div id="mc_embed_signup">
				<form action="http://apptamin.us4.list-manage2.com/subscribe/post?u=4661ee37b391143120a66df77&amp;id=43af2f6808" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
			
							<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php echo _e('Email address','apptamin-text-mailchimp');?>" required />
				
							<input type="submit" value="<?php echo _e('Subscribe','apptamin-text-mailchimp');?>" name="subscribe" id="mc-embedded-subscribe" class="blue nice button radius" />
				
				</form>
				</div>
				<!--End mc_embed_signup-->
			</div>
			
			<h3><?php _e('Blog',"apptamin-admin-text-sidebar");?></h3>
			<p><?php _e("We blog about mobile apps marketing. Basically, we talk about our experience and all the app promotion techniques we've learned. We would love you to join the discussion (or make an interview if you're a developer), so <strong>check out our <a href='http://www.apptamin.com/blog/' title='Apptamin's Blog'>Apptamin App Marketing Blog</a></strong>!","apptamin-admin-text-sidebar");?></p>
			<p><?php _e("<a href='http://feeds.feedburner.com/apptamin' title='Apptamin RSS Feed'>Subscribe to our RSS Feed</a> and never miss a post.","apptamin-admin-text-sidebar");?><p>
			
			<h3><?php _e("We need to eat, too ;)","apptamin-admin-text-sidebar");?></h3>
			<p><?php _e("Did we save you some time ? Help us build more free wordpress themes for your apps ! Here are examples of what you can contribute :","apptamin-admin-text-sidebar");?>
				<ul>
					<li><?php _e("Baguette (yes, we're French) : $1","apptamin-admin-text-sidebar");?></li>
					<li><?php _e("Coffee : $2","apptamin-admin-text-sidebar");?></li>
					<li><?php _e("Starbucks Coffee : $5","apptamin-admin-text-sidebar");?></li>
				</ul>
			</p>
			<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
				">
				<input type="image" src="https://www.paypalobjects.com/en_US/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			<h3><?php _e("Apptamin A Theme on GitHub","apptamin-admin-text-sidebar");?></h3>
			<p><?php _e("You know what you're doing when it comes to WordPress themes and PHP? You're a designer? Check out the project on <a href='https://github.com/apptamin/apptamin-a' target='_blank'>GitHub</a> and <strong>together, let's take the theme to the next level</strong>. There are several improvements that could benefit many app developers!","apptamin-admin-text-sidebar");?></p>
		
			<h3><?php _e("Help & Support","apptamin-admin-text-sidebar");?></h3>
			<p><?php _e("This is a free theme, so <strong>support is not guaranteed</strong>. However, we want to make it the best possible, so any problem or suggestion <strong>shoot us an email at <a href='mailto:contact@apptamin.com'>contact@apptamin.com</a></strong>. It just means that if we're chilling on the beach, out partying or working (more likely ;) we probably won't stop what we're doing to answer you right away. But you WILL get a response, no matter what.","apptamin-admin-text-sidebar");?></p>
		
			<h3><?php _e("Showcase your appsite","apptamin-admin-text-sidebar");?></h3>
			<p><?php _e("We'd be glad to feature what you did with our theme on our website. <strong><a href='mailto:contact@apptamin.com'>Contact Us !</a></strong>.","apptamin-admin-text-sidebar");?></p>
		
		</div>
	</div>
</div> <!-- / .wrap -->

<?php
	}
}

/** 
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset']
 * @uses $_POST['update']
 */
function optionsframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */
	 
	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'optionsframework' ), 'updated fade' );
		return of_get_default_values();
	}

	/*
	 * Udpdate Settings.
	 */
	 
	if ( isset( $_POST['update'] ) ) {
		$clean = array();
		$options = optionsframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = '0';
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = '0';
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'optionsframework' ), 'updated fade' );
		return $clean;
	}

	/*
	 * Request Not Recognized.
	 */
	
	return of_get_default_values();
}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */
 
function of_get_default_values() {
	$output = array();
	$config = optionsframework_options();
	foreach ( (array) $config as $option ) {
		if ( ! isset( $option['id'] ) ) {
			continue;
		}
		if ( ! isset( $option['std'] ) ) {
			continue;
		}
		if ( ! isset( $option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
	}
	return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */
 
add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );

function optionsframework_adminbar() {
	
	global $wp_admin_bar;
	
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'of_theme_options',
		'title' => __( 'Theme Options' ),
		'href' => admin_url( 'themes.php?page=options-framework' )
  ));
}

if ( ! function_exists( 'of_get_option' ) ) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	 
	function of_get_option( $name, $default = false ) {
		$config = get_option( 'optionsframework' );

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
}