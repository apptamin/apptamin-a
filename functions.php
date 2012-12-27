<?php

//
//  Custom Child Theme Functions
//

// I've included a "commented out" sample function below that'll add a home link to your menu
// More ideas can be found on "A Guide To Customizing The Thematic Theme Framework" 
// http://themeshaper.com/thematic-for-wordpress/guide-customizing-thematic-theme-framework/


// Unleash the power of Thematic's dynamic classes
// 
// define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
// define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
// define('THEMATIC_COMPATIBLE_FEEDLINKS', true);
include('mfields-opengraph-meta-tags.php');
include('library/widget-areas.php');
include 'admin/admin-guide.php';

/**
 * Removing Thematic Options Panel
 */
function remove_thematic_panel() {
  remove_action('admin_menu' , 'mytheme_add_admin');
}
add_action('init', 'remove_thematic_panel');

/* 
 * Loads the Options Panel
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether we're in a child theme or parent theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#company_showhidden').click(function() {
  		jQuery('#section-apptamin_show_logo_uploader').fadeToggle(400);
	});
	
	if (jQuery('#company_showhidden:checked').val() !== undefined) {
		jQuery('#section-apptamin_show_logo_uploader').show();
	}
	
	
	/****** TYPOGRAPHY *******/
	
	jQuery('#typography_showhidden').click(function() {
  		jQuery('#section-apptamin_typography').fadeToggle(400);
		jQuery('#section-apptamin_a_color').fadeToggle(400);
		jQuery('#section-apptamin_a_hover_color').fadeToggle(400);
		jQuery('#section-apptamin_a_visited_color').fadeToggle(400);
	});
	
	if (jQuery('#typography_showhidden:checked').val() !== undefined) {
		jQuery('#section-apptamin_typography').show();
		jQuery('#section-apptamin_a_color').show();
		jQuery('#section-apptamin_a_hover_color').show();
		jQuery('#section-apptamin_a_visited_color').show();
	}
	
	/****** BUTTONS *******/
	
	jQuery('#buttons_showhidden').click(function() {
  		jQuery('#section-apptamin_button_bg_color').fadeToggle(400);
		jQuery('#section-apptamin_button_border_color').fadeToggle(400);
		jQuery('#section-apptamin_button_font_color').fadeToggle(400);
	});
	
	if (jQuery('#buttons_showhidden:checked').val() !== undefined) {
		jQuery('#section-apptamin_button_bg_color').show();
		jQuery('#section-apptamin_button_border_color').show();
		jQuery('#section-apptamin_button_font_color').show();
	}
	
	/****** FACEBOOK LIKE *******/
	
	jQuery('#apptamin_fbbutton_showhidden_checkbox').click(function() {
  		jQuery('#section-apptamin_fbcustom_url_text').fadeToggle(400);
	});
	
	if (jQuery('#apptamin_fbbutton_showhidden_checkbox:checked').val() !== undefined) {
		jQuery('#section-apptamin_fbcustom_url_text').show();
	}
	
	/****** GOOGLE +1 *******/

        jQuery('#apptamin_pobutton_showhidden_checkbox').click(function() {
    	 jQuery('#section-apptamin_pocustom_url_text').fadeToggle(400);
        });

        if (jQuery('#apptamin_pobutton_showhidden_checkbox:checked').val() !== undefined) {
    	 jQuery('#section-apptamin_pocustom_url_text').show();
        }
	
	/****** MAILCHIMP *******/
	
	jQuery('#mailchimp_header_showhidden').click(function() {
  		jQuery('#section-apptamin_mailchimp_email_text').fadeToggle(400);
		jQuery('#section-apptamin_mailchimp_button_text').fadeToggle(400);
	});
	
	if (jQuery('#mailchimp_header_showhidden:checked').val() !== undefined) {
		jQuery('#section-apptamin_mailchimp_email_text').show();
		jQuery('#section-apptamin_mailchimp_button_text').show();
	}
	
	
	/****** FOOTER *******/
	
	jQuery('#footer_showhidden').click(function() {
  		jQuery('#section-apptamin_footer_background').fadeToggle(400);
		jQuery('#section-apptamin_footer_font_color').fadeToggle(400);
		jQuery('#section-apptamin_footer_a_color').fadeToggle(400);
		jQuery('#section-apptamin_footer_a_hover_color').fadeToggle(400);
		jQuery('#section-apptamin_footer_a_visited_color').fadeToggle(400);
	});
	
	if (jQuery('#footer_showhidden:checked').val() !== undefined) {
		jQuery('#section-apptamin_footer_background').show();
		jQuery('#section-apptamin_footer_font_color').show();
		jQuery('#section-apptamin_footer_a_color').show();
		jQuery('#section-apptamin_footer_a_hover_color').show();
		jQuery('#section-apptamin_footer_a_visited_color').show();
	}
	
});
</script>
<?php
}


