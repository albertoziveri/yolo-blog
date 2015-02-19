				<div id="sidebar1" class="sidebar" role="complementary">
						<?php 
						//Se è mobile visualizza le categorie nella sidebar in fondo.
						global $detect;
							if($detect->isMobile() && !$detect->isTablet()) { display_cats(); } ?>
					<div class="widget">
						<?php sidebar_menu(); // Adjust using Menus in Wordpress Admin ?>
					</div>
				
					<div id="ads_widget" class="widget ads_widget">
						<h4 class="widgettitle">Pubblicit&aacute;</h4>
					</div>
					
					<div class="widget">
						<ul class="sidebar-menu">
							<li class="title"><a href="http://www.tasc.it/sezione/howto/"><span class="spr labposts"></span>How to</a></li>
						    <?php $howto = new WP_Query('numberposts=4&showposts=4&sezione=howto');
						    
						    	if ( $howto->have_posts()) : while ( $howto->have_posts()) :  $howto->the_post();  { ?> 
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						    <?php } endwhile; endif; ?>		
						</ul>
					</div>
					
												
					<div id="social_widget" class="widget social_widget">
						<h4 class="widgettitle">Social</h4>
						
						<?php 
						//Se è mobile visualizza i bottoni normali, altrimenti carica gli script social
						if($detect->isMobile() && !$detect->isTablet()) {  ?>
							<a class="facebook tasc-button" href="http://www.facebook.com/tascproject">seguici su Facebook</a>
							<a class="twitter tasc-button" href="http://www.twitter.com/tascproject">seguici su Twitter</a>
						<?php } else { ?>
							<a href="https://twitter.com/tascproject" class="twitter-follow-button" data-show-count="false" data-lang="it" data-size="large">Segui @tascproject</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							<div class="fb-like-box" data-href="http://www.facebook.com/tascproject" data-width="250" data-height="70" data-show-faces="false" data-stream="false" data-header="true"></div>
							<div class="g-plus" data-width="250" data-height="69" data-href="https://plus.google.com/u/0/b/107793090627145380318/107793090627145380318/"></div>
							
						<?php } ?>
						<a class="tasc-button-rss tasc-button" href="http://feeds.feedburner.com/tascproject">abbonati al nostro feed RSS</a>
						<a class="tasc-button tasc-button" href="http://tasc.us7.list-manage1.com/subscribe?u=477f2151bad0a691a88c3e571&id=281b6ea363">seguici sulla mailing Tasc Box</a>
						
					</div>					
					
					<div class="widget">
						<h4 class="widgettitle">Instagram @tascproject</h4>
					
					
								                <?php
		
		                //1 - Settings (please update to math your own)
		                $username='tascproject'; //Provide your instagram username
		                $access_token='187257254.de86970.592d0f4c9590415dbdb3af3f95cb9d4f'; //Provide your instagram access token
		                $count='8'; //How many shots do you want?
		                //3 - Instanciate
		                if(!empty($username) && $username!='yourusername' && !empty($access_token) && $access_token!='youraccesstoken'){
		                $isg = new instagramPhp($username,$access_token); //instanciates the class with the parameters
		                $shots = $isg->getUserMedia(array('count'=>$count)); //Get the shots from instagram
		                } else {
		                echo'Please update your settings to provide a valid username and access token';
		                }
		                //4 - Display
		                if(!empty($shots)){ echo $isg->simpleDisplay($shots); }
		
		                ?>
					</div>
					
					


					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. 
						
						<div class="alert help">
							<p>Please activate some Widgets.</p>
						</div>-->

					<?php endif; ?>
						<div id="donate_widget" class="widget donate_widget">
							<h4 class="widgettitle">Supporta Tasc</h4>
								<ul>
									<li><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TZVTJ6EPYTMRE">Supportaci con un'offerta libera</a></li>
									<li><a target="_blank" href="http://www.amazon.it/?_encoding=UTF8&tag=skimbu08-21&linkCode=ur2&camp=3370&creative=24114">Compra qualcosa su Amazon</a></li>
									<li><a target="_blank" href="http://clk.tradedoubler.com/click?p=24373&a=1972645&g=20490700">Compra qualcosa su iTunes</a></li>
									<small>Naviga su Amazon o iTunes utilizzando i link qui sopra. Il prezzo dei tuoi acquisti rester&agrave; invariato ma una piccola percentuale verr&agrave; donata a Tasc! Grazie.</small>
								</ul>
						</div>						
						<?php if(is_single()) { ?>
						<div id="related_widget" class="widget related_widget">
							<h4 class="widgettitle">Leggi anche</h4>
							<?php global $wp_query; $postid = $wp_query->post->ID;;  related_posts(array(), $postid); ?>
						</div>
						<?php } ?>
						
				</div>