<?php /* Template name: All you can eat panel */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								    <header class="article-header">
									    <div class="page-icon iconfont grafitestyle">h</div>
									    <h3>All you can eat</h3>
									    <div class="desc center-wrap">Benvenuto in All You Can Eat. Da qui accedi ai tuoi vantaggi, e puoi gestire il tuo account.</div>
								    </header> <!-- end article header -->
								    
								    <hr class="strong" />
								    
								    <section class="post-content clearfix" itemprop="articleBody">
								    	<div class="story-center">
								    		<ul class="buttons">
								    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/account/">Gestisci account</a></li>
								    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/richiedi/">Richiedi</a></li>
								    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/link-temple/">Link Temple</a></li>
								    			<li class="button-container"><a href="http://www.tasc.it/all-u-can-eat/resource-library/">Resource Library</a></li>
								    		</ul>
								    	</div>
								   </section>
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>
