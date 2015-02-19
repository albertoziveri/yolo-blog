<?php /* Template name: Lab page */ ?>  

<?php get_header(); ?>	
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
	
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    								
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="story-big">
								    		<div class="story-img">
								    			<img src="<?php echo get_stylesheet_directory_uri(); ?>/library/images/immagini/grafite.jpg" alt="grafite" />
								    		</div>
								    	</div>
								    
								    	<div class="simple-story center-wrap">
									    	<h1>Il lato produttivo</h1>
									    	<p>Il progetto di Tasc non è solo un progetto volto a ricercare e produrre grandi articoli su Tasc.it. Tasc è un progetto che include un laboratorio virtuale, che abbiamo chiamato <a href="http://www.grafite.io">Grafite</a>. Ne fanno parte ideatori, designer, sviluppatori, artigiani e altre persone che hanno come scopo quello di realizzare ogni genere di idea. Proponila, discutila, valuta con il team se vale la pena svilupparla, fatti aiutare a trovare i mezzi per realizzarla. Non ci sono limiti alla creatività: puoi proporre un social network, una linea di abbigliamento, un piccolo file digitale. <strong>Tutto è possibile.</strong></p>
								    	</div>

								    	<div class="story-center story-info story">
									    	<h1 class="black">Grafite Power</h1>
									    	<p class="story-centered">Ecco perché dovresti entrare nel nostro laboratorio senza cercare finanziatori esterni o metterti in proprio.</p>
									    	<table class="clean">
										    	<tr>
										    		<td><span>Promozione</span>Avrai la promozione costante di Tasc</td>
										    		<td><span>Infrastruttura</span>Potrai usare i server di Tasc (almeno inizialmente)</td>
										    		<td><span>Risorse umane</span>Troverai subito le persone migliori in grado di aiutarti a realizzare l'idea</td>
										    		<td><span>No limits</span>Non devi preoccuparti di alcuna questione burocratica, ci pensa Tasc.</td>
										    	</tr>
										    	<tr>
										    		<td><span>Feedback adeguato</span>Avrai un'ampia schiera di consiglieri di serie A, a tua scelta</td>
										    		<td><span>Massimo rispetto</span>Il merito e la proprietà dell'idea saranno dell'ideatore</td>
										    		<td><span>Meritocrazia</span>Eventuali guadagni saranno divisi in modo meritocratico</td>
										    		<td><span>Aiuto reciproco</span>Tasc aiuterà te, la tua idea aiuterà Tasc e Tasc Lab a crescere</td>
										    	</tr>
										    	<tr>
										    		<td><span>Servizi utili</span>Avrai a disposizione strumenti e servizi già pagati da Tasc (Basecamp, Flickr e altri)</td>
										    		<td><span>Piccoli finanziamenti</span>Tasc sosterrà le spese (almeno quelle più piccole)</td>
										    		<td><span>Massima segretezza</span>Ti daremo gli strumenti validi per mantenere la tua idea segreta, anche tra una ristretta cerchia di persone del lab</td>
										    		<td><span>Team</span>Sarai in un gruppo, e in un mondo in continua evoluzione in gruppo si lavora più velocemente</td>
										    	</tr>
									    	</table>
								    	</div>
								    	
								    	
								    	<div id="lab-users" class="story">
								    		<div id="inner_lab-users">
									    		<h1>Proponi un’idea (o <a href="http://www.tasc.it/entra-nel-cast/">diventa membro</a>)</h1>
											<?php echo do_shortcode('[contact-form-7 id="17120" title="Pagina Lab"]') ?>
									    	</div>
								    	</div>								    
									    <?php  // the_content(); ?>
								    </section> <!-- end article section -->
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>