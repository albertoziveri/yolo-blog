<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>

<?php if (have_posts()):?>
<div id="related_stories">
	<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix main-post permalink'); ?> role="article">
    	<div class="tasc-post">
    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
	    		<div class="title"><?php the_title(); ?></div>
    			<div class="overlay"></div>
    			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-big'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?>
			<div class="gradient"> </div>
    		</a>
    	</div>	
    </article>
	<?php endwhile; ?>
</div>

<?php else: ?>
<p>Nessun articolo correlato. Evidentemente &eacute; un articolo troppo unico.</p>
<?php endif; ?>
