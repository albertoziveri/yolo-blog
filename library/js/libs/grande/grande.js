/* http://mattduvall.com/grande.js */

!function(){function a(){var a=M.createElement("div"),b="<div class='options'>           <span class='no-overflow'>             <span class='ui-inputs'>               <button class='bold'>B</button>               <button class='italic'>i</button>               <button class='header1'>h1</button>               <button class='header2'>h2</button>               <button class='quote'>&rdquo;</button>               <button class='url useicons'>&#xe001;</button>               <input class='url-input' type='text' placeholder='Paste or type a link'/>             </span>           </span>         </div>",c=M.createElement("div"),d=M.createElement("div");d.className="g-body",M.body.appendChild(d),c.innerHTML="<div class='pos-abs file-label'>Insert image</div>                                         <input class='file-hidden pos-abs' type='file' id='files' name='files[]' accept='image/*' multiple/>",c.className="image-tooltip hide",a.className="text-menu hide",a.innerHTML=b,0===M.querySelectorAll(".text-menu").length&&(d.appendChild(a),d.appendChild(c)),I=M.querySelectorAll(".file-label + input")[0],H=M.querySelectorAll(".image-tooltip")[0],D=M.querySelectorAll(".text-menu")[0],E=M.querySelectorAll(".text-menu .options")[0],F=M.querySelectorAll(".text-menu .url-input")[0]}function b(){var a,b,f;for(M.onmousedown=B,M.onmouseup=function(a){setTimeout(function(){B(a)},1)},M.onkeydown=l,M.onkeyup=function(a){var b=window.getSelection();b.anchorNode&&"ARTICLE"!==b.anchorNode.nodeName&&(m(a),b.isCollapsed&&q(a))},L.onresize=B,F.onblur=t,F.onkeydown=u,Q.allowImages&&(H.onmousedown=d,I.onchange=e,M.onmousemove=c),a=0,b=N.length;b>a;a++)f=N[a],f.contentEditable=!0,f.onmousedown=f.onkeyup=f.onmouseup=B}function c(a){f(a,a.target)}function d(){var a=O.children,b=O.getBoundingClientRect();J=g(a,b)}function e(){var a,b=this.files[0],c=new FileReader;c.onload=function(){return function(b){a=M.createElement("figure"),a.innerHTML='<img src="'+b.target.result+'"/>',O.insertBefore(a,J.bottomElement)}}(b),c.readAsDataURL(b)}function f(){var a=O.children,b=O.getBoundingClientRect(),c=g(a,b);c?(H.style.left=b.left-90+"px",H.style.top=c.top-17+"px"):(H.style.left=K+"px",H.style.top=K+"px")}function g(a){var b,c,d,e,f,g,h,i,j=[];for(c=0,d=a.length-1;d>c;c++)e=a[c],f=a[c+1]||null,g=e.getBoundingClientRect().bottom-5,h=f.getBoundingClientRect().top,j.push({top:h,bottom:g,topElement:e,bottomElement:f,index:c+1});for(i=event.pageY-L.scrollY,c=0,d=j.length;d>c;c++)if(b=j[c],i<b.top&&i>b.bottom)return b;return null}function h(a){var b,c,d,e=M.querySelectorAll(".text-menu button"),f=function(b){a(b)};for(b=0,c=e.length;c>b;b++)d=e[b],f(d)}function i(){h(function(a){a.onmousedown=function(){s(a)}})}function j(){return L.getSelection().focusNode}function k(){var a,b,c,d=j();h(function(e){a=e.className;for(var f in tagClassMap)if(b=tagClassMap[f],c=new RegExp(b),c.test(a)){e.className=z(d,f)?b+" active":b;break}})}function l(a){var b,c=window.getSelection(),d=y(c.anchorNode,"p");13===a.keyCode&&d&&(prevSibling=d.previousSibling,b=prevSibling&&"HR"===prevSibling.nodeName&&!d.textContent.length,b&&a.preventDefault())}function m(a){var b,c=window.getSelection();13===a.keyCode&&("DIV"===c.anchorNode.nodeName&&v("p"),b=y(c.anchorNode,"p"),b&&n(b))}function n(a){var b,c,d;for(b=a.previousSibling,c=b;c&&c.nodeType==Node.TEXT_NODE;)c=c.previousSibling;"P"!==b.nodeName||b.textContent.length||"HR"===c.nodeName||(d=M.createElement("hr"),d.contentEditable=!1,a.parentNode.replaceChild(d,b))}function o(a){var b;return b=a.nodeType===Node.TEXT_NODE?"data":P?"textContent":"innerText"}function p(a,b,c){var d="ol"===c?"insertOrderedList":"insertUnorderedList",e="ol"===c?3:2;return M.execCommand(d),a.anchorNode[b]=a.anchorNode[b].substring(e),y(a.anchorNode,c)}function q(){var a,b,c,d,e,f,g=window.getSelection();g.isCollapsed&&g.anchorNode&&"ARTICLE"!==g.anchorNode.nodeName&&(a=o(g.anchorNode),b=g.anchorNode[a],b.match(/^[-*]\s/)&&"LI"!==g.anchorNode.parentNode.nodeName&&(c=p(g,a,"ul")),b.match(/^1\.\s/)&&"LI"!==g.anchorNode.parentNode.nodeName&&(c=p(g,a,"ol")),d=c&&["ul","ol"].indexOf(c.nodeName.toLocaleLowerCase())>=0&&["p","div"].indexOf(c.parentNode.nodeName.toLocaleLowerCase())>=0,d&&(e=g.anchorNode,f=c.parentNode,f.parentNode.insertBefore(c,f),f.parentNode.removeChild(f),r(g,e)))}function r(a,b){range=M.createRange(),range.setStart(b,0),range.setEnd(b,0),a.removeAllRanges(),a.addRange(range)}function s(a){var b,c,d=a.className,e=window.getSelection(),f=e.anchorNode;for(var g in tagClassMap)if(b=tagClassMap[g],c=new RegExp(b),c.test(d))switch(g){case"b":return!f||z(f,"h1")||z(f,"h2")||M.execCommand(b,!1),void 0;case"i":return M.execCommand(b,!1),void 0;case"h1":case"h2":case"h3":case"blockquote":return v(g),void 0;case"a":return w(),E.className="options url-mode",void 0}B()}function t(){var a=F.value;return E.className="options",window.getSelection().addRange(G),M.execCommand("unlink",!1),""===a?!1:(a.match("^(http://|https://|mailto:)")||(a="http://"+a),M.execCommand("createLink",!1,a),F.value="",void 0)}function u(a){13===a.keyCode&&(a.preventDefault(),a.stopPropagation(),F.blur())}function v(a){z(j(),a)?(M.execCommand("formatBlock",!1,"p"),M.execCommand("outdent")):M.execCommand("formatBlock",!1,a)}function w(){setTimeout(function(){var a=A(j());"undefined"!=typeof a?F.value=a:M.execCommand("createLink",!1,"/"),G=window.getSelection().getRangeAt(0),F.focus()},150)}function x(a,b,c){if(null!==a)for(;a.parentNode;){if(b(a))return c(a);a=a.parentNode}}function y(a,b){var c=function(a){return a.nodeName.toLowerCase()===b},d=function(a){return a};return x(a,c,d)}function z(a,b){return!!y(a,b)}function A(a){var b=function(a){return"undefined"!=typeof a.href},c=function(a){return a.href};return x(a,b,c)}function B(a){var b,c,d=L.getSelection(),e=a.target||a.srcElement;return e.isContentEditable?(d.isCollapsed?(C(K,K),D.className="text-menu hide"):(b=d.getRangeAt(0),c=b.getBoundingClientRect(),k(),C(c.top-5+L.pageYOffset,(c.left+c.right)/2)),void 0):(k(),void 0)}function C(a,b){D.style.top=a+"px",D.style.left=b+"px",Q.animate&&(D.className=a===K?"text-menu hide":"text-menu active")}var D,E,F,G,H,I,J,K=-999,L=this,M=this.document,N=M.querySelectorAll(".g-body article"),O=N[0],P=navigator.userAgent.toLowerCase().indexOf("firefox")>-1,Q={animate:!0};grande={bind:function(c,d){c&&(N=c),Q=d||Q,a(),b(),i()},select:function(){B()}},tagClassMap={b:"bold",i:"italic",h1:"header1",h2:"header2",a:"url",blockquote:"quote"},L.grande=grande}.call(this);


grande.bind(document.querySelectorAll("article"));