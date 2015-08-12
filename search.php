<?php get_header(); ?>
			<div id="content-container" class="center-wrap">
				<div id="content">
					<div id="inner-content" class="clearfix">
							<h1 class="archive-title">Risultati ricerca per  <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e('<span class="search-terms">'); echo $key; _e('</span>, ');  echo $count . ' ';  echo ' articoli trovati';  wp_reset_query(); ?></h1>
								<div id="articles">
									<?php if (have_posts()) : while (have_posts()) : the_post(); 
											get_template_part( 'loop','bigstory' );
										endwhile;
									?>
						
						        <?php if (get_next_posts_link() or get_previous_posts_link()) {  ?>
								        <nav class="wp-prev-next button-container">
									        <ul class="clearfix">
										        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
										        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
									        </ul>
								        </nav>
							        <?php }  ?>		
							    <?php endif; ?>
							    </div>
	    			</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
			<?php get_template_part( 'parts/grafitebar' ); ?>
<?php get_footer(); ?>