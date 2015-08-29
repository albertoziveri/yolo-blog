		
		</div> <!-- end #container -->
		<footer class="footer" role="contentinfo">
		
			<div id="inner-footer" class="wrap clearfix">
				<p class="attribution">
					Powered by <a href="http://www.grafite.io">Grafite</a><!--... <a target="_blank" href="http://it.wikipedia.org/wiki/Nespresso">What else?</a>-->
				</p>
				<p><a href="http://www.tasc.it/disclaimer">Legal Policy</a></p>
				<p class="quote">
					<a href="http://www.getquotesapp.com" target="_blank">
					<?php
						/*$key = 'vyfl4dws0xnebf9ka95p9e'; 
						$language = 'it';
						$request = file_get_contents('https://www.getquotesapp.com/api/randomquote?key='.$key.'&ln='.$language);
						$response = json_decode($request, true);
						
						$body_quote = $response['quote']['body'];
						$author_quote = $response['quote']['author'];	
						echo '"'.$body_quote . '" - ' . $author_quote;		*/			
					?>
					</a>
				</p>
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
		<?php 
		//Se non è mobile mostro il Facebook Like BOX dentro un modal, con jquery cookie che controlla ecc.
		global $detect;
		if($detect->isMobile() && !$detect->isTablet()) {} else { ?>
		<div id="fblikebox">
		    <h1 class="mediumone">Seguici per leggere</h1>
		    	<p>Le pagine che andrai a leggere sono pagine create con passione da un team giovane e intraprendente. Segui il progetto Tasc su Facebook.</p>
		      <div class="fb-like-box" data-href="https://www.facebook.com/tascproject" data-height="200" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
		      <p>Se non hai Facebook seguici su Twitter!</p>
		      <p><a href="https://twitter.com/tascproject" class="twitter-follow-button">Follow @tascproject</a>    
 <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script></p>
		      <a href="#" class="modal_close">Non ho Facebook ne Twitter o vi seguo già</a>
		</div>		
		<a id="fblikebox-open" href="#fblikebox" style="display:none;">
		<?php } ?>
		
		
		<!-- APPCACHE REFRESH -->
		<?php
			if ( is_home() ) { ?>
				<script  type="text/javascript">
					// Check if a new cache is available on page load.
					window.addEventListener('load', function(e) {
					
					  window.applicationCache.addEventListener('updateready', function(e) {
					    if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
					      // Browser downloaded a new app cache.
					      // Swap it in and reload the page to get the new hotness.
					      window.applicationCache.swapCache();
					        window.location.reload();
					    } else {
					      // Manifest didn't changed. Nothing new to server.
					    }
					  }, false);
					
					}, false);
				</script>
			
			<?php } else { ?>
				<script  type="text/javascript">
					// Check if a new cache is available on page load.
					window.addEventListener('load', function(e) {
					
					  window.applicationCache.addEventListener('updateready', function(e) {
					    if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
					      // Browser downloaded a new app cache.
					      // Swap it in and reload the page to get the new hotness.
					      window.applicationCache.swapCache();
					    } else {
					      // Manifest didn't changed. Nothing new to server.
					    }
					  }, false);
					
					}, false);
				</script>
			<?php
			}
			?>
		<!-- END APPCACHE REFRESH -->
        
        <!-- FULL SCREEN IN POST IMAGES -->
            <?php if ( is_single() ) {?>	
	<script  type="text/javascript">	
		jQuery(document).ready(function($) {
		/*FULL SCREEN IMAGE*/
$(function(){
	var w = $(window).width();
	var pW = $(".single .post").width();
	var setMargin = (pW - w)/2;
	$(".post-content img.full_screen_img").css("max-width", "none");
	$(".post-content img.full_screen_img").css('width',w);
	$(".post-content img.full_screen_img").css('margin-left',(setMargin) + "px");
    $(window).resize(function(){
		var w = $(window).width();
		var pW = $(".single .post").width();
		var setMargin = (pW - w)/2;
		$(".post-content img.full_screen_img").css("max-width", "none");
		$(".post-content img.full_screen_img").css('width',w);
		$(".post-content img.full_screen_img").css('margin-left',(setMargin) + "px");
    });
});

});
    </script>
            <?php } ?> 
        <!-- END FULL SCREEN IN POST IMAGES -->
            
		<?php wp_footer(); // js scripts are inserted using this function ?>

<script type='text/javascript'>var _merchantSettings=_merchantSettings || [];_merchantSettings.push(['AT', '11lK8x']);(function(){var autolink=document.createElement('script');autolink.type='text/javascript';autolink.async=true; autolink.src= ('https:' == document.location.protocol) ? 'https://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js' : 'http://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(autolink, s);})();</script>
	</body>

</html> <!-- end page. what a ride! -->