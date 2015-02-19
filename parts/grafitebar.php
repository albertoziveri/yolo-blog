			<div id="tasc-world" class="grafitestyle">
				<div class="border-line"></div>
				<div class="world-inner wrap">
					<div class="world-element opinions">
						<div class="inner-world sticky">
							<?php 
							
								//Se ci sono dei post nella categoria featured metto in evidenza quello.
								// The Query
								$the_query = new WP_Query( array( 'category_name' => 'featured', 'orderby' => 'rand', 'showposts' => 1 )  );
								$the_query2 = new WP_Query( array( 'post_type' => 'opinion', 'showposts' => 4 )  );
								
								//Genero un numero rand in base al quale mostro opinioni, oppure progetti Grafite
								$toshow = 2; /*rand(1, 2);*/
								
								// The Loop
								if ( $the_query->have_posts() ) { ?>
								<h3>In evidenza</h3>

								<?php	while ( $the_query->have_posts() ) : $the_query->the_post(); 
										get_template_part( 'loop','bigstory' );
									endwhile;
								} elseif ($toshow == 2 and $the_query2->have_posts()) { ?>
									<h3><a href="http://www.tasc.it/opinioni">Ultime opinioni</a></h3>
									<div class="inner-world">
									<ul>
									<?php 
										while ( $the_query2->have_posts() ) : $the_query2->the_post(); 
									?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile; ?>
									</ul>
									</div>
								<?php
								} elseif ($toshow == 1)  { ?>
									<h3><a href="http://www.grafite.io">Grafite</a></h3>
									<div class="inner-world">
										<?php grafite_projects(); // Adjust using Menus in Wordpress Admin ?>
									</div>
								<?php }
								/* Restore original Post Data */
								wp_reset_postdata();		
							?>			
						</div>
					</div>
					
					<div class="world-element tasclinks">
						<h3>Tasc Power</h3>
						<div class="inner-world">
							<?php blackbar(); // Adjust using Menus in Wordpress Admin ?>
						</div>
					</div>
					
					<div class="world-element tascrank">
						<h3><a href="http://www.tasc.it/tasc-rank">Tasc Rank</a></h3>
						<div class="inner-world">
							<ul>
						    	<?php
						    	
								function cmp( $a, $b )
								{ 
								  if(  $a->points_user_day ==  $b->points_user_day ){ return 0 ; } 
								  return ($a->points_user_day < $b->points_user_day ) ? 1 : -1;
								} 
								
								$args = array(
								'meta_key' => 'points_user_day',
								'who' => 'authors',
								);
								$blogusers = get_users($args);
								usort($blogusers ,'cmp');
								$i = 0;
								foreach ($blogusers as $user) { $i++; ?>
								<li><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="avatar"><?php echo get_avatar($user->ID, 60); ?></span><span class="name"><?php echo $user->display_name; ?></span></a></li>						      
							    <?php 
							    if ($i==3) {break;}  }
							    ?>
							</ul>
						</div>
					</div>
					<div class="world-element sponsor">
					<?php if(is_single()) { ?>
						<h3>Segui Tasc</h3>
						<ul>
							<li><a href="http://www.facebook.com/tascproject">Facebook</a></li>
							<li><a href="http://www.twitter.com/tascproject">Twitter</a></li>
							<li><a href="https://plus.google.com/u/0/+TASCit/posts">Google</a></li>
							<li><a href="http://www.instagram.com/tascproject">Instagram</a></li>
						</ul>
					<?php
					} else { ?>
						<h3>Sponsored by</h3>
						<div class="inner-world">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2858043727445910";
/* Tasc */
google_ad_slot = "1283268581";
google_ad_width = 320;
google_ad_height = 50;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>						</div>
					<?php } ?>
					</div>
				</div>
			</div>
