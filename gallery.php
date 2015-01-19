<!doctype html>
<html>
<head>
    <script src="js/jquery.js"></script>
    <script src="galleria/galleria-1.4.2.min.js"></script>
    <style>
        body {
            margin:0px;
            background-color:black;
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
        $jsondata = array();
        $dir = "photos/".$_GET["name"];
        $files = scandir($dir);
        $allowed= array("JPG","JPEG");
        foreach ($files as $file) {
            if (!is_dir($dir."/".$file) && in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed)){
                array_push($jsondata, array("thumb" => "$dir/thumbs/$file",
                    "image" => "$dir/small/$file",
                    "title" => "$file"));
            }
        }
        echo json_encode($jsondata);
        ?>;
    Galleria.loadTheme('galleria/themes/twelve/galleria.twelve.js');

    function downloadURL(url) {
        var hiddenIFrameID = 'hiddenDownloader',
            iframe = document.getElementById(hiddenIFrameID);
        if (iframe === null) {
            iframe = document.createElement('iframe');
            iframe.id = hiddenIFrameID;
            iframe.style.display = 'none';
            document.body.appendChild(iframe);
        }
        iframe.src = url;
    };

    var gallery;

    Galleria.ready(function(options) {
        gallery = this;
        /*$(".galleria-bar").append("<div class='galleria-download'></div>");
        $(".galleria-download").click(function() {
            var uri = gallery.getActiveImage().src;
            downloadURI(uri.replace("small/", ""), uri.split("/").pop());
        });*/
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
        transition: "none"
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
