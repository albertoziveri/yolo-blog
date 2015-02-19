<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'opt_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['tasc_metabox'] = array(
		'id'         => 'standard',
		'title'      => __( 'Impostazioni articolo', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'ARTICOLO SUPER', 'cmb' ),
				'id'   => $prefix . 'large',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Non appare come top story in home page', 'cmb' ),
				'id'   => $prefix . 'notbig',
				'type' => 'checkbox',
			),
		),
	);
	
	
	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'Tasc Profile Info', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Tasc Profile Info', 'cmb' ),
				'desc'     => __( 'Completa più informazioni possibili', 'cmb' ),
				'id'       => $prefix . 'desclocation',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name' => __( 'Luogo', 'cmb' ),
				'desc' => __( 'Inserisci città e nazione. Es. Milano, Italy', 'cmb' ),
				'id'   => $prefix . 'location',
				'type' => 'text',
			),
			array(
				'name' => __( 'Twitter username', 'cmb' ),
				'desc' => __( 'Es. adrianoolivetti , senza la @', 'cmb' ),
				'id'   => 'twitter',
				'type' => 'text',
			),
			array(
				'name' => __( 'Facebook username', 'cmb' ),
				'desc' => __( 'Es. adrianoolivetti , solo il codice che vedi nell\'url del tuo profilo', 'cmb' ),
				'id'   => 'facebook',
				'type' => 'text',
			),
			array(
				'name' => __( 'Instragram username', 'cmb' ),
				'desc' => __( 'SOLO l\'username', 'cmb' ),
				'id'   => 'instagram',
				'type' => 'text',
			),
			array(
				'name' => __( 'Flickr username', 'cmb' ),
				'desc' => __( 'Solo username che ricavi dal\'url del tuo profilo', 'cmb' ),
				'id'   => 'flickr',
				'type' => 'text',
			),
			array(
				'name' => __( 'LinkedIn', 'cmb' ),
				'desc' => __( 'Solo username che ricavi dal\'url del tuo profilo', 'cmb' ),
				'id'   => 'linkedin',
				'type' => 'text',
			),
		)
	);
	
	
	
	
	

	return $meta_boxes;
}


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}





/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('sezione', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Sezioni', 'taxonomy general name' ),
			'singular_name' => _x( 'Sezione', 'taxonomy singular name' ),
			'search_items' =>  __( 'Cerca nelle sezioni' ),
			'all_items' => __( 'Tutte le sezioni' ),
			'parent_item' => __( 'Parent Genere' ),
			'parent_item_colon' => __( 'Parent Genere:' ),
			'edit_item' => __( 'Modifica sezione' ),
			'update_item' => __( 'Aggiorna sezione' ),
			'add_new_item' => __( 'Aggiungi nuova sezione' ),
			'new_item_name' => __( 'Nuova sezione' ),
			'menu_name' => __( 'Sezioni' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'sezione', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );



//USER MAPS!!!
function lookup_city($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }
 
   print_r($response);
   $geometry = $response['results'][0]['geometry'];
 
    $longitude = $geometry['location']['lat'];
    $latitude = $geometry['location']['lng'];
 
    $array = array(
        'latitude' => $geometry['location']['lng'],
        'longitude' => $geometry['location']['lat'],
        'location_type' => $geometry['location_type'],
    );
 
    return $array;
}

