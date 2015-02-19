<?php /* Template name: Top authors page */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								    <header class="article-header">
									    <div class="page-icon iconfont grafitestyle">g</div>
									    <h3>Tasc Rank</h3>
									    <div class="desc center-wrap">Un complesso algoritmo sviluppato da <a href="http://www.grafite.io">Grafite</a> per classificare al meglio i <a href="http://www.tasc.it/cast">membri di Tasc, autori e non autori</a>, utilizzando 8 parametri tra i quali le visite ricevute, le parole scritte, le condivisioni sui social e gli articoli pubblicati. Aggiornato ogni sera alle 20.</div>
								    </header> <!-- end article header -->
								    
								    <hr class="strong" />
								    
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="story-big">
											<table id="topauthors" class="sortable regular">
												<!--Using http://joequery.github.io/Stupid-Table-Plugin/ -->
											    <thead>
											      <tr>
											        <th data-sort="int">#</th>
											        <th data-sort="string-ins">Membro</th>
											        <th data-sort="float">Punti</th>
											        <th data-sort="float" class="hidemobile">Record punti</th>
											        <th data-sort="int" class="hidemobile">Record posizione</th>
											        <th data-sort="int" class="hidemobile medal gold"><span></span></th>
											        <th data-sort="int" class="hidemobile medal silver"><span></span></th>
											        <th data-sort="int" class="hidemobile medal bronze"><span></span></th>
											      </tr>
											    </thead>
											    <tbody>
											    
										    	<?php
										    	
												function cmp( $a, $b )
												{ 
												  if(  $a->points_user_day ==  $b->points_user_day ){ return 0 ; } 
												  return ($a->points_user_day < $b->points_user_day ) ? 1 : -1;
												} 
												
												$args = array(
												'meta_key' => 'points_user_day'
												);
												$blogusers = get_users($args);
												usort($blogusers ,'cmp');
												$i = 0;
												foreach ($blogusers as $user) { if(user_can($user->ID,'publish_posts')) {} else {continue;} $i++; ?>
											      <tr>
											        <td class="points_pos"><?php echo $i; ?></td>
											        <td class="author_name"><?php echo get_avatar($user->ID, 60); ?><a href="<?php echo get_author_posts_url( $user->ID); ?>"><?php echo $user->display_name; ?></a></td>
											        <td class="points_user_day"><?php echo get_user_meta($user->ID, "points_user_day", true); ?></td>
											        <td class="points_record_day"><?php echo get_user_meta($user->ID, "points_record_day", true); ?></td>
											        <td class="points_record_place"><?php echo get_user_meta($user->ID, "points_record_place", true); ?></td>
											        <td class="points_first_place"><?php if (get_user_meta($user->ID, "points_first_place", true)=="") {echo "0";} else {echo get_user_meta($user->ID, "points_first_place", true);} ?></td>
											        <td class="points_second_place"><?php if (get_user_meta($user->ID, "points_second_place", true)=="") {echo "0";} else {echo get_user_meta($user->ID, "points_second_place", true);} ?></td>
											        <td class="points_third_place"><?php if (get_user_meta($user->ID, "points_third_place", true)=="") {echo "0";} else {echo get_user_meta($user->ID, "points_third_place", true);} ?></td>
											      </tr>
											    <?php 
											    }
											    ?>
											    </tbody>
											  </table>	
								    	</div>
								    	
								    	
								    	<div class="story-center">
								    		<h1 class="black">Classifica storica</h1>
											<table id="topauthors" class="sortable regular">
												<!--Using http://joequery.github.io/Stupid-Table-Plugin/ -->
											    <thead>
											      <tr>
											        <th data-sort="int">#</th>
											        <th data-sort="string">Membro</th>
											        <th data-sort="float">Punti</th>
											      </tr>
											    </thead>
											    <tbody>
											    
										    	<?php
										    	
												function cmp2( $a, $b )
												{ 
												  if(  $a->points_user_total ==  $b->points_user_total ){ return 0 ; } 
												  return ($a->points_user_total < $b->points_user_total ) ? 1 : -1;
												} 
												
												$args2 = array(
												'meta_key' => 'points_user_total'
												);
												$blogusers2 = get_users($args2);
												usort($blogusers2 ,'cmp2');
												$i = 0;
												foreach ($blogusers2 as $user) {if(user_can($user->ID,'publish_posts')) {} else {continue;} $i++; ?>
											      <tr>
											        <td class="points_pos"><?php echo $i; ?></td>
											        <td class="author_name"><?php echo get_avatar($user->ID, 60); ?><a href="<?php echo get_author_posts_url( $user->ID); ?>"><?php echo $user->display_name; ?></a></td>
											        <td class="points_user_day"><?php echo get_user_meta($user->ID, "points_user_total", true); ?></td>
											      </tr>
											    <?php 
											    }
											    ?>
											    </tbody>
											  </table>	
								    	</div>
								    	
								    	<div class="story-center">
								    		<h1 class="black">Record</h1>
								    		
									    	<table class="clean">
										    	<tr>
										    		<td>
												    	<?php
												    	
														function cmp3( $a, $b )
														{ 
														  if(  $a->points_times_first_record ==  $b->points_times_first_record ){ return 0 ; } 
														  return ($a->points_times_first_record < $b->points_times_first_record ) ? 1 : -1;
														} 
														
														$args3 = array(
														'meta_key' => 'points_times_first_record',
														'who' => 'authors',
														);
														$blogusers3 = get_users($args3);
														usort($blogusers3 ,'cmp3');
														$i = 0;
														foreach ($blogusers3 as $user) { $i++; ?>
										    			<span>
														     <?php echo get_user_meta($user->ID, "points_times_first_record", true); ?> volte consecutive primo
										    			</span>
										    			di <a href="<?php echo get_author_posts_url( $user->ID); ?>"><?php echo $user->display_name; ?></a> il  <?php echo get_user_meta($user->ID, "points_times_first_record_date", true); ?>
										    			<?php    if ($i ==1) break; } ?>
										    		</td>
										    		<td>
												    	<?php
												    	
														function cmp4( $a, $b )
														{ 
														  if(  $a->points_record_day ==  $b->points_record_day ){ return 0 ; } 
														  return ($a->points_record_day < $b->points_record_day ) ? 1 : -1;
														} 
														
														$args3 = array(
														'meta_key' => 'points_record_day',
														'who' => 'authors',
														);
														$blogusers3 = get_users($args3);
														usort($blogusers3 ,'cmp4');
														$i = 0;
														foreach ($blogusers3 as $user) { $i++; ?>
										    			<span>
														     <?php echo get_user_meta($user->ID, "points_record_day", true); ?> record punti
										    			</span>
										    			in un giorno, di <a href="<?php echo get_author_posts_url( $user->ID); ?>"><?php echo $user->display_name; ?></a> il  <?php echo get_user_meta($user->ID, "points_record_day_date", true); ?>
										    			<?php    if ($i ==1) break; } ?>
										    		</td>
										    	</tr>
										    </table>
								    		
								    	</div>
								    </section> <!-- end article section -->
				
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>
