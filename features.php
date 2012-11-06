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
	?>
	<li class="<?php echo of_get_option('feature_'.$i.'_images');?>">
		<div class="imgwrap">
			<?php //Check for which phone(s) to display
				$smartphone=of_get_option('feature_'.$i.'_smartphones_radio');
				$back='';
				switch ($smartphone)
					{
					case "iphone":
						$single='single-phone';
						$front='iphone';
						break;
					case "android":
						$single='single-phone';
						$front='android';
						break;
					case "android_android":
						$front='android';
						$back='android';
						break;
					case "iphone_android":
						$front='iphone';
						$back='android';
						break;
					case "android_iphone":
						$front='android';
						$back='iphone';
						break;
					case "iphone_iphone":
						$front='iphone';
						$back='iphone';
						break;
					default:
						$single='single-phone';
						$front='iphone';
						break;
				}
			?>
			<div class="feature <?php echo $single;?>">
				<?php //$smartphone=of_get_option('feature_'.$i.'_smartphones_radio');?>
				<div class="<?php echo $front; ?>">
				<?php 
					if(($front=='android')){
							if (of_get_option('feature_'.$i.'_screenshot_uploader')){ ?>
							<img width="192" height="339" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="<?php echo 'Feature '.$i.' front screenshot';?>"/>
						<?php }else{ ?>
							<img width="192" height="339" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front-android.jpg" alt="Home screenshot"/>
						<?php 
							} 
					}else{	
							if (of_get_option('feature_'.$i.'_screenshot_uploader')){ ?>
							<img width="185" height="330" src="<?php echo of_get_option('feature_'.$i.'_screenshot_uploader'); ?>" alt="<?php echo 'Feature '.$i.' front screenshot';?>"/>
						<?php }else{ ?>
							<img width="185" height="330" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-front.jpg" alt="feature-1-scr"/>
						<?php 
							} 
					}	
					?>
					<div class="glare"></div>
				</div>
				<div class="<?php echo $back; ?> back">
					<?php if($back!=''){?>
					<?php if($back=="android"){
							if(of_get_option('feature_'.$i.'_back_screenshot_uploader')){?>
								<img width="160" height="284" src="<?php echo of_get_option('feature_'.$i.'_back_screenshot_uploader')?>"/>
							<?php }else{ ?>
								<img width="160" height="284" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back-android.jpg" alt="<?php echo 'Feature '.$i.' back screenshot';?>"/>
							<?php }
						}else{
							if(of_get_option('feature_'.$i.'_back_screenshot_uploader')){?>
								<img width="151" height="270" src="<?php echo of_get_option('feature_'.$i.'_back_screenshot_uploader')?>"/>
							<?php }else{ ?>
								<img width="151" height="270" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-back.jpg" alt="<?php echo 'Feature '.$i.' back screenshot';?>"/>
							<?php }
						}}?>
				</div>
			</div>
			<div class="features-txt">
				<h3><?php echo of_get_option('feature_'.$i.'_text');?></h3>
				<h4><?php echo of_get_option('feature_'.$i.'_textarea');?></h4>
			</div>
		</div>
	</li>
	<?php if(i<5){?>
	<hr class="styled"/>
	<?php }
		} 
	}
	
	?>

</ul>

