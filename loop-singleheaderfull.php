					<?php 
						global $post;
						//get the right thumbnail
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
						$thumb= $thumb_url[0];
					?>
					<div id="super-header">
						<div id="large-post-header" <?php if ( has_post_thumbnail() ) { ?>style="background-image:url('<?php echo $thumb; ?>');"  <?php } ?>  >
							<div id="full-post-info">
								<div id="super-title"><h1 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>
								<div id="super-author">
									<h2>
										<span class="gravatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '120' ); } ?></span>
										<span class="author-details">creato da <?php the_author_posts_link(); ?> in <?php the_category(', '); ?></span>
									</h2>
								</div>
							</div>
			    			<div class="gradient"></div>
						</div>
					</div>