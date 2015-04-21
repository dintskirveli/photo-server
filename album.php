<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>My Фотогрэфs</title>
<link href='https://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/packery.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <link rel="stylesheet" href="css/jquery.fancybox5.css" type="text/css" media="screen" />
    <script src="js/jquery.fancybox5.js"></script>
    <script src="js/jquery.lazyload.min.js" type="text/javascript"></script>
    <script>
        $(".lazy").lazyload({effect: "fadeIn"});
    </script>
    <style type="text/css">
        body {
            margin: 0px;
            background: orange;
            font-family: 'Helvetica Neue', arial, sans-serif;
            text-align: center;
        }

        #pagetitle {
color: white;
text-shadow: rgb(204, 204, 204) 0px 1px 0px, rgb(201, 201, 201) 0px 2px 0px, rgb(187, 187, 187) 0px 3px 0px, rgb(185, 185, 185) 0px 4px 0px, rgb(170, 170, 170) 0px 5px 0px, rgba(0, 0, 0, 0.0980392) 0px 6px 1px, rgba(0, 0, 0, 0.0980392) 0px 0px 5px, rgba(0, 0, 0, 0.298039) 0px 1px 3px, rgba(0, 0, 0, 0.2) 0px 3px 5px, rgba(0, 0, 0, 0.247059) 0px 5px 10px, rgba(0, 0, 0, 0.2) 0px 10px 10px, rgba(0, 0, 0, 0.14902) 0px 20px 20px;
		font-family: 'Lobster', cursive;
            margin-top: 10px;
            margin-bottom: 50px;
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
        }

        .item {
            word-wrap: break-word;
            text-align: center;
            vertical-align: top;
            box-sizing: border-box;
            width: 200px;
            height: 150px;
            background-color: lightgray;
            width: 200px;
            float: left;
        }

        .packery {
border-top-right-radius: 8px;
border-top-left-radius: 8px;
border-bottom-right-radius: 8px;
border-bottom-left-radius: 8px;
            margin: 0 auto;
	background-color: white;
	padding:20px;
            box-shadow: rgb(204, 204, 204) 0px 1px 0px, rgb(201, 201, 201) 0px 2px 0px, rgb(187, 187, 187) 0px 3px 0px, rgb(185, 185, 185) 0px 4px 0px, rgb(170, 170, 170) 0px 5px 0px, rgba(0, 0, 0, 0.0980392) 0px 6px 1px, rgba(0, 0, 0, 0.0980392) 0px 0px 5px, rgba(0, 0, 0, 0.298039) 0px 1px 3px, rgba(0, 0, 0, 0.2) 0px 3px 5px, rgba(0, 0, 0, 0.247059) 0px 5px 10px, rgba(0, 0, 0, 0.2) 0px 10px 10px, rgba(0, 0, 0, 0.14902) 0px 20px 20px;

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

<h1 id="pagetitle">Фотогрэфs</h1>
<h2 id="albumtitle" class="stamp"></h2>
<!--<a id='slideshow'>Slideshow</a>-->
<div id="container" class="packery">
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
        //<a href="img/image-1.jpg" data-lightbox="image-1" data-title="My caption">Image #1</a>
    }

        echo "<script>$('#albumtitle').text('$albumName');</script>";
    ?>
</div>
<?php

echo "<br><h2 id='stats'>";
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

        $("#pagetitle").fitText(0.7);
            new Packery( document.querySelector('.packery'), {
                itemSelector: '.item',
		stamp: '.stamp', 
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
