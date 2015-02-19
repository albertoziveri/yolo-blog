<?php

define('APPSTORE', 'http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/wa/wsLookup?country=IT&id=');

function AppStoreLinks_plugin_BelloWeb_callback($match) {
	$searchid = $match[1];
	return createLinkAppStore($searchid);
}

function createHTMLAppStore($linkImg, $nomeApp, $classe, $descrizione, $autore,$linkautore,$categoriaApp, $prezzoApp, $linkAppStore, $screenshots){
if (is_feed()) {
$strhtml = '<p><strong>'.$nomeApp.':</strong><br />'.$descrizione.'</p><p><img class="'.$classe.'" src="'.$linkImg.'" width="128" height="128" alt="icona" /></p><p><strong>Prezzo:</strong> '.$prezzoApp.'<br /><strong>Autore:</strong> <a href="'.$linkautore.'">'.$autore.'</a></p><br /><strong>Categoria:</strong> '.$categoriaApp.'<br /><a href="'.$linkAppStore.'" target="_blank">Download</a>';
} else {
$strHtml = '
<div class="review clearfix">
	<div class="image"><img class="'.$classe.'" src="'.$linkImg.'" alt="icona" /></div>
	<div class="right-info">
		<div class="header">
			<h2 class="h2">'.$descrizione.'</h2><h1 class="h1">'.$nomeApp.'</h1><div class="download"><a href="'.$linkAppStore.'" class="tasc-button" target="_blank">Download</a></div>
		</div>
		<div class="content">
			<div class="field price"><span class="icon"></span>'.$prezzoApp.'</div>
			<div class="field cat"><span class="icon"></span>'.$categoriaApp.'</div>
			<div class="field author"><span class="icon"></span><a href="'.$linkautore.'">'.$autore.'</a></div>
		</div>
	</div>
	<div class="screenshots">
		<ul>
			'.$screenshots.'
		</ul>
	</div>
</div>';
}
		return $strHtml;
}// end createHTMLAppStore

function createLinkAppStore($idApp,$atts){

	$obj = getContentApp($idApp);
	
	
	if($obj->{'resultCount'} > 0){
		if($atts["img"] == "") {$linkImg = $obj->results[0]->artworkUrl512;} else {$linkImg = $atts["img"];}
		if ($obj->results[0]->kind == "mac-software") {$tipo = 0;} elseif ($obj->results[0]->features[0] =="iosUniversal") {$tipo=1;} elseif (count($obj->results[0]->ipadScreenshotUrls)>0) {$tipo=2;} else {$tipo=3;} 
		$classe = "";
		if ($tipo>0) $classe = "icon_rounded";
		if($atts["titolo"] == "") {$nomeApp = $obj->results[0]->trackName;} else {$nomeApp = $atts["titolo"]; }
		if($atts["genere"] == "") {$categoriaApp = $obj->results[0]->genres[0];} else {$categoriaApp = $atts["genere"]; }
		if($atts["prezzo"] == "") {if($obj->results[0]->price > 0) {$prezzoApp = $obj->results[0]->price." €";} else {$prezzoApp = "Gratis";} } else {$prezzoApp = $atts["prezzo"]; }
		if($atts["linkdownload"] == "") {$linkAppStore = $obj->results[0]->trackViewUrl;} else {$linkAppStore =  $atts["linkdownload"]; }
		if($atts["autore"] == "") {$autore = $obj->results[0]->artistName;} else {$autore = $atts["autore"]; }
		if($atts["link"] == "") {$linkautore = $obj->results[0]->sellerUrl;} else {$linkautore = $atts["link"]; }
		
		foreach ($obj->results[0]->screenshotUrls as $theurl) {
			$filename_from_url = parse_url($theurl);
			$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);			
			if ($ext =="tiff") {} else {
				$screenshots .= '<li><img src="'.$theurl.'" alt="app screenshot" /></li>';
			}
		}
		foreach ($obj->results[0]->ipadScreenshotUrls as $theurlipad) {
			$filename_from_url = parse_url($theurlipad);
			$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);			
			if ($ext =="tiff") {} else {
				$screenshots .= '<li><img src="'.$theurlipad.'" alt="app screenshot" /></li>';
			}
		}
		
		
		if($atts["descrizione"] == "") {
			switch ($tipo) {
			    case 0:
			        $descrizione = "App per Mac";
			        break;
			    case 1:
			        $descrizione = "App universale per iOs";
			        break;
			    case 2:
			        $descrizione = "App per iPad";
			        break;
			    case 3:
			        $descrizione = "App per iPhone";
			        break;
			}	
		}	else {$rating = $atts["descrizione"]; }
		// Tolgo il punto e metto la virgola
		$prezzoApp = str_replace(".", ",", $prezzoApp);
		
		$linkAppStor2 = $linkAppStore;

		$strHtml = createHTMLAppStore($linkImg, $nomeApp, $classe, $descrizione, $autore,$linkautore,$categoriaApp, $prezzoApp, $linkAppStore, $screenshots);

		return $strHtml;
	}
}

