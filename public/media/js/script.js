
      $(document).ready(function(){
      jQuery('#camera_wrap').camera({
        loader: false,
        pagination: false ,
        minHeight: '444',
        thumbnails: false,
        height: '48.375%',
        caption: true,
        navigation: true,
        fx: 'mosaic'
      });
      /*carousel*/
      var owl=$("#owl");
        owl.owlCarousel({
        items : 2, //10 items above 1000px browser width
        itemsDesktop : [995,2], //5 items between 1000px and 901px
        itemsDesktopSmall : [767, 2], // betweem 900px and 601px
        itemsTablet: [700, 2], //2 items between 600 and 0
        itemsMobile : [479, 1], // itemsMobile disabled - inherit from itemsTablet option
        navigation : true,
        pagination : false
        });
      $().UItoTop({ easingType: 'easeOutQuart' });
      });
      

$(function(){
// IPad/IPhone
  var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
  ua = navigator.userAgent,

  gestureStart = function () {viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";},

  scaleFix = function () {
    if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
      viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
      document.addEventListener("gesturestart", gestureStart, false);
    }
  };

  //
  $('#bookingForm input, #bookingForm textarea').placeholder();

  $('#bookingForm').bookingForm({
          ownerEmail: '#'
        });

  //Tabs
$('#bookingForm').bookingForm({
        ownerEmail: '#'
      });
     
     if($('#tabs').length) {
         var myTabs = tabs({
                el: '#tabs',
             tabNavigationLinks: '.c-tabs-nav__link',
             tabContentContainers: '.c-tab'
             });
            myTabs.init();
     }

  scaleFix();
  // Menu Android
  if(window.orientation!=undefined){
  var regM = /ipod|ipad|iphone/gi,
   result = ua.match(regM)
  if(!result) {
   $('.sf-menu li').each(function(){
    if($(">ul", this)[0]){
     $(">a", this).toggle(
      function(){
       return false;
      },
      function(){
       window.location.href = $(this).attr("href");
      }
     );
    } 
   })
  }
 }
});
var ua=navigator.userAgent.toLocaleLowerCase(),
 regV = /ipod|ipad|iphone/gi,
 result = ua.match(regV),
 userScale="";
if(!result){
 userScale=",user-scalable=0"
}
document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0'+userScale+'">')

var currentYear = (new Date).getFullYear();
  $(document).ready(function() {
  $("#copyright-year").text( (new Date).getFullYear() );
  });

  $(function(){
  $('.sf-menu').superfish({autoArrows: true})
})