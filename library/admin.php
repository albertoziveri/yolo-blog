<?php
/* 
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it 
function bones_login_css() {
	/* i couldn't get wp_enqueue_style to work :( */
	echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/library/css/login.css">';
}

// changing the logo link from wordpress.org to your site 
function bones_login_url() { echo bloginfo('url'); }

// changing the alt text on the logo to show your site name 
function bones_login_title() { echo get_option('blogname'); }

// calling it only on the login page
add_action('login_head', 'bones_login_css');
add_filter('login_headerurl', 'bones_login_url');
add_filter('login_headertitle', 'bones_login_title');


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really reccomend editing the admin too much
as things may get funky if Wordpress updates. Here
are a few funtions which you can choose to use if 
you like.
*/

// Custom Backend Footer
function bones_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://tasc.it" target="_blank">Tasc</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'bones_custom_admin_footer');


//Contributor capability - RICORDARSI DI RIMUOVERLA se si toglie!
function add_theme_caps() {
    // gets the author role
    $role = get_role( 'contributor' );
    $role2 = get_role( 'editor' );
    $role3 = get_role( 'author' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'upload_files' ); 
    $role2->add_cap( 'unfiltered_html' ); 
    $role3->add_cap( 'unfiltered_html' ); 
}
add_action( 'admin_init', 'add_theme_caps');


//INFO DASHBOARD
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
 
function my_custom_dashboard_widgets() {
    add_meta_box( 'custom_help_widget', 'Le guide di Tasc', 'custom_dashboard_help', 'dashboard', 'normal', 'high' );
}

function custom_dashboard_help() {
echo '<p style="font-size:14px;">CIAO! Ricordati che per fare un lavoro perfetto hai bisogno di conoscere e comprendere le guide di Tasc:
<ul  style="font-size:14px;">
<li><strong><a target="_blank" href="https://docs.google.com/document/d/1CzsweZMVtf57qNDnppfUSagCDQLGJhA_3YVa5LUK2_4/edit?usp=sharing">Guida del membro:</a></strong> contiene le fondamenta di Tasc, i contatti utili, le referenze, Basecamp e tanta altra roba utile a tutti.</strong> </li>
<li><strong><a target="_blank" href="https://docs.google.com/document/d/1jd4MDUrh2xn4n8Bu6Gxb8X0_Cbb5iAp7wK3VvYacIS0/edit?usp=sharing">Guida degli autori:</a></strong> contiene i principi fondamentali degli autori di Tasc con tutte le linee guida per produrre articoli perfetti e geniali.</strong> </li>
<li><strong><a target="_blank" href="https://docs.google.com/document/d/1yCPkq1w1aMmKC58sZxZ4UsuPT1Ab5fsN9i0gVFBDCYY/edit?usp=sharing">Memorandum autore:</a></strong> paura di scordarti qualcosa? Stampati questo foglio e smettila!</strong> </li>
</ul>

</p>';
}


/*TITOLI MEMBRO E OPZIONI*/
// create custom plugin settings menu
add_action('admin_menu', 'tasc_options');

function tasc_options() {

	//create new top-level menu
	//add_menu_page('Opzioni Tasc', 'Opzioni', 'manage_options', 'opzioni_tasc', 'opzioni_tasc',plugins_url('/images/icon.png'));
	add_menu_page('Tasc Frame', 'Tasc Frame', 'edit_theme_options', 'tasc_frame_settings', 'tasc_frame_front');
	//call register settings function
}

function tasc_frame_front() {  
  echo "eh no, scegli un submenu";
}  



/* BOTTONI PER ESEGUIRE FUNZIONI*/
add_action('admin_menu', 'function_buttons');

function function_buttons() {

	//create new top-level menu
	//add_menu_page('Opzioni Tasc', 'Opzioni', 'manage_options', 'opzioni_tasc', 'opzioni_tasc',plugins_url('/images/icon.png'));
	add_submenu_page('tasc_frame_settings',  'Bottoni funzioni', 'Bottoni funzioni', 'administrator',  'bottoni-funzioni', 'tasc_frame_bottoni_funzioni');
}


