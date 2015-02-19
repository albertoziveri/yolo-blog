<?php /* Template name: Diventa membro */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    								
								    <header class="article-header">
									    <h1 class="page-title smaller" itemprop="headline"><?php the_title(); ?></h1>
									    <h2 class="smaller">e impara qualcosa</h2>
								    </header> <!-- end article header -->
							
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="simple-story center-wrap">
									    <div class="story-icon iconfontextra">l</div>
									    	<h1>Qualcosa di diverso</h1>
									    	<p>Tasc, come avrai letto <a href="http://www.tasc.it/ciao">qui</a>, è un progetto davvero unico: giovani tra i 15 ed i 40 anni, provenienti da tutta Italia, lavorano insieme per qualcosa in cui credono. Questo è il Cast, l'insieme di tutti i membri del magazine Tasc e del laboratorio Grafite. Non esiste un'altra struttura simile alla nostra ed è per questo che il nostro progetto è assolutamente innovativo. Entrare a farne parte non costa niente ed è un'esperienza diversa, che ti allontana dalla routine quotidiana, ti mette in gioco ed accresce il tuo bagaglio culturale. In questa pagina scoprirai come entrare a far parte del nostro team, cosa potrai fare e quali sono i vantaggi che otterrai.</p>
								    	</div>
								    	
								    	<hr class="strong" />
								    	
								    	<div class="simple-story center-wrap">
									    <div class="story-icon iconfontextra">m</div>
									    	<h1>Chiunque deve fare la differenza</h1>
									    	<p>Non abbiamo solo blogger di alta qualità, ma anche sviluppatori, creativi, designer ed inventori che lavorano in <a href="http://www.grafite.io">Grafite</a>. Ma non basta: abbiamo anche amministratori, gestori dei social, assistenti e grafici. Su Tasc puoi fare di tutto, accettiamo ogni tipo di talento perchè non siamo un semplice blog ma un progetto innovativo. Organizzare il tutto è davvero difficile.. ah già, puoi aiutarci anche a fare quello!</p>
								    	</div>
								    	
								    	<hr class="strong" />
								    	
								    	<div class="simple-story center-wrap">
									    <div class="story-icon iconfontextra">n</div>
									    	<h1>Come entrare</h1>
									    	<p>Abbiamo creato un efficace sistema di integrazione: leggi <strong><a href="https://docs.google.com/document/d/1pu0EB-zv1dfP-iYv2rhgdNXlCP3H4e2S3TwRVjMOwrE/edit?usp=sharing">la guida</a></strong> con tutte le informazioni di cui hai bisogno per entrare in Tasc; se sei interessato, puoi fare domanda compilando <a href="https://podio.com/webforms/6957836/536071"><strong>questo modulo</strong></a>. Il processo di integrazione nel Cast richiede almeno due settimane perché preferiamo un processo più lento ma efficace, che ci assicuri che la gente sia ben selezionata e pronta ad un progetto che mira all'eccellenza.</p>
								    	</div>
								    	
								    	<hr class="strong" />
								    	
								    	<div class="story-big">
									    	<h1>8 vantaggi</h1>
									    	<table class="clean">
										    	<tr>
										    		<td><span>Una fucina di talenti</span>Imparerai a lavorare e collaborare in gruppo, con altre persone di estremo talento, che raramente potresti conoscere in altro modo.</td>
										    		<td><span>Metodo</span>Tasc insegna una filosofia ed un metodo di lavoro che aspirano all'eccellenza.</td>
										    		<td><span>Una grande lezione</span>Scrivi ciò che ti piace, lavora ad un'idea che ti eccita, gestisci i social network, impara ad usare strumenti usati da tante vere aziende: Wordpress, Basecamp, Flickr, Wunderlist e tanti altri, tutti pagati da Tasc.</td>
										    		<td><span>Crescita</span>Chi entra in Tasc cresce, sempre. Da una chiacchierata ad un articolo c'è sempre qualcosa da imparare: la cultura, la pratica, il metodo piuttosto che la mentalità. 
Tasc ha già aiutato più volte i propri membri a raggiungere obiettivi personali.</td>
										    	</tr>
										    	<tr>
										    		<td><span>Impegno</span>Tasc è una sfida, un impegno ed una responsabilità. Ognuno sceglie quanto tempo può dedicarvi, a patto che la scelta sia responsabile.</td>
										    		<td><span>Punta in alto</span>Chiunque lavori a Tasc lo fa perché è convinto che un giorno questo progetto possa diventare qualcosa di importante. E se non lo diventerà, avrà comunque imparato tanto.</td>
										    		<td><span>Soddisfazioni e personalità</span>Tasc dà soddisfazione, gli amministratori si assicurano sempre che i meriti vengano riconosciuti, anche pubblicamente di fronte alle migliaia di lettori giornalieri.</td>
										    		<td><span>Valori e professionalità</span>Tasc è un progetto serio con l'obiettivo di ispirare a tutti i membri valori quali l'onestà, il rispetto e la lealtà.</td>
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