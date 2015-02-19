<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt
  - custom google+ integration
  - adding custom fields to user profiles

//add this to html tag for appcache: <?php if(is_home() or is_preview() or is_page()) {} else { ?>manifest="<?php echo get_template_directory_uri(); ?>/cache.appcache" <?php } ?>

*/

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'bones_wpsearch' );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */



/* A BETTER TITLE*/
// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title



/*OTHER CLEANUP FUNCTIONS*/

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/*********************
SCRIPTS & ENQEUEING
*********************/

// loading modernizr and jquery, and reply script 
function bones_scripts_and_styles() {
  if (!is_admin()) {
  
    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
    wp_register_script( 'tasc-jslibs', get_stylesheet_directory_uri() . '/library/js/libs/jslibs.js', array(), '', false );
    wp_register_script( 'fastclick', get_stylesheet_directory_uri() . '/library/js/libs/fastclick.js', array(), '', false );
        
    /* register main stylesheet*/
    wp_register_style( 'tasc-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );
    
    /* register secondary stylesheet for extras like custom templates - disabilitata causa modalità notte in tasc 2*/
    wp_register_style( 'tasc-style-extra', get_stylesheet_directory_uri() . '/library/css/extra-style.css', array(), '', 'all' );

    // ie-only style sheet
    //wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );
    
        
    //adding scripts file in the footer
    wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts-ck.js', array( 'jquery' ), '', false ); //era ck
    
    //adding scripts file in the footer
    wp_register_script( 'grande-editor', get_stylesheet_directory_uri() . '/library/js/libs/grande/grande.js', array(), '', trues );
    wp_register_style( 'grande-style1', get_stylesheet_directory_uri() . '/library/js/libs/grande/css/menu.css', array(), '' );
    //non serve wp_register_style( 'grande-style2', get_stylesheet_directory_uri() . '/library/js/libs/grande/css/editor.css', array(), '' );

    //Per i grafici
    wp_register_script( 'prettify', get_stylesheet_directory_uri() . '/library/js/libs/prettify/run_prettify.js', array(), '', false );
    wp_register_script( 'chart', get_stylesheet_directory_uri() . '/library/js/libs/chart.js', array(), '', false);
    wp_register_style( 'prettify-css', get_stylesheet_directory_uri() . '/library/js/libs/prettify/prettify.css', array(), '' );
    
    //Scripts e stili per pagine autori, e team
    wp_register_script( 'charts-one', get_stylesheet_directory_uri() . '/library/js/libs/morrischarts/raphael-2.1.0.min.js', array( ), '', false );
    wp_register_script( 'charts-two', get_stylesheet_directory_uri() . '/library/js/libs/morrischarts/morris.min.js', array( ), '', false );
    wp_register_style( 'charts-three', get_stylesheet_directory_uri() . '/library/js/libs/morrischarts/morris.css', array(), '');
    
    wp_register_style( 'mapboxcss', 'https://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.css', array(), '');
    wp_register_script( 'mapboxjs', 'https://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js', array( ), '', false );
    
    //load extra pages scripts
     //wp_register_script( 'scripts_extra', get_stylesheet_directory_uri() . '/library/js/scripts_extra.js', array( 'jquery' ), '', true );
    
    //Se è la pagina di write opinioni gli mando questo
    if(is_page( 'write' )) {wp_enqueue_script( 'grande-editor' );wp_enqueue_style('grande-style1');}
    
    
    //Se è la pagina del cast metto mapbox
    if(is_page( 'cast' )) {wp_enqueue_script( 'mapboxjs' );wp_enqueue_style('mapboxcss');}

    // enqueue styles and scripts, if mobile or not..
    wp_enqueue_script( 'bones-modernizr' ); 
    
    global $detect;
	if($detect->isMobile() && !$detect->isTablet()) {
		wp_enqueue_script( 'fastclick' );
	}
	
   	wp_enqueue_style( 'tasc-stylesheet' ); 
    //wp_enqueue_style('bones-ie-only');
    
    //Se sono pagine..
    if (is_page() or is_author() or is_tax('sezione')) { wp_enqueue_style('tasc-style-extra'); }
    
    /*
    I reccomend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' ); 
    wp_enqueue_script( 'tasc-jslibs' ); 
    wp_enqueue_script( 'bones-js' ); 
    
    if(has_shortcode2('barchart')) {  wp_enqueue_script( 'chart' ); }
    if(has_shortcode2('code')) { wp_enqueue_script( 'prettify' ); wp_enqueue_style('prettify-css'); }
    
    if(is_author()) {
	    wp_enqueue_script( 'charts-one' ); 
	    wp_enqueue_script( 'charts-two' ); 
	    wp_enqueue_style( 'charts-three' ); 
    }
    
  }
}


/*********************
THEME SUPPORT
*********************/
	
// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {
	
	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');   
	
	// default thumb size   (usually 125x125) 
	set_post_thumbnail_size(236, 160, true);   
		
	// rss thingy           
	add_theme_support('automatic-feed-links'); 	
	
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
		
	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside'             // title less blurb
		)
	);
		
	// wp menus
	add_theme_support( 'menus' );  
	
	// registering wp3+ menus          
	register_nav_menus(                      
		array( 
			'main-nav' => __( 'The Main Menu' ),   // main nav in header
			'sidebar-menu' => __( 'Sidebar menu' ),   // sidebar menu in sidebar
			'bar-menu' => __( 'Bar menu' ),   // bar menu in header
			'footer-links' => __( 'Footer Links' ), // secondary nav in footer
			'blackbar' => __( 'Black Bar' ), // secondary nav in footer
			'grafite_projects' => __( 'Grafite Project in black bar' ) // secondary nav in footer
		)
	);
} /* end bones theme support */

