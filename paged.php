<?php get_header(); ?>
			<div id="content-container" class="wrap center-wrap">
				<div id="content">			
				
					<div id="inner-content" class="clearfix">
				
							    <div id="articles">
							    <?php query_posts('showposts=10'); ?>
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>						 
								    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix many_posts'); ?> role="article">
									    <header class="article-header">
											<div class="cat"><?php the_category(', '); ?></div>
										    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
										    <p class="meta">Di <?php the_author_posts_link(); ?> il <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time> - da leggere in <?php $mycontent = $post->post_content; $word = str_word_count(strip_tags($mycontent));$m = floor($word / 200);$s = floor($word % 200 / (200 / 60));$est = $m . ' minuti e ' . $s . ' secondi'; echo $est; ?></p>
									    </header> <!-- end article header -->
								    	
								    	<div class="thumbnail">
								    		<?php if ( has_post_thumbnail() ) { the_post_thumbnail('post-thumb'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?>
								    	</div>
																
									    <section class="post-content clearfix">
										    <?php the_content('<p class="readmore">(Leggi tutto...)</p>'); ?>
									    </section> <!-- end article section -->
									
									    <footer class="article-footer">
			    							<div class="tags"><?php the_tags('<span class="tags_icon spr"></span> ', ', ', ''); ?></div>
			    							<div class="shareme" data-url="<?php the_permalink() ?>" data-text="Tasc.it | <?php the_title(); ?>"></div>
									    </footer> <!-- end article footer -->
								
								    </article> <!-- end article -->
							
							    <?php endwhile; ?>	
							        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
									        <nav class="wp-prev-next button-container">
										        <ul class="clearfix">
											        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
											        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
										        </ul>
									        </nav>
								        <?php }  ?>		
							
							    <?php else : ?>
							    
							        <article id="post-not-found" class="hentry clearfix">
							            <header class="article-header">
							        	    <h1>Articolo non trovato!</h1>
							        	</header>
							            <section class="post-content">
							        	    <p>Controlla bene l'url dell'articolo o cerca nel blog.</p>
							        	</section>
							        	<footer class="article-footer">
							        	    <p></p>
							        	</footer>
							        </article>
							
							    <?php endif; ?>
							    </div><!-- end articles -->
					    </div> <!-- end #main -->
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    

<?php get_footer(); ?>
