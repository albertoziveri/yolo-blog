<?php /* Template name: Logged in */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    
						    		<?php if ( is_user_logged_in() ) { ?> 
									    <header class="article-header">
										    <h3>Benvenuto</h3>
										    <div class="desc center-wrap">Sei utente di Tasc! Cosa fai ora?</div>
									    </header> <!-- end article header -->
						    		<?php } else { ?> 
									    <header class="article-header">
										    <h3>Errore</h3>
										    <div class="desc center-wrap">Non sei autorizzato a vedere questa pagina.
									    			<a href="http://www.tasc.it/login">Collegati ora</a> oppure <a href="http://www.tasc.it/signup/tasc-vip-register/">registrati</a>.</div>
									    </header> <!-- end article header -->
						    		<?php } ?>
								    <hr class="strong" />
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="story-center">
								    		<?php if ( is_user_logged_in() ) { ?> 
									    		<ul class="buttons">
												 <?php if(MeprRule::is_allowed_by_rule(35954)) { ?>
									    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/home/">All You Can Eat</a></li>
												<?php } else { ?>
									    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/">Abbonati a All You Can Eat</a></li>
												<?php } ?>
													<li class="button-container"><a href="http://www.tasc.it/logged/account/">Gestione account</a></li>
									    			<li class="button-container"><a href="http://www.tasc.it/opinioni/write">Crea opinione</a></li>
									    			<li class="button-container"><a href="http://www.tasc.it/wp-admin/post-new.php">Crea articolo</a></li>
									    		</ul>
								    		<?php } ?>
								    	</div>
								   </section>
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>