function getContentApp($idApp){

	$searchlink = APPSTORE.$idApp;

	$result = @file_get_contents($searchlink);

	// Decode Content
	$obj = json_decode($result);

	return $obj;
}



//CREATE THE SHORTCODE
function appstore_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'titolo' => '',
      'descrizione' => '',
      'img' => '',
      'prezzo' => '',
	  'genere' => '',
	  'autore' => '',
	  'link' => '',
	  'linkdownload' => '',
	  'id' => ''
      ), $atts ) );
// INIZIO CACHE
$tempurl = get_template_directory(); 
$cachefile = $tempurl.'/library/cache/apps/'.esc_attr($id).'.txt';
$cachetime = 525600 * 60; // 1 year
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
//$return = include $cachefile;
//exit;
} else {
ob_start(); // start the output buffer
$return = createLinkAppStore(esc_attr($id),$atts);
$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, $return); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser
}
$include =  file_get_contents($cachefile);
return $include;
}
add_shortcode('appstore', 'appstore_shortcode');



/*
Plugin Name: Savrix Android Market
Plugin URI: http://androidphoneitalia.it
Description: Savrix Android Market
Version: 2.2.3
Author: Saverio Petrangelo
Author URI: http://androidphoneitalia.it
*/

// Shortcode per link al market
function sav_get_file ($package_name) {
	$opts = array(
	'http'=>array(
	'method'=>"GET",
	'header'=>"User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36\r\n" .
				"Accept-Language: en-US,en;q=0.8\r\n" .
				"Connection: close\r\n"
	)
	);

	$sav_context = stream_context_create($opts);
	global $sav_file;
	$sav_file = false;
	
	// Open the file (webpage) using the HTTP header created above
	if ($package_name != ""){
		$sav_file = @file_get_contents('https://play.google.com/store/apps/details?id=' . $package_name, false, $sav_context);
		}
}

function market_code ($sav_atts, $sav_content = null) {
	extract( shortcode_atts( array(
		'type' => 'market',
		'recensione' => '',
	), $sav_atts ) );
	
	$nome = "App Name";
	$sviluppatore = "Developer";
	$prezzo = "ND";
	$icona = plugin_dir_url( __FILE__ ) . "images/icona-default.png";
	$link_market = "https://play.google.com/store/apps/";
	$link_appbrain = "http://www.appbrain.com/";
	$valutazione = "";
	
	global $sav_file;
	if ($sav_content != "") {
		sav_get_file($sav_content);

		if ($sav_file != false) {
			$regexp = "<span\sitemprop=\"offers\"\s[^>]*>.*itemprop=\"offerType\">\s<meta\scontent=\"(.*)\"\sitemprop=\"price\">\s<span\sitemprop=\"seller\"";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$prezzo = $matches[1][0];
				}
			if ($prezzo == "ND") {
				$prezzo = "Free";
				}
			
			$regexp = "<div\sclass=\"document-title\"\sitemprop=\"name\">\s<div>(.*)<\/div>";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$nome = $matches[1][0];
			}
			
			$regexp = "<div\sitemprop=\"author\"\s.*itemprop=\"name\">(.*)<\/a>";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$sviluppatore = $matches[1][0];
			}
			
			$regexp = "<div\sclass=\"cover-container\">\s<img\s[^>]*\ssrc=\"([^=]*)=.*\"";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$icona = $matches[1][0];
			}
			
			$regexp = "<div\sclass=\"thumbnails\"\s[^>]*>(.*)<\/div>";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$screens = $matches[1][0];
			}
			
			$regexp = "<div\sclass=\"header-star-badge\">.*<div\sclass=\"current-rating\"\sstyle=\"width:(.*)\">";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				for ($i = 0; $i <= 4; $i++){
					if ($matches[1][$i] == "SPRITE_star_on_dark")
						$star_img[$i] = "star-on-dark-img";
					else if ($matches[1][$i] == "SPRITE_star_half_dark")
						$star_img[$i] = "star-half-dark-img";
					else
						$star_img[$i] = "star-off-dark-img";
				}
				$valutazione = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[0] . '.png" alt="' . $star_img[0] . '" />';
				$valutazione = $valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[1] . '.png" alt="' . $star_img[1] . '" />';
				$valutazione = $valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[2] . '.png" alt="' . $star_img[2] . '" />';
				$valutazione = $valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[3] . '.png" alt="' . $star_img[3] . '" />';
				$valutazione = $valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[4] . '.png" alt="' . $star_img[4] . '" />';
			}
		}
		
		$link_market = "https://play.google.com/store/apps/details?id=" . $sav_content;
		$link_appbrain = "http://www.appbrain.com/app/" . $sav_content;
		if (strcasecmp($type, "market") == 0)
			$link_qr_code = $link_market;
		else if (strcasecmp($type, "appbrain") == 0)
			$link_qr_code = $link_appbrain;
	}
	
	return '<div class="review clearfix googleplay">
	<div class="image"><img src="'. $icona .'" alt="icona" /></div>
	<div class="right-info">
		<div class="header">
			<h2 class="h2">App per Android</h2><h1 class="h1">'. $nome .'</h1><div class="download"><a href="'. $link_market .'" class="tasc-button" target="_blank">Download</a></div>
		</div>
		<div class="content">
			<div class="field price"><span class="icon"></span>'. $prezzo .'</div>
			<div class="field author"><span class="icon"></span>'.$sviluppatore. '</div>
		</div>
	</div>
	<div class="screenshots">
		'. $screens .'
	</div>
