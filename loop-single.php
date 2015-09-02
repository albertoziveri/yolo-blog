<?php
//Se è un articolo SUPER
$large = get_post_meta(get_the_ID(), 'opt_large', true);
if ( $large == "on" or $large == 1 ) {
	
	//VECCHIO

?>

						    <article id="post-<?php the_ID(); ?>" <?php if(is_single()) {post_class('clearfix single');} else {post_class('clearfix snack');} ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<?php get_template_part( 'parts/sharebox' ); ?>
						    <section class="post-content post-content-article clearfix" itemprop="articleBody">
							<?php the_content(); ?>
						    </section> <!-- end article section -->

<?php
//Se è uno snack
}
elseif ( has_post_format( 'aside' )) {
?>
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix snack single'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							    <header class="article-header clearfix">
									<div class="cat"><span class="snack">SNACK</span> <?php the_category(', '); ?></div>
								    <h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								    
							    </header> <!-- end article header -->
							    		
								<?php get_template_part( 'parts/sharebox' ); ?>
							    		
							    													
							    <section class="post-content post-content-article clearfix" itemprop="articleBody">
								<?php the_content(); ?>
							    </section> <!-- end article section -->

<?php

//Se non è snack ed è un articolo
} else {
?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix single'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
    
	    <header class="article-header clearfix">
			<div class="cat"><?php the_category(', '); ?></div>
		    <h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
	    </header> <!-- end article header -->
	    
		<?php get_template_part( 'parts/sharebox' ); ?>
	    
	    <?php if ( has_post_thumbnail() ) { ?>
    	<div class="thumbnail">
    		<?php the_post_thumbnail('thumb-big'); ?>
    	</div>
    	<?php } ?>
							
	    <section class="post-content post-content-article clearfix" itemprop="articleBody">
			<?php  the_content(''); ?>
	    </section> <!-- end article section -->

<?php 
}
?>

<footer class="article-footer">
    <div class="meta post-detailed-info " class="updated" datetime="<?php get_the_time( 'Y-m-j' ); ?>" >Pubblicato il <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></div>
    
	<div class="tags post-detailed-info " style="display: none;"><?php the_tags('<span class="tags_icon iconfont">j</span> ', ', ', ''); ?></div>	
	<div id="post-rating" class="post-detailed-info"><?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>	
</footer> <!-- end article footer -->


<div class="theauthor clearfix">
	<div class="image"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '280' ); }?></div>
	
	<div class="about">
		<h1 class="h1 author mediumone"><?php the_author_posts_link(); ?></h1>
		<p><?php the_author_description(); ?></p>
	    <?php 
	    		$curauth = get_userdata(get_the_author_meta('ID'));
	    ?>
		<ul class="social">
	  		<?php if ($curauth->twitter) { ?><li><a class="tasc-button smallbtn twitter" target="_blank" href="http://www.twitter.com/<?php echo $curauth->twitter; ?>">Twitter</a></li><?php } ?>
	  		<?php if ($curauth->facebook) { ?><li><a class="tasc-button smallbtn facebook" target="_blank" href="http://www.facebook.com/<?php echo $curauth->facebook; ?>">Facebook</a></li><?php } ?>
	  		<?php if ($curauth->instagram) { ?><li><a class="tasc-button smallbtn instagram" target="_blank" href="http://www.instagram.com/<?php echo $curauth->instagram; ?>">Instagram</a></li><?php } ?>
	  		<?php if ($curauth->flickr) { ?><li><a class="tasc-button smallbtn flickr" target="_blank" href="http://www.flickr.com/<?php echo $curauth->flickr; ?>">Flickr</a></li><?php } ?>
	  		<?php if ($curauth->linkedin) { ?><li><a class="tasc-button smallbtn linkedin" target="_blank" href="http://www.linkedin.com/in/<?php echo $curauth->linkedin; ?>">LinkedIn</a></li><?php } ?>
	  		<?php if ($curauth->user_url) { ?><li><a class="tasc-button smallbtn more" target="_blank" href="<?php echo $curauth->user_url; ?>">di più</a></li><?php } ?>
  		</ul>
	</div>
	
</div>

<h1 class="mediumone">Esprimi la tua</h1>
<?php comments_template(); // comments should go inside the article element ?>
</article> <!-- end article -->
