// Eliminate FOIT (Flash of Invisible Text) caused by web fonts loading slowly
// using font events with Font Face Observer.
(function ($) {

  "use strict";

  Drupal.behaviors.atFFOI = {
    attach: function (context) {

      $('html').addClass('fa-loading');

      var fontawesome = new FontFaceObserver('FontAwesome', {});

      // Because we are checking an icon font we need a unicode code point to check,
      // SEE https://github.com/bramstein/fontfaceobserver/issues/34
      fontawesome.check('\uf22d').then(function () {
        $('html').removeClass('fa-loading').addClass('fa-loaded');
      }, function() {
        $('html').removeClass('fa-loading').addClass('fa-unavailable');
      });

    }
  };
}(jQuery));
;
!function(a,b){"use strict";if(a("table.forum").addClass("responsive-enabled"),a("table.responsive-enabled").wrap('<div class="responsive-table"><div class="responsive-table__scroll"></div></div>'),a("table.responsive-enabled").prop("scrollWidth")>a(".responsive-table").width()){var c=b.t("Scroll to view");a(".responsive-table__scroll").append('<div class="responsive-table__message"><em>'+c+"</em></div>"),a("table.responsive-enabled").addClass("has-overflow")}}(jQuery,Drupal);

window.matchMedia||(window.matchMedia=function(){"use strict";var e=window.styleMedia||window.media;if(!e){var t=document.createElement("style"),i=document.getElementsByTagName("script")[0],n=null;t.type="text/css";t.id="matchmediajs-test";i.parentNode.insertBefore(t,i);n="getComputedStyle"in window&&window.getComputedStyle(t,null)||t.currentStyle;e={matchMedium:function(e){var i="@media "+e+"{ #matchmediajs-test { width: 1px; } }";if(t.styleSheet){t.styleSheet.cssText=i}else{t.textContent=i}return n.width==="1px"}}}return function(t){return{matches:e.matchMedium(t||"all"),media:t||"all"}}}());
;
