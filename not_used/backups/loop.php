<?php
$important= get_post_meta(get_the_ID(), 'opt_notbig', true);
$format = get_post_format();
if ($important=="on") {
?>
							    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix small'); ?> role="article">
							    	<div class="post-info">
								    	<div class="thumbnail">
								    		<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-rect'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?>
								    	</div>
								    
									    <footer class="article-footer">
									    	<p class="readtime">da leggere in <?php $mycontent = $post->post_content; $word = str_word_count(strip_tags($mycontent));$m = floor($word / 200);$s = floor($word % 200 / (200 / 60));$est = $m . ' minuti e ' . $s . ' secondi'; echo $est; ?></p>
			    							<div class="shareme" data-url="<?php the_permalink() ?>" data-text="Tasc.it | <?php the_title(); ?>"></div>
									    </footer> <!-- end article footer -->
									</div>
								    <header class="article-header">
										<div class="cat"><?php if($format == 'aside') { ?><span>SNACK</span> <?php } the_category(', '); ?></div>
									    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									    <p class="meta">Di <?php the_author_posts_link(); ?> il <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
								    </header> <!-- end article header -->
							  															
								    <section class="post-content clearfix">
									    <?php the_content('<p class="readmore">(Leggi tutto...)</p>'); ?>
								    </section> <!-- end article section -->
								
							    </article> <!-- end article -->

<?php
//Se è uno snack
} elseif ($format == 'aside') {
?>

						    
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix snack large'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    <header class="article-header">
									<div class="cat"><span>SNACK</span> <?php the_category(', '); ?></div>
								    <h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							    </header> <!-- end article header -->
							    													
							    <section class="post-content clearfix" itemprop="articleBody">
							    	<div class="thumbnail">
							    		<a class="nohover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-big'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?></a>
							    	</div>
									<?php echo content(300); ?>
							    </section> <!-- end article section -->
							
							    <footer class="article-footer">
	    							<div class="author"><?php the_tags('<span class="tags_icon spr"></span> ', ', ', ''); ?></div>
	    							<div class="shareme" data-thumb="<?php wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumb' ); ?>" data-url="<?php the_permalink() ?>" data-text="Tasc.it | <?php the_title(); ?>">
	    							</div>
							    </footer> <!-- end article footer -->
						    </article> <!-- end article -->



<?php

//Se non è importante e non è snack
} else {
?>

						    
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix large'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    <header class="article-header">
									<div class="cat"><?php the_category(', '); ?></div>
								    <h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							    </header> <!-- end article header -->
							    													
							    <section class="post-content clearfix" itemprop="articleBody">
							    	<div class="thumbnail">
							    		<a class="nohover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-big'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?></a>
							    	</div>
								<?php the_content(); ?>
							    </section> <!-- end article section -->
							
							    <footer class="article-footer">
	    							<div class="shareme" data-thumb="<?php wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumb' ); ?>" data-url="<?php the_permalink() ?>" data-text="Tasc.it | <?php the_title(); ?>">
	    							</div>
							    </footer> <!-- end article footer -->
						    </article> <!-- end article -->



<?php 
}

?>