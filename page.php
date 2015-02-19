<?php get_header(); ?>
			<div id="content-container" class="center-wrap">
				<div id="content">
					<div id="inner-content" class="clearfix">
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    								
								    <header class="article-header">
									    <h1 class="page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								    </header> <!-- end article header -->
							
								    <section class="post-content clearfix post-content-article" itemprop="articleBody">
									    <?php the_content(); ?>
								    </section> <!-- end article section -->
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
						
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