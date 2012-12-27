<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Radio data
	//$smartphones_array = array("iphone" => "iphone","android" => "android");
	$smartphones_array = array("none" => "None", "iphone" => "iPhone 4S", "iphone5" => "iPhone 5", "android" =>"Android (Galaxy S2)", "android2" => "Android (Galaxy S3)");
	$devices_front_array = array("none" => "None", "iphone4S" => "iPhone 4S", "iphone5" => "iPhone 5", "androidS2" =>"Android (Samsung Galaxy S2)", "androidS3" => "Android (Samsung Galaxy S3)");
	$devices_back_array = $devices_front_array;

	// Multicheck Array
	$multicheck_array = array("one" => "iTunes Store", "two" => "Google Play (Android Market)");

	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","two" => "1");

	// Background Defaults

	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';

	$options = array();

	/**** =App Settings ****/	
	
	$options[] = array( "name" => "App",
		"type" => "heading");

	$options[] = array( "name" => "APP INFORMATIONS",
		"desc" => "These options will let you define your app name, icon and description",
		"type" => "info",
		"class" => "special first");
	
	$options[] = array( "name" => "App Name",
		"desc" => "Put here your app name",
		"id" => "appname_text",
		"std" => "Your app name",
		"type" => "text");
	
	$options[] = array( "name" => "App Icon",
		"desc" => "Upload your app icon. We recommend a 100x100 icon.",
		"id" => "app_icon_uploader",
		"type" => "upload");
	
	
	$options[] = array( 
		"desc" => "Put here the link you want to use on your app icon, if any",
		"id" => "app_icon_link_text",
		"std" => "",
		"type" => "text");
		
	$options[] = array( "name" => "App Description",
		"desc" => "This is where you explain what your app does. You can use basic HTML stuff.",
		"id" => "app_description_textarea",
		"std" => "Your app Description goes here. Put your elevator pitch describing what the app does, who it is for and what differentiates it. Don't be too long though ;)",
		"type" => "textarea");
	
	$options[] = array( "name" => "Pre-launch MODE",
		"desc" => "This option will let you have a subscription form to your mailchimp newsletter that your visitors can subscribe to in order to be notified when your app launches. For your mailchimp settings, go to the 'Social Settings' tab.",
		"type" => "info",
		"class" => "special");
	
	$options[] = array(
		"desc" => "Check the box if you want to have a mailchimp newsletter subscription form. *** Important *** : it will override the App Supported OS options below.",
		"id" => "app_launch_newsletter_checkbox",
		"std" => "false",
		"type" => "checkbox");
	
	$options[] = array( "name" => "APP SUPPORTED OS",
		"desc" => "These options will let you define for which appstores your app is available on by adding links to download the apps. If left blank, the smartphone and download buttons will not appear.",
		"type" => "info",
		"class" => "special");
		
	$options[] = array( "name" => "iTunes Store (iOS)",
		"desc" => "Check the box if you have an iPhone app (will display download button)",
		"id" => "app_itunes_store_checkbox",
		"std" => "true",
		"type" => "checkbox");
	
	$options[] = array( 
		"desc" => "Put here the link towards your app page on the iTunes Store. If left blank, no 'Available on the App Store' button will show on the AppStage",
		"id" => "app_itunes_store_text",
		"std" => "",
		"type" => "text");
		
	$options[] = array( "name" => "Google Play (Android)",
		"desc" => "Check the box if you have an Android app (will display download button).",
		"id" => "app_android_store_checkbox",
		"std" => "true",
		"type" => "checkbox");
	
	$options[] = array( 
		"desc" => "Put here the link towards your app page on the Google Play store (Android Market). If left blank, no Android Smartphone and no 'Download for Android' button will show on the AppStage",
		"id" => "app_android_store_text",
		"std" => "",
		"type" => "text");
		
	
	/**** =AppStage Settings ****/		
	
	
	$options[] = array( "name" => "AppStage",
		"type" => "heading");
	
	$options[] = array("name" => "APPSTAGE LAYOUT",
		"desc" => "These options will let you define how the AppStage looks like. The AppStage is the zone just below the header, where you should put the most important information.",
		"type" => "info",
		"class" => "special first");
	
	$options[] = array( "name" => "Smartphone(s) on the left/right",
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear for the AppStage (the Appstage is the area where main app info is displayed).",
		"id" => "appstage_images",
		"std" => "",
		"type" => "images",
		"options" => array(
			'' => $imagepath . 'phone_left.png',
			'app-content-left' => $imagepath . 'phone_right.png')
	);
	
		
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
		
			
	$options[] = array( "name" => "App Screenshot (front device)",
		"desc" => "Upload your app screenshot for the front device. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "app_screenshot_1_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "App Screenshot (back device - not needed if 'none' selected as back device)",
		"desc" => "Upload your app screenshot for the back device. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "app_screenshot_2_uploader",
		"type" => "upload");

		
		
	/**** =App Features Settings ****/	
		
	$options[] = array( "name" => "App Features",
		"type" => "heading");

	$options[] = array(
		"desc" => "These options will let you define the app features you want to highlight. If you don't need that many, just don't check the boxes !",
		"type" => "info",
		"class" => "special first");
	
	
	/* Feature #1 */	
	$options[] = array( "name" => "Feature #1",
		"desc" => "Check the box if you want this feature to be displayed",
		"id" => "feature_1_checkbox",
		"type" => "checkbox",
		"class" => "special first");
	
	$options[] = array(
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear",
		"id" => "feature_1_images",
		"std" => "imgleft",
		"type" => "images",
		"options" => array(
			'imgleft' => $imagepath . 'phone_left.png',
			'imgright' => $imagepath . 'phone_right.png')
	);
	
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "feature_1_devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "feature_1_devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
		
	$options[] = array(
		"desc" => "Put the feature name here. Try to be as catchy and understandable as possible : no technical stuff.",
		"id" => "feature_1_text",
		"std" => "An awesome feature #1",
		"type" => "text");
		
	$options[] = array( "name" => "",
		"desc" => "Explain feature #1",
		"id" => "feature_1_textarea",
		"std" => "That's where you explain your first feature. You can put some technical stuff here. You can use basic HTML tags.",
		"type" => "textarea");
	
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the front device for Feature #1. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_1_screenshot_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the back device for Feature #1. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_1_back_screenshot_uploader",
		"type" => "upload");
	
	/* Feature #2 */	
	$options[] = array( "name" => "Feature #2",
		"desc" => "Check the box if you want this feature to be displayed",
		"id" => "feature_2_checkbox",
		"type" => "checkbox",
		"class" => "special");
	
	$options[] = array(
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear",
		"id" => "feature_2_images",
		"std" => "imgleft",
		"type" => "images",
		"options" => array(
			'imgleft' => $imagepath . 'phone_left.png',
			'imgright' => $imagepath . 'phone_right.png')
	);
	
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "feature_2_devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "feature_2_devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
		
	$options[] = array( "name" => "",
		"desc" => "Put the feature name. Try to be as catchy and understandable as possible : no technical stuff.",
		"id" => "feature_2_text",
		"std" => "An awesome feature #2",
		"type" => "text");
		
	$options[] = array( "name" => "",
		"desc" => "Explain feature #2",
		"id" => "feature_2_textarea",
		"std" => "That's where you explain your second feature. You can put some technical stuff here. You can use basic HTML tags.",
		"type" => "textarea");
	
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the front device for Feature #2. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_2_screenshot_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the back device for Feature #2. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_2_back_screenshot_uploader",
		"type" => "upload");
	
	/* Feature #3 */	
	$options[] = array( "name" => "Feature #3",
		"desc" => "Check the box if you want this feature to be displayed",
		"id" => "feature_3_checkbox",
		"type" => "checkbox",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear",
		"id" => "feature_3_images",
		"std" => "imgleft",
		"type" => "images",
		"options" => array(
			'imgleft' => $imagepath . 'phone_left.png',
			'imgright' => $imagepath . 'phone_right.png')
	);
		
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "feature_3_devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "feature_3_devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
	
	$options[] = array( "name" => "",
		"desc" => "Put the feature name. Try to be as catchy and understandable as possible : no technical stuff.",
		"id" => "feature_3_text",
		"std" => "An awesome feature #3",
		"type" => "text");
		
	$options[] = array( "name" => "",
		"desc" => "Explain feature #3",
		"id" => "feature_3_textarea",
		"std" => "That's where you explain your third feature. You can put some technical stuff here. You can use basic HTML tags.",
		"type" => "textarea");
	
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the front device for Feature #3. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_3_screenshot_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the back device for Feature #3. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_3_back_screenshot_uploader",
		"type" => "upload");
	
	/* Feature #4 */	
	$options[] = array( "name" => "Feature #4",
		"desc" => "Check the box if you want this feature to be displayed",
		"id" => "feature_4_checkbox",
		"type" => "checkbox",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear",
		"id" => "feature_4_images",
		"std" => "imgleft",
		"type" => "images",
		"options" => array(
			'imgleft' => $imagepath . 'phone_left.png',
			'imgright' => $imagepath . 'phone_right.png')
	);
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "feature_4_devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "feature_4_devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
	
	$options[] = array( "name" => "",
		"desc" => "Put the feature name. Try to be as catchy and understandable as possible : no technical stuff.",
		"id" => "feature_4_text",
		"std" => "An awesome feature #4",
		"type" => "text");
		
	$options[] = array( "name" => "",
		"desc" => "Explain feature #4",
		"id" => "feature_4_textarea",
		"std" => "That's where you explain your fourth feature. You can put some technical stuff here. You can use basic HTML tags.",
		"type" => "textarea");
	
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the front device for Feature #4. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_4_screenshot_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the back device for Feature #4. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_4_back_screenshot_uploader",
		"type" => "upload");
	
	/* Feature #5 */	
	$options[] = array( "name" => "Feature #5",
		"desc" => "Check the box if you want this feature to be displayed",
		"id" => "feature_5_checkbox",
		"type" => "checkbox",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Choose on which side you want the smartphone(s) and screenshot(s) to appear",
		"id" => "feature_5_images",
		"std" => "imgleft",
		"type" => "images",
		"options" => array(
			'imgleft' => $imagepath . 'phone_left.png',
			'imgright' => $imagepath . 'phone_right.png')
	);
		
	$options[] = array( "name" => "Front Device",
		"desc" => "Choose the device you want in the front.",
		"id" => "feature_5_devices_front_radio",
		"std" => "iphone5",
		"type" => "radio",
		"options" => $devices_front_array);	
		
	$options[] = array(
		"desc" => "We don't recommend mixing iPhone 4S and iPhone 5. It doesn't make sense AND the position of the phones won't look that good.",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Back Device",
		"desc" => "Choose the device you want in the back.",
		"id" => "feature_5_devices_back_radio",
		"std" => "none",
		"type" => "radio",
		"options" => $devices_back_array);
		
	$options[] = array( "name" => "",
		"desc" => "Put the feature name. Try to be as catchy and understandable as possible : no technical stuff.",
		"id" => "feature_5_text",
		"std" => "An awesome feature #5",
		"type" => "text");
		
	$options[] = array( "name" => "",
		"desc" => "Explain feature #5",
		"id" => "feature_5_textarea",
		"std" => "That's where you explain your fifth feature. You can put some technical stuff here. You can use basic HTML tags.",
		"type" => "textarea");
	
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the front device for Feature #5. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_5_screenshot_uploader",
		"type" => "upload",
		"class" => "recommended");
		
	$options[] = array( "name" => "",
		"desc" => "Upload your app screenshot for the back device for Feature #5. We recommend .jpg files with the following sizes : iPhone 4S (186px*279px), iPhone 5(185px*328px), Samsung Galaxy S2 (186px*310px), Samsung Galaxy S3 (192px*341px).",
		"id" => "feature_5_back_screenshot_uploader",
		"type" => "upload");
	
	/**** =Video Settings ****/		
		
	$options[] = array( "name" => "Video",
		"type" => "heading");
		
	$options[] = array( "name" => "VIDEO INFORMATIONS",
		"desc" => "These options will let you define the video settings. Video is a great way to show how your app works, either by using a demo video or a simple screencast. If you want a great-looking video, contact us at contact@apptamin.com to talk about it !",
		"type" => "info",
		"class" => "special first");
		
	
	$options[] = array( "name" => "YouTube / Vimeo video",
		"desc" => "Put the youtube or vimeo link for the video you want to use. Leave blank if you don't have one. Example : http://vimeo.com/23969939 or http://www.youtube.com/watch?v=qK84v-TQRf8. Note : Don't put 'https' links",
		"id" => "video_text",
		"std" => "",
		"type" => "text");
		
	$options[] = array(
		"desc" => "*** Important *** For the popup video to work, you will need to install and activate the WP Video LightBox plugin. One-click install from the 'Install Plugins' section of the Appearance Menu.",
		"type" => "info",
		"class" => "special");
		
	$options[] = array( "name" => "Video Thumbnail",
		"desc" => "This is the thumbnail that shows up on the app stage and that people need to click on to play the video. Recommended size: 150px*115px.",
		"id" => "video_thumbnail_uploader",
		"type" => "upload");
		
	$options[] = array( "name" => "Video Thumbnail Text",
		"desc" => "Put here the text you want to display under the video thumbnail, if any.",
		"id" => "video_thumbnail_text",
		"std" => "Video : discover the app",
		"type" => "text");
	
	/**** =Style Settings ****/		
		
	$options[] = array( "name" => "Style",
		"type" => "heading");
		
	$options[] = array( "name" => "FAVICON and backgrounds",
		"desc" => "To change the website favicon, replace the favicon.ico file in the images/ folder by yours. We recommend a 24px*24px favicon.",
		"type" => "info",
		"class" => "special first");
	
	$options[] = array( "name" =>  "Body background",
		"desc" => "Change the background CSS. Choose a color, or click the button to add a background image (options will appear once the image is uploaded).",
		"id" => "apptamin_background",
		"std" => $background_defaults,
		"type" => "background");
		
	$options[] = array( "name" =>  "Wrapper background",
		"desc" => "Change the wrapper CSS. This lets you add a background on top of the body background. For example, a picture with a 635px height will get you just under the app stage.",
		"id" => "apptamin_wrapper_background",
		"std" => $background_defaults,
		"type" => "background");
	
	$options[] = array( "name" => "COMPANY NAME OR LOGO",
		"desc" => "These options will let you display the blog title or a logo",
		"type" => "info",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Check if you want to display a Company Name or Logo. If not checked, nothing will appear.",
		"id" => "company_showhidden",
		"type" => "checkbox");

	$options[] = array( 
		"desc" => "Upload your logo. If left blank, it will display the website title.  ",
		"id" => "apptamin_show_logo_uploader",
		"class" => "hidden",
		"type" => "upload");
			
		
	$options[] = array( "name" => "TYPOGRAPHY",
		"desc" => "These options will let you define styles for typography directly from the admin panel by checking the box below. For advance typography styling, do it via css (c.f 'Advance Settings' tab).",
		"type" => "info",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Check the box if you want to define typography from the admin panel : font-size, font-family or color.",
		"id" => "typography_showhidden",
		"type" => "checkbox");
		
	$options[] = array(	"name" => "Body typography",
		"desc" => "Typography options. For the font-size, it will define the body font-size. Other font-sizes use this as a base. Go to the 'Advanced Settings' tab for more.",
		"id" => "apptamin_typography",
		"class" => "hidden",
		"std" => array('size' => '13px','face' => 'verdana','style' => 'normal','color' => '#123456'),
		"type" => "typography");
		
	$options[] = array( "name" => "Link color",
		"desc" => "Choose the link (a:link) color.",
		"id" => "apptamin_a_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
	
	$options[] = array( "name" => "Link hover/active color",
		"desc" => "Choose the link (a:hover and a:active) color.",
		"id" => "apptamin_a_hover_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
		
	$options[] = array( "name" => "Link visited color",
		"desc" => "Choose the link (a:visited) color.",
		"id" => "apptamin_a_visited_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
	
	$options[] = array( "name" => "BUTTONS",
		"desc" => "These options will let you define the buttons styles. For advance buttons styling, do it via css (c.f 'Advance Settings' tab).",
		"type" => "info",
		"class" => "special");
	
	$options[] = array(
		"desc" => "Check the box if you want to define buttons styling from admin panel : background color, border color or font color.",
		"id" => "buttons_showhidden",
		"type" => "checkbox");
	
	$options[] = array( "name" => "Button background color",
		"desc" => "Choose the button background color.",
		"id" => "apptamin_button_bg_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
		
	$options[] = array( "name" => "Button border color",
		"desc" => "Choose the button border color.",
		"id" => "apptamin_button_border_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
	
	$options[] = array( "name" => "Button font color",
		"desc" => "Choose the button background color.",
		"id" => "apptamin_button_font_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");

	$options[] = array( "name" => "FOOTER",
		"desc" => "These options will let you define some footer styles. For advance footer styling, do it via css (c.f 'Advance Settings' tab).",
		"type" => "info",
		"class" => "special");
		
	$options[] = array(
		"desc" => "Check the box if you want to define footer styling from admin panel : background color and font color.",
		"id" => "footer_showhidden",
		"type" => "checkbox");
	
	$options[] = array( "name" =>  "Footer background",
		"desc" => "Change the background CSS. Choose a color, or click the button to add a background image (options will appear once the image is uploaded).",
		"id" => "apptamin_footer_background",
		"class" => "hidden",
		"std" => $background_defaults,
		"type" => "background");
		
	$options[] = array( "name" =>  "Footer font color",
		"desc" => "Change the background color of the footer.",
		"id" => "apptamin_footer_font_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");

	$options[] = array( "name" => "Footer Link color",
		"desc" => "Choose the footer link (#footer a:link) color.",
		"id" => "apptamin_footer_a_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
	
	$options[] = array( "name" => "Footer Link hover/active color",
		"desc" => "Choose the footer hover link (#footer a:hover and #footer a:active) color.",
		"id" => "apptamin_footer_a_hover_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");
		
	$options[] = array( "name" => "Footer Link visited color",
		"desc" => "Choose the footer visited link (#footer a:visited) color.",
		"id" => "apptamin_footer_a_visited_color",
		"class" => "hidden",
		"std" => "",
		"type" => "color");

	/*
	$options[] = array(
		"name" => "Footer Text",
    	"desc" => "Disabled on free themes, please leave the credit line. You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]",
    	"id" => "footer_text",
    	"std" => "Powered by [wp-link] & <a href='http://www.apptamin.com' title='Marketing tools for mobile applications'>Apptamin</a>.",
    	"type" => "textarea");	*/
		
	/**** =Social Settings ****/		
		
	$options[] = array( "name" => "Social",
		"type" => "heading");	
	
	$options[] = array( "name" => "TWITTER",
		"desc" => "These options will let you define the social settings relating to Twitter",
		"type" => "info",
		"class" => "special first");
		
	$options[] = array( "name" => "Twitter ID",
		"desc" => "Insert your twitter ID for the 'tweet' button.",
		"id" => "apptamin_twit_text",
		"std" => "",
		"type" => "text");
	/*
	$options[] = array( "name" => "Number of tweets",
		"desc" => "Put here the number of tweets you'd like to display in the footer. If you put more than 2, make sure your footer height is correct.",
		"id" => "apptamin_twitnum_text",
		"std" => "",
		"type" => "text");
	*/
	$options[] = array(
		"desc" => "Check if you want to display a Tweet Button on the App Stage. It will use the settings from your twitter ID.",
		"id" => "apptamin_tweetbutton_checkbox",
		"std" => "false",
		"type" => "checkbox");
		
	$options[] = array( "name" => "Widgets - Other twitter features",
		"desc" => "You can define more twitter stuff to use from the Appearence > Widgets page, by adding Widgets : recent tweets (widget: Apptamin - Recent Tweets) or a twitter icon with a link to your profile (widget: Apptamin - Social Icon).",
		"type" => "info");
		
	$options[] = array( "name" => "FACEBOOOK",
		"desc" => "These options will let you define the social settings relating to Facebook.",
		"type" => "info",
		"class" => "special");
		
	$options[] = array( "name" => "Facebook Like button",
		"desc" => "Check if you want to display a Like Button on the App Stage. The URL used will be the homepage URL. If you want to use a custom URL (like your facebook fanpage for example), put the URL in the field bellow.",
		"id" => "apptamin_fbbutton_showhidden_checkbox",
		"std" => "false",
		"type" => "checkbox");
	
	$options[] = array(
		"desc" => "Put a custom URL if you want to use something else than the homepage URL (like your facebook fan page). Leave blank for default URL.",
		"id" => "apptamin_fbcustom_url_text",
		"class" => "hidden",
		"std" => "",
		"type" => "text");
		
	$options[] = array( "name" => "Widgets - Other facebook features",
		"desc" => "You can define more facebook stuff to use from the Appearence > Widgets page, by adding Widgets like a facebook icon with a link to your fan page (widget: Apptamin - Social Icon).",
		"type" => "info");
	
	/*
	$options[] = array( "name" => "Facebook fan page URL",
		"desc" => "Put here the link to your facebook fan page, if you have one. This will add a facebook button to the footer.",
		"id" => "apptamin_fbpage_text",
		"std" => "",
		"type" => "text");*/
		
	$options[] = array( "name" => "GOOGLE +",
		"desc" => "These options will let you define the social settings relating to Google +",
		"type" => "info",
		"class" => "special");
		
	$options[] = array( "name" => "Google +1 button",
		  "desc" => "Check if you want to display a +1 Button on the App Stage. The URL used will be the homepage URL. If you want to use a custom URL (like your android market app link for example), put the URL in the field bellow.",
		  "id" => "apptamin_pobutton_showhidden_checkbox",
		  "std" => "false",
		  "type" => "checkbox" );
	
	$options[] = array(
		  "desc" => "Put a custom URL if you want to use something else than the homepage URL (like your android market app link). Leave blank for default URL.",
		  "id" => "apptamin_pocustom_url_text",
		  "class" => "hidden",
		  "std" => "",
		  "type" => "text" );
	
	$options[] = array( "name" => "Widgets - Google + features",
		"desc" => "You can define Google + stuff to use from the Appearence > Widgets page, by adding Widgets like a Google+ icon with a link to your page (widget: Apptamin - Social Icon).",
		"type" => "info");
	
	/*
	$options[] = array( "name" => "Google + page URL",
		"desc" => "Insert your Google + page URL. This will insert a Google + button to the footer.",
		"id" => "apptamin_gplus_text",
		"std" => "",
		"type" => "text");
	*/
	$options[] = array( "name" => "RSS",
		"desc" => "These options will let you define the social settings relating to your RSS Feed. You can create one on http://feeds.feedburner.com for example.",
		"type" => "info",
		"class" => "special");
		
	$options[] = array( "name" => "Widgets - RSS features",
		"desc" => "You can define RSS stuff to use from the Appearence > Widgets page, by adding Widgets like a RSS icon with a link to your RSS Feed (widget: Apptamin - Social Icon).",
		"type" => "info");
	
	/*
	$options[] = array( "name" => "RSS Feed URL",
		"desc" => "Insert your RSS Feed URL. This will insert a RSS button in the footer.",
		"id" => "apptamin_rss_text",
		"std" => "",
		"type" => "text");
	*/
	$options[] = array( "name" => "MAILCHIMP",
		"desc" => "These options will let you define the social settings relating to your Mailchimp newsletter. Having a newsletter is a good way to connect with your customers, and to reach out to them. You can create a free account on Mailchimp.com.",
		"type" => "info",
		"class" => "special");
	
	$options[] = array( "name" => "Mailchimp ID",
		"desc" => "Insert here the 'form action' link from the embed code you generate with Mailchimp. It looks like this : http://apptamin.us4.list-manage1.com/subscribe/post?u=4661ee37b391143120a66df77&amp;id=43af2f6808.",
		"id" => "apptamin_mailchimp_text",
		"std" => "",
		"type" => "text");
		
	$options[] = array("name" => "Header : newsletter subscription",
		"desc" => "Check if you want to display a Mailchimp newsletter subscription in the header",
		"id" => "mailchimp_header_showhidden",
		"type" => "checkbox");
	
	$options[] = array( "name" => "Custom Mailchimp fields texts (header)",
		"desc" => "Text input field (header)",
		"id" => "apptamin_mailchimp_email_text",
		"std" => "Free email updates",
		"type" => "text",
		"class" => "hidden");
		
	$options[] = array(
		"desc" => "Text button (header)",
		"id" => "apptamin_mailchimp_button_text",
		"std" => "Subscribe",
		"type" => "text",
		"class" => "hidden");
	
	$options[] = array("name" => "Pre-Launch Mode : newsletter subscription",
		"desc" => "The newsletter subscription form will appear on the App Stage if you checked 'Pre-Launch Mode' in the App Settings.",
		"type" => "info");
	
	$options[] = array(
		"desc" => "Text input field (appstage)",
		"id" => "apptamin_mailchimp_launch_email_text",
		"std" => "Enter your email address",
		"type" => "text");
	$options[] = array(
		"desc" => "Text button (appstage)",
		"id" => "apptamin_mailchimp_launch_button_text",
		"std" => "Notify me !",
		"type" => "text");
	

	/**** =Blog Settings ****/		
		
	$options[] = array( "name" => "Blog",
		"type" => "heading");
		
	$options[] = array( "name" => "Adding a blog",
		"desc" => "To add a blog to your app site, add a page named 'Blog' (or whatever name you want to give it) and in the page attributes choose 'Blog' as template.",
		"type" => "info",
		"class" => "special first");	
	
	/*
	$options[] = array( "name" => "Footer recent blog posts",
		"desc" => "Number of recent blog posts to display in footer. 3 by default.",
		"id" => "apptamin_blog_footer_text",
		"std" => "3",
		"class" => "mini",
		"type" => "text");*/
		
	$options[] = array( "name" => "Footer recent blog posts",
		"desc" => "You can display recent blog posts in the footer from the Appearence > Widgets page with the 'Apptamin - Recent Posts' widget.",
		"type" => "info");
		
		
	/**** =Widget / Advanced Settings ****/		
	
	$options[] = array( "name" => "Widgets / Advanced",
		"type" => "heading");
		
	$options[] = array( "name" => "WIDGETS",
		"desc" => "This theme is compatible with widgets. In the 'Appearance -> Widgets' section you'll see the 'App Widgets' widget area. That's where you can put more info about your app. Here is what we suggest : press testimonials, great user reviews, contact info or invitation to discover some of your other apps. There is also a 'Footer Widgets' widget area, where you can put recent blog posts, social networks icons or recent tweets. ",
		"type" => "info",
		"class" => "special first");
	
	/*
	$options[] = array( "name" => "Disable Widgets section under AppStage",
		"desc" => "Check this box if you don't want to use the Widgets section under the AppStage. ",
		"id" => "apptamin_widget_checkbox",
		"type" => "checkbox");*/
		
	$options[] = array( "name" => "ADVANCED STYLING",
		"desc" => "This theme allows you, through this Admin Panel, to define several styling options. You might want to go further and modify the CSS classes. If that's the case, you don't have to edit the newstyles.css file where all the styles are defined : instead, do it in the yourstyles.css file.",
		"type" => "info",
		"class" => "special");
	
	$options[] = array( "name" => "Background styling",
		"desc" => "The current image used for the background is images/bg.jpg, and is used as a tile. You can change the image in the 'Layout Settings', replace it manually or change the styling in yourstyles.css",
		"type" => "info",
		"class" => "special");
	
	$options[] = array( "name" => "Images",
		"desc" => "All theme's images are in the apptamin-a/images/ folder. Add the images you don't want to upload via wordpress to this folder.",
		"type" => "info",
		"class" => "special");
	
	
	
	/**** =Text Editor ****/	
	
/*	$options[] = array( "name" => "Text Editor",
		"type" => "heading");

	$options[] = array( "name" => "Default Text Editor",
		"desc" => "Here is the description.",
		"id" => "example_editor",
		"type" => "editor");
	*/
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	/*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array( "name" => "Customized Text Editor",
		"desc" => "Here is the description.",
		"id" => "custom_editor",
		"type" => "editor",
		"settings" => $wp_editor_settings );*/

	return $options;
}
