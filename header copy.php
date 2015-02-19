<!doctype html>  
<html <?php language_attributes(); ?> <?php if(is_home() or is_preview() or is_page()) {} else { ?>manifest="<?php echo get_template_directory_uri(); ?>/cache.appcache" <?php } ?>>
<!-- 

  _______ .______          ___       _______  __  .___________. _______ 
 /  _____||   _  \        /   \     |   ____||  | |           ||   ____|
|  |  __  |  |_)  |      /  ^  \    |  |__   |  | `---|  |----`|  |__   
|  | |_ | |      /      /  /_\  \   |   __|  |  |     |  |     |   __|  
|  |__| | |  |\  \----./  _____  \  |  |     |  |     |  |     |  |____ 
 \______| | _| `._____/__/     \__\ |__|     |__|     |__|     |_______|
                                                                        
                                                                        
If you're reading our source code it means you want to copy that. You won't never grow.
Grow with us and innovate the world: https://podio.com/webforms/6994256/538251

-->

	<head>
		<title><?php wp_title('&laquo;', true, 'right'); ?></title>
		<!--Typography-->
		<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6718272/768424/css/fonts.css" />		
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset="utf-8" />
				
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/library/images/apple-touch-icon-144x144.png">		
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/library/images/apple-touch-icon-72x72.png">		
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/library/images/apple-touch-icon-114x114.png">		
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/library/images/apple-touch-icon-57x57.png">		
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
				 
		<!-- WINDOWS PHONE FIX  -->
		<script type="text/javascript">
			//WINDOWS PHONE FIX
			(function() {
				if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
					var msViewportStyle = document.createElement("style");
					msViewportStyle.appendChild(
						document.createTextNode("@-ms-viewport{width:auto!important}")
					);
					document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
				}
			})();	
			
			console.log ( 'Don\'t copy Tasc. Join us at grafite: www.grafite.io' );				
		</script>
		<!-- /WINDOWS PHONE FIX  -->
		
		<!-- GOOGLE PLUS -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
			    po.src = "https://apis.google.com/js/plusone.js?publisherid=107793090627145380318";
			    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>		
		<!-- \GOOGLE PLUS -->
			
		<!-- end of wordpress head -->
		</head>
	
	<body <?php body_class(); ?>>
	
		<div id="site-nav"  class="grafitestyle">
			<div id="inner-site-nav">
			
				<div class="site-nav-box">
					<div id="white-logo">
						<span></span>
					</div>
					<div id="closesitenav">
						<span id="closesitenavspan" class="iconfont">f</span>
					</div>
				</div>
				
				<div class="site-nav-box">
					<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
				</div>
				
				
				<?php global $detect;
				if($detect->isMobile() && !$detect->isTablet()) { ?> 
				<div class="site-nav-box">
					<h3>Esplora</h3>
					<?php display_cats(); ?>
				</div>
				<?php } ?>
				
				
				<div class="site-nav-box">
					<div id="search">
						<?php get_search_form(); ?>
					</div>
				</div>
				
				<div class="site-nav-box">
					<div id="social">
						<ul>
							<li><a class="iconfont" href="http://feeds.feedburner.com/tascproject" target="_blank">d</a></li>
							<li><a class="iconfont" href="http://www.facebook.com/tascproject" target="_blank">a</a></li>
							<li><a class="iconfont" href="http://www.twitter.com/tascproject" target="_blank">b</a></li>
							<li><a class="iconfont" href="https://plus.google.com/+TASCit/posts" target="_blank">k</a></li>
							<li><a class="iconfont" href="http://www.instagram.com/tascproject" target="_blank">c</a></li>
							<li><a class="iconfont" href="http://www.pinterest.com/tascmagazine/" target="_blank">l</a></li>
						</ul>
					</div>
				</div>
				
				<div class="site-nav-box">
	    		<?php if ( is_user_logged_in() ) { ?> 
						<h3><?php if (current_user_can('publish_posts')) { echo "Membro del Cast";} else {echo "Tasc VIP";} ?></h3>
						<ul>
							<?php if (current_user_can('publish_posts')) { ?> 
								<li><a href="http://www.tasc.it/wp-admin">Wordpress admin</a></li>
							<?php } else { ?> 
								<li><a href="http://www.tasc.it/logged/account/">Gestione account</a></li>
								<li><a href="http://www.tasc.it/wp-admin/post-new.php">Scrivi articolo</a></li>
								<li><a href="http://www.tasc.it/opinioni/write">Scrivi opinione</a></li>
							<?php } ?>
							<?php if(MeprRule::is_allowed_by_rule(35954)) { ?>
								<li><a href="http://www.tasc.it/all-u-can-eat/home/">I tuoi servizi</a></li>
							<?php } else { ?>
								<li><a href="http://www.tasc.it/all-u-can-eat/">All you can eat</a></li>
							<?php } ?>
							<li><a href="http://www.tasc.it/wp-login.php?action=logout&redirect_to=http%3A%2F%2Fwww.tasc.it%2Flogin%2F&_wpnonce=e12a88ab89">Logout</a></li>
						</ul>
	    		<?php } else { ?>
					<h3>Tasc VIP</h3>
					<ul>
						<li><a href="http://www.tasc.it/tasc-vip">Cos'è Tasc VIP</a></li>
						<li><a href="http://www.tasc.it/signup/tasc-vip-register/">Registrati</a></li>
						<li><a href="http://www.tasc.it/all-u-can-eat/">All You Can Eat</a></li>
						<li><a href="http://www.tasc.it/login">Login</a></li>
					</ul>
	    		<?php } ?>
				</div>
			</div>
		</div>
		<header class="header" role="banner">
		
			<div id="inner-header" class="wrap clearfix">
				<button id="hamburger" class="iconfont" data-action="openNav">n</button>
				<!--<button id="open-nav" data-action="openNav"></button>-->
				
				<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
				<div id="logo">
					<a href="<?php echo home_url(); ?>" rel="nofollow" class="iconfont"><span id="logospan"></span></a>
				</div>
				
				<?php display_cats(); ?>
				
			</div> <!-- end #inner-header -->
		
		</header> <!-- end header -->
		
		<!-- Apro il container in base al tipo di pagina -->
		<?php if(is_single()) {
			$large = get_post_meta($post->ID, 'opt_large', true);
			if($large == "on" or $large == 1) { ?>
				<div id="container" class="super-full" <?php if(is_page('cast')) {?>class="grafitestyle" <?php } ?> >
			<?php } else { ?>
				<div id="container" <?php if(is_page('cast')) {?>class="grafitestyle" <?php } ?> >
			<?php }
			?>
		<?php } else { ?>
		<div id="container" <?php if(is_page('cast')) {?>class="grafitestyle" <?php } ?> >
		<?php } ?>
