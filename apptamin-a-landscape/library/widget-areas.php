<?php

function my_register_sidebars() {

	/* Register the 'appwidgets' sidebar. */
	register_sidebar(
		array(
			'name' => __( 'App Widgets', 'apptamin' ),
			'id' => 'primary',
			'description' => 'Place your app widgets here : reviews, testimonials, etc.',
			'before_widget' => '<li class="app-widget-item">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	/* Register the 'footerwidgets' sidebar. */
	register_sidebar(
		array(
			'name' => __( 'Footer Widgets', 'apptamin' ),
			'id' => 'secondary',
			'description' => 'Place your footer widgets here : recent blog posts, last tweets, etc.',
			'before_widget' => '<li class="footer-bloc">',
			'after_widget' => '</li>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>'
		)
	);

	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'my_register_sidebars');

function childtheme_override_init_presetwidgets() {
		update_option( 'widget_text', array( 2 => array( 'title' => '' ,'text' => '<em>"Here you can put an awesome review from a blog about your app"</em> - <strong>Reviewsite.com</strong>'), 3 => array( 'title' => '' ,'text' => '<em>"Why not put another blog review, or maybe something from the press"</em> - <strong>Blogreview.com</strong>'),4 => array( 'title' => '' ,'text' => '<em>"People like your app, so why not let others know : put some more review !"</em> - <strong>User Review</strong>'),'_multiwidget' => 1 ) );
		update_option( 'widget_at_social_icons', array( 2 => array( 'title' => 'Social' ), '_multiwidget' => 1 ) );
		update_option( 'widget_diww_my_recent_tweets_widget', array( 2 => array( 'title' => 'Recent tweets'), '_multiwidget' => 1 ) );
		update_option( 'widget_at_recentposts_widget', array( 2 => array( 'title' => 'Recent posts' ), '_multiwidget' => 1 ) );
		update_option( 'widget_pages', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
		update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
		update_option( 'widget_links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_rss-links', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
		update_option( 'widget_meta', array( 2 => array( 'title' => ''), '_multiwidget' => 1 ) );
}
add_action( 'childtheme_override_presetwidgets', 'childtheme_override_init_presetwidgets' );

function childtheme_filter_preset_widgets( $preset_widgets ) {
	$preset_widgets = array (
		'primary-aside'  => array('search-2','categories-2', 'archives-2' ),
		'primary'  => array('text-2', 'text-3', 'text-4'),
		'secondary'  => array('at_recentposts_widget-2','at_social_icons-2', 'diww_my_recent_tweets_widget-2')
		);
	return $preset_widgets;
}
add_filter('thematic_preset_widgets','childtheme_filter_preset_widgets');

/*
function preset_child_widgets() {
	$child_preset_widgets = array (
		'primary'  => array( 'meta-2', 'meta')

	);
return $child_preset_widgets;
}
add_filter('thematic_preset_widgets','preset_child_widgets' );*/



/*********** Removing uneeded (and unstyled) widget areas ***********/
function remove_widget_areas($content) {
	unset($content['Secondary Aside']);
	unset($content['Index Insert']);
	//unset($content['Single Insert']);
	unset($content['Index Top']);
	unset($content['Index Bottom']);
	//unset($content['Single Top']);
	//unset($content['Single Bottom']);
	unset($content['Page Top']);
	unset($content['Page Bottom']);
	unset($content['1st Subsidiary Aside']);
	unset($content['2nd Subsidiary Aside']);
	unset($content['3rd Subsidiary Aside']);
	return $content;
}
add_filter('thematic_widgetized_areas', 'remove_widget_areas');

// Renaming and Changing Functionality

function rename_widgetized_areas($content) {
	$content['Primary Aside']['args']['name'] = __('Sidebar','apptamin');
	//$content['Secondary Aside']['args']['name'] = 'Page Sidebar';
	//$content['Secondary Aside']['args']['description'] = 'This widget area appears on pages but not posts.';
	/*$content['1st Subsidiary Aside']['args']['name'] = 'Footer First';
	$content['2nd Subsidiary Aside']['args']['name'] = 'Footer Second';
	$content['3rd Subsidiary Aside']['args']['name'] = 'Footer Third';
	$content['Secondary Aside']['function'] = 'childtheme_secondary_aside';*/
	return $content;
}
add_filter('thematic_widgetized_areas', 'rename_widgetized_areas');


?>