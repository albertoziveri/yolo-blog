<?php /* Template name: Hello page */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    								
								    <header class="article-header">
									    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									    <h2>benvenuto su tasc</h2>
								    </header> <!-- end article header -->
							
								    <hr class="strong" />
								    
								    <section class="post-content clearfix  center-wrap" itemprop="articleBody">
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">a</div>
								    		<h1>Tutto nasce da</h1>
								    		<p>Un'idea alimentata dalla continua necessit&agrave; di distinguersi dagli altri. La passione, lo studio, la ricerca e l'innovazione sono i mezzi che Tasc usa per produrre un lavoro migliore, unico e originale. Cos&igrave;, ogni giorno, un team di giovani arricchisce la filosofia del progetto con grande impegno e con brillanti intuizioni. Tecnologia, arti, scienze, tendenze, stili e culture: tutto &egrave; utile e affascinante.</p>
								    	</div>
									    <hr class="light" />
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">c</div>
								    		<h1>A proposito di Tasc</h1>
								    		<p>Tasc &egrave; un progetto innovativo che ha come obiettivo principale quello di pubblicare articoli di elevata qualit&agrave; frutto di ricerche, indagini, opinioni. Tutti i contenuti riguardano diversi argomenti di innovazione: tecnologie, scienza, stili e culture (capito perch&eacute; Tasc?). Tasc non produce notizie, vi dà un assaggio del futuro. Tasc include anche un laboratorio chiamato <a href="http://www.tasc.it/grafite">Grafite</a>.</p>
								    	</div>
									    <hr class="light" />
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">e</div>
								    		<h1>Produciamo: il laboratorio Grafite</h1>
								    		<p>Sapevate che la parte emersa di un iceberg &egrave; meno del 10% del suo volume totale? Questo perch&eacute;, molte volte, ci&ograve; che si vede rappresenta solo la punta di un progetto molto pi&ugrave; grande; infatti, alla base di Tasc c’&egrave; <a href="http://www.tasc.it/grafite">Grafite</a>, un’officina virtuale in cui vengono sviluppate e valorizzate tante idee. <a href="http://www.tasc.it/grafite">Scopri Grafite.</a></p>
								    	</div>
									    <hr class="light" />
								    	<div class="simple-story">
								    		<div class="story-icon iconfontextra">d</div>
								    		<h1>Cosa devi sapere</h1>
								    		<p>Tasc per ora &egrave; no-profit, quindi qualsiasi guadagno &egrave; utilizzato per pagare i costi e finanziare il laboratorio. La passione &egrave; il nostro carburante e la soddisfazione il nostro stipendio. Contiamo un team di oltre 25 persone che hanno dai 15 ai 35 anni, donne e uomini. Imparare &egrave; un'esperienza, tutto il resto &egrave; solo informazione.</p>
								    	</div>									    
									    <?php get_template_part( 'parts/sharebox' ); ?>
								    </section> <!-- end article section -->
				
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>