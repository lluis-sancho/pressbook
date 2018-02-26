<!--
  https://tympanus.net/codrops/2013/07/11/animated-books-with-css-3d-transforms/
  http://srobbin.com/blog/3d-css-book-covers/
-->

<?php
	get_header();
	$metadata = pb_get_book_information();
if ( pb_is_public() ) :
	if ( have_posts() ) { the_post();
	}
?>

<?php //get_template_part( 'page-cover', 'top-block' ); ?>
<?php //get_template_part( 'page-cover', 'second-block' ); ?>
<?php //get_template_part( 'page-cover', 'third-block' ); ?>

<?php pb_get_links( false ); ?>
<?php $metadata = pb_get_book_information();?>
<?php global $first_chapter; ?>

<div class="hero" id="hero" style="background-image: url('http://subsolardesigns.com/novelawp/wp-content/uploads/2014/10/missed_deadlines_by_aquasixio-d666l5m.jpg');">
  <div class="hero-mask"></div>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="hero-content">
          <h1><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h1>
          <p>Finally, I always go to sea as a sailor, because of the wholesome exercise and pure air of the fore-castle deck. For as in this world, head winds are far more prevalent than winds from astern.</p>          
          
          <a href="<?php global $first_chapter; echo $first_chapter; ?>" class="button">
            <i class="fa fa-book"></i>Leer libro
          </a>
        </div>
      </div>


      <div class="col-sm-4">
        <figure class='book'>
          <!-- Front -->
          <ul class='hardcover_front'>
            <li>
              <div class="coverDesign">
                <?php if ( ! empty( $metadata['pb_cover_image'] ) ) : ?>
                  <img src="<?php echo $metadata['pb_cover_image']; ?>" width="320" height="440"/>
                <?php endif; ?>
              </div>
            </li>
            <li></li>
          </ul>
          <!-- Pages -->
          <ul class='page'>
            <li></li>
            <li>
              <a class="btn" href="#">Leer libro</a>
            </li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
          <!-- Back -->
          <ul class='hardcover_back'>
            <li></li>
            <li></li>
          </ul>
          <ul class='book_spine'>
            <li></li>
            <li></li>
          </ul>
        </figure>      
      </div>
    </div><!-- end row -->
  </div><!-- end container -->
</div>



<?php else : ?>
	<?php //get_template_part( 'page-cover', 'private-block' ); ?>
<?php endif; ?>

<?php //get_footer(); ?>

<script type="text/javascript">
  /* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-touch-shiv-cssclasses-teststyles-prefixes-load
 */
  //;window.Modernizr=function(a,b,c){function w(a){j.cssText=a}function x(a,b){return w(m.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n={},o={},p={},q=[],r=q.slice,s,t=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=r.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(r.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(r.call(arguments)))};return e}),n.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:t(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c};for(var B in n)v(n,B)&&(s=B.toLowerCase(),e[s]=n[B](),q.push((e[s]?"":"no-")+s));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},w(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=m,e.testStyles=t,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+q.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
</script>

<style type="text/css">
/*  button,input{line-height:normal;}button,select{text-transform:none;}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer;}button[disabled],html input[disabled]{cursor:default;}input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0;}input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none;}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0;}textarea{overflow:auto;vertical-align:top;}table{border-collapse:collapse;border-spacing:0;}*/
</style>

<style type="text/css">
/*
  A. Mini Reset 
*/
*, *:after, *:before { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }



::before,
::after {
  content: "";
}

/* ///////////////////////////////////////////////////

HARDCOVER
Table of Contents

1. container
2. background & color
3. opening cover, back cover and pages
4. position, transform y transition
5. events
6. Bonus
  - Cover design
  - Ribbon
  - Figcaption
7. mini-reset

/////////////////////////////////////////////////////*/

/*
  1. container
*/

.book {
  position: relative;
  width: 320px; 
  height: 440px;
  -webkit-perspective: 1000px;
  -moz-perspective: 1000px;
  perspective: 1000px;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
}

/*
  2. background & color
*/

/* HARDCOVER FRONT */
.hardcover_front li:first-child {
  /*background-color: #eee;*/
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  backface-visibility: hidden;
}

/* reverse */
.hardcover_front li:last-child {
  background: #fffbec;
}

/* HARDCOVER BACK */
.hardcover_back li:first-child {
  background: #fffbec;
}

/* reverse */
.hardcover_back li:last-child {
  background: #fffbec;
}

.book_spine li:first-child {
  background: #eee;
}
.book_spine li:last-child {
  background: #333;
}

/* thickness of cover */

