<?php get_header(); ?>
			<?php if (is_paged()) { } else { ?>
			<div id="content-top" class="wrap">
				<div id="top-stories">
					<div id="main-story" class="big-story left-column">		
							<?php query_posts('showposts=3'); ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); 
							//NON INSERISCO IN TOP STORIES POST non importanti.
							$important= get_post_meta($post->ID, 'opt_notbig', true); if( $important == "on" ) continue;
							if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
							
							$do_not_duplicate[] = $post->ID; ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
								<?php get_template_part( 'loop','bigstory' ); ?>	
								</article>
								
							<?php break; endwhile; ?>	
							<?php endif; ?>
					</div> <!-- End first-stories -->
												
					<div id="side-story"  class="right-column">
						<div class="last-opinions">
							<h2><a href="http://www.tasc.it/opinioni">Ultime Opinioni</a><a class="iconfont write" href="http://www.tasc.it/opinioni/write">o</a></h2>
							<ul>
								<?php 
									$last_opinions = new WP_Query( array( 'post_type' => 'opinion', 'showposts' => 5 )  );
									while ( $last_opinions->have_posts() ) : $last_opinions->the_post(); 
								?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
						
						<div class="second-story-right small-posts">
							
<?php 
								
								//Inizializzo query
								if (is_paged()) {wp_reset_query();   } else { query_posts('showposts=10'); } ?>
								
								<?php 
								
								while (have_posts()) : the_post(); 
								
								//Se è uno snack NON salta
								$format = get_post_format();
								if ($format == 'aside') {} else {continue;}
								
								//Se è già stato messo prima lo salta
								if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
								
								$do_not_duplicate[] = $post->ID;
								
								get_template_part( 'loop','bigstory' );

								break;
								endwhile;
								
							?>
						</div>

					</div> 
				</div><!-- End top-stories -->
			</div>
			<?php } //solo se è la home mostra le top-stories ?>
			
			<div id="content-container" class="wrap">
				<div id="content">			
					<div id="inner-content" class="clearfix">
				
					    <div id="main" class="clearfix" role="main">
						    <div id="articles" class="tasc-grid">
								
						    
						    	<div class="left-column">
									<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); 
									
										//Se è uno snack salta
										$format = get_post_format();
										if ($format == 'aside') { continue;}
										
										//Se è già stato messo prima lo salta
										if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
										
										$do_not_duplicate[] = $post->ID;
										
										get_template_part( 'loop','bigstory');
										//$i++; 
										endwhile;
									?>
								</div>
										
						    	<div class="right-column small-posts">
									<?php 
										//Inizio ad elencare i contenuti nella sidebar super-dinamica. Prima gli snack, poi articolo casuale e citazione, tasc rank.
										$i = 1; 
										
										while (have_posts()) : the_post(); 
										
										//Se è uno snack NON salta
										$format = get_post_format();
										if ($format == 'aside') {} else {continue;}
										
										//Se è già stato messo prima lo salta
										if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
										
										
										$do_not_duplicate[] = $post->ID;
										
										
										//C'È LO SNACK!
										if ($i % 2 == 0) {?>
										<div class="second-tile tile">  

										<?php
										} else { ?>
											
										<div class="first-tile tile"> 
											
										<?php }
										get_template_part( 'loop','bigstory' );
										
										
										?> </div> <?php
										$i++; 
										endwhile;
									?>

									<?php
									 
									query_posts(array(
										'showposts' => 2,
										'orderby' => 'rand'
									));
									while (have_posts()) : the_post();									
									
									if(empty($do_not_duplicate)) {} else { if( in_array($post->ID, $do_not_duplicate) ) continue;}
									 
									 if ($i % 2 == 0) { ?>
										<div class="second-tile tile">  

										<?php
										} else { ?>
											
										<div class="first-tile tile"> 
											
										<?php }
										get_template_part( 'loop','bigstory' ); $i++;
										?> </div> <?php
										 
									 endwhile; ?>	
<<<<<<< HEAD
=======
									 
									 
									 
									 
									 					    	
						    		<div class="<?php if ($i % 2 == 0) { ?>second-tile <?php } else { echo "first-tile"; } $i++; ?> tile quote">
							    			<p>
											<?php
												$key = 'vyfl4dws0xnebf9ka95p9e'; 
												$language = 'it';
												$request = file_get_contents('https://www.getquotesapp.com/api/randomquote.php?key='.$key.'&ln='.$language);
												$response = json_decode($request, true);
												
												$body_quote = $response['quote']['body'];
												$author_quote = $response['quote']['author'];	
												echo '"'.$body_quote . '" <p><small>' . $author_quote . '</small></p>';					
											?>
											<p><small><a href="http://www.getquotesapp.com">GET QUOTES APP</a></small></p>
											</p>
							    		</div>
>>>>>>> origin/master
							    		
							    		<div class="<?php if ($i % 2 == 0) { ?>second-tile <?php } else { echo "first-tile"; } $i++; ?>">
										<div id="tasc-world" class="promotion grafitestyle">
											<h3><a href="http://www.tasc.it/tasc-rank">Tasc Rank</a></h3>
											<div class="tascrank">
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
													$count = 0;
													foreach ($blogusers as $user) { $count++; ?>
													<li><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="avatar"><?php echo get_avatar($user->ID, 60); ?></span><span class="name"><?php echo $user->display_name; ?></span></a></li>						      
												    <?php 
												    if ($count==3) {break;}  }
												    ?>
												</ul>
											</div>
										</div>
										</div>
										
										
										
										<div class="<?php if ($i % 2 == 0) { echo "second-tile"; } else { echo "first-tile"; } $i++; ?> tile"> 
											<article class="article-big-story">
																		    	<div class="tasc-post">
																		    		<a href="https://www.tasc.it/entra-nel-cast" rel="bookmark" title="Entra nel Cast, crea, scrivi, produci, progetta" sl-processed="1">
																			    		<div class="title">Entra nel Cast</div>
																		    			<div class="overlay"></div> 
																		    			<img width="700" height="462" src="https://www.tasc.it/images/entranelcast.jpg" class="attachment-large wp-post-image" alt="Entra in Tasc e Grafite">							    			<div class="gradient"></div>
																		    		</a>
																		    	</div>
										    	</article>
										 </div>										
										
								</div><!-- end right-column -->
								
								
								
						    </div><!-- end articles -->
						        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
								        <nav class="wp-prev-next button-container">
									        <ul class="clearfix">
										        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
										        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
									        </ul>
								        </nav>
							        <?php }  ?>		
							    <?php endif; ?>
					    </div> <!-- end #main -->
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    

<?php get_footer(); ?>
