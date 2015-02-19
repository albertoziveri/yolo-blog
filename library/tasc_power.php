<?php



/*****
AGGIUNGO PROGRAMMAZIONE TOP AUTHORS ALLE 23 DI OGNI GIORNO A PARTIRE DAL 1° MAGGIO 2014
****/ 
 
// Useful: http://wordpress.stackexchange.com/questions/9209/list-authors-of-site-with-link-and-gravatar
add_action( 'wp', 'daily_schedule' );
/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function daily_schedule() {
	if ( ! wp_next_scheduled( 'update_tasc_rank' ) ) {
		//unix timestamp
		wp_schedule_event( 1398016800, 'daily', 'update_tasc_rank');
	}
}
add_action( 'update_tasc_rank', 'update_tasc_rank' );



//wp_mail('you@yoursite.com', 'Automatic email', 'Hello, this is an automatically scheduled email from WordPress.');


//AUTORI INATTIVI
add_action( 'wp', 'weekly_schedule' );
function weekly_schedule() {
	if ( ! wp_next_scheduled( 'check_inactive_authors' ) ) {
		//unix timestamp
		wp_schedule_event( 1398016800, 'wpo_weekly', 'check_inactive_authors');
	}
}
add_action( 'check_inactive_authors', 'check_inactive_authors' );
//wp_clear_scheduled_hook( 'update_tasc_rank' );


function check_inactive_authors() {
	 //Ci inserisco anche l'aggiornamento della mappa
	 
    $blogusers = get_users('who=authors'); 
    
    $geojson = '{"type":"FeatureCollection","features":[';  
	     
    foreach ($blogusers as $user) {
    	list ($words_number, $comments_number,$views_number,$shares_number) = post_word_count_by_author($user->ID);
    	if (check_user_role('author',$user->ID) and $words_number<5) {
	    	wp_mail($user->user_email, "Avviso automatico dal Cast", "Ciao, questa è un'email automatica, ma non per questo significa che la devi ignorare. La ricevi perché sei autore su Tasc e non hai scritto un articolo da oltre 30 giorni. Tasc, e lo stesso Grafite, sono due progetti a cui crediamo molto, che hanno dimostrato di avere molti utenti fedeli che amano i nostri articoli e i nostri prodotti. E se tutti ci dedicassimo più tempo avremmo enormi potenzialità. Bastano 30 minuti per fare un articolo decente, e nemmeno 5 minuti per fare uno snack. Cerca di essere più attivo oppure rispondi a questa email comunicando le tue difficoltà. PS: il tempo è sempre una scusa.");
    	}
    	if (user_can($user->ID,'publish_posts')) {
	    	if ($user->opt_location) {
		    	$location = lookup_city($user->opt_location);
		    	$url = get_author_posts_url( $user->ID);
		    	$geojson .=  '{"type":"Feature","properties":{title: "'. $user->display_name .'","marker-color": "#f00", url: "'. $url .'"},"geometry":{"type":"Point","coordinates":['.$location['latitude'].','.$location['longitude'].']}},';
	    	}
	    }
    }

    $geojson .= ']}';
    
    //Scrivo il file
     $tempurl = get_template_directory(); 
	 $cacheFile = $tempurl .'/library/cache/userlocations.geojson';
     $fp = fopen($cacheFile, 'w');
    fwrite($fp, $geojson);
    fclose($fp);

}




/* 
INIZIA IL TASC RANK
*/
//Post totali utente ultimi 15 giorni
function get_posts_count_from_last_15days($post_type ='post',$userid = 1) {
    global $wpdb;

    $numposts = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(ID) ".
            "FROM {$wpdb->posts} ".
            "WHERE ".
                "post_status='publish' ".
                "AND post_type= %s ".
                "AND post_date> %s".
                "AND post_author= %s ",
            $post_type, date('Y-m-d H:i:s', strtotime('-15 days')),$userid
        )
        
    );
    return $numposts;
}


  
/**
 * Count all post in a term.
 *
 * @author Bainternet http://wordpress.stackexchange.com/users/2487/bainternet
 * @link   {http://wordpress.stackexchange.com/a/33464/73}
 * @param  string $term
 * @param  string $taxonomy
 * @param  string $type
 * @return int
 */
 
