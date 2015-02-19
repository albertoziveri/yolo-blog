<?php get_header(); ?>
			<div id="content-container" class="wrap full-width">
				<div id="content-header" >
				    <?php 
				    	if (isset($_GET['author_name'])) :
				    		$curauth = get_userdatabylogin($curauth_name);
				    	else :
				    		$curauth = get_userdata(intval($author));
				    	endif;
				    ?>
				   <div id="author-header">
				   		<div id="avatar">
					   		<?php echo get_avatar($curauth->ID, 300); ?>
				   		</div>
				   		<div id="author-title">
					   		 <h1><?php echo $curauth->display_name; ?></h1>
				   		</div>
				   </div>

					<?php if (user_can($curauth->ID,'publish_posts')) { ?>
				   <hr class="light" />
					   <div id="author-details">
					   
					   		<div id="bio">
					   			<h2 class="smallone">BIO</h2>
					   			<p><?php echo $curauth->description; ?></p>
					   		</div>
					   		
					   		<div id="stats">
					   			<h2 class="smallone">INFO</h2>
					   			<ul>
					   				<li>È un <?php if (user_can($curauth->ID,'publish_posts')) { echo "Membro del <a href='http://www.tasc.it/cast'>Cast</a>"; } else { echo "Tasc VIP"; } ?>.</li>
						   			<li><strong> <?php echo count_user_posts( $curauth->ID ); ?></strong> articoli scritti su Tasc.</li>
						   			<li>Fedele a Tasc da <strong><?php $today = date('Y-n-j'); $user_registered=$curauth->user_registered; $author_registered= date("Y-n-j", strtotime($user_registered)); $timeregistered = (strtotime($today) - strtotime($author_registered)) / ( 60 * 60 * 24); echo $timeregistered; ?></strong> giorni.</li>
					   			</ul>
					   		</div>
					   		
					   		<div id="social">
					   			<h2 class="smallone">FOLLOW</h2>
								<ul class="social">
							  		<?php if ($curauth->twitter) { ?><li><a class="tasc-button smallbtn twitter" target="_blank" href="http://www.twitter.com/<?php echo $curauth->twitter; ?>">Twitter</a></li><?php } ?>
							  		<?php if ($curauth->facebook) { ?><li><a class="tasc-button smallbtn facebook" target="_blank" href="http://www.facebook.com/<?php echo $curauth->facebook; ?>">Facebook</a></li><?php } ?>
							  		<?php if ($curauth->instagram) { ?><li><a class="tasc-button smallbtn instagram" target="_blank" href="http://www.instagram.com/<?php echo $curauth->instagram; ?>">Instagram</a></li><?php } ?>
							  		<?php if ($curauth->flickr) { ?><li><a class="tasc-button smallbtn flickr" target="_blank" href="http://www.flickr.com/<?php echo $curauth->flickr; ?>">Flickr</a></li><?php } ?>
							  		<?php if ($curauth->linkedin) { ?><li><a class="tasc-button smallbtn linkedin" target="_blank" href="http://www.linkedin.com/in/<?php echo $curauth->linkedin; ?>">LinkedIn</a></li><?php } ?>
							  		<?php if ($curauth->user_url) { ?><li><a class="tasc-button smallbtn more" target="_blank" href="<?php echo $curauth->user_url; ?>">di più</a></li><?php } ?>
						  		</ul>
					   		</div>
					   </div>
				<?php } //non è membro del cast ?>
				   
				</div>
				
				<hr class="strong" />
				
				<div id="content">
					<div id="inner-content" class="clearfix">
							<?php if (have_posts()) : ?>
							    <div id="articles" class="square-list">
									 <?php while (have_posts()) : the_post(); ?> <article class="large"><?php
											get_template_part( 'loop','bigstory' );?> </article> <?php
										endwhile;
									?>
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
							    
							<?php 
								// The Query OPINIONI
								$the_query2 = new WP_Query( array( 'post_type' => 'opinion', 'author' =>  $curauth->ID, 'posts_per_page' => -1)  );
								
								if ($the_query2->have_posts()) { ?>
								<hr class="strong" />
								<div class="simple-story">
									<h1 class="black">Le sue opinioni</h1>
									<ul class="linklist">
									<?php 
										while ( $the_query2->have_posts() ) : $the_query2->the_post(); 
									?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile; ?>
									</ul>
								</div>
								<?php
								} 
								/* Restore original Post Data */
								wp_reset_postdata();		
							?>			
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
				
				
				<?php if (user_can($curauth->ID,'publish_posts')) { ?>
				<hr class="strong" />
				
				<div id="content-footer"  class="full-width">
						<div class="story-center">
							<h1 class="black">Tasc Rank Stats</h1>
							<?php list ($words_number, $comments_number,$views_number) = get_user_meta($curauth->ID, "points_thirtydays", true); ?>
					    	<table class="clean">
						    	<tr>
						    		<td><span><?php echo get_user_meta($curauth->ID, "points_user_day", true); ?> punti oggi</span>sul <a href="http://www.tasc.it/tasc-rank">Tasc Rank</a></td>
						    		<td><span><?php echo get_user_meta($curauth->ID, "points_user_total", true); ?> punti totali</span>nella classifica storica.</td>
						    		<td><span><?php $podi = get_user_meta($curauth->ID, "points_first_place", true) + get_user_meta($curauth->ID, "points_second_place", true) + get_user_meta($curauth->ID, "points_third_place", true); echo $podi; ?> podi</span>nel Tasc Rank, di cui <?php if (get_user_meta($curauth->ID, "points_first_place", true)) {echo  get_user_meta($curauth->ID, "points_first_place", true);} else {echo "0";} ?> volte primo, <?php if (get_user_meta($curauth->ID, "points_second_place", true)) {echo  get_user_meta($curauth->ID, "points_second_place", true);} else {echo "0";} ?> volte secondo e <?php if (get_user_meta($curauth->ID, "points_third_place", true)) {echo  get_user_meta($curauth->ID, "points_third_place", true);} else {echo "0";} ?> volte terzo.</td>
						    	</tr>
						    	<tr>
						    		<td><span><?php echo get_user_meta($curauth->ID, "points_record_place", true); ?>° posizione</span>record in classifica del <a href="http://www.tasc.it/tasc-rank">Tasc Rank</a></td>
						    		<td><span><?php echo get_user_meta($curauth->ID, "points_record_day", true); ?> punti</span>record di punti in un giorno totalizzati il <?php echo get_user_meta($curauth->ID, "points_record_day_date", true); ?></td>
						    		<td><span><?php echo get_posts_count_from_last_15days('post',$curauth->ID); ?> post scritti</span>negli ultimi 15 giorni, di cui <?php echo get_posts_count_from_last_15days_snack($curauth->ID,'post'); ?> post brevi.</td>
					    		</tr>
						    	<tr>
						    		<td><span><?php echo $words_number; ?> parole scritte</span>negli ultimi 30 giorni</td>
						    		<td><span><?php echo $comments_number; ?> commenti ricevuti</span>negli ultimi 30 giorni.</td>
						    		<td><span><?php echo $views_number; ?> visite ricevute</span>negli ultimi 30 giorni.</td>
						    	</tr>
					    	</table>
				    	</div>
				    	
				    	<div class="story-center">
					    	<h1 class="black">Storia dei punti</h1>
					    	<div id="authorchart" class="story-center" style="height:250px;">
					    	</div>
					    </div>
				    	<div class="story-center">
					    	<h1 class="black">Storia posizione nel Tasc Rank</h1>
					    	<div id="authorposition" class="story-center" style="height:250px;">
					    	</div>
					    </div>
					</div>
				<?php } ?>
			</div>  <!-- end #content-container -->    

			<script>
			
				new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'authorchart',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: [
				  
				  <?php
				  $pointshistory = get_user_meta($curauth->ID, "points_history", true);
				  $last_days = array_reverse($pointshistory);
				  $i = 0;
				  foreach ($pointshistory as $key => $value) {
				  		$date = date("Y-m-d", strtotime($key));
					  echo "{ date: '". $date ."', value: ". $value['points']."},";
					 /* $i++;
					  if ($i==30) {
						  break;
					  }*/
				  }
				  ?>
				  ],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'date',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['value'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['Punti'],
				  xLabels: ['day']
				});			
			
				new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'authorposition',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: [
				  
				  <?php
				  $i = 0;
				  foreach ($pointshistory as $key => $value) {
				  		$date = date("Y-m-d", strtotime($key));
					  echo "{ date: '". $date ."', value: ". $value['pos']."},";
					  $i++;
					 /* if ($i==30) {
						  break;
					  }*/
				  }
				  ?>
				  ],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'date',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['value'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['Posizione'],
				  xLabels: ['day']
				});			
			
			</script>
			<?php get_template_part( 'parts/grafitebar' ); ?>
<?php get_footer(); ?>
