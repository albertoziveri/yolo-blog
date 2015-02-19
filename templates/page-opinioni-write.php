<?php /* Template name: OPINIONI scrivi */ ?>  

<?php get_header(); ?>
<?php

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

// Do some minor form validation to make sure there is content
if (isset ($_POST['title'])) {
	$title =  $_POST['title'];
} else {
	echo 'Please enter a  title';
}
if (isset ($_POST['description'])) {
	$description = $_POST['description'];
} else {
	echo 'Please enter the content';
}

// Add the content of the form to $post as an array
if(is_user_logged_in()) {
	$new_post = array(
		'post_title'    => $title,
		'post_content'  => $description,
		'post_status'   => 'pending',           // Choose: publish, preview, future, draft, etc.
		'post_type' => 'opinion'  //'post',page' or use a custom post type if you want to
	);
} else {
	$new_post = array(
		'post_title'    => $title,
		'post_content'  => $description,
		'post_status'   => 'pending',           // Choose: publish, preview, future, draft, etc.
		'post_type' => 'opinion',  //'post',page' or use a custom post type if you want to
		'post_author' => 103
	);
}

//Invio email ai tasc manager
$editors = get_users('role=tasc_manager');
$editors2 = get_users('role=editor');
foreach ($editors as $editor) {
	$editors_emails[] = $editor->user_email;
}
foreach ($editors2 as $editor) {
	$editors_emails[] = $editor->user_email;
}
$headers[] = 'From: Cast <cast@tasc.it>';
	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
    wp_mail($editors_emails,'Nuova opinione in attesa di revisione',$title . ' in attesa di revisione. <a href="http://www.tasc.it/wp-admin/edit.php?post_type=opinion">Revisionalo il prima possibile.</a><br /> <strong>Go Cast Go Fast. Tasc Power.</strong>',$headers);



//save the new post
$pid = wp_insert_post($new_post);
} 

?>



			<div id="content-container" class="wrap center-wrap">
				<div id="content" class="full-width">
					<div id="inner-content" class="clearfix">
							    								
					    <header class="article-header">
						    <h3>La tua opinione</h3>
						    <div class="desc">Scrivi la tua opinione riguardo qualsiasi cosa: un'emozione, un racconto, una storia.</div>
					    </header> <!-- end article header -->
					    <hr class="strong" />
					    <section class="post-content clearfix  center-wrap" itemprop="articleBody">
						    <div class="simple-story">
						    
							    <?php if(isset($_POST['submit'])) { ?>
							    	<?php if ( is_user_logged_in() ) { ?>
									<p>Grazie per aver inviato la tua opinione. Sarà revisionata e pubblicata in 24 ore. Per una corretta visualizzazione del tuo articolo, ricordati di impostare il tuo <a href="http://www.tasc.it/logged/account/">profilo</a> e di registrarti a <a href="http://www.gravatar.com">Gravatar</a> per inserire un immagine di profilo associata alla tua mail.</p>
									<?php } else { ?>
									<p>Grazie per aver inviato la tua opinione. Sarà revisionata e pubblicata in 24 ore.</p>
									<?php }
								 } else { ?>
				                    <div id="postbox">
				                    	<form id="new_post" name="new_post" method="post" action="" onsubmit="document.getElementById('description').value = document.getElementById('theopinion').innerHTML;">
				                            <!-- post name -->
				                            <p><label for="title">Titolo</label><br />
				                            <input type="text" id="title" value="" tabindex="1" size="30" name="title" />
				                            </p>
				                            
				                            <!-- post Content -->
				                            <textarea hidden="true" id="description" tabindex="4" name="description" cols="50" rows="15"></textarea>
				                            
				                            <article id="theopinion" contenteditable="true">
				                            	<p>Scrivi qui il tuo articolo... Seleziona le parti di testo che vuoi formattare.</p>
				                            </article>
		
				                            <p align="right"><input type="submit" value="Invia per revisione" tabindex="6" id="submit" name="submit" /></p>
								    		
								    		<?php if ( is_user_logged_in() ) { } else { ?>
												<p>La tua opinione verrà pubblicata come anonima perché non sei un Tasc VIP, puoi sempre <a href="http://www.tasc.it/signup/tasc-vip-register/">registrati gratuitamente</a></p>
								    		<?php } ?>

				                            <input type="hidden" name="action" value="new_post" />
				                            <?php wp_nonce_field( 'new-post' ); ?>
				                    	</form>
				                        
				                    </div>					    
									<?php }	 ?>
							    </div>
						    
						    
						</section>
					</div> <!-- end #inner-content -->
	    
				</div> <!-- end #content -->
			</div>  <!-- end #content-container -->    
<?php get_footer(); ?>