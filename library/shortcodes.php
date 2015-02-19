<?php

//AGGIUNGO DROPDOWN
add_action( 'admin_head', 'tasctags' );
function tasctags() {
    global $typenow;

    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'tasctags_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'tasctags_add_tinymce_button' );
}

// inlcude the js for tinymce
function tasctags_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['tasctags_buttons'] = get_template_directory_uri() . '/library/js/tinymce.js';
    // Print all plugin js path
    //var_dump( $plugin_array );
    return $plugin_array;
}

// Add the button key for address via JS
function tasctags_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'tasctags_buttons_key' );
    // Print all buttons
    //var_dump( $buttons );
    return $buttons;
}



//QUOTE BOX SHORTCODE
function quote_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'dove' => 'sinistra',
      ), $atts ) );
   return '<div class="quote-box '.esc_attr($dove).'">'.$content.'</div>';
}
add_shortcode('quote', 'quote_shortcode');


//QUOTE BOX SHORTCODE
function riassunto_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'titolo' => 'Nome del prodotto.',
      'voto' => '6',
      'foto' => 'si'
      ), $atts ) );
      
			$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb-big', true);
	$thumb= $thumb_url[0];
   return '<div style="background-image:url(\''.$thumb.'\')" class="riassunto '.esc_attr($dove).'"><div class="vote">'.esc_attr($voto).'<small>/ 10</small></div><div class="descrizione"><div class="nomeprodotto">'.esc_attr($titolo).'</div><p class="testo">'.$content.'</p></div><div class="overlay-entire-black"></div></div>';
}
add_shortcode('riassunto', 'riassunto_shortcode');


//PANORAMA BOX SHORTCODE
function panorama_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'titolo' => 'Panorama',
      ), $atts ) );
   return '<div class="panorama"><img src="'.$content.'" alt="'.esc_attr($panorama).'" /></div>';
}
add_shortcode('panorama', 'panorama_shortcode');


//LIKE BUTTON FACEBOOK
function facebook_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'url_pagina' => 'https://www.facebook.com/tascproject',
      ), $atts ) );
   return '<div class="fb-like-box" data-href="'.esc_attr($url_pagina).'" data-width="400" data-show-faces="true" data-stream="false" data-header="false"></div>';
}
add_shortcode('facebook', 'facebook_shortcode');

//FOLLOW BUTTON TWITTER
function twitter_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'user' => 'tascproject',
      ), $atts ) );
   return '<a href="https://twitter.com/'.esc_attr($user).'" class="twitter-follow-button" data-show-count="false" data-lang="it" data-size="large">Segui @tascproject</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
}
add_shortcode('twitter', 'twitter_shortcode');

//TWEET BUTTON TWITTER
function tweet_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'href' => '',
      'data-related' => '',
      ), $atts ) );
   return '<a href="'.esc_attr($href).'" data-lang="it" data-size="large" data-related="'.esc_attr($data_related).'">Tweet to @tascproject</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
}
add_shortcode('tweet', 'tweet_shortcode');

// FLICKR PHOTO SET!!
function flickrset_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'photoset' => '72157633041248513',
      'class' => 'centro',
      'escludi' => '',
      ), $atts ) );

require_once("flickr/phpFlickr.php");
$f = new phpFlickr("15c79ea37d7fd4d8e69289520762793e");
$set = $f->photosets_getPhotos(esc_attr($photoset));

$exclude = esc_attr($escludi);
$excludes = explode(',', $exclude);


foreach ($set['photoset']['photo'] as $photo) {
	if (in_array("$photo[id]", $excludes)) {
	} else {
	  $photosreturn .= "<a href=". $f->buildPhotoURL($photo, "large") . ">"."<img class=".esc_attr($class)." alt='$photo[title]' "." alt='$photo[title]' ".
	            "src=" . $f->buildPhotoURL($photo, "Large") . ">" . "</a>";
	}
}
return $photosreturn;
}
add_shortcode('flickrset', 'flickrset_shortcode');