/*********************
MENUS & NAVIGATION
*********************/	
 
// the main menu 
function bones_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => 'The Main Menu',                           // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback'      // fallback function
	));
} /* end bones main nav */

// the sidebar menu 
function sidebar_menu() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => 'Sidebar menu',                           // nav name
    	'menu_class' => 'clearfix sidebar-menu',         // adding custom nav class
    	'theme_location' => 'sidebar-menu',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'sidebar_menu_fallback'      // fallback function
	));
} /* end bones main nav */

// the bar menu 
function bar_menu() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => 'Bar menu',                           // nav name
    	'menu_class' => 'clearfix bar-menu',         // adding custom nav class
    	'theme_location' => 'bar-menu',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bar_menu_fallback' ,     // fallback function
    	'items_wrap' => '%3$s' 
	));
} /* end bones main nav */

// the bar menu 
function blackbar() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => 'Blackbar menu',                           // nav name
    	'menu_class' => 'clearfix blackbar',         // adding custom nav class
    	'theme_location' => 'blackbar',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'blackbar_fallback'      // fallback function
	));
} /* end bones main nav */

// the bar menu 
function grafite_projects() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => 'Grafite projects menu',                           // nav name
    	'menu_class' => 'clearfix grafite_projects',         // adding custom nav class
    	'theme_location' => 'grafite_projects',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'grafite_projects_fallback'      // fallback function
	));
} /* end bones main nav */

// the footer menu (should you choose to use one)
function bones_footer_links() { 
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => 'Footer Links',                       // nav name
    	'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
	));
} /* end bones footer link */
 
// this is the fallback for header menu
function bones_main_nav_fallback() { 
	wp_page_menu( 'show_home=Home' ); 
}

// this is the fallback for sidebar menu
function sidebar_menu_fallback() { 
}
// this is the fallback for sidebar menu
function bar_menu_fallback() { 
}

// this is the fallback for footer menu
function bones_footer_links_fallback() { 
	/* you can put a default here if you like */ 
}

// this is the fallback for footer menu
function blackbar_fallback() { 
	/* you can put a default here if you like */ 
}
// this is the fallback for footer menu
function grafite_projects_fallback() { 
	/* you can put a default here if you like */ 
}


/*********************
PAGE NAVI
Cambiamenti eseguiti:
-Sostituito >> con Dopo
-Messo il link anche per la pagina corrente
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ol class="bones_page_navi clearfix">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = __( "First", 'bonestheme' );
		echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li class="bpn-prev-link">';
	previous_posts_link('Precedente');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="bpn-current"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="bpn-next-link">';
	next_posts_link('Successiva');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = __( "Ultima", 'bonestheme' );
		echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ol></nav>'.$after."";
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/	

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	
}

function remove_empty_paragraph($content){
	return preg_replace('/<p[^>]*>[\s|&nbsp;]*<\/p>/', '', $content);
	
}

// This removes the annoying […] to a Read More link
/*function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">(Prosegui)</a>';
}*/

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 270;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*********************
FUNZIONI AGGIUNTE DA GRAFITE ALBERTO ZIVERI
*********************/	


