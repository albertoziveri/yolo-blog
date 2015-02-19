<?php /* Template name: All you can Eat */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								    <header class="article-header">
									    <div class="page-icon iconfont grafitestyle">h</div>
									    <h3>all you can eat</h3>
									    <div class="center-wrap desc">“All you can eat” è il servizio di membership di Tasc. È il modo per aiutare Tasc e il laboratorio Grafite pagando un prezzo simbolico di 25 € per sempre. Hai tutto quello che hai sempre avuto, più delle risorse extra molto interessanti, aggiornati ogni settimana. Quali vantaggi hai?</div>
								    </header> <!-- end article header -->
								    
								    <hr class="strong" />
								    
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="story-center">
									    	<table class="clean">
										    	<tr>
										    		<td><span>Il nostro ringraziamento</span>Diventando membri aiuti Tasc e Grafite, due progetti composti da 40 membri totali che lavorano ogni giorno in qualcosa in cui credono e che può migliorare il mondo, nel suo piccolo.</td>
										    		<td><span>App gratis</span>Avrai diritto (su richiesta) ad un codice promozionale gratuito (su richiesta) per ogni applicazione iOS e Android pubblicata da Grafite.</td>
										    		<td><span>Link library</span>Avrai accesso al <i>Tasc Link Temple</i> dove trovi tutte le fonti e i link preziosi del Cast, e poi avrai accesso al gruppo di Facebook dei membri di Tasc dove vengono pubblicati settimanalmente link e notizie esterne da vedere.</td>
										    	</tr>
										    	<tr>
										    		<td><span>Resource library</span>Avrai accesso ad una libreria di risorse made by Tasc e Grafite. Prevalentemente risorse grafiche come i mockup di tutti i nostri progetti.</td>
										    		<td><span>5% su tutto</span>Avrai diritto (su richiesta) ad un 5% di sconto su qualsiasi prodotto fisico e digitale prodotto da Tasc e Grafite. Quindi ad esempio hai diritto ad un 5% di sconto su <a href="http://www.fromowl.com">OWL</a>.</td>
										    		<td><span>Accesso Facebook</span>Avrai accesso al gruppo segreto di Facebook dove quotidianamente i membri del Cast condividono tutto ciò che ci interessa.</td>
									    		</tr>
									    	</table>
								    	</div>
								    	
								    	<hr class="strong" />
								    
								    	<div class="story-center story-centered">
									    	<?php if(MeprRule::is_allowed_by_rule(35954)) { ?> 
									    		<p>Grande! Hai già acquistato All You Can Eat! Apri il menu a sinistra per vedere i tuoi vantaggi.</p>
									    	<?php } else { ?> 
									    		<h1 class="black">Acquista ora</h1>
									    		<ul class="buttons">
										    		<!--<a class="tasc-button" href="http://www.tasc.it/signup/all-you-can-eat/">Mensile (€ 2,50 al mese)</a>
										    		<a class="tasc-button" href="http://www.tasc.it/signup/all-you-can-eat-yearly/">Annuale (€ 25 all'anno)</a>-->
										    		<a class="tasc-button" href="http://www.tasc.it/signup/all-you-can-eat-forever/">Per sempre (€ 25 per sempre)</a>
									    		</ul>
									    	<?php } ?>
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
