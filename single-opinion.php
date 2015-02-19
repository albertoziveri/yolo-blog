		<?php get_header(); ?>
			<div id="content-container" class="wrap center-wrap">
			
				<div id="content">
	
					<div id="inner-content" class="clearfix">
				
							<?php if (have_posts()) : while (have_posts()) : the_post(); 
								
								get_template_part( 'loop', 'opinion' );

							 endwhile; ?>			
						
							<?php else : ?>
						
	    					    <article id="post-not-found" class="hentry clearfix">
								    <header class="article-header">
									    <h1 class="page-title" itemprop="headline">Pagina non trovata!!</h1>
								    </header> <!-- end article header -->
	    					    	<section class="post-content">
	    					    		<p>Controlla per bene l'indirizzo...</p>
	    					    	</section>
	    					    </article>
						
							<?php endif; ?>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
				
			</div>  <!-- end #content-container -->    

<?php get_footer(); ?>