/*********************
FUNZIONE DISPLAY_CATS
Viene inserita in ogni file (index, archive ecc.) per mostrare la barra delle categorie. Se siamo su mobile viene usata la classe mobile altrimenti la classe desktop.
*********************/	
function display_cats() {
		echo '<div id="categories-nav"><ul>'; bar_menu(array( 'container' => false ));	echo '</ul></div>';	
}


/*CHECK USER ROLE*/

/*USATO PER..?*/
/**
* Checks if a particular user has a role.
* Returns true if a match was found.
*
* @param string $role Role name.
* @param int $user_id (Optional) The ID of a user. Defaults to the current user.
* @return bool
*/
function check_user_role( $role, $user_id = null ) {
  if (isset($_REQUEST['user_id']))
    $user_id = $_REQUEST['user_id'];
  if ( is_numeric( $user_id ) )
    $user = get_userdata( $user_id );
    else
    $user = wp_get_current_user();
  if ( empty( $user ) )
    return false;
  return in_array( $role, (array) $user->roles );
}

function logged_user_role( $role, $user_id = null) {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
  if ( is_numeric( $user_id ) )
    $user = get_userdata( $user_id );
    else
    $user = wp_get_current_user();
  if ( empty( $user ) )
    return false;
  return in_array( $role, (array) $user->roles );
}
      	
      	
/*
CACHE MANIFEST
*/

add_action( 'save_post', 'update_manifest' );
add_action( 'publish_post', 'update_manifest' );


function update_manifest() {
	$manifest_file = get_template_directory().'/cache.appcache';
	ob_start(); // start the output buffer
	$cachemanifest = 
	"CACHE MANIFEST
	# http://blog.grayghostvisuals.com/wordpress/cache-manifest-for-wordpress/
	# Version Control
	# version ".date('l jS \of F Y h:i:s A')."
	#
	# Handy Dandy Developer Tools
	# CHROME chrome://appcache-internals
	# FIREFOX about:cache
	# Charles - Web Debugging Proxy App
	# http://charlesproxy.com
	#
	# CACHE explicit entries
	# NETWORK URL online whitelist entries
	# FALLBACK ish entries 
	#
	CACHE:
	# Styles
	library/css/style.css
	#
	# Scripts
	library/js/libs/modernizr.custom.min.js
	#
	NETWORK:
	*
	http://go.disqus.com/embed.js
	library/js/libs/jslibs.js
	library/js/scripts.js
	cache.appcache
	#SETTINGS:
	#prefer-online
	#
	FALLBACK:";
	$fp = fopen($manifest_file, 'w'); // open the cache file for writing
	fwrite($fp, $cachemanifest); // save the contents of output buffer to the file
	fclose($fp); // close the file
	ob_end_flush(); // Send the output to the browser

}



/************* EDITOR STYLE *****************/
function my_theme_add_editor_styles() {
    add_editor_style( get_stylesheet_directory_uri() .'/library/css/editor-style.css');
}
add_action( 'init', 'my_theme_add_editor_styles' );


/*********************
HAS SHORTCODE?
Utile per scripts personalizzati se ci sono shortcode
*********************/

// check the current post for the existence of a short code
function has_shortcode2($shortcode = '') {
	
	$post_to_check = get_post(get_the_ID());
	
	// false because we have to search through the post content first
	$found = false;
	
	// if no short code was provided, return false
	if (!$shortcode) {
		return $found;
	}
	// check the post content for the short code
	if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
		// we have found the short code
		$found = true;
	}
	
	// return our final results
	return $found;
}




/* 
OPINIONI!!!!

Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function opinione() { 
	// creating (registering) the custom type 
	register_post_type( 'opinion', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Opinioni', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Opinione', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'Tutte le opinioni', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Aggiungi nuova', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Aggiungi nuova opinione', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Modifica', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Modifica opinioni', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'Nuova opinione', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'Vedi opinione', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Cerca opinione', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nessuna opinione trovata', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Esempio di opinione', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'opinione', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail')
		) /* end of options */
	); /* end of register post type */	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'opinione');

?>