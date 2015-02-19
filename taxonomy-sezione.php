<?php get_header(); ?>
			<?php 
			$business = get_terms( 'sezione', 'parent=business' );
			$howto = get_terms( 'sezione', 'parent=howto' );
			$queried_object = get_queried_object();  
			$term_id = $queried_object->term_id; 
			$parent  = get_term_by( 'id', $term_id, 'sezione'); 
			
			$paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;
			 ?>
				<?php if($parent->parent == "2348" or $parent->slug == "business") { ?>
					<div id="content-header"> 
						<div class="header-image business"></div>
						<ul id="content-menu" class="content-menu-cut wrap">
							<li><a href="http://www.tasc.it/sezione/business">Home Business</a></li>
							<?php wp_list_categories('taxonomy=sezione&hide_empty=0&title_li=&child_of=2348'); ?> 
						</ul>
					</div>
				<?php } ?>
				
				<?php if($parent->parent == "2958" or $parent->slug == "howto") { ?>
					<div id="content-header"> 
						<div class="header-image howto"></div>
					</div>
				<?php } ?>
				
				
				<?php  //Queste top stories sono copiate dalla index.
				if ($detect->isMobile() && !$detect->isTablet()) { ?> 
				<div id="content">					
					<div id="inner-content" class="clearfix">						
						
					    <div id="main" class="eightcol first clearfix" role="main">
						    <div id="articles">
							    <?php $query = new WP_Query($query_string. '&offset='.($paged-1)*14);
							    
							    	if ( $query->have_posts()) : while ( $query->have_posts()) :  $query->the_post();  { get_template_part( 'loop' ); } endwhile; endif; ?>		
							</div>
	    				</div> <!-- end #main -->
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
				
				<?php } else { ?>
				<div id="content-top" class="wrap">
					<div id="top-stories">
						<div id="main-story" class="big-story">		
								<?php query_posts($query_string.'&showposts=1&offset='.($paged-1)*14); ?>
								<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
									    	<?php get_template_part( 'loop','bigstory' ); ?>
									</article>
								<?php endwhile; ?>	
								<?php endif; ?>
							</div> <!-- End top-stories -->
							
							<div id="side-story" class="big-story">
								<?php query_posts($query_string . '&showposts=1&offset='.((($paged-1)*14)+1)); ?>
								<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix side-post permalink'); ?> role="article">
									    	<?php get_template_part( 'loop','bigstory' ); ?>
									</article>
								<?php endwhile; ?>	
								<?php endif; ?>
							</div> 
					</div>
					<div id="top-stories" class="stories-table">
						<div id="main-story" class="big-story">		
								<?php query_posts($query_string . '&showposts=1&offset='.((($paged-1)*14)+2)); ?>
								<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
									    	<?php get_template_part( 'loop','bigstory' ); ?>	
									</article>
								<?php endwhile; ?>	
								<?php endif; ?>
							</div> <!-- End top-stories -->
							
							<div id="side-story" class="big-story">
								<?php query_posts($query_string . '&showposts=1&offset='.((($paged-1)*14)+3)); ?>
								<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate[] = $post->ID; ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix side-post permalink'); ?> role="article">
									    	<?php get_template_part( 'loop','bigstory' ); ?>
									</article>
								<?php endwhile; ?>	
								<?php endif; ?>
							</div> 
					</div><!-- End main-stories -->
				</div>
				
				<?php get_template_part( 'parts/grafitebar' ); ?>
			 
			<div id="content-container" class="wrap">
				<div id="content">					
					<div id="inner-content" class="clearfix center-wrap">	
							<h1 class="archive-title">Altre Storie</h1>					
						    <div id="articles">
							    <?php $query = new WP_Query($query_string.'&offset='.((($paged-1)*14)+4));
							    
							    	if ( $query->have_posts()) : while ( $query->have_posts()) :  $query->the_post();  { get_template_part( 'loop' ); } endwhile; 
							    	
							        if (get_next_posts_link() or get_previous_posts_link()) {  ?>
									        <nav class="wp-prev-next button-container">
										        <ul class="clearfix">
											        <li class="prev-link"><?php next_posts_link('Vai nel passato') ?></li>
											        <li class="next-link"><?php previous_posts_link('Torna al presente') ?></li>
										        </ul>
									        </nav>
								        <?php }  	
							    	
							    	 endif; ?>		
							</div>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
				<?php } //non è mobile ?> 
			</div>  <!-- end #content-container -->    

<?php get_footer(); ?>