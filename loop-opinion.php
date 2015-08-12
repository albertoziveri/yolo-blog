    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix opinion'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
    
	    <header class="article-header clearfix">
		    <h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
	    </header> <!-- end article header -->
	    
	    <?php if ( has_post_thumbnail() ) { ?>
    	<div class="thumbnail">
    		<?php the_post_thumbnail('thumb-big'); ?>
    	</div>
    	<?php } ?>
							
	    <section class="post-content post-content-article clearfix" itemprop="articleBody">
			<?php  the_content(''); ?>
	    </section> <!-- end article section -->
	    
	    <footer class="article-footer">
		    <div class="meta meta-author"><?php echo get_avatar( get_the_author_email(), '50' ); the_author_posts_link(); ?></div>
			<div class="shareme">
				<ul class="tasc-social tasc-social-small">
	    			<?php $title = urlencode(get_the_title()); ?>
	    			<li><a id="fbshare" class="facebook" onclick="javascript:fbshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);"><span class="iconfont icon">a</span>Facebook</a></li>
	    			
	    			<li><a id="twittershare" class="twitter" onclick="javascript:twittershare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);"  target="blank"><span class="iconfont icon">b</span>Twitter</a></li>
	    			<li><a id="googleshare" class="gplus" onclick="javascript:googleshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);" target="blank" ><span class="iconfont icon">k</span>Google</a></li>
	    		</ul>
			</div>
	    </footer> <!-- end article footer -->
	</article>