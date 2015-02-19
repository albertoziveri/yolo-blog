
/*CACHE UPDATE trasferita in footer.php
if (window.applicationCache) {
    applicationCache.addEventListener('updateready', function() {
            window.location.reload();
    });
}    */

// as the page loads, call these scripts

jQuery(document).ready(function($) {


/*RESIZE WINDOWS IN SUPER FULL PAGE POST*/
$(function(){
	var h = $(window).height();
	$("#super-header").css('height',h);
    $(window).resize(function(){
		var h = $(window).height();
		$("#super-header").css('height',h);
        var w = $(window).width();
        $("#super-header").css('height',h);
    });
});


//SORT TABLES es. pagina top authors
$(function(){
    $("table.sortable").stupidtable();
});


/*LEFT NAVIGATION*/
var shownav = false;
$('[data-action="openNav"]').click(function() { 
	if (shownav == false) {
	    $('#site-nav').addClass("opened");
		$('html').addClass("opened-nav");
		$(function(){
			var h = $(window).height();
			$("#site-nav").css('height',h);
		    $(window).resize(function(){
				var h = $(window).height();
				$("#site-nav").css('height',h);
		        var w = $(window).width();
		        $("#site-nav").css('height',h);
		    });
		});
		shownav = true;
	} else {
	    $('html').removeClass("opened-nav");        
		setTimeout(function() {
		      $("#site-nav").removeClass("opened");
		}, 200);
		shownav = false;    
	} 
});


$(document).click(function (e)
{
    var navigation = $("#site-nav");
    
    var opener = $("#open-nav");
    var hamburger = $("#hamburger");
     var overlaycontainer = $("#overlaycontainer");
    if (!navigation.is(e.target) && !opener.is(e.target) && !hamburger.is(e.target) && !overlaycontainer.is(e.target) && !target.parent(hamburger).length // if the target of the click isn't the container...
        && navigation.has(e.target).length === 0) // ... nor a descendant of the container
    {
	    $('html').removeClass("opened-nav");        
		setTimeout(function() {
		      navigation.removeClass("opened");
		}, 200);        
		shownav = false;
    }
});


/*
FLUIDBOX
*/
$(function () {
    $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"], a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]').fluidbox();
});

//EXTERNAL LINKS
$("a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])")
.addClass("external")
.attr("target","_blank")
	
	

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it so, be sure to research and find the one
    that works for you best.
    */
        
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    

    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above 768px */
    if (responsive_viewport > 768) {
    
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });	
        
        
        
        //MODAL FACEBOOK LIKE BOX
        if($.cookie('tascfbliked') == null) { 
        	$("#fblikebox-open").leanModal({ top : 120, overlay : 0.8, closeButton: ".modal_close" });
        	
			setTimeout(function() {
			     $("#fblikebox-open").click();
			}, 10000);			     	
			
        	$(".modal_close").click(function() { 
			        $.cookie('tascfbliked', '1',{ expires: 365, path: '/' }); 
			});
			
        	$("#lean_overlay").click(function() { 
			        $.cookie('tascfbliked', '1',{ expires: 365, path: '/' }); 
			});
			
			twttr.events.bind('follow', function(event) {
			        $("#lean_overlay").click(); 
			        $.cookie('tascfbliked', '1',{ expires: 365, path: '/' }); 
			});	
			
					
			window.fbAsyncInit = function () {
			    FB.init({
			        appId: '260103890835717',
			        status: true,
			        cookie: true,
			        xfbml: true,
			        oauth: true
			    });
			    FB.Event.subscribe('edge.create', function (response) {
			        $("#lean_overlay").click();
			        $.cookie('tascfbliked', '1',{ expires: 365, path: '/' }); 
			    });
			};
			(function (d) {
			    var js, id = 'facebook-jssdk';
			    if (d.getElementById(id)) {
			        return;
			    }
			    js = d.createElement('script');
			    js.id = id;
			    js.async = true;
			    js.src = "//connect.facebook.net/en_US/all.js";
			    d.getElementsByTagName('head')[0].appendChild(js);
			}(document));   
			
			setTimeout(function() {
			     $("#lean_overlay").click(); 
			        $.cookie('tascfbliked', '1',{ expires: 365, path: '/' }); 
			}, 35000);			     	
		}	 
		 
				   
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
    	
    
    /*Animations*/
		

}); /* end of as page load scripts */




	
//SOCIAL BUTTONS
function fbshare(url, title) {
	var winTop = (screen.height / 2) - (175);
	var winLeft = (screen.width / 2) - (260);
	window.open('https://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&u=' + url , 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=520,height=350');
}

function twittershare(url, title) {
	var winTop = (screen.height / 2) - (350 / 2);
	var winLeft = (screen.width / 2) - (520 / 2);
	
	window.open('https://twitter.com/intent/tweet?text=' + title + '&url=' + url + '&related=tasc%20For%20the%20latest%20from%20Tasc&via=tascproject', 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=520,height=350');
}

function googleshare(url, title) {
	var winTop = (screen.height / 2) - (350 / 2);
	var winLeft = (screen.width / 2) - (520 / 2);
	window.open('https://plus.google.com/share?url=' + url , 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=520,height=350');
}


/*! A fix for the iOS orientationchange zoom bug. Script by @scottjehl, rebound by @wilto.MIT / GPLv2 License.*/(function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),k=Math.abs(l.z),(!a.orientation||a.orientation===180)&&(i>7||(k>6&&j<8||k<8&&j>6)&&i>5)?h&&n():h||m()}var b=navigator.userAgent;if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1))return;var c=a.document;if(!c.querySelector)return;var d=c.querySelector("meta[name=viewport]"),e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0,i,j,k,l;if(!d)return;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)})(this); 