if ( !function_exists( 'optionsframework_add_page' ) && current_user_can('edit_theme_options') ) {
	function apptamin_options_default() {
		add_theme_page(__('Theme Options','apptamin'), __('Theme Options','apptamin'), 'edit_theme_options', 'options-framework','optionsframework_page_notice');
	}
	add_action('admin_menu', 'apptamin_options_default');
}


/**
 * Displays a notice on the theme options page if the Options Framework plugin is not installed
 */

if ( !function_exists( 'optionsframework_page_notice' ) ) {
	function optionsframework_page_notice() { ?>
	
		<div class="wrap">
		<?php screen_icon( 'themes' ); ?>
		<h2><?php _e('Theme Options','apptaminoptions'); ?></h2>
        <p><b><?php printf( __( 'If you would like to use the Apptamin-A theme options, please download, install and activate the %s plugin.', 'apptaminoptions' ), '<a href="http://wordpress.org/extend/plugins/options-framework/">Options Framework</a>' ); ?></b></p>
        <p><?php _e('Once the plugin is activated you will have options to:','apptaminoptions'); ?></p>
        <ul class="ul-disc">
        <li><?php _e('Fill in your app informations : Name, Icon, Download links, etc.','apptaminoptions'); ?></li>
        <li><?php _e('Define the app features you want to display','apptaminoptions'); ?></li>
        <li><?php _e('Add your app demo video from Vimeo or Youtube','apptaminoptions'); ?></li>
        <li><?php _e('Define Layout and style options : AppStage Layout, Typography, Buttons and footer styles','apptaminoptions'); ?></li>
        <li><?php _e('Add social stuff like twitter, facebook and mailchimp','apptaminoptions'); ?></li>
		<li><?php _e('Define settings for your app blog','apptaminoptions'); ?></li>
		<li><?php _e('Add social stuff like twitter, facebook and mailchimp','apptaminoptions'); ?></li>
		<li><?php _e('Have info on how to customize further and add widgets','apptaminoptions'); ?></li>
        </ul>
        
        <p><?php _e('If you don\'t need these options (really ??), the plugin is not required and default settings will be used.','apptaminoptions'); ?></p>
		</div>
	<?php
	}
}


/**
 * CSS Styling from the Admin Panel Options. Will be added at the end of the head section.
 */