function tasc_frame_bottoni_funzioni() {
?>
<div class="wrap">
<h2>Bottoni funzioni vari</h2>
<div id="setting-error-settings_updated" class="updated settings-error"> 
<p><strong>Questa pagina contiene delicati link che azionano operazioni sul server. Evitare di cliccare. Ogni casino può essere ripristinato da backup ma molto meglio evitare.</strong></p></div>
<h3>Ruolo Tasc Manager</h3>
<p>
<?php 
$checkrole = get_role( 'tasc_manager' ); 
//Se NON ESISTE
if (null !== $checkrole) { ?>
<a href="#ajaxthing" class="rimuovi-tascmanager">Rimuovi ruolo "Tasc Manager"!</a>
<?php 
//SE ESISTE....
} else { ?>
<a href="#ajaxthing" class="aggiungi-tascmanager">Aggiungi ruolo "Tasc Manager"!</a>
<?php } ?>
</p>
<h3>Ruolo membro lab</h3>
<p>
<?php 
$checkrole = get_role( 'membro_lab' ); 
//Se NON ESISTE
if (null !== $checkrole) { ?>
<a href="#ajaxthing" class="rimuovi-membrolab">Rimuovi ruolo "membro LAB"!</a>
<?php 
//SE ESISTE....
} else { ?>
<a href="#ajaxthing" class="aggiungi-membrolab">Aggiungi ruolo "membro LAB"!</a>
<?php } ?>
</p>
<h3>Ruolo gestore social OLD</h3>
<p>
<?php 
$checkrole2 = get_role( 'gestore_social' ); 
//Se NON ESISTE
if (null !== $checkrole2) { ?>
<a href="#ajaxthing" class="rimuovi-gestoresocial">Rimuovi ruolo "gestore social"!</a>
<?php 
//SE ESISTE....
} else { ?>
<a href="#ajaxthing" class="aggiungi-gestoresocial">Aggiungi ruolo "gestore social"!</a>
<?php } ?>
</p>
<h3>Ruolo Social Manager NEW</h3>
<p>
<?php 
$checkrole2 = get_role( 'social_manager' ); 
//Se NON ESISTE
if (null !== $checkrole2) { ?>
<a href="#ajaxthing" class="rimuovi-socialmanager">Rimuovi ruolo "social manager"!</a>
<?php 
//SE ESISTE....
} else { ?>
<a href="#ajaxthing" class="aggiungi-socialmanager">Aggiungi ruolo "social manager!</a>
<?php } ?>
</p>
<h3>App-cache locali visitatori</h3>
<p>
<a href="#ajaxthing" class="crea_appcache">Ri-crea app-cache locali</a>
</p>
<h3>Aggiorna classifica autori</h3>
<p>
<a href="#ajaxthing" class="aggiorna_classifica">Aggiorna classifica</a>
</p>
<!--<h3>Reset classifica autori (NON FARLO)</h3>
<p>
<a href="#ajaxthing" class="reset_classifica">Reset classifica</a>
</p>-->
<h3>Fissa luoghi del Cast</h3>
<p>
<a href="#ajaxthing" class="aggiorna_luoghi">Fissa luoghi del Cast</a>
</p>
<h3>Delete classifica autori (NON FARLO)</h3>
<p>
<a href="#ajaxthing" class="delete_classifica">Cancella classifica</a>
</p>
<script type="text/javascript" >
jQuery(document).ready(function($) {

    $('.rimuovi-tascmanager').click(function(){
        var data = {
            action: 'rimuovi_tascmanager'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Rimosso ruolo ' + response);
            location.reload();
        });
    });
    
    $('.aggiungi-tascmanager').click(function(){
        var data = {
            action: 'aggiungi_tascmanager'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Aggiunto ruolo ' + response);
            location.reload();
        });
    });
    
    
    $('.rimuovi-membrolab').click(function(){
        var data = {
            action: 'rimuovi_membrolab'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Rimosso ruolo ' + response);
            location.reload();
        });
    });
    
    $('.aggiungi-membrolab').click(function(){
        var data = {
            action: 'aggiungi_membrolab'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Aggiunto ruolo ' + response);
            location.reload();
        });
    });



    $('.rimuovi-gestoresocial').click(function(){
        var data = {
            action: 'rimuovi_gestoresocial'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Rimosso ruolo ' + response);
            location.reload();
        });
    });
    
    $('.aggiungi-gestoresocial').click(function(){
        var data = {
            action: 'aggiungi_gestoresocial'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Aggiunto ruolo ' + response);
            location.reload();
        });
    });

    $('.rimuovi-socialmanager').click(function(){
        var data = {
            action: 'rimuovi_socialmanager'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Rimosso ruolo ' + response);
            location.reload();
        });
    });
    
    $('.aggiungi-socialmanager').click(function(){
        var data = {
            action: 'aggiungi_socialmanager'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Aggiunto ruolo ' + response);
            location.reload();
        });
    });
    
    
    $('.crea_appcache').click(function(){
        var data = {
            action: 'crea_appcache'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Appcache ricreata ' + response);
            location.reload();
        });
    });
    
    $('.aggiorna_classifica').click(function(){
        var data = {
            action: 'aggiorna_classifica'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Classifica aggiornata ' + response);
            location.reload();
        });
    });
    
    $('.reset_classifica').click(function(){
        var data = {
            action: 'reset_classifica'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Classifica resettata ' + response);
            location.reload();
        });
    });
    
    $('.delete_classifica').click(function(){
        var data = {
            action: 'delete_classifica'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Classifica eliminata ' + response);
            location.reload();
        });
    });
    
    $('.aggiorna_luoghi').click(function(){
        var data = {
            action: 'aggiorna_luoghi'
            //whatever: 1234
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            alert('Luoghi aggiornati ' + response);
            location.reload();
        });
    });


});
</script>


