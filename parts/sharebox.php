	    <div id="share-box">
		    <div class="share">
		    	<div class="share-count">
		    		<span class="count"><?php $url1 = get_permalink(); $url2 = get_permalink(); $url2 = preg_replace("/^https:/i", "http:", $url2); $total =  getsocialcount($url1) + getsocialcount($url2);  echo $total; ?></span>
		    		<span class="shares-name">condivisioni</span>
		    	</div>
		    	<div class="share-it">
		    		<ul class="tasc-social clearfix">
		    			<?php $title = urlencode(get_the_title()); ?>
		    			<li><a id="fbshare" class="facebook" onclick="javascript:fbshare('<?php urlencode(the_permalink());?>/','<?php echo $title; ?>')" href="javascript:return(0);"><span class="iconfont icon">a</span></a></li>
		    			
		    			<li><a id="twittershare" class="twitter" onclick="javascript:twittershare('<?php urlencode(the_permalink()); ?>','<?php echo $title; ?>')" href="javascript:return(0);"  target="blank"><span class="iconfont icon">b</span></a></li>
		    			<li><a id="googleshare" class="gplus" onclick="javascript:googleshare('<?php the_permalink();?>','<?php echo $title; ?>')" href="javascript:return(0);" target="blank" ><span class="iconfont icon">k</span></a></li>
		    		</ul>
		    	</div>
		    </div>
		    
		    <div class="sponsor">
		    	<div class="advertisement">
		    		
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2858043727445910";
/* Tasc */
google_ad_slot = "1283268581";
google_ad_width = 320;
google_ad_height = 50;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>		    	</div>
		    </div>
	    </div>