</div>';
}

function sav_qr_code ($qr_atts, $qr_content = null) {
	extract( shortcode_atts( array(
		'size' => '125',
		'type' => 'market',
		'class' => '',
	), $qr_atts ) );
	
	if (strcasecmp($type, "market") == 0)
		$qr_link_market = "https://play.google.com/store/apps/details?id=" . $qr_content;
	else if (strcasecmp($type, "appbrain") == 0)
		$qr_link_market = "http://www.appbrain.com/app/" . $qr_content;
	
	if ($class != "")
		return '<img class="' . $class . '" title="QR Code" src="http://qrcode.kaywa.com/img.php?s=5&amp;d=' . $qr_link_market . '" alt="qrcode-app" />';
	else
		return '<img width="'. $size. '" height="' . $size . '" title="QR Code" src="http://qrcode.kaywa.com/img.php?s=5&amp;d=' . $qr_link_market . '" alt="qrcode-app" />';
}

function sav_star_code ($star_atts, $star_content = null) {
	extract( shortcode_atts( array(
		'class' => '',
	), $star_atts ) );
	
	$star_valutazione = "";
	
	global $sav_file;
	
	if ($sav_file == false){
		sav_get_file($star_content);
		}
	else {
		if (!stristr($sav_file, $star_content)){
			sav_get_file($star_content);
			}
		}
		
	if ($sav_file != false) {
		$regexp = "<div\sclass=\"cover-container\">\s<img\s[^>]*\ssrc=\"([^\"]*)\"";
		if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
			for ($i = 0; $i <= 4; $i++){
				if ($matches[1][$i] == "SPRITE_star_on_dark")
					$star_img[$i] = "star-on-dark-img";
				else if ($matches[1][$i] == "SPRITE_star_half_dark")
					$star_img[$i] = "star-half-dark-img";
				else
					$star_img[$i] = "star-off-dark-img";
			}
			if ($class == "") {
				$star_valutazione = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[0] . '.png" alt="' . $star_img[0] . '" />';
				$star_valutazione = $star_valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[1] . '.png" alt="' . $star_img[1] . '" />';
				$star_valutazione = $star_valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[2] . '.png" alt="' . $star_img[2] . '" />';
				$star_valutazione = $star_valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[3] . '.png" alt="' . $star_img[3] . '" />';
				$star_valutazione = $star_valutazione . '<img src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[4] . '.png" alt="' . $star_img[4] . '" />';
				}
			else {
				$star_valutazione = '<img class="' . $class . '" src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[0] . '.png" alt="' . $star_img[0] . '" />';
				$star_valutazione = $star_valutazione . '<img class="' . $class . '" src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[1] . '.png" alt="' . $star_img[1] . '" />';
				$star_valutazione = $star_valutazione . '<img class="' . $class . '" src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[2] . '.png" alt="' . $star_img[2] . '" />';
				$star_valutazione = $star_valutazione . '<img class="' . $class . '" src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[3] . '.png" alt="' . $star_img[3] . '" />';
				$star_valutazione = $star_valutazione . '<img class="' . $class . '" src="' . plugin_dir_url( __FILE__ ) . 'images/' . $star_img[4] . '.png" alt="' . $star_img[4] . '" />';
				}
			}
		}
	return $star_valutazione;
}

function sav_icon_code ($icon_atts, $icon_content = null) {
	extract( shortcode_atts( array(
		'size' => '125',
		'class' => '',
	), $icon_atts ) );
	
	$sav_icon = "";
	
	global $sav_file;
	
	if ($sav_file == false){
		sav_get_file($icon_content);
		}
	else {
		if (!stristr($sav_file, $icon_content)){
			sav_get_file($icon_content);
			}
		}
	
	if ($sav_file != false) {
		$regexp = "<div\sclass=\"doc-banner-icon\"><img\s[^>]*src=\"([^\"]*)\"";
			if(preg_match_all("/$regexp/siU", $sav_file, $matches)) {
				$sav_icon = $matches[1][0];
			}
		}
	if ($class != "") {
		return '<img src="' . $sav_icon . '" class="' . $class . '" alt="logo-app" />';
		}
	else {
		return '<img src="' . $sav_icon . '" width="' . $size . '" height="' . $size .'" alt="logo-app" />';
		}
}

add_shortcode( 'googleplay', 'market_code' );
add_shortcode( 'qr', 'sav_qr_code' );
add_shortcode( 'stars', 'sav_star_code' );
add_shortcode( 'appicon', 'sav_icon_code' );


?>