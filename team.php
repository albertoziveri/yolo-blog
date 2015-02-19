<?php /* Template name: Il CAST */ ?>  

<?php get_header(); ?>
			<div id="content-container" class="wrap">
				<div id="content" class="full-width">
					<div align="giustify" id="inner-content" class="clearfix">
				
							<!-- Titolo -->
						    <header class="article-header">
							    <h1 class="page-title" itemprop="headline">il Cast</h1>
							    <h2>un progetto forte richiede un forte team</h2>
							    <div class="desc center-wrap">Qui trovi i migliori membri di Tasc, divisi per ruolo. Alcuni fanno parte anche del laboratorio <a href="http://www.grafite.io">Grafite</a>. Visita la pagina per <a href="http://www.tasc.it/entra-nel-cast/">entrare nel Cast</a> nel caso fossi interessato a far parte del nostro team.</div>
						    </header> <!-- end article header -->
							
							<!--INIZIO BOX RUOLO AUTORE-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Autori</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list">
							
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
									
									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
									$posts = count_user_posts( $author->ID );
										if (check_user_role('author',$author->ID) and $posts>10) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->
							
							
							<!--INIZIO BOX RUOLO EDITORE-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Editori</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list pochimembri">
							
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
									
									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
										if (check_user_role('editor',$author->ID)) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
									
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->
							
							
							<!--INIZIO BOX RUOLO GESTORE DEI SOCIAL-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Social Manager</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list pochimembri">
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");

									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
										if (check_user_role('gestore_social',$author->ID)) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
									
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->
							

							<!--INIZIO BOX MEMBRO DEL LAB-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Grafite co-members</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list">
							
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
									
									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
										if (check_user_role('membro_lab',$author->ID)) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
									
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->
							
							
							<!--INIZIO BOX MEMBRO DEL LAB-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Tasc Managers</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list">
							
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
									
									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
										if (check_user_role('tasc_manager',$author->ID)) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
									
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->


							<!--INIZIO BOX RUOLO ADMIN-->
							<div class="profile-category">
								<hr class="hr-pagecast">
								<h2 class="h2-pagecast">Amministratori</h2>
								<hr class="hr-pagecast">
								<ul class="users-unordered-list">
							
									<?php
									global $wpdb;
									$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
									
									foreach($authors as $author) {
									$author = get_userdata( $author->ID );
										if (check_user_role('administrator',$author->ID)) {
										?>	
										<li class="users-list-item">
											<div class="profile">
												<div class="image-user">
													<a href="<?php echo get_author_posts_url($author->ID); ?>" class="boxtext">
														<?php echo get_avatar($author->ID, 300); ?>
												
														<div class="text">
															<h3 class="name"><?php echo $author->display_name; ?></h3>
														</div>
													</a>
												</div>
											</div>
										</li>
										<?php
										}
									}
									?>
									
								</ul>
							</div> 
							<!-- fine "BOX RUOLI" -->
							
							<div class="simple-story profile-category">
								<h2 class="h2-pagecast">The Cast Map</h2>
								<div id='map'></div>
								
								<script>
								var map = L.mapbox.map('map', 'albertoziveri.i4m9deo4');
								map.scrollWheelZoom.disable();
								
								var myLayer = L.mapbox.featureLayer().addTo(map);
								
								// The GeoJSON representing the two point features
								var geoJson = <?php 	     $tempurl = get_template_directory(); 
										 $userlocations = $tempurl .'/library/cache/userlocations.geojson';
									     $geojson = file_get_contents("$userlocations");
									   echo $geojson;
								 ?>;
								
								// Pass features and a custom factory function to the map
								myLayer.setGeoJSON(geoJson);
								myLayer.on('click', function(e) {
								    e.layer.unbindPopup();
								    window.open(e.layer.feature.properties.url);
								});
								</script>								
								
							</div>


					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>