function last_fifteen_days( $where = '' ) {
	global $wpdb;
	
	$where .= $wpdb->prepare( " AND post_date > %s", date( 'Y-m-d', strtotime('-15 days') ) );
	
	return $where;
}

function get_posts_count_from_last_15days_snack($userid, $type = 'post' )
{
	 
	add_filter( 'posts_where', 'last_fifteen_days' );
	$args = array (
		'fields'         =>'ids',
		'posts_per_page' => -1, //-1 to get all post
		'post_type'      => $type,
		'author'  => $userid,
		'suppress_filters' => false,
		'tax_query'      => array (
			array (
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => "post-format-aside"
			)
		)
	);
 
	
	if ( $posts = get_posts( $args ) ) {
		// Important to avoid modifying other queries
		remove_filter( 'posts_where', 'last_fifteen_days' );
		return count( $posts );
	}
	
	// Important to avoid modifying other queries
	remove_filter( 'posts_where', 'last_fifteen_days' );
	return 0;

}


/**
 * Count Words and comments of post for given author *
 * @author Bainternet http://wordpress.stackexchange.com/users/2487/bainternet
 * @link   {http://wordpress.stackexchange.com/a/33464/73}
 * @param  string $term
 * @param  string $taxonomy
 * @param  string $type
 * @return int
 */



 function last_thirty_days( $where = '' ) {
	global $wpdb;
	
	$where .= $wpdb->prepare( " AND post_date > %s", date( 'Y-m-d', strtotime('-30 days') ) );
	
	return $where;
}

function post_word_count_by_author($author) {

	add_filter('posts_where', 'last_thirty_days');
	    $args=array(
	      'post_type' => 'post',
	      'post_status' => 'publish',
	      'author' => $author,
	      'showposts' => -1,
	      'caller_get_posts'=> 1
	      );
	$my_query=new WP_Query($args);
	remove_filter('posts_where', 'last_thirty_days');
	$totalcount = array(0,0,0,0);
	  if( $my_query->have_posts() ) {
	    while ($my_query->have_posts()) : $my_query->the_post();
	         $content = $my_query->post->post_content;
	         $count = str_word_count($content);       
	        $totalcount[0] = $totalcount[0] + $count;
	        
	        //Becco numero di commenti
	        $num_comments = get_comments_number($my_query->post->ID);
	        $totalcount[1] = $totalcount[1] + $num_comments;
	        
	        //Becco numero di visite
	        if (get_post_meta( get_the_ID(), 'views',true)) {
		        $post_views = get_post_meta(get_the_ID(),'views',true);
		        $totalcount[2] = $totalcount[2] + $post_views;
	        } else {
		        $totalcount[2] = $totalcount[2];
	        }      
	        
	        
	        //Becco statistiche social
			$sharescount = getsocialcount(get_permalink($my_query->post->ID));
			$totalcount[3] = $totalcount[3] + $sharescount;
			
			
			        
	    endwhile;
	  } else {
	  	$totalcount[0] = 0;
	  	$totalcount[1] = 0;
	  	$totalcount[2] = 0;
	  	$totalcount[3] = 0;
	  }
	wp_reset_query(); //just in case
	
	//Salvo tutto in dei post meta per beccarli velocemente se servono
     if (get_user_meta($author, "points_thirtydays", true)) {
     	$stats = array($totalcount[0],$totalcount[1],$totalcount[2],$totalcount[3]);
     	update_user_meta( $author, 'points_thirtydays', $stats);
     } else {
     	$stats = array($totalcount[0],$totalcount[1],$totalcount[2],$totalcount[3]);
     	add_user_meta( $author, 'points_thirtydays', $stats,true);
     }
     
	 
	 return $totalcount;
}
 