function apptamin_head_css() {
				
		$output = '';
		
		
		/****** BACKGROUND *******/
		
		$background='';
		$image=false;
		$bodybg=of_get_option('apptamin_background');
			if (!empty($bodybg)) {
				if($bodybg['image']!=''){
					$background.= "background-image:url('" . $bodybg['image']  . "');";
					$background.= "background-repeat:" . $bodybg['repeat']  . ";";
					$background.= "background-position:" . $bodybg['position']  . ";";
					$background.= "background-attachment:" . $bodybg['attachment']  . ";";	
					$image=true;
				}
				if($bodybg['color']!=''){
					if($image){
						$background.= "background-color:" . $bodybg['color']  . ";";
					}else{
						$background.= "background:" . $bodybg['color']  . ";";
					}
				}
				if(!empty($background)){
					$output .= "body {" . $background . "}\n";
					$output .= "body.home {" . $background . "}\n";
				}
			}
		
		$background='';
		$image=false;
		$wrapperbg=of_get_option('apptamin_wrapper_background');
			if (!empty($wrapperbg)) {
				if($wrapperbg['image']!=''){
					$background.= "background-image:url('" . $wrapperbg['image']  . "');";
					$background.= "background-repeat:" . $wrapperbg['repeat']  . ";";
					$background.= "background-position:" . $wrapperbg['position']  . ";";
					$background.= "background-attachment:" . $wrapperbg['attachment']  . ";";
					$image=true;
				}
				if($wrapperbg['color']!=''){
					if($image){
						$background.= "background-color:" . $wrapperbg['color']  . ";";
					}else{
						$background.= "background:" . $wrapperbg['color']  . ";";
					}
				}
				if(!empty($background)){
					$output .= "#wrapper {" . $background . "}\n";
				}
			}

		
		
		/****** TYPOGRAPHY *******/
		
		if (of_get_option('typography_showhidden')) {
			if (of_get_option('apptamin_typography')) {
				$typo='';
				$typography=of_get_option('apptamin_typography');
			
				$typo .= "font-size:" . $typography['size']  . ";";
				$typo .= "font-family:" . $typography['face']  . ",Arial,Tahoma,sans-serif;";
				$typo .= "font-style:" . $typography['style']  . ";";
				$typo .= "color:" . $typography['color']  . ";";
			
				$output .= "body{" . $typo . "}\n";
				$output .= "input,textarea{" . "font-family:" . $typography['face']  . ",Arial,Tahoma,sans-serif;}\n";
			}
			if (of_get_option('apptamin_a_color')) {
				$output .= "a:link {color:" . of_get_option('apptamin_a_color') . ";}\n";
			}
			if (of_get_option('apptamin_a_hover_color')) {
				$output .= "a:hover,a:active {color:" . of_get_option('apptamin_a_hover_color') . ";}\n";
			}
			if (of_get_option('apptamin_a_visited_color')) {
				$output .= "a:visited {color:" . of_get_option('apptamin_a_visited_color') . ";}\n";
			}
		}
		
		/****** BUTTONS *******/
		if (of_get_option('buttons_showhidden')) {
			$button='';
			if (of_get_option('apptamin_button_bg_color')) {
				$button .= "background-color:" . of_get_option('apptamin_button_bg_color') . ";";
			}
			if (of_get_option('apptamin_button_border_color')) {
				$button .= "border-color:" . of_get_option('apptamin_button_border_color') . ";";
			}
			if (of_get_option('apptamin_button_font_color')) {
				$button .= "color:" . of_get_option('apptamin_button_font_color') . ";";
			}
			$output .= "input.button {" . $button . "}\n";
		}
		
		/****** FOOTER *******/
		
		if (of_get_option('footer_showhidden')) {
			$footer='';
			$footer_background=of_get_option('apptamin_footer_background');
			if (!empty($footer_background)) {
				if($footer_background['color']!=''){
					$footerbg.= "background-color:" . $footer_background['color']  . ";";
				}
				if($footer_background['image']!=''){
					$footerbg.= "background-image:url('" . $footer_background['image']  . "');";
					$footerbg.= "background-repeat:" . $footer_background['repeat']  . ";";
					$footerbg.= "background-position:" . $footer_background['position']  . ";";
					$footerbg.= "background-attachment:" . $footer_background['attachment']  . ";";	
				}
			
				$footer .= $footerbg;
				$output .= "#footer {" . $footer . "}\n";
			}
			if (of_get_option('apptamin_footer_font_color')) {
				$footer .= "color:" . of_get_option('apptamin_footer_font_color') . ";";
				$output .= "#footerfont {" . $footer . "}\n";
			}
			
			
			
			if (of_get_option('apptamin_footer_a_color')) {
				$output .= "#footer a:link {color:" . of_get_option('apptamin_footer_a_color') . ";}\n";
			}
			if (of_get_option('apptamin_footer_a_hover_color')) {
				$output .= "#footer a:hover,#footer a:active {color:" . of_get_option('apptamin_footer_a_hover_color') . ";}\n";
			}
			if (of_get_option('apptamin_footer_a_visited_color')) {
				$output .= "#footer a:visited {color:" . of_get_option('apptamin_footer_a_visited_color') . ";}\n";
			}
		}
		
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
}
add_action('wp_head', 'apptamin_head_css');






/* 
 * Filter footer text
 */

function thematicoptions_footer($thm_footertext) {
	//$footertext = of_get_option('footer_text');
	$footertext = "Powered by [wp-link] & <a href='http://www.apptamin.com' title='Marketing tools for mobile applications'>Apptamin</a>.";
    return $footertext;
}

