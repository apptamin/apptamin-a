<div id="scroller">
	<div id="scroller-content">
		<div class="app-box <?php echo of_get_option('appstage_images');?>">		
			<?php //Check for which phone(s) to display
				$device_front_appstage=of_get_option('devices_front_radio');
				$device_back_appstage=of_get_option('devices_back_radio');
				
				if ($device_back_appstage=="none"){
					$single_appstage='single-phone';
				}else{
					$single_appstage='';
				}
			?>
			<div class="feature <?php echo $single_appstage;?>">
				<div class="<?php echo $device_front_appstage;?>">
					<?php 

						if (of_get_option('app_screenshot_1_uploader')){ ?>
						<img class="screenshot" src="<?php echo of_get_option('app_screenshot_1_uploader'); ?>" alt="Home screenshot"/>
					<?php }else{ ?>
						<img class="screenshot" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-placeholder.jpg" alt="feature-1-scr"/>
					<?php 
						}
					?>
					<div class="glare"></div>
				</div>
				<?php if($device_back_appstage!='none'){?>
				<div class="<?php echo $device_back_appstage;?> back">
						<?php if (of_get_option('app_screenshot_2_uploader')){ ?>
							<img class="screenshot" src="<?php echo of_get_option('app_screenshot_2_uploader'); ?>" alt="feature-2-scr"/>
						<?php }else{ ?>
							<img class="screenshot" src="<?php bloginfo('stylesheet_directory'); ?>/images/screenshots/scr-placeholder.jpg" alt="feature-2-scr"/>
						<?php } ?>
				</div>
				<?php }?>
			</div>
			<div class="app-content">
				<div class="app-name">
					<?php if(of_get_option('app_icon_uploader')){?>
						<h1><a class="app-icon" href="<?php echo of_get_option('app_icon_link_text');?>" title="<?php echo _e('Application Name','apptamin-text-title');?>"><img width="100" height="100" src="<?php echo of_get_option('app_icon_uploader')?>" alt="App icon"/></a><?php echo of_get_option('appname_text');?></h1>
						
					<?php }else{ ?>
						<h1><a class="app-icon" href="<?php echo of_get_option('app_icon_link_text');?>" title="<?php echo _e('Application Name','apptamin-text-title');?>"><img width="100" height="100" src="<?php bloginfo('stylesheet_directory'); ?>/images/app_icon.png" alt="App icon"/></a><?php echo of_get_option('appname_text');?></h1>
						
					<?php } ?>
				</div>
				<?php if(of_get_option('video_text')){$video=" video-on";}?>
	
				<div class="app-description<?php echo $video;?>">
					<h2><?php echo of_get_option('app_description_textarea');?>
					</h2>
					<?php if(of_get_option('video_text')){ ?>
					<div class="app-video"> 
						<a href="<?php echo of_get_option('video_text').'?width=640&amp;height=480';?>" rel="wp-video-lightbox" title="<?php echo _e('Watch video','apptamin-text-title');?>"><img src="<?php if(of_get_option('video_text')){echo of_get_option('video_thumbnail_uploader');}else{bloginfo('stylesheet_directory').'/images/video_icon.png';}?>" alt="" width="150" /></a> 
						<p><?php echo of_get_option('video_thumbnail_text');?></p>
					</div>
					<?php } ?>
					
				</div>
			
				<?php if(of_get_option('app_launch_newsletter_checkbox')){?>
					<div class="notif">
						<!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup_appstage">
							<form action="<?php echo of_get_option('apptamin_mailchimp_text');?>" method="post" id="mc-embedded-subscribe-form_appstage" name="mc-embedded-subscribe-form" class="validate" target="_blank">
								<?php if(of_get_option('appstage_images')!=''){;?>
										<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL_appstage" placeholder="<?php echo of_get_option('apptamin_mailchimp_launch_email_text');?>" required />
										<input type="submit" value="<?php echo of_get_option('apptamin_mailchimp_launch_button_text');?>" name="subscribe" id="mc-embedded-subscribe_appstage" class="button" />
								
											<?php }else{ ?>
										<input type="submit" value="<?php echo of_get_option('apptamin_mailchimp_launch_button_text');?>" name="subscribe" id="mc-embedded-subscribe_appstage" class="button" />
										<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL_appstage" placeholder="<?php echo of_get_option('apptamin_mailchimp_launch_email_text');?>" required />
							
										<?php } ?>
							</form>
						</div>
						<!--End mc_embed_signup-->
					</div>
				<?php }else{ ?>
					<div class="download-buttons">
						<?php if(of_get_option('app_android_store_checkbox')){ ?>
							<a class="androiddl" target="_blank" href="<?php echo of_get_option('app_android_store_text');?>"  title="<?php echo _e('Download our Android app','apptamin-text-title');?>"></a>
						<?php } ?>
						<?php if(of_get_option('app_itunes_store_checkbox')){ ?>
							<a class="itunesdl" target="_blank" href="<?php echo of_get_option('app_itunes_store_text');?>"  title="<?php echo _e('Download our iPhone app','apptamin-text-title');?>"></a>
						<?php } ?>
					</div>
				<?php } ?>
					<div class="social-buttons">
						<?php if(of_get_option('apptamin_tweetbutton_checkbox')) { ?>
							<div class="tweet-button">
								<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo of_get_option('apptamin_twit_text','no-entry');?>" data-related="<?php echo of_get_option('apptamin_twit_text','no-entry');?>: Our twitter account"></a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div>
						<?php } ?>
						<?php if(of_get_option('apptamin_fbbutton_showhidden_checkbox')) { ?>
							
							<div class="fb-button">
								<iframe src="http://www.facebook.com/plugins/like.php?href=<?php if(of_get_option('apptamin_fbcustom_url_text')){echo of_get_option('apptamin_fbcustom_url_text');}else{bloginfo('url');}?>&layout=standard&postmessage&extended_social_context=false&show_faces=false&width=100&action=like&colorscheme=light" scrolling="no" frameborder="0"  allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:30px"></iframe>
							</div>
						<?php } ?>
						<?php if(of_get_option('apptamin_pobutton_showhidden_checkbox')) { ?>
							
							<div class="po-button">
								<?php
								if ( of_get_option( 'apptamin_pocustom_url_text' ) ) {
								$po_link = of_get_option( 'apptamin_pocustom_url_text' );
								} else {
								$po_link = get_bloginfo( 'url' );
								}
								?>
								<!-- Place this tag where you want the +1 button to render. -->
								<div class="g-plusone" data-size="tall" data-annotation="inline" data-width="300" href="<?php echo $po_link;?>"></div>
							</div>
							<!-- Place this tag after the last +1 button tag. -->
							<script type="text/javascript">
							  (function() {
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/plusone.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
						<?php } ?>
					</div>
			</div>

		</div>
		
		
	</div>
</div>

<div class="clear"></div>

	

