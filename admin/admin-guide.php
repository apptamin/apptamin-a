<?php
add_action('admin_menu', 'apptamin_guide');

function apptamin_guide() {
	add_theme_page('How to use the Apptamin A Theme', __('Apptamin User Guide','apptaminguide'),8, 'manage_options', 'apptamin_guide_options');
}

function apptamin_guide_options() {
?>
<div class="wrap">
<div class="opwrap" style="background: url('http://www.apptamin.com/wp-content/themes/reverie/images/bg.jpg') scroll 0px 0 #f2f2f2;; margin:20px auto; width:80%; padding:30px; border:1px solid #ddd;" >
		<h1><?php echo _e('Apptamin Theme: User guide','apptaminguide');?></h1>

		<h2><?php echo _e('Welcome !','apptaminguide');?></h2>
		
		<p><?php echo _e("We're glad you're taking interest in one of <a href='http://www.apptamin.com' title='marketing tools for mobile apps'>Apptamin</a>'s Wordpress Theme.","apptaminguide");?></p>
		<p><?php echo _e("This theme lets you <strong>fully customize your app presentation website without coding a single line</strong>. It is optimized to display the needed elements about your app, based on our experience.
			You can also go further and modify the css files and the code to suit your needs.","apptaminguide");?></p> 
		<p><?php echo _e("We would also be glad if you could let us know what you think, and show us what you did with the theme by sending us an email at <a href='mailto:contact@apptamin.com'>contact@apptamin.com</a>. It would be great to see you <strong>join our discussions about mobile app marketing on <a href='http://www.apptamin.com/blog' title='marketing tools for mobile apps'>Apptamin's Blog</a> !</strong>","apptaminguide");?></p>
			
		
		
		<h2 id="license"><?php echo _e("License","apptaminguide");?></h2>

		<p><?php echo _e("The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL. ","apptaminguide");?></p>
		<p><?php echo _e("All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage.  ","apptaminguide");?></p>
		<p><?php echo _e("We really appreciate it if you retain the Apptamin credit at the bottom. But we won't be mad if you don't.","apptaminguide");?></p>
		<p><?php echo _e("You are allowed to use the theme on multiple installations, and to edit the template for your personal use.","apptaminguide");?></p>
		<p><?php echo _e("You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it.","apptaminguide");?></p>  
		<p><?php echo _e("You are NOT allowed to use the theme as a part of a template repository for any paid CMS service.","apptaminguide");?></p>  
	  
		<h2 id="start"><?php echo _e("Getting Started","apptaminguide");?></h2>
		
		<p><?php echo _e("There are two main places you need to go to customize your app website. The rest of it is classic Wordpress stuff : adding articles, pages and plugins.","apptaminguide");?></p>
		<ul>
			<li><strong><?php echo _e("Apparence > Theme Options","apptaminguide");?></strong><br/>
			<p><?php echo _e("In the Theme Options panel, you will find several tabs where you can define how your website is going to look like. Start with the basics : 'App Settings' then explore the other tabs to customize more.","apptaminguide");?></p>
			<p><?php echo _e("If you know CSS, you can (should?) customize the theme design by modifying the yourstyles-xxx.css file (or creating a new one).","apptaminguide");?></p>
			</li>
			<li><strong><?php echo _e("Apparence > Widgets","apptaminguide");?></strong><br/>
			<p><?php echo _e("We've defined customed widget-ready area to make your life simpler : 'App Widgets' and 'Footer Widgets'. We suggested you some elements and even created some custom Widgets (they start by 'Apptamin-'), but really you can drop anything you want in there.","apptaminguide");?></p>
			</li>
		</ul>
		
		<p><strong><?php echo _e("Here is a screenshot that should help you understand the different parts of the themes mentioned.","apptaminguide");?></strong></p>
		<p style="text-align:center"><img width="100%" src="http://www.apptamin.com/screenshot.jpg" alt="Apptamin A theme screenshot"/></p>

</div>

<?php }; ?>