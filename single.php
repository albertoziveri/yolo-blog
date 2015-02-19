<?php 
//Se è un articolo largo fullscreen allora abilita l'header enorme, che è un duplicato di header.php ma che aggiunge la classe super-full al #container. Poi sotto, come vedrai, se è full super aggiunge l'header dell'articolo. Infine il loop viene gestito da loop-single, dove se sarà un articolo super non inserirà alcuna thumbnail o header ad inizio post.
global $post;
$large = get_post_meta($post->ID, 'opt_large', true);
get_header(); ?>
			
			
			<?php 
			//SE L'ARTICOLO è FULL SUPER
					$large = get_post_meta(get_the_ID(), 'opt_large', true);
					if ( $large == "on" or $large == 1 ) {					
						get_template_part( 'loop', 'singleheaderfull' );
					} ?>
		
			<div id="content-container" class="wrap center-wrap">
			
				<div id="content">
	
					<div id="inner-content" class="clearfix">
				
							<?php if (have_posts()) : while (have_posts()) : the_post(); 
								
								get_template_part( 'loop', 'single' );

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
			<?php get_template_part( 'parts/grafitebar' ); ?>
<?php get_footer(); ?>