<?php } 

add_action('wp_ajax_rimuovi_tascmanager', 'rimuovi_tascmanager');
add_action('wp_ajax_aggiungi_tascmanager', 'aggiungi_tascmanager');
add_action('wp_ajax_rimuovi_membrolab', 'rimuovi_membrolab');
add_action('wp_ajax_aggiungi_membrolab', 'aggiungi_membrolab');
add_action('wp_ajax_rimuovi_gestoresocial', 'rimuovi_gestoresocial');
add_action('wp_ajax_aggiungi_gestoresocial', 'aggiungi_gestoresocial');
add_action('wp_ajax_rimuovi_socialmanager', 'rimuovi_socialmanager');
add_action('wp_ajax_aggiungi_socialmanager', 'aggiungi_socialmanager');
add_action('wp_ajax_crea_appcache', 'crea_appcache');
add_action('wp_ajax_aggiorna_classifica', 'aggiorna_classifica');
add_action('wp_ajax_reset_classifica', 'reset_classifica');
add_action('wp_ajax_delete_classifica', 'delete_classifica');
add_action('wp_ajax_aggiorna_luoghi', 'aggiorna_luoghi');

function rimuovi_tascmanager() {
     global $wpdb; // this is how you get access to the database
     remove_role( 'tasc_manager' );
	 echo "tasc_manager";

     exit(); // this is required to return a proper result & exit is faster than die();
}


function aggiungi_tascmanager() {
     global $wpdb; // this is how you get access to the database
	$editor=get_role('editor');
	 $newrole=add_role('tasc_manager','Tasc Manager',$editor->capabilities);
	 $newrole->add_cap('edit_users');     
	 $newrole->add_cap('remove_users');     
	 $newrole->add_cap('edit_dashboard');     
	 $newrole->add_cap('promote_users');     
	 $newrole->add_cap('delete_users');     
	 $newrole->add_cap('list_users');     
	 $newrole->add_cap('create_users');    

	 echo "tasc_manager";

     exit(); // this is required to return a proper result & exit is faster than die();
}


