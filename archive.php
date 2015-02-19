<?php get_header(); ?>
	<div id="content-container" class="wrap center-wrap">
		<div id="content">
		
			<div id="inner-content" class="clearfix">
			
				    <?php if (is_category()) { ?>
					    <h1 class="archive-title h2">
						    <?php single_cat_title(); ?>
				    	</h1>
				    
				    <?php } elseif (is_tag()) { ?> 
					    <h1 class="archive-title h2">
						    <span>Tag:</span> <?php single_tag_title(); ?>
					    </h1>
				    
				    <?php } elseif (is_author()) { ?>
					    <h1 class="archive-title h2">
					    	<span></span> <?php get_the_author_meta('display_name'); ?>
					    </h1>
				    
				    <?php } elseif (is_day()) { ?>
					    <h1 class="archive-title h2">
    						<span>Archivio giornaliero:</span> <?php the_time('l, F j, Y'); ?>
					    </h1>
	
	    			<?php } elseif (is_month()) { ?>
		    		    <h1 class="archive-title h2">
			    	    	<span>Archivio mensile:</span> <?php the_time('F Y'); ?>
				        </h1>
				
				    <?php } elseif (is_year()) { ?>
				        <h1 class="archive-title h2">
				    	    <span>Archivio annuale:</span> <?php the_time('Y'); ?>
				        </h1>
				    <?php } ?>
				    <div id="articles">
						<?php if (have_posts()) :  while (have_posts()) : the_post(); 
							get_template_part( 'loop' );
							endwhile;
						?>
										
					    <?php else : ?>
					
					        <article id="post-not-found" class="hentry clearfix">
					            <header class="article-header">
					        	    <h1>Articolo non trovato!</h1>
					        	</header>
					            <section class="post-content">
					        	    <p>Controlla bene l'url dell'articolo o cerca nel blog.</p>
					        	</section>
					        	<footer class="article-footer">
					        	    <p></p>
					        	</footer>
					        </article>
					
			        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
					        <nav class="wp-prev-next button-container">
						        <ul class="clearfix">
							        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
							        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
						        </ul>
					        </nav>
				        <?php }  ?>		
				    <?php endif; ?>
				</div> <!-- end #articles -->
            </div> <!-- end #inner-content -->
		</div> <!-- end #content -->
	</div>  <!-- end #content-container -->    
	<?php get_template_part( 'parts/grafitebar' ); ?>
<?php get_footer(); ?>