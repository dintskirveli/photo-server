<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>
<?php
if (!isset($_GET["name"]) || (isset($_GET['random']) && $_GET['random'] == "true")) {
	echo "RANDOM";
} else {
	$_GET["name"] = rtrim($_GET["name"], '/');
	echo $_GET["name"];
}
?>
</title>
<script src="js/jquery.js" type="text/javascript"></script>
<!-- Core CSS file -->
<link rel="stylesheet" href="js/photoswipe/photoswipe.css">

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite,
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="js/photoswipe/default-skin/default-skin.css">

<!-- Core JS file -->
<script src="js/photoswipe/photoswipe.min.js"></script>

<!-- UI JS file -->
<script src="js/photoswipe/photoswipe-ui-default.min.js"></script>
</head>
<body>

<script>

<?php
$jsondata = array();
$dir = "photos/" . $_GET["name"];
$files = scandir($dir . "/small");
$allowed = array("JPG", "JPEG");
$albumName = $_GET["name"];
foreach ($files as $file) {
    if (!is_dir($dir . "/small/" . $file) && in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed)) {
      $filepath = $dir . "/small/" . $file;
        $output = explode("x", `identify "$filepath" | cut -f 3 -d " "`);
        array_push($jsondata,
          array("msrc" => "$dir/thumbs/$file",
            "src" => "$dir/small/$file",
            "w" => intval($output[0]),
            "h" => intval($output[1]),
            "title" => $_GET["name"]."/".$file));
    }
}
echo "var slides = ".json_encode($jsondata).";";
?>

$( document ).ready(function() {
    var pswpElement = document.querySelectorAll('.pswp')[0];
    // define options (if needed)
    var options = {
      // optionName: 'option value'
      // for example:
      index: 0, // start at first slide
      preload: [3,10],

      tapToClose: false,

      closeEl:false,
      captionEl: true,
      fullscreenEl: true,
      zoomEl: true,
      shareEl: true,
      counterEl: true,
      arrowEl: true,
      preloaderEl: true,

      closeOnScroll : false,

      closeOnVerticalDrag : false,

      escKey : false,

      //tapToToggleControls: true,

      clickToCloseNonZoomable: false,

      //closeElClasses: ['item', 'caption', 'zoom-wrap', 'ui', 'top-bar'],
      closeElClasses : [],

      shareButtons: [
        //{id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
        //{id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
        //{id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'},
        {id:'download', label:'Download image', url:'{{raw_image_url}}', download:true}
      ]
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, slides, options);
    gallery.init();
});

</script>

  <!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader - active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>

</body>
</html>