/*
INIZIO FUNZIONE UPDATE CLASSIFICA
Ricordo gli user meta:

-points_user_day : punti del giorno dell'utente. Integer
-points_user_day_details : tutti i dettagli dei punti del giorno dell'utente per capire come è stato calcolato. Stringa.
-points_user_total : punti totali dell'utente
-points_first_place : numero di volte che è stato primo
-points_second_place : numero di volte che è stato secondo
-points_third_place : numero di volte che è stato terzo
-points_previous_place : posizione precedente, 
-points_date : data del giorno -IMPORTANTE
-points_times_first : numero di volte consecutive che è stato primo l'ultima volta o al momento, 
-points_times_first_record: record numero di volte consecutive che è stato primo, 
-points_times_first_record_date: data ultima del record di volte consecutive che è stato primo
-points_record_place: posizione in classifica maggiore
-points_record_day: record giornaliero di punti
-points_record_day_date: data record giornaliero di punti
-points_history : array con key la data e value i punti del giorno
-points_thirtydays : array con statistiche varie ultimi 30gg

*/
/**
 * On the scheduled action hook, run a function.
 */
function update_tasc_rank() {
	


    $blogusers = get_users();    
    
    foreach ($blogusers as $user) {
         if(user_can($user->ID,'publish_posts')) {} else {continue;}
         
         //1. Numero articoli totali, PESO: 0.0055
         $totalposts = count_user_posts( $user->ID );
         //2. Numero articoli ultimi 15 giorni, PESO: 0.9
         $totalPosts_15days = get_posts_count_from_last_15days('post',$user->ID);
         //3. Numero snack ultimi 15 giorni, PESO: -0.5
         $totalSnacks_15days = get_posts_count_from_last_15days_snack($user->ID,'post');
         //4. Giorni di permanenza su tasc, PESO: 0.00009
         $today = date('Y-n-j'); $user_registered=$user->user_registered; $author_registered= date("Y-n-j", strtotime($user_registered)); 
         $timeregistered = (strtotime($today) - strtotime($author_registered)) / ( 60 * 60 * 24);
         //5. Numero di parole scritte negli ultimi 30 gg, PESO: 0.0001 ; e numero di commenti ultimi 30 giorni PESO: 0.08
         list ($words_number, $comments_number,$views_number,$shares_number) = post_word_count_by_author($user->ID);
         
         //Imposto costanti-coefficenti
         DEFINE ('totalposts', 0.000145); //Da tenere basso per futuro.
         DEFINE ('recentposts', 0.375);
         DEFINE ('snacks', 0.23);
         DEFINE ('timeregistered', 0.0000715); //Da tenere basso per futuro.
         DEFINE ('wordsnumber', 0.000132);
         DEFINE ('commentsnumber', 0.0065);
         DEFINE ('viewsnumber', 0.000351); //Definitivo, basso inizialmente ma destinate ad aumentare nel tempo.
         DEFINE ('sharesnumber', 0.00151);
         
         
         //CALCOLO PUNTEGGIO GIORNALIERO
         $author_points = number_format (($totalposts*totalposts)+($totalPosts_15days*recentposts)-($totalSnacks_15days*snacks)+($timeregistered*timeregistered)+($words_number*wordsnumber)+($comments_number*commentsnumber)+($views_number*viewsnumber) + ($shares_number*sharesnumber),2);
         
         //Assegno stringa fatta bene con valori:
         $author_points_detail = "Numero post: ".$totalposts."; Post 15 giorni: ".$totalPosts_15days."; Snack 15 giorni: ".$totalSnacks_15days."; Tempo registrazione: ".$timeregistered."; Numero parole 30gg: ".$words_number."; Numero commenti 30gg: ".$comments_number."; Numero visite 30gg: ".$views_number."; Numero condivisioni 30gg: ".$shares_number."; CALCOLO: Numero post: ".($totalposts*totalposts)."; Post 15 giorni: ".($totalPosts_15days*recentposts)."; Snack 15 giorni: ".($totalSnacks_15days*snacks)."; Tempo registrazione: ".($timeregistered*timeregistered)."; Numero parole 30gg: ".($words_number*wordsnumber)."; Numero commenti 30gg: ".($comments_number*commentsnumber)."; Numero visite 30gg: ".($views_number*viewsnumber)."; Numero condivisioni 30gg: ".($shares_number*sharesnumber).";";
         
         
         //AGGIORNO INFORMAZIONI: Aggiorno l'user meta con il punteggio del giorno, e aggiorno quello totale
         if (get_user_meta($user->ID, "points_user_day", true)) {
	     	update_user_meta( $user->ID, "points_user_day", $author_points);
	     	
	     	//Aggiunto stringa dettagli punti
	     	update_user_meta( $user->ID, 'points_user_day_details', $author_points_detail);
         } else {
	     	add_user_meta( $user->ID, 'points_user_day', $author_points,true);
	     	add_user_meta( $user->ID, 'points_user_day_details', $author_points_detail,true);
         }
         
         if (get_user_meta($user->ID, "points_user_total", true) and get_user_meta($user->ID, "points_date", true) and get_user_meta($user->ID, "points_date", true) != date('j F Y')) {
         $old_points = get_user_meta($user->ID, "points_user_total", true);
          $total_points = get_user_meta($user->ID, "points_user_total", true) + $author_points;
	     	update_user_meta( $user->ID, 'points_user_total', $total_points);
	     	if ($old_points == 0 or $old_points == "0") {
	     		delete_user_meta($user->ID, "points_user_total");
		     	add_user_meta( $user->ID, 'points_user_total', $author_points,true);
	     	}
         } else {
	        $total_points = $author_points;
	     	delete_user_meta($user->ID, "points_user_total");
	     	add_user_meta( $user->ID, 'points_user_total', $total_points,true);
         }
         
         //Aggiorno record giornaliero punti
         if (get_user_meta($user->ID, "points_record_day", true) and get_user_meta($user->ID, "points_record_day", true) < $author_points) {
	     	update_user_meta( $user->ID, 'points_record_day', $author_points);
	     	update_user_meta( $user->ID, 'points_record_day_date', date('j F Y'));
         } else {
	     	add_user_meta( $user->ID, 'points_record_day', $author_points,true);
	     	add_user_meta( $user->ID, 'points_record_day_date', date('j F Y'),true);
         }
    }
    
    
    
    /*
	    Aggiorno statistiche storiche: data, posizione del giorno prima, numero di volte che è stato primo, secondo e terzo.
    */
    
    
	function orderr( $a, $b )
	{ 
	  if(  $a->points_user_day ==  $b->points_user_day ){ return 0 ; } 
	  return ($a->points_user_day < $b->points_user_day ) ? 1 : -1;
	} 
	
	$args = array(
	'meta_key' => 'points_user_day'
	//'who' => 'authors',
	);
	$best_users_day = get_users($args);
	usort($best_users_day ,'orderr');
	
	
    $i = 0; //$i++; e $item[number];
	foreach ($best_users_day as $user) {
		if(user_can($user->ID,'publish_posts')) {} else {continue;}
	    $i++;
	    
    	if($i==1) {
    	
    		//Se è primo allora tengo una serie di dati anche storici.
	         if (get_user_meta($user->ID, "points_first_place", true) and get_user_meta($user->ID, "points_date", true) != date('j F Y')) {
	         
	         	//becco delle variabili
	         	$points_previous_place = get_user_meta($user->ID, "points_previous_place", true);
	         	$points_times_first = get_user_meta($user->ID, "points_times_first", true);
	         	$points_times_first_record = get_user_meta($user->ID, "points_times_first_record", true);
	         	$points_times_first_record_date = get_user_meta($user->ID, "points_times_first_record_date", true);
	         	$points_first_place = get_user_meta($user->ID, "points_first_place", true);
	         
	         
		     	//Aggiorno giorni totali in cui è stato primo
		     	$points_first_place = $points_first_place + 1;
		     	update_user_meta( $user->ID, 'points_first_place', $points_first_place);
		     	
		     	//Se la posizione precedente era il primo posto aggiorno dati storici primo posto consecutivo 
		     	if ($points_previous_place == 1){
		     		$points_times_first++;
		         	if ($points_times_first>$points_times_first_record) {
			         	$points_times_first_record=$points_times_first;
			         	$points_times_first_record_date = date('j F Y');
		         	}
	         	} else {
		         	$points_times_first = 1;
	         	}
	         	
	         	//Aggiorno tutti i dati storici riguardo le volte consecutive che è stato primo
		     	update_user_meta( $user->ID, 'points_times_first', $points_times_first);
		     	update_user_meta( $user->ID, 'points_times_first_record', $points_times_first_record);
		     	update_user_meta( $user->ID, 'points_times_first_record_date', $points_times_first_record_date);

	         } else {
		     	add_user_meta( $user->ID, 'points_first_place', 1,true);
		     	add_user_meta( $user->ID, 'points_times_first', 1,true);
		     	add_user_meta( $user->ID, 'points_times_first_record', 1,true);
		     	add_user_meta( $user->ID, 'points_times_first_record_date', date('j F Y'),true);
	         }
	         
	     	         
	    //Se è secondo     
        } elseif($i==2) {
	         if (get_user_meta($user->ID, "points_second_place", true) and get_user_meta($user->ID, "points_date", true) != date('j F Y')) {
		     	update_user_meta( $user->ID, 'points_second_place', get_user_meta($user->ID, "points_second_place", true) + 1);
	         } else {
		     	add_user_meta( $user->ID, 'points_second_place', 1,true);
	         }
	    
	    //Se è terzo
        } elseif($i==3) {
	         if (get_user_meta($user->ID, "points_third_place", true) and get_user_meta($user->ID, "points_date", true) != date('j F Y') ) {
		     	update_user_meta( $user->ID, 'points_third_place', get_user_meta($user->ID, "points_third_place", true) + 1);
	         } else {
		     	add_user_meta( $user->ID, 'points_third_place', 1,true);
	         }
        } 
        
        //Aggiorno record posizione user
         if (get_user_meta($user->ID, "points_record_place", true) and $i<get_user_meta($user->ID, "points_record_place", true)) {
	     	update_user_meta( $user->ID, 'points_record_place', $i);
         } else {
	     	add_user_meta( $user->ID, 'points_record_place', $i,true);
         }

	    //Aggiorno data e posizione precedente
         if (get_user_meta($user->ID, "points_date", true) and get_user_meta($user->ID, "points_previous_place", true)) {
	     	update_user_meta( $user->ID, 'points_date', date('j F Y'));
	     	update_user_meta( $user->ID, 'points_previous_place', $i);
         } else {
	     	add_user_meta( $user->ID, 'points_date', date('j F Y'),true);
	     	add_user_meta( $user->ID, 'points_previous_place', $i,true);
         }
         
         //Aggiorno storico user punti con punti data, posizione in classifica
         if (get_user_meta($user->ID, "points_history", true)) {
         	$points_history = get_user_meta($user->ID, "points_history", true);
         	
         	$points_history[date('Y-m-d')]["points"] = get_user_meta($user->ID, "points_user_day", true);
         	$points_history[date('Y-m-d')]["pos"] = $i;
	     	
	     	delete_user_meta( $user->ID, 'points_history');
	     	add_user_meta( $user->ID, 'points_history', $points_history,true);
         } else {
         	$points_history[date('Y-m-d')]["points"] = get_user_meta($user->ID, "points_user_day", true);
         	$points_history[date('Y-m-d')]["pos"] = $i;
	     	add_user_meta( $user->ID, 'points_history', $points_history,true);
         }

	}


}


    
/*FUNZIONI AD PERSONAM*/