.hardcover_front li:first-child:after,
.hardcover_front li:first-child:before,
.hardcover_front li:last-child:after,
.hardcover_front li:last-child:before,
.hardcover_back li:first-child:after,
.hardcover_back li:first-child:before,
.hardcover_back li:last-child:after,
.hardcover_back li:last-child:before,
.book_spine li:first-child:after,
.book_spine li:first-child:before,
.book_spine li:last-child:after,
.book_spine li:last-child:before {
  background: #999;
}

/* page */

.book .page > li {
  background: -webkit-linear-gradient(left, #e1ddd8 0%, #fffbf6 100%);
  background: -moz-linear-gradient(left, #e1ddd8 0%, #fffbf6 100%);
  background: -ms-linear-gradient(left, #e1ddd8 0%, #fffbf6 100%);
  background: linear-gradient(left, #e1ddd8 0%, #fffbf6 100%);
  box-shadow: inset 0px -1px 2px rgba(50, 50, 50, 0.1), inset -1px 0px 1px rgba(150, 150, 150, 0.2);
  border-radius: 0px 5px 5px 0px;
}

/*
  3. opening cover, back cover and pages
*/

.hardcover_front {
  -webkit-transform: rotateY(-34deg) translateZ(8px);
  -moz-transform: rotateY(-34deg) translateZ(8px);
  transform: rotateY(-34deg) translateZ(8px);
  z-index: 100;
}

.hardcover_back {
  -webkit-transform: rotateY(-15deg) translateZ(-8px);
  -moz-transform: rotateY(-15deg) translateZ(-8px);
  transform: rotateY(-15deg) translateZ(-8px);
}

.book .page li:nth-child(1) {
  -webkit-transform: rotateY(-28deg);
  -moz-transform: rotateY(-28deg);
  transform: rotateY(-28deg);
}

.book .page li:nth-child(2) {
  -webkit-transform: rotateY(-30deg);
  -moz-transform: rotateY(-30deg);
  transform: rotateY(-30deg);
}

.book .page li:nth-child(3) {
  -webkit-transform: rotateY(-32deg);
  -moz-transform: rotateY(-32deg);
  transform: rotateY(-32deg);
}

.book .page li:nth-child(4) {
  -webkit-transform: rotateY(-34deg);
  -moz-transform: rotateY(-34deg);
  transform: rotateY(-34deg);
}

.book .page li:nth-child(5) {
  -webkit-transform: rotateY(-36deg);
  -moz-transform: rotateY(-36deg);
  transform: rotateY(-36deg);
}

/*
  4. position, transform & transition
*/

.hardcover_front,
.hardcover_back,
.book_spine,
.hardcover_front li,
.hardcover_back li,
.book_spine li {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
}

.hardcover_front,
.hardcover_back {
  -webkit-transform-origin: 0% 100%;
  -moz-transform-origin: 0% 100%;
  transform-origin: 0% 100%;
}

.hardcover_front {
  -webkit-transition: all 0.8s ease, z-index 0.6s;
  -moz-transition: all 0.8s ease, z-index 0.6s;
  transition: all 0.8s ease, z-index 0.6s;
}

/* HARDCOVER front */
.hardcover_front li:first-child {
  cursor: default;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
  -webkit-transform: translateZ(2px);
  -moz-transform: translateZ(2px);
  transform: translateZ(2px);
}

.hardcover_front li:last-child {
  -webkit-transform: rotateY(180deg) translateZ(2px);
  -moz-transform: rotateY(180deg) translateZ(2px);
  transform: rotateY(180deg) translateZ(2px);
}

/* HARDCOVER back */
.hardcover_back li:first-child {
  -webkit-transform: translateZ(2px);
  -moz-transform: translateZ(2px);
  transform: translateZ(2px);
}

.hardcover_back li:last-child {
  -webkit-transform: translateZ(-2px);
  -moz-transform: translateZ(-2px);
  transform: translateZ(-2px);
}

/* thickness of cover */
.hardcover_front li:first-child:after,
.hardcover_front li:first-child:before,
.hardcover_front li:last-child:after,
.hardcover_front li:last-child:before,
.hardcover_back li:first-child:after,
.hardcover_back li:first-child:before,
.hardcover_back li:last-child:after,
.hardcover_back li:last-child:before,
.book_spine li:first-child:after,
.book_spine li:first-child:before,
.book_spine li:last-child:after,
.book_spine li:last-child:before {
  position: absolute;
  top: 0;
  left: 0;
}

/* HARDCOVER front */
.hardcover_front li:first-child:after,
.hardcover_front li:first-child:before {
  width: 4px;
  height: 100%;
}

.hardcover_front li:first-child:after {
  -webkit-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  -moz-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  transform: rotateY(90deg) translateZ(-2px) translateX(2px);
}

.hardcover_front li:first-child:before {
  -webkit-transform: rotateY(90deg) translateZ(158px) translateX(2px);
  -moz-transform: rotateY(90deg) translateZ(158px) translateX(2px);
  transform: rotateY(90deg) translateZ(158px) translateX(2px);
}

.hardcover_front li:last-child:after,
.hardcover_front li:last-child:before {
  width: 4px;
  height: 160px;
}

.hardcover_front li:last-child:after {
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(-2px) translateY(-78px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(-2px) translateY(-78px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(-2px) translateY(-78px);
}
.hardcover_front li:last-child:before {
  box-shadow: 0px 0px 30px 5px #333;
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(-2px) translateY(-78px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(-2px) translateY(-78px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(-2px) translateY(-78px);
}

/* thickness of cover */

.hardcover_back li:first-child:after,
.hardcover_back li:first-child:before {
  width: 4px;
  height: 100%;
}

.hardcover_back li:first-child:after {
  -webkit-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  -moz-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  transform: rotateY(90deg) translateZ(-2px) translateX(2px);
}
.hardcover_back li:first-child:before {
  -webkit-transform: rotateY(90deg) translateZ(158px) translateX(2px);
  -moz-transform: rotateY(90deg) translateZ(158px) translateX(2px);
  transform: rotateY(90deg) translateZ(158px) translateX(2px);
}

.hardcover_back li:last-child:after,
.hardcover_back li:last-child:before {
  width: 4px;
  height: 160px;
}

.hardcover_back li:last-child:after {
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(2px) translateY(-78px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(2px) translateY(-78px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(80px) translateX(2px) translateY(-78px);
}

.hardcover_back li:last-child:before {
  box-shadow: 10px -1px 80px 20px #666;
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(2px) translateY(-78px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(2px) translateY(-78px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(-140px) translateX(2px) translateY(-78px);
}

/* BOOK SPINE */
.book_spine {
  -webkit-transform: rotateY(60deg) translateX(-5px) translateZ(-12px);
  -moz-transform: rotateY(60deg) translateX(-5px) translateZ(-12px);
  transform: rotateY(60deg) translateX(-5px) translateZ(-12px);
  width: 16px;
  z-index: 0;
}

.book_spine li:first-child {
  -webkit-transform: translateZ(2px);
  -moz-transform: translateZ(2px);
  transform: translateZ(2px);
}

.book_spine li:last-child {
  -webkit-transform: translateZ(-2px);
  -moz-transform: translateZ(-2px);
  transform: translateZ(-2px);
}

/* thickness of book spine */
.book_spine li:first-child:after,
.book_spine li:first-child:before {
  width: 4px;
  height: 100%;
}

.book_spine li:first-child:after {
  -webkit-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  -moz-transform: rotateY(90deg) translateZ(-2px) translateX(2px);
  transform: rotateY(90deg) translateZ(-2px) translateX(2px);
}

.book_spine li:first-child:before {
  -webkit-transform: rotateY(-90deg) translateZ(-12px);
  -moz-transform: rotateY(-90deg) translateZ(-12px);
  transform: rotateY(-90deg) translateZ(-12px);
}

.book_spine li:last-child:after,
.book_spine li:last-child:before {
  width: 4px;
  height: 16px;
}

.book_spine li:last-child:after {
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(8px) translateX(2px) translateY(-6px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(8px) translateX(2px) translateY(-6px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(8px) translateX(2px) translateY(-6px);
}

.book_spine li:last-child:before {
  box-shadow: 5px -1px 100px 40px rgba(0, 0, 0, 0.2);
  -webkit-transform: rotateX(90deg) rotateZ(90deg) translateZ(-210px) translateX(2px) translateY(-6px);
  -moz-transform: rotateX(90deg) rotateZ(90deg) translateZ(-210px) translateX(2px) translateY(-6px);
  transform: rotateX(90deg) rotateZ(90deg) translateZ(-210px) translateX(2px) translateY(-6px);
}

.book .page,
.book .page > li {
  position: absolute;
  top: 0;
  left: 0;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
}

.book .page {
  width: 100%;
  height: 98%;
  top: 1%;
  left: 3%;
  z-index: 10;
}

.book .page > li {
  width: 100%;
  height: 100%;
  -webkit-transform-origin: left center;
  -moz-transform-origin: left center;
  transform-origin: left center;
  -webkit-transition-property: transform;
  -moz-transition-property: transform;
  transition-property: transform;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  transition-timing-function: ease;
}

.book .page > li:nth-child(1) {
  -webkit-transition-duration: 0.6s;
  -moz-transition-duration: 0.6s;
  transition-duration: 0.6s;
}

.book .page > li:nth-child(2) {
  -webkit-transition-duration: 0.6s;
  -moz-transition-duration: 0.6s;
  transition-duration: 0.6s;
}

.book .page > li:nth-child(3) {
  -webkit-transition-duration: 0.4s;
  -moz-transition-duration: 0.4s;
  transition-duration: 0.4s;
}

.book .page > li:nth-child(4) {
  -webkit-transition-duration: 0.5s;
  -moz-transition-duration: 0.5s;
  transition-duration: 0.5s;
}

.book .page > li:nth-child(5) {
  -webkit-transition-duration: 0.6s;
  -moz-transition-duration: 0.6s;
  transition-duration: 0.6s;
}

/*
  5. events
*/

.book:hover > .hardcover_front {
  -webkit-transform: rotateY(-145deg) translateZ(0);
  -moz-transform: rotateY(-145deg) translateZ(0);
  transform: rotateY(-145deg) translateZ(0);
  z-index: 0;
}

.book:hover > .page li:nth-child(1) {
  -webkit-transform: rotateY(-30deg);
  -moz-transform: rotateY(-30deg);
  transform: rotateY(-30deg);
  -webkit-transition-duration: 1.5s;
  -moz-transition-duration: 1.5s;
  transition-duration: 1.5s;
}

.book:hover > .page li:nth-child(2) {
  -webkit-transform: rotateY(-35deg);
  -moz-transform: rotateY(-35deg);
  transform: rotateY(-35deg);
  -webkit-transition-duration: 1.8s;
  -moz-transition-duration: 1.8s;
  transition-duration: 1.8s;
}

.book:hover > .page li:nth-child(3) {
  -webkit-transform: rotateY(-118deg);
  -moz-transform: rotateY(-118deg);
  transform: rotateY(-118deg);
  -webkit-transition-duration: 1.6s;
  -moz-transition-duration: 1.6s;
  transition-duration: 1.6s;
}

.book:hover > .page li:nth-child(4) {
  -webkit-transform: rotateY(-130deg);
  -moz-transform: rotateY(-130deg);
  transform: rotateY(-130deg);
  -webkit-transition-duration: 1.4s;
  -moz-transition-duration: 1.4s;
  transition-duration: 1.4s;
}

.book:hover > .page li:nth-child(5) {
  -webkit-transform: rotateY(-140deg);
  -moz-transform: rotateY(-140deg);
  transform: rotateY(-140deg);
  -webkit-transition-duration: 1.2s;
  -moz-transition-duration: 1.2s;
  transition-duration: 1.2s;
}

/*
  6. Bonus
*/

/* cover CSS */

.coverDesign {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  overflow: hidden;
  z-index: 1;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  backface-visibility: hidden;
}

.coverDesign::after {
  background-image: -webkit-linear-gradient( -135deg, rgba(255, 255, 255, 0.45) 0%, transparent 100%);
  background-image: -moz-linear-gradient( -135deg, rgba(255, 255, 255, 0.45) 0%, transparent 100%);
  background-image: linear-gradient( -135deg, rgba(255, 255, 255, 0.45) 0%, transparent 100%);
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

.coverDesign h1 {
  color: #fff;
  font-size: 2.2em;
  letter-spacing: 0.05em;
  text-align: center;
  margin: 54% 0 0 0;
  text-shadow: -1px -1px 0 rgba(0,0,0,0.1);
}

.coverDesign p {
  color: #f8f8f8;
  font-size: 1em;
  text-align: center;
  text-shadow: -1px -1px 0 rgba(0,0,0,0.1);
}

.yellow {
  background-color: #f1c40f;
  background-image: -webkit-linear-gradient(top, #f1c40f 58%, #e7ba07 0%);
  background-image: -moz-linear-gradient(top, #f1c40f 58%, #e7ba07 0%);
  background-image: linear-gradient(top, #f1c40f 58%, #e7ba07 0%);
}

.blue {
  background-color: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db 58%, #2a90d4 0%);
  background-image: -moz-linear-gradient(top, #3498db 58%, #2a90d4 0%);
  background-image: linear-gradient(top, #3498db 58%, #2a90d4 0%);
}

.grey {
  background-color: #f8e9d1;
  background-image: -webkit-linear-gradient(top, #f8e9d1 58%, #e7d5b7 0%);
  background-image: -moz-linear-gradient(top, #f8e9d1 58%, #e7d5b7 0%);
  background-image: linear-gradient(top, #f8e9d1 58%, #e7d5b7 0%);
}

/* Media Queries */
@media screen and (max-width: 37.8125em) {
  .align > li {
    width: 100%;
    min-height: 440px;
    height: auto;
    padding: 0;
    margin: 0 0 30px 0;
  }

  .book {
    margin: 0 auto;
  }
}

</style>
