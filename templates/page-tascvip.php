<?php /* Template name: Tasc VIP */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    								
								    <header class="article-header">
									    <div class="page-icon iconfontextra grafitestyle">g</div>
									    <h3>VIP Program</h3>
									    <div class="desc center-wrap">Tasc, assieme al laboratorio <a href="http://www.grafite.io">Grafite</a>, è una miniera di talenti, risorse, opportunità, organizzazione e innovazione. Ci sono 3 modi per collaborare con Tasc, gratuitamente. La prima cosa che devi fare in ogni caso è registrarti a <a href="http://www.tasc.it/signup/tasc-vip-register/">Tasc.</a></div>
								    </header> <!-- end article header -->
							
								    <hr class="strong" />
								    
								    <section class="post-content clearfix  center-wrap" itemprop="articleBody">
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">i</div>
								    		<h1>1. Membro del Cast</h1>
								    		<p>Vuoi partecipare al massimo a Tasc o al laboratorio Grafite? <a href="http://www.tasc.it/entra-nel-cast/">Entra nel Cast.</a> Se vuoi essere un autore, uno sviluppatore, un designer o occuparti di qualsiasi altra cosa su Tasc, allora la via migliore è diventare membro del Cast. <a href="http://www.tasc.it/entra-nel-cast/">Maggiori info qui.</a></p>
								    	</div>
									    <hr class="light" />
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">k</div>
								    		<h1>2. Scrivi un articolo</h1>
								    		<p>Vuoi semplicemente scrivere un articolo su Tasc? Ci sono solo tre passaggi da fare:</p>
								    		<ul class="linklist">
								    			<li><a href="http://www.tasc.it/signup/tasc-vip-register/">1. Registrati gratuitamente a Tasc</a></li>
								    			<li><a href="https://docs.google.com/document/d/1jd4MDUrh2xn4n8Bu6Gxb8X0_Cbb5iAp7wK3VvYacIS0/edit?usp=sharing">2. Leggiti la guida dell'autore di Tasc</a></li>
								    			<li><a href="http://www.tasc.it/wp-admin/post-new.php">3. Scrivi l'articolo e aspetta l'approvazione</a></li>
								    		</ul>
								    	</div>
									    <hr class="light" />
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">j</div>
								    		<h1>3. Invia un'opinione</h1>
								    		<p>Hai un emozione di cui parlare? Un opinione politica da scrivere? Una riflessione da fare? Non esiste posto migliore che su Tasc, che ti offre il metodo più semplice e una grafica eccezionale per condividere i tuoi pensieri. Una volta registrato scrivi la tua opinione in <a href="http://www.tasc.it/opinioni/write">questa pagina</a>, la valuteremo in meno di 12 ore e la pubblicheremo il prima possibile nella pagina <a href="http://www.tasc.it/opinioni">Opinioni</a>.</p>
								    	</div>
								    </section> <!-- end article section -->
				
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>