//update_user_meta(87, 'points_user_total',1.00);




function reset_top_authors() {
    $blogusers = get_users('who=authors');    
    
    foreach ($blogusers as $user) {
    	update_user_meta($user->ID, "points_user_day",0);
    	update_user_meta($user->ID, "points_user_total",0);
    	update_user_meta($user->ID, "points_first_place",0);
    	update_user_meta($user->ID, "points_second_place",0);
    	update_user_meta($user->ID, "points_third_place",0);
    	update_user_meta($user->ID, "points_previous_place",9999);
    	update_user_meta($user->ID, "points_date",date('j F Y'));
    	update_user_meta($user->ID, "points_times_first",0);
    	update_user_meta($user->ID, "points_times_first_record",0);
    	update_user_meta($user->ID, "points_times_first_record_date",date('j F Y'));
    	update_user_meta($user->ID, "points_record_place",9999);
    	update_user_meta($user->ID, "points_record_day",0);
    	update_user_meta($user->ID, "points_record_day_date",date('j F Y'));
    	//delete_user_meta($user->ID, "points_history");
    }
}

function delete_top_authors() {
    $blogusers = get_users('who=authors');    
    
    foreach ($blogusers as $user) {
    	delete_user_meta($user->ID, "points_user_day");
    	delete_user_meta($user->ID, "points_user_day_details");
    	delete_user_meta($user->ID, "points_user_total");
    	delete_user_meta($user->ID, "points_first_place");
    	delete_user_meta($user->ID, "points_second_place");
    	delete_user_meta($user->ID, "points_third_place");
    	delete_user_meta($user->ID, "points_previous_place");
    	delete_user_meta($user->ID, "points_date");
    	delete_user_meta($user->ID, "points_times_first");
    	delete_user_meta($user->ID, "points_times_first_record");
    	delete_user_meta($user->ID, "points_times_first_record_date");
    	delete_user_meta($user->ID, "points_record_place");
    	delete_user_meta($user->ID, "points_record_day");
    	delete_user_meta($user->ID, "points_record_day_date");
    	delete_user_meta($user->ID, "points_history");
    	delete_user_meta($user->ID, "points_thirtydays");
    }
}

