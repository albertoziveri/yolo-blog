/*global tinyMCE, tinymce*/
/*jshint forin:true, noarg:true, noempty:true, eqeqeq:true, bitwise:true, strict:true, undef:true, unused:true, curly:true, browser:true, devel:true, maxerr:50 */

/*global tinyMCE, tinymce*/
/*jshint forin:true, noarg:true, noempty:true, eqeqeq:true, bitwise:true, strict:true, undef:true, unused:true, curly:true, browser:true, devel:true, maxerr:50 */
( function() {
    tinymce.PluginManager.add( 'tasctags_buttons', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'tasctags_buttons_key', {

        type: 'listbox',
        text: 'TascTags    ',
        icon: false,
        tooltip:'Tasc Shortcodes usali tanto!',
        onselect: function(e) {
            // do things...
        },
            values: [
             
                {text: 'YouTube HTML5', onclick : function() {
						var appID = prompt("ID Video", "Incolla URL video. Bravo/a che usi i player fighi.");
						idPattern = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
						var m = idPattern.exec(appID);
						if (m != null && m != 'undefined') {
							tinymce.execCommand('mceInsertContent', false, '[youtubetasc idvideo="'+m[1]+'"]');
						}
                }},
                
                {text: 'iOS App', onclick : function() {
						idPattern = /([0-9]+)/;
						var appID = prompt("ID App", "Inserisci l'ID dell'app Mac, iPad, iPod o iPhone. Es. 284971781");
						var m = idPattern.exec(appID);
						if (m != null && m != 'undefined') {
							tinymce.execCommand('mceInsertContent', false, '[appstore id="'+m[1]+'"]');
						}
                }},


                {text: 'Android App', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var appID = prompt("ID app android", "Inserisci l'ID dell'app Android Es. com.bfs.ninjump");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[googleplay]'+m[1]+'[/googleplay]');
					}
                }},


                {text: 'Frase importante', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var appID = prompt("Frase", "Don't get inspired, inspire");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[quote dove="sinistra"]'+m[1]+'[/quote]');
					}
                }},


                {text: 'Box Voto prodotto', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var titolo = prompt("Titolo prodotto", "es. iPhone 5s");
					var conclusione = prompt("Conclusione prodotto", "es. Il miglior smartphone in commercio, fotocamera eccellente, impronta digitale e iOS 7.");
					var voto = prompt("Voto prodotto", "Da 1 a 10. Es. 7");
						tinymce.execCommand('mceInsertContent', false, '[riassunto titolo="'+titolo+'" voto="'+voto+'" ]'+conclusione+'[/riassunto]');
                }},


                {text: 'Immagine panorama', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var appID = prompt("URL immagine", "Inserisci l'url immagine caricato su un hosting immagini");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[panorama titolo="Panorama"]'+m[1]+'[/panorama]');
					}
                }},


                {text: 'Set Flickr', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var appID = prompt("ID Flickr SET", "Inserisci l'ID del set su Flickr. Nel tag inserisci l'attributo escludi con gli id delle eventuali foto da escludere dal photoset.");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[flickrset class="centro" photoset="'+m[1]+'"]');
					}
                }},


                {text: 'Foto di Flickr', onclick : function() {
					idPattern = /([a-zA-Z0-9_]+.+[a-zA-Z0-9_])/;
					var appID = prompt("ID Flickr Foto", "Inserisci l'ID della foto su Flickr che ricavi dal link della foto. Nel tag inserisci l'attributo escludi con gli id delle eventuali foto da escludere dal photoset.");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[flickrphoto class="centro" id="'+m[1]+'"]');
					}
                }},


                {text: 'Foto di Instagram', onclick : function() {
					idPattern = /http:\/\/(instagr\.am\/p\/.*|instagram\.com\/p\/.*)/i;
					var appID = prompt("ID Foto Instagram", "Inserisci l'URL della foto su Instagram! URL URL URL!");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[instagramphoto idpicture="'+m[1]+'"]');
					}
                }},
                {text: 'Sondaggio polarb.com', onclick : function() {
					idPattern = /([0-9]+)/;
					var appID = prompt("ID Sondaggio polarb.com", "Inserisci l'URL del sondaggio creato su Polarb.com! URL URL URL!");
					var m = idPattern.exec(appID);
					if (m != null && m != 'undefined') {
						tinymce.execCommand('mceInsertContent', false, '[polarpolls idpoll="'+m[1]+'"]');
					}
                }},
                {text: 'Grafico Infogram', onclick : function() {
					var appID = prompt("ID Grafico infogr.am", "L'ID del grafico lo ricavi dall'URL del grafico. Es. se l'URL del grafico è https://infogr.am/i-problemi-secondo-tascit?src=web allora l'ID è i-problemi-secondo-tascit");
						tinymce.execCommand('mceInsertContent', false, '[infogram idgrafico="'+appID+'"]');
                }}

            ]

        } );

    } );

} )();