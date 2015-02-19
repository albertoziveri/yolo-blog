<?php /* Template name: OPINIONI archivio */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap center-wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
							    								
					    <header class="article-header">
						    <div class="page-icon iconfontextra grafitestyle">h</div>
						    <h3>Opinioni</h3>
						    <div class="desc">Riflessioni, emozioni, considerazioni. Niente immagini. Solo testo.</div>
						    <a class="tasc-button" href="http://www.tasc.it/opinioni/write">Scrivi la tua</a>
					    </header> <!-- end article header -->
							
					    <hr class="strong" />
					    <div class="articles">
							<?php 
							
								//Se ci sono dei post nella categoria featured metto in evidenza quello.
								// The Query
								$the_query = new WP_Query( array( 'post_type' => 'opinion', 'posts_per_page' => 10)  );
								
								// The Loop
								if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) : $the_query->the_post(); 
										get_template_part( 'loop','opinion' );
									endwhile;
								/* Restore original Post Data */
								}
								wp_reset_postdata();
										
							?>	
							
					        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
							        <nav class="wp-prev-next button-container">
								        <ul class="clearfix">
									        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
									        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
								        </ul>
							        </nav>
					        <?php }  ?>		
						</div>		
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>