function rimuovi_membrolab() {
     global $wpdb; // this is how you get access to the database
     remove_role( 'membro_lab' );
	 echo "membro_lab";

     exit(); // this is required to return a proper result & exit is faster than die();
}


function aggiungi_membrolab() {
     global $wpdb; // this is how you get access to the database
     
	$author=get_role('author');
	 $newrole=add_role('membro_lab', 'Membro LAB',$author->capabilities);     
	 echo "membro_lab";

     exit(); // this is required to return a proper result & exit is faster than die();
}

function rimuovi_gestoresocial() {
     global $wpdb; // this is how you get access to the database
     remove_role( 'gestore_social' );
	 echo "gestore_social";

     exit(); // this is required to return a proper result & exit is faster than die();
}


function aggiungi_gestoresocial() {
     global $wpdb; // this is how you get access to the database
     
		$author=get_role('author');
		$newrole=add_role('gestore_social', 'Gestore Social',$author->capabilities);
		 $newrole->add_cap('edit_posts');     
		 $newrole->add_cap('read');     
		 $newrole->add_cap('edit_others_posts');     
		 $newrole->add_cap('edit_published_posts');     
	 echo "gestore_social";

     exit(); // this is required to return a proper result & exit is faster than die();
}

function aggiungi_socialmanager() {
     global $wpdb; // this is how you get access to the database
     
		$author=get_role('author');
		$newrole=add_role('social_manager', 'Social Manager',$author->capabilities);
		 $newrole->add_cap('edit_posts');     
		 $newrole->add_cap('read');     
		 $newrole->add_cap('edit_others_posts');     
		 $newrole->add_cap('edit_published_posts');     
	 echo "social_manager";

     exit(); // this is required to return a proper result & exit is faster than die();
}

function rimuovi_socialmanager() {
     global $wpdb; // this is how you get access to the database
     remove_role( 'social_manager' );
	 echo "social_manager";

     exit(); // this is required to return a proper result & exit is faster than die();
}

	 

function crea_appcache() {
	update_manifest();
	 echo date('l jS \of F Y h:i:s A');

     exit(); // this is required to return a proper result & exit is faster than die();
}


function aggiorna_classifica() {
	update_tasc_rank();
     exit(); // this is required to return a proper result & exit is faster than die();
}
function reset_classifica() {
	reset_top_authors();
     exit(); // this is required to return a proper result & exit is faster than die();
}
function delete_classifica() {
	delete_top_authors();
     exit(); // this is required to return a proper result & exit is faster than die();
}


function aggiorna_luoghi() {
		//Se si cambia la funzione cambiarla anche in tasc power
	    $blogusers = get_users('who=authors'); 
	    $geojson = '{"type":"FeatureCollection","features":[';   
	    foreach ($blogusers as $user) {
	    	if ($user->opt_location) {
		    	$location = lookup_city($user->opt_location);
		    	$url = get_author_posts_url( $user->ID);
		    	$geojson .=  '{"type":"Feature","properties":{title: "'. $user->display_name .'","marker-color": "#f00", url: "'. $url .'"},"geometry":{"type":"Point","coordinates":['.$location['latitude'].','.$location['longitude'].']}},';
	    	}
	    }
	    
	    $geojson .= ']}';
	    
	    //Scrivo il file
	     $tempurl = get_template_directory(); 
		 $cacheFile = $tempurl .'/library/cache/userlocations.geojson';
	     $fp = fopen($cacheFile, 'w');
	    fwrite($fp, $geojson);
	    fclose($fp);
	    
     exit(); // this is required to return a proper result & exit is faster than die();
}