add_filter('thematic_footertext', 'thematicoptions_footer');


/** 
*	Use latest jQuery release
*/
function apptamin_scripts() {
	if( !is_admin() ){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '');
		wp_enqueue_script('jquery');
	}
	//Additional js scripts (mainly for scroller)
	wp_enqueue_script('jqfancy', get_stylesheet_directory_uri() . '/js/jqfancy.js');
}
add_action('wp_enqueue_scripts', 'apptamin_scripts');



//Ensure No problem with robots.txt (filter content)
function custom_robots($output) {
	$output = 'User-agent: *
Disallow: /cgi-bin
Disallow: /wp-admin
Disallow: /wp-includes
Disallow: /wp-content/plugins
Disallow: /wp-content/cache
Disallow: /wp-content/themes
Disallow: /trackback
Disallow: /feed
Disallow: /comments
Disallow: /category/*/*
Disallow: */trackback
Disallow: */feed
Disallow: */comments
Disallow: /*?*
Disallow: /*?
Allow: /wp-content/uploads

# Google Image
User-agent: Googlebot-Image
Disallow:
Allow: /*

# Google AdSense
User-agent: Mediapartners-Google*
Disallow:
Allow: /*

# digg mirror
User-agent: duggmirror
Disallow: /';
return $output;
}
add_filter('robots_txt','custom_robots',0);


//Adding a favicon
function apptamin_favicon() {
echo '<link rel="shortcut icon" href="'
. get_bloginfo('stylesheet_directory')
. '/images/favicon.ico"/>';
}
add_action('wp_head', 'apptamin_favicon');

//Add language variable to body classes
function extend_body_class($c) {
	$c[] = 'lang-' . ICL_LANGUAGE_CODE;
	return $c;
}
//add_filter('body_class', 'extend_body_class');



//Change menu type
function apptamin_change_menu_type() {
return 'wp_nav_menu';
}
add_filter('thematic_menu_type', 'apptamin_change_menu_type');

//Replace blog title with image or don't display blog title at all

  function remove_thematic_blogtitle() {
    remove_action( 'thematic_header', 'thematic_blogtitle', 3 );
  }
add_action( 'init', 'remove_thematic_blogtitle' );

// In the header div : defines if a company logo or name is displayed
  function apptamin_blogtitle() {
    if ( of_get_option( 'company_showhidden', 'true' )) {
		if (of_get_option( 'apptamin_show_logo_uploader' ) ){
	 ?>
	 <div id="blog-title"><a href="<?php bloginfo( 'siteurl' ); ?>/" title="<?php bloginfo( 'name' ); ?>"><img height="35" src="<?php echo of_get_option( 'apptamin_show_logo_uploader' ); ?>"/></a></div>
	 <?php
		}else{
		thematic_blogtitle();
		}
    } else{
		//do nothing if checkbox unchecked and no logo uploaded
	}
  }
add_action('thematic_header', 'apptamin_blogtitle', 3);


// In the header div
function apptamin_headersocial() {
//if(of_get_option('company_showhidden', 'false' )){
	//if(of_get_option('apptamin_show_logo', 'false' )) { ?>
		<div id="header-social">
			<?php if(of_get_option('mailchimp_header_showhidden')) { ?>
				<div class="notif">
					<!-- Begin MailChimp Signup Form -->
					<div id="mc_embed_signup">
					<form action="<?php echo of_get_option('apptamin_mailchimp_text')?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
				
								<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php echo of_get_option('apptamin_mailchimp_email_text');?>" required />
					
								<input type="submit" value="<?php echo of_get_option('apptamin_mailchimp_button_text');?>" name="subscribe" id="mc-embedded-subscribe" class="button"/>
					
					</form>
					</div>
					<!--End mc_embed_signup-->
				</div>
			<?php } ?>
				
		</div>

	<?php

}
add_action('thematic_header', 'apptamin_headersocial', 4);





// Open #branding
	// In the header div
function childtheme_override_brandingopen(){

			echo "<div id=\"branding\"><!--  test -->\n";
	}
//remove_action('thematic_header','thematic_brandingopen',1);
//add_action('thematic_header','childtheme_override_brandingopen',1);

function remove_access() {
    remove_action('thematic_header','thematic_access',9);
}
add_action('init','remove_access');
add_action('thematic_header','thematic_access',7);

//Putting the blog description after the menu from the theme
function childtheme_override_blogdescription() { 
	$blogdesc = '"blog-description">';
	//. get_bloginfo('description');
			if (is_home() || is_front_page()) { 
	        	//echo "\t\t<div id=$blogdesc</div>\n\n";
	        } else {	
	        	//echo "\t\t<div id=$blogdesc</div>\n\n";
	        }
 }
add_action('thematic_header','childtheme_override_blogdescription',8);



//On inclus la navigation � l'int�rieur de la div branding
function childtheme_override_brandingclose() { 
	echo "\t\t</div><!--  #branding -->\n";
}
remove_action('thematic_header','thematic_brandingclose',7);
//add_action('thematic_header','childtheme_override_brandingclose',10);


//add thumbnail size for blog template
add_image_size( 'blog-thumb', 200, 9999 );

//Change how posts are displayed on the blog template
function apptamin_indexloop() {
	query_posts("posts_per_page=8");

	if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID() ?>" class="<?php thematic_post_class() ?>">
	<?php thematic_postheader();?>
	<a class="thumb" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
	<?php
	the_post_thumbnail('blog-thumb');?>
	</a>

	<div class="entry-content">
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" class="more">
	<?php echo more_text() ?></a>
	</div>
	</div><!-- .post -->
	<?php endwhile; else: ?>
	<h2><?php echo _e('Oops','apptamin');?></h2>
	<p><?php echo _e('There are no posts to show!','apptamin');?></p>
	<?php endif;
	wp_reset_query();
}


//Footer divs
function change_before_widget_area($content) {
    $content=str_replace('<div id="primary" class="aside main-aside">', '<div id="primary" class="aside main-aside"><div class="side-top"></div>', $content);
	$content=str_replace('<div id="secondary" class="aside">', '<div id="footer"><div class="footer-cont" >', $content);
	return $content;
}
add_filter('thematic_before_widget_area','change_before_widget_area');

function change_after_widget_area($content) {
    $content= str_replace('</div><!-- #primary .aside -->', '<div class="side-bottom"></div></div><!-- #primary .aside -->', $content);
	$content= str_replace('</div><!-- #secondary .aside -->', '</div><!-- .footer-cont -->', $content);
	return $content;
}
add_filter('thematic_after_widget_area','change_after_widget_area');


//Including widget files for custom widgets
include(get_stylesheet_directory() . '/widgets/author-data.php');
include(get_stylesheet_directory() . '/widgets/last_tweets.php');
include(get_stylesheet_directory() . '/widgets/popular-post.php');
include(get_stylesheet_directory() . '/widgets/recent-post.php');
include(get_stylesheet_directory() . '/widgets/social-icons.php');

// Add footer Sidebar Area
function add_apptamin_footer_widgets() {
	if (is_active_sidebar('secondary')) {
		echo thematic_before_widget_area('secondary');
		dynamic_sidebar('secondary');
		echo thematic_after_widget_area('secondary');
		//footer closed after thematic_belowfooter
	}
}
add_action('thematic_footer','add_apptamin_footer_widgets');

/*
function childtheme_filter_preset_widgets( $preset_widgets ) {
	$preset_widgets = array (
		'primary-aside'  => array( 'mytestwidget-2', 'pages-2', 'categories-2', 'archives-2' ),
		'secondary-aside'  => array( 'links-2', 'rss-links-2', 'meta-2' ),
	);
	return $preset_widgets;
}
add_filter('thematic_preset_widgets','childtheme_filter_preset_widgets');

function childtheme_override_init_presetwidgets() {
		update_option( 'widget_mytestwidget', array( 2 => array( 'title' => '1st' ), '_multiwidget' => 1 ) );
		update_option( 'widget_pages', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
		update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
		update_option( 'widget_links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_rss-links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_meta', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
}
add_action( 'childtheme_override_presetwidgets', 'childtheme_override_init_presetwidgets' );

*/


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.3
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
 
 
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'WP Video Lightbox', // The plugin name
			'slug'     				=> 'wp-video-lightbox', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/library/plugins/wp-video-lightbox.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		/*,

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'BuddyPress',
			'slug' 		=> 'buddypress',
			'required' 	=> false,
		),*/

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'apptamin';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );

}



?>
