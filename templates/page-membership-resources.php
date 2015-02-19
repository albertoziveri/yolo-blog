<?php /* Template name: All you can Eat  RESOURCES*/ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
				
					    <div id="main" class="eightcol first clearfix page" role="main">
					    
						    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								    <header class="article-header">
									    <div class="page-icon iconfontextra grafitestyle">f</div>
									    <h3>Resource Library</h3>
									    <div class="center-wrap desc">Benvenuto nel Resource Library di Tasc All You Can Eat. Ogni giorno qui possono essere aggiunti dai membri del Cast link per scaricare risorse e freebies interessanti, oltre che links tecnici per creativi, programmatori e web designer.</div>
								    </header> <!-- end article header -->
								    
								    <hr class="strong" />
								    
								    <section class="post-content clearfix" itemprop="articleBody">
										<?php
										$taxonomy = 'link_category';
										$title = 'Link Category: ';
										$args ='include=6225,6226,6227';
										$terms = get_terms( $taxonomy, $args );
										if ($terms) {
											foreach($terms as $term) { ?>
												    	<div class="simple-story center-wrap gray-story">
												    		<h1><?php echo $term->name; ?></h1>
												    		<p class="story-centered"><?php echo $term->description; ?></p>
												    		<ul class="linklist">
													    		<?php
													    		$bookmarks = get_bookmarks( array(
													    			'orderby'        => 'link_id',
													    			'order'          => 'DESC',
													    			'category'  => $term->term_id
													    		));
													    		
													    		// Loop through each bookmark and print formatted output
													    		foreach ( $bookmarks as $bookmark ) { 
													    		    printf( '<li><a class="relatedlink" href="%s">%s</a></li>', $bookmark->link_url, $bookmark->link_name );
													    		}
													    		?>
												    		</ul>
												    	</div>
													<?php 
											}
										}
										?>								    
								    </section> <!-- end article section -->
				
							    </article> <!-- end article -->
						
						    <?php endwhile; ?>		
												
						    <?php endif; ?>
	    				</div> <!-- end #main -->
	    				
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>