// FLICKR PHOTO!!
function flickrphoto_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'id' => '8574203981',
      'class' => 'centro',
      ), $atts ) );

require_once("flickr/phpFlickr.php");
$f = new phpFlickr("15c79ea37d7fd4d8e69289520762793e");
$thephoto = $f->photos_getInfo(esc_attr($id));

foreach ((array)$thephoto as $photo) {
	$photoid = "$photo[id]";
	if ($photoid == esc_attr($id)) {
	  $photosreturn .= "<a href=". $f->buildPhotoURL($photo, "large") . ">"."<img class=".esc_attr($class)." alt='$photo[title]' "." alt='$photo[title]' ".
	            "src=" . $f->buildPhotoURL($photo, "Large") . ">" . "</a>";
	   break;
	 }
}
return $photosreturn;
}
add_shortcode('flickrphoto', 'flickrphoto_shortcode');


//CODE BOX SHORTCODE
function code_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'titolo' => 'Codice',
      ), $atts ) );
      
   return '<pre class="prettyprint">'.$content.'</pre>';
}
add_shortcode('code', 'code_shortcode');

//INSTAGRAM EMBED
function instagramphoto_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'idpicture' => 'k0M9NXnJVd',
      ), $atts ) );
      
   return "<div class='embed-container'><iframe class='instagram_box' src='//".esc_attr($idpicture)."embed/' frameborder='0' scrolling='no' allowtransparency='true'></iframe></div>  ";
   
}
add_shortcode('instagramphoto', 'instagramphoto_shortcode');


//POLAR POLLS
function polarpolls_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'idpoll' => '179696',
      ), $atts ) );
      
   return '<script src="https://assets-polarb-com.a.ssl.fastly.net/assets/polar-embedded.js" async="true" data-publisher="albertoziveri" data-poll-id="'.esc_attr($idpoll).'"></script>';
   
}
add_shortcode('polarpolls', 'polarpolls_shortcode');



//YOUTUBE EMBED
function youtubetasc_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'idvideo' => 'k0M9NXnJVd',
      ), $atts ) );
      
   return '<div class="youtubevideo"><iframe width="800" height="450" src="https://www.youtube.com/embed/'.esc_attr($idvideo).'?rel=0&theme=light&color=white&wmode=opaque&modestbranding=0" frameborder="" allowfullscreen=""></iframe></div>';
   
}
add_shortcode('youtubetasc', 'youtubetasc_shortcode');



//YOUTUBE EMBED
function infogram_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'idgrafico' => 'i-problemi-secondo-tascit',
      ), $atts ) );
      
   return '<script id="infogram_0_'.esc_attr($idgrafico).'" src="//e.infogr.am/js/embed.js" type="text/javascript"></script><div style="width:100%;border-top:1px solid #acacac;padding-top:3px;font-family:Arial;font-size:10px;text-align:center;"><a target="_blank" href="//infogr.am/'.esc_attr($idgrafico).'" style="color:#acacac;text-decoration:none;">Grafico</a> | <a style="color:#acacac;text-decoration:none;" href="//infogr.am" target="_blank">Create Infographics</a></div>';
   
}
add_shortcode('infogram', 'infogram_shortcode');


//CHART BOX SHORTCODE
function barchart_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'titolo' => 'grafico',
      'labels' => '"ciao","ciao2"',
      'data' => '30,45',
      'altro' => ''
      
      ), $atts ) );
     $labels_decoded = html_entity_decode($labels);
	 $content2 = html_entity_decode($altro);
   return '<canvas id="'.esc_attr($titolo).'" height="500" width="700"></canvas>
   	<script>

		var barChartData = {
			labels : ['. $labels_decoded .'],
			datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					data : ['.esc_attr($data).'],
					'.$altro.'
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("'.esc_attr($titolo).'").getContext("2d")).Bar(barChartData);
	
	</script>
   ';
}
add_shortcode('barchart', 'barchart_shortcode');


?>