/*function backup_data() {
	$args = array(
	'meta_key' => 'points_user_day',
	'who' => 'authors'
	);
	$users = get_users($args);

	foreach ($users as $user) {
		$points_user_day = get_user_meta($user->ID, "points_user_day", true);
		$points_user_day_details = get_user_meta($user->ID, "points_user_day_details", true);
		$points_user_total = get_user_meta($user->ID, "points_user_total", true);
		$points_first_place = get_user_meta($user->ID, "points_first_place", true);
		$points_second_place = get_user_meta($user->ID, "points_second_place", true);
		$points_third_place = get_user_meta($user->ID, "points_third_place", true);
		$points_previous_place = get_user_meta($user->ID, "points_previous_place", true);
		$points_date = get_user_meta($user->ID, "points_date", true);
		$points_times_first = get_user_meta($user->ID, "points_times_first", true);
		$points_times_first_record = get_user_meta($user->ID, "points_times_first_record", true);
		$points_times_first_record_date = get_user_meta($user->ID, "points_times_first_record_date", true);
		$points_record_place = get_user_meta($user->ID, "points_record_place", true);
		$points_record_day = get_user_meta($user->ID, "points_record_day", true);
		$points_record_day_date = get_user_meta($user->ID, "points_record_day_date", true);
		$points_record_day_date = get_user_meta($user->ID, "points_record_day_date", true);
		$points_history = get_user_meta($user->ID, "points_history", true);
		$points_thirtydays = get_user_meta($user->ID, "points_thirtydays", true);
		
		
		add_user_meta( $user->ID, 'points_history', $points_history,true);		
		
	}
}*/




//FUNZIONI UTILI PER LISTARE LE INFO

//Becco i punti del giorno degli utenti



?>