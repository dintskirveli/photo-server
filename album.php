<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>My Фотогрэфs</title>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/packery.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/jquery.lazyload.min.js" type="text/javascript"></script>

    <script>
        $(".lazy").lazyload({effect: "fadeIn"});
    </script>
    <style type="text/css">
        body {
            margin: 0px;
            background: #ececec;
            font-family: 'Helvetica Neue', arial, sans-serif;
            text-align: center;
        }

        h1 {
            margin-top: 0px;
            margin-bottom: 10px;
            font-family: anchor-web-1, anchor-web-2, Impact, sans-serif;
            text-align: center;
        }

        .item h3 {
            margin: 10px;
            font-size: 13px;
        }

        .item p {
            margin: 10px;
            font-size: 12px;
            color: #aaa;
        }

        #container a {
            cursor: pointer;
            display: none;
        }

        .item {
            word-wrap: break-word;
            text-align: center;
            vertical-align: top;
            box-sizing: border-box;
            width: 200px;
            height: 150px;
            background-color: lightgray;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 8px 1px;
            width: 200px;
            float: left;
        }

        .packery {
            margin: 0 auto;
            margin-top: 20px;
        }

        .packery:after {
            content: ' ';
            display: block;
            clear: both;
        }

        .item img {
            min-width: 100%;
            min-height: 100%;
            clip: rect(0px, 200px, 150px, 0px);
            position: absolute;
            left: 0;
            top: 0;
        }

        }

        .random img {
            width: auto;
        }

        .random h3 {
            margin-top: 0px;
            font-size: 16px;
        }

        .random h1 {
            margin-top: 10px;
            margin-bottom: 0px;
        }

        a:link {
            color: black;
            text-decoration: none;
        }

        a:visited {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: black;
            text-decoration: underline;
        }

        a:active {
            color: black;
            text-decoration: underline;
        }

        .gutter-sizer {
            width: 1%;
        }

        .grid-sizer {
            width: 200px;
        }

        #stats {
            display: none;
            text-align: center;
        }

        #albumtitle {
            text-overflow: ellipsis;
            width: 100%;
            font-size: 30px;
            overflow: hidden;
        }

        #slideshow {
            font-family: anchor-web-1, anchor-web-2, Impact, sans-serif;
            font-size: 30px;
            text-decoration: underline;
        }

        ul#supersized {
            z-index: 1000;
            visibility: hidden;
            display: none;
        }

        .fancybox-lock, .fancybox-overlay { overflow: visible !important;}
    </style>
</head>

<body>

<h1 id="pagetitle">My Фотогрэфs</h1>

<h1 id="albumtitle"></h1>
<!--<a id='slideshow'>Slideshow</a>-->

<div id="container" class="packery">
    <h1 id="progress-text"></h1>
    <!--<div id="container" class="packery js-packery" data-packery-options='{ "gutter": ".gutter-sizer", "itemSelector": ".item", "columnWidth": ".grid-sizer" }'>-->
    <div class="gutter-sizer"></div>
    <div class="grid-sizer"></div>


    <?php
    $albumName = "";
    $countimages = 0;
    $jsondata = array();
    $allowed = array("JPG", "JPEG");
    if (!isset($_GET["name"]) || (isset($_GET['random']) && $_GET['random'] == "true")) {
        $albumName = "Random";
        $output = `cat allfiles | shuf | head -n 500`;
        $files = explode("\n", $output);
        foreach ($files as $file) {
            if ($file != '') {
                $thumb = str_replace("/small/", "/thumbs/", $file);
                $name = str_replace("photos/", "", $file);
                $name = str_replace("small/", "", $name);
                array_push($jsondata, array("thumb" => "$thumb",
                    "image" => "$file",
                    "title" => "$name"));
                echo "<a class='fancybox' href='$file' title='$name'><div class='item'/><img class= 'lazy' src='$thumb' /></div></a>";
                $countimages += 1;
            }
        }
    } else {
        $dir = "photos/" . $_GET["name"];
        $files = scandir($dir . "/small");
        $albumName = $_GET["name"];
        foreach ($files as $file) {
            if (!is_dir($dir . "/small/" . $file) && in_array(pathinfo($file, PATHINFO_EXTENSION), $allowed)) {
                array_push($jsondata, array("thumb" => "$dir/thumbs/$file",
                    "image" => "$dir/small/$file",
                    "title" => "$file"));
                echo "<a class='fancybox' href='$dir/small/$file' title='$file'><div class='item'/><img class= 'lazy' src='$dir/thumbs/$file' /></div></a>";
                $countimages += 1;

            }
        }
        echo "<script>$('#albumtitle').text('$albumName');</script>";
        //<a href="img/image-1.jpg" data-lightbox="image-1" data-title="My caption">Image #1</a>
    }

    ?>
</div>
<?php
echo "<h2 id='stats'>";
if ($countimages > 0) {
    echo "$countimages images.";
} else {
    echo "... will be back soon :(";
}
echo "</h2>";
?>

<script>
    // overwrite Packery methods
    var __resetLayout = Packery.prototype._resetLayout;
    Packery.prototype._resetLayout = function () {
        __resetLayout.call(this);
        // reset packer
        var parentSize = getSize(this.element.parentNode);
        var colW = this.columnWidth + this.gutter;
        this.fitWidth = Math.floor(( parentSize.innerWidth + this.gutter ) / colW) * colW;
        console.log(colW, this.fitWidth)
        this.packer.width = this.fitWidth;
        this.packer.height = Number.POSITIVE_INFINITY;
        this.packer.reset();
    };


    Packery.prototype._getContainerSize = function () {
        // remove empty space from fit width
        var emptyWidth = 0;
        for (var i = 0, len = this.packer.spaces.length; i < len; i++) {
            var space = this.packer.spaces[i];
            if (space.y === 0 && space.height === Number.POSITIVE_INFINITY) {
                emptyWidth += space.width;
            }
        }

        return {
            width: this.fitWidth - this.gutter - emptyWidth,
            height: this.maxY - this.gutter
        };
    };

    // always resize
    Packery.prototype.resize = function () {
        this.layout();
    };

    docReady(function () {

        <?php
            if ($countimages === 0) {
                echo "return;";
            } else {
                echo "var numThumbs = $countimages;";
            }
         ?>

        $("#pagetitle").fitText(1);
        var progressText = $("#progress-text");
        progressText.fitText(1);

            progressText.hide();
            $('#container a').show();
            $('#stats').show();
            new Packery( document.querySelector('.packery'), {
                itemSelector: '.item',
                columnWidth: 200,
                gutter: 5
            });
        $(".fancybox")
            .attr('rel', 'gallery')
        .fancybox({
            padding    : 0,
            margin     : 0,
            openEffect : 'none',
            nextEffect : 'none',
            prevEffect : 'none',
            closeEffect : 'none',
            autoCenter : false,
            helpers:{title:null/*,overlay : { locked : false } */},
            afterLoad  : function () {
                $.extend(this, {
                    aspectRatio : false,
                    type    : 'html',
                    width   : '100%',
                    height  : '100%',
                    content : '<div class="fancybox-image" style="background-image:url(' + this.href + '); background-size: contain; background-position:50% 50%;background-repeat:no-repeat;height:100%;width:100%;" /></div>'
                });
            }
        });




        //});
    });
</script>
</body>
</html>
