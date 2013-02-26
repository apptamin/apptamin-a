<?php if (is_active_sidebar('primary')){?>
<hr class="styled"/>
<div class="special">
	<div class="app-widgets">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('primary') ) : ?>    
			<?php endif; ?>
		</ul>
	</div>
</div>
<?php } ?>

<ul class="features">
	<hr class="styled"/>
	<?php 
	$i=0;
	while($i < 5){
	$i++;
	if(of_get_option('feature_'.$i.'_checkbox')){
	?>
	<li class="<?php echo of_get_option('feature_'.$i.'_images');?>">
		<div class="imgwrap">
			<div class="feature">
				<?php $smartphone=of_get_option('feature_'.$i.'_smartphones_radio');?>
				<div class="<?php echo $smartphone; ?>">
				<?php 
					if($smartphone=='android'){
							if (of_get_option('feature_'.$i.'_screenshot_uploader')){ ?>
							<img width="186" height="310" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="Home screenshot"/>
						<?php }else{ ?>
							<img width="186" height="310" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front-android.jpg" alt="Home screenshot"/>
						<?php 
							} 
					}else{	
							if (of_get_option('app_screenshot_'.$i.'_uploader')){ ?>
							<img width="186" height="279" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="Home screenshot"/>
						<?php }else{ ?>
							<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="feature-1-scr"/>
						<?php 
							}
					}	
					?>
					<!--
					<?php if(of_get_option('feature_1_screenshot_uploader')){?>
						<img width="186" height="279" src="<?php echo of_get_option('feature_1_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="App feature #1 front screenshot"/>
					<?php } ?>-->
					<div class="glare"></div>
				</div>
				<div class="<?php echo $smartphone; ?> back">
					<?php if($smartphone=='android'){
							if(of_get_option('feature_'.$i.'_back_screenshot_uploader')){?>
								<img width="155" height="259" src="<?php echo of_get_option('feature_'.$i.'_back_screenshot_uploader')?>"/>
							<?php }else{ ?>
								<img width="155" height="259" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back-android.jpg" alt="App feature #2 front screenshot"/>
							<?php }
						}else{
							if(of_get_option('feature_'.$i.'_back_screenshot_uploader')){?>
								<img width="152" height="228" src="<?php echo of_get_option('feature_'.$i.'_back_screenshot_uploader')?>"/>
							<?php }else{ ?>
								<img width="152" height="228" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="App feature #2 front screenshot"/>
							<?php }
						}?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_1_text');?></h3>
				<h4><?php echo of_get_option('feature_1_textarea');?></h4>
			</div>
		</div>
	</li>
	<hr class="styled"/>
	<?php } 
	}
	
	?>
	<!--
	<?php if(of_get_option('feature_2_checkbox')){?>
	<li class="<?php echo of_get_option('feature_2_images');?>">
		<div class="imgwrap">
			<div class="feature">
				<div class="iphone">
					<?php if(of_get_option('feature_2_screenshot_uploader')){?>
						<img width="186" height="279" src="<?php echo of_get_option('feature_2_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="App feature #1 front screenshot"/>
					<?php } ?>
					<div class="glare"></div>
				</div>
				<div class="iphone back">
					<?php if(of_get_option('feature_2_back_screenshot_uploader')){?>
						<img width="152" height="228" src="<?php echo of_get_option('feature_2_back_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="152" height="228" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="App feature #2 front screenshot"/>
					<?php } ?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_2_text');?></h3>
				<h4><?php echo of_get_option('feature_2_textarea');?></h4>
			</div>
		</div>
	</li>	
	<hr class="styled"/>
	<?php } ?>
	<?php if(of_get_option('feature_3_checkbox')){?>
	<li class="<?php echo of_get_option('feature_3_images');?>">
		<div class="imgwrap">
			<div class="feature">
				<div class="iphone">
					<?php if(of_get_option('feature_3_screenshot_uploader')){?>
						<img width="186" height="279" src="<?php echo of_get_option('feature_3_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="App feature #1 front screenshot"/>
					<?php } ?>
					<div class="glare"></div>
				</div>
				<div class="iphone back">
					<?php if(of_get_option('feature_3_back_screenshot_uploader')){?>
						<img width="152" height="228" src="<?php echo of_get_option('feature_3_back_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="152" height="228" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="App feature #2 front screenshot"/>
					<?php } ?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_3_text');?></h3>
				<h4><?php echo of_get_option('feature_3_textarea');?></h4>
			</div>
		</div>
	</li>
	<hr class="styled"/>
	<?php } ?>
	<?php if(of_get_option('feature_4_checkbox')){?>
	<li class="<?php echo of_get_option('feature_4_images');?>">
		<div class="imgwrap">
			<div class="feature">
				<div class="iphone">
					<?php if(of_get_option('feature_4_screenshot_uploader')){?>
						<img width="186" height="279" src="<?php echo of_get_option('feature_4_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="App feature #1 front screenshot"/>
					<?php } ?>
					<div class="glare"></div>
				</div>
				<div class="iphone back">
					<?php if(of_get_option('feature_4_back_screenshot_uploader')){?>
						<img width="152" height="228" src="<?php echo of_get_option('feature_4_back_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="152" height="228" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="App feature #2 front screenshot"/>
					<?php } ?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_4_text');?></h3>
				<h4><?php echo of_get_option('feature_4_textarea');?></h4>
			</div>
		</div>
	</li>
	<hr class="styled"/>
	<?php }
	} ?>
	<?php if(of_get_option('feature_5_checkbox')){?>
		<li class="<?php echo of_get_option('feature_5_images');?>">
		<div class="imgwrap">
			<div class="feature">
				<div class="iphone">
					<?php if(of_get_option('feature_5_screenshot_uploader')){?>
						<img width="186" height="279" src="<?php echo of_get_option('feature_5_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="186" height="279" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="App feature #1 front screenshot"/>
					<?php } ?>
					<div class="glare"></div>
				</div>
				<div class="iphone back">
					<?php if(of_get_option('feature_5_back_screenshot_uploader')){?>
						<img width="152" height="228" src="<?php echo of_get_option('feature_5_back_screenshot_uploader')?>"/>
					<?php }else{ ?>
						<img width="152" height="228" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="App feature #2 front screenshot"/>
					<?php } ?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_5_text');?></h3>
				<h4><?php echo of_get_option('feature_5_textarea');?></h4>
			</div>
		</div>
	</li>
	<?php } ?>-->
</ul>

