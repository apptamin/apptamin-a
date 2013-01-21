<?php if (is_active_sidebar('primary')){?>
<!--<hr class="styled"/>-->
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
	$single="";
	if(of_get_option('feature_'.$i.'_checkbox')){
	
	if($i>1){?>
	<hr class="styled"/>
	<?php } ?>
	<li class="<?php echo of_get_option('feature_'.$i.'_images').' '.'feature'.$i;?>">
		<div class="imgwrap">
			<?php 				
				$device_front_appstage=of_get_option('feature_'.$i.'_devices_front_radio');
				$device_back_appstage=of_get_option('feature_'.$i.'_devices_back_radio');
				
				if ($device_back_appstage=="none"){
					$single='single-phone';
				}else{
					$single='';
				}
			?>
			<div class="feature <?php echo $single;?>">
				<?php //$smartphone=of_get_option('feature_'.$i.'_smartphones_radio');?>
				<div class="<?php echo $device_front_appstage;?>">
				<?php 
					if (of_get_option('feature_'.$i.'_screenshot_uploader')){ ?>
							<img class="screenshot" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="<?php echo 'Feature '.$i.' front screenshot';?>"/>
						<?php }else{ ?>
							<img class="screenshot" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-placeholder.jpg" alt="Home screenshot"/>
						<?php 
							} 
					/*}else{	
							if (of_get_option('feature_'.$i.'_screenshot_uploader')){ ?>
							<img width="185" height="330" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="<?php echo 'Feature '.$i.' front screenshot';?>"/>
						<?php }else{ ?>
							<img width="185" height="330" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="feature-1-scr"/>
						<?php 
							} 
					}	*/
					?>
					<div class="glare"></div>
				</div>
				<?php 
				if($device_back_appstage!='none'){?>
					<div class="<?php echo $device_back_appstage;?> back">
							<?php if(of_get_option('feature_'.$i.'_back_screenshot_uploader')){?>
								<img class="screenshot" src="<?php echo of_get_option('feature_'.$i.'_back_screenshot_uploader')?>"/>
							<?php }else{ ?>
								<img class="screenshot" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-placeholder.jpg" alt="<?php echo 'Feature '.$i.' back screenshot';?>"/>
							<?php }
							?>
					</div>
				<?php 
				}	
				?>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_'.$i.'_text');?></h3>
				<h4><?php echo of_get_option('feature_'.$i.'_textarea');?></h4>
				<div class="download-buttons">
						<?php if(of_get_option('app_android_store_checkbox')){ ?>
							<a class="androiddl" target="_blank" href="<?php echo of_get_option('app_android_store_text');?>"  title="<?php echo _e('Download our Android app','apptamin-text-title');?>"></a>
						<?php } ?>
						<?php if(of_get_option('app_itunes_store_checkbox')){ ?>
							<a class="itunesdl" target="_blank" href="<?php echo of_get_option('app_itunes_store_text');?>"  title="<?php echo _e('Download our iPhone app','apptamin-text-title');?>"></a>
						<?php } ?>
				</div>
			</div>
		</div>
	</li>

	<?php 
		} 
	}
	
	?>

</ul>

