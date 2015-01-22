<!doctype html>
<html>
<head>
    <script src="js/jquery.js"></script>
    <script src="galleria/galleria-1.4.2.min.js"></script>
    <style>
        body {
            margin:0px;
            background-color:black;
            overflow:hidden;

        }

        body .galleria-thumbnails .galleria-image{width:160px;height:90px;}
        .galleria{ width:100%; height: 800px; background: #000 }
    </style>
</head>
<body>
<div class="galleria">
</div>
<script>

    var data =
        <?php
        $allowed= array("JPG","JPEG");
        $jsondata = array();
        //set page title
        if(!isset($_GET["name"]) || (isset($_GET['random']) && $_GET['random'] == "true")) {
            $output = `cat allfiles | shuf | head -n 10`;
            $files = explode("\n", $output);
             foreach ($files as $file) {
                if($file != '') {
                    $thumb = str_replace("/small/", "/thumbs/", $file);
                    array_push($jsondata, array("thumb" => "$thumb",
                        "image" => "$file",
                        "title" => "$file"));
                }
            }
        } else {

            $dir = "photos/".$_GET["name"];
            $files = scandir($dir."/small");

            foreach ($files as $file) {
                if (!is_dir($dir."/small/".$file) && in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed)){
                    array_push($jsondata, array("thumb" => "$dir/thumbs/$file",
                        "image" => "$dir/small/$file",
                        "title" => "$file"));
                }
            }
        }
        echo json_encode($jsondata);
        ?>;
    Galleria.loadTheme('galleria/themes/twelve/galleria.twelve.js');

    var gallery;

    Galleria.ready(function(options) {
        gallery = this;
        this.attachKeyboard({
            left: this.prev, // applies the native prev() function
            right: this.next,
            up: function() {
                // custom up action
                Galleria.log('up pressed');
            },
            13: function() {
                // start playing when return (keyCode 13) is pressed:
                this.playToggle();
            }
        });
        this.lazyLoadChunks( 50, 1000 );

    });
    Galleria.run('.galleria', {
        dataSource: data,
        thumbnails: 'lazy',
        responsive: 'true',
        width: $(window).width(),
        height: $(window).height(),
        transition: "none",
	imageCrop: false
	
    });

    function doSomething() {
        gallery.resize({

            width: $(window).width(),
            height: $(window).height()
        });
    };

    var resizeTimer;
    $(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(doSomething, 100);
    });

</script>
</body>
</html>
