<?php
$format = get_post_format();
if ($format == 'aside') {
?>
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix snack large'); ?> role="article">
							    <header class="article-header clearfix">
									<div class="cat"><span class="snack">SNACK</span> <?php the_category(', '); ?></div>
							    </header> <!-- end article header -->
							    													
							    <!--<section class="post-content clearfix">-->
							    	<div class="tasc-post">
							    		<a class="nohover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										    <h1 class="title"><?php the_title(); ?></h1>
							    			<div class="overlay"></div>
							    			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?>
							    			<div class="gradient"></div>
							    		</a>
							    	</div>
							    <!--</section>  end article section -->
							
							    <footer class="article-footer">
								    <div class="meta meta-author"><?php echo get_avatar( get_the_author_email(), '50' ); the_author_posts_link(); ?></div>
	    							<div class="shareme">
		    							<ul class="tasc-social tasc-social-small">
							    			<?php $title = urlencode(get_the_title()); ?>
							    			<li><a id="fbshare" class="facebook" onclick="javascript:fbshare('<?php the_permalink();?>/','<?php echo $title; ?>')" href="javascript:return(0);"><span class="iconfont icon">a</span>Facebook</a></li>
							    			
							    			<li><a id="twittershare" class="twitter" onclick="javascript:twittershare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);"  target="blank"><span class="iconfont icon">b</span>Twitter</a></li>
							    			<li><a id="googleshare" class="gplus" onclick="javascript:googleshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);" target="blank" ><span class="iconfont icon">k</span>Google</a></li>
							    		</ul>
	    							</div>
							    </footer> <!-- end article footer -->
						    </article> <!-- end article -->



<?php

//Se non è importante e non è snack
} else {
?>

						    
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix large'); ?> role="article">
							    <header class="article-header clearfix">
									<div class="cat"><?php the_category(', '); ?></div>
									<div class="time meta">
										<span class="iconfont">i</span>
										<?php 
												$mycontent = $post->post_content; 
												$word = str_word_count(strip_tags($mycontent));
												$m = floor($word / 200);
												$s = floor($word % 200 / (200 / 60)); 
												if ($m == "0") {
													$est = $s . ' secondi'; 
												} elseif ($m == "1") {
													$est = $m . ' minuto e ' . $s . ' secondi';
												} elseif ($m > "1") { 
													$est = $m . ' minuti e ' . $s . ' secondi';
												}
												echo $est; 
										?>										
									</div>
									
							    </header> <!-- end article header -->
							    													
							    <!--<section class="post-content clearfix">-->
							    	<div class="tasc-post">
							    		<a class="nohover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										    <h1 class="title"><?php the_title(); ?></h1>
							    			<div class="overlay"></div>
							    			<?php if ( has_post_thumbnail() ) { /*the_post_thumbnail('thumb-big');*/ the_post_thumbnail('large'); } else { ?><img src="<?php echo get_template_directory_uri(); ?>/library/images/no_thumbnail.png" /><?php } ?>
							    			<div class="gradient"></div>
							    		</a>
							    	</div>
							   <!--  </section> end article section -->
							
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
						    </article> <!-- end article -->



<?php 
}

?>