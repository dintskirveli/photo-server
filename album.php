<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>
<?php
if (!isset($_GET["name"]) || (isset($_GET['random']) && $_GET['random'] == "true")) {
	echo "RANDOM";
} else {
	echo $_GET["name"];
}
?>
</title>
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

        .packery-albums .item h3 {
            margin: 10px;
            font-size: 13px;
        }

        .packery-albums .item p {
            margin: 10px;
            font-size: 12px;
            color: #aaa;
        }

        #albums-container {
            cursor: pointer;
	    display: none;
        }

       .packery-albums .gutter-sizer {
            width: 2%;
        }

        .packery-albums .grid-sizer {
            width: 200px;
        }

        .packery-albums .item img {
            width: 100%;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;

        }

        .packery-albums .item {
            word-wrap: break-word;
            text-align: center;
            vertical-align: top;
            background: #fff;
            box-sizing: border-box;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
            box-shadow:  rgb(204, 204, 204) 0px 1px 0px, rgb(201, 201, 201) 0px 2px 0px, rgb(187, 187, 187) 0px 3px 0px, rgb(185, 185, 185) 0px 4px 0px, rgb(170, 170, 170) 0px 5px 0px, rgba(0, 0, 0, 0.0980392) 0px 6px 1px, rgba(0, 0, 0, 0.0980392) 0px 0px 5px, rgba(0, 0, 0, 0.298039) 0px 1px 3px, rgba(0, 0, 0, 0.2) 0px 3px 5px, rgba(0, 0, 0, 0.247059) 0px 5px 10px, rgba(0, 0, 0, 0.2) 0px 10px 10px, rgba(0, 0, 0, 0.14902) 0px 20px 20px;

            width: 200px;
            float: left;
        }

        #photos-container {
              cursor: pointer;
              display: none;
          }
	.packery-albums {
            margin: 0 auto;
        }
        .packery-albums:after {
            content: ' ';
            display: block;
            clear: both;
        }

        .packery-photos .item h3 {
            margin: 10px;
            font-size: 13px;
        }

        .packery-photos .item p {
            margin: 10px;
            font-size: 12px;
            color: #aaa;
        }

        #photos-container a {
            cursor: pointer;
        }

        .packery-photos .item {
            word-wrap: break-word;
            text-align: center;
            vertical-align: top;
            box-sizing: border-box;
            width: 200px;
            padding: 0px;
            height: 150px;
            background-color: lightgray;
            float: left;
        }

        .packery-photos {
border-top-right-radius: 8px;
border-top-left-radius: 8px;
border-bottom-right-radius: 8px;
border-bottom-left-radius: 8px;
            margin: 0 auto;
	background-color: white;
	padding:10px;
            box-shadow: rgb(204, 204, 204) 0px 1px 0px, rgb(201, 201, 201) 0px 2px 0px, rgb(187, 187, 187) 0px 3px 0px, rgb(185, 185, 185) 0px 4px 0px, rgb(170, 170, 170) 0px 5px 0px, rgba(0, 0, 0, 0.0980392) 0px 6px 1px, rgba(0, 0, 0, 0.0980392) 0px 0px 5px, rgba(0, 0, 0, 0.298039) 0px 1px 3px, rgba(0, 0, 0, 0.2) 0px 3px 5px, rgba(0, 0, 0, 0.247059) 0px 5px 10px, rgba(0, 0, 0, 0.2) 0px 10px 10px, rgba(0, 0, 0, 0.14902) 0px 20px 20px;

        }

        .packery-photos:after {
            content: ' ';
            display: block;
            clear: both;
        }

        .packery-photos .item img {
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

        .packery-photos .gutter-sizer {
            width: 1%;
        }

        .packery-photos .grid-sizer {
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

     	#progress-text {
                color: white;
        }

        .fancybox-lock, .fancybox-overlay { overflow: visible !important;}
    </style>
</head>

<body>

<h1 id="pagetitle">Фотогрэфs</h1>
<h2 id="albumtitle" class="stamp"></h2>
<h1 id="progress-text"></h1>
<div id="albums-container" class="packery-albums">
    <div class="gutter-sizer"></div>
    <div class="grid-sizer"></div>
<?php

$countimages = 0;
$albums = 0;
if (isset($_GET["name"])) {
	$dir = "photos/" . $_GET["name"];
	$files = scandir($dir);
	$exclude=array("small", "thumbs");
	foreach ($files as $file) {
       		$fullfile = $dir."/".$file;
       		if (!in_array($file, $exclude) && $file != "." && $file != ".." && is_dir($fullfile)) {
        		#echo $fullfile;
           		$img = `find "$fullfile" | grep /thumbs/ | grep -i .jpg | shuf | head -n 1`;
            		$imgcount = intval(`find "$fullfile" | grep /small/ | wc -l`);
            		$albums = $albums + 1;
            		#$countimages = $countimages + $imgcount;
			$album=$_GET["name"]."/".$file;
            		echo "<a href='album.php?name=$album' ><div class='item'><img src='$img'/><h3>$file</h3><p>$imgcount images.</p></div></a>";
        	}
    	}
}
?>
</div>
<?php
if ($albums > 0) {
	echo "<br>";
}
?>
<div id="photos-container" class="packery-photos">

    <div class="gutter-sizer"></div>
    <div class="grid-sizer"></div>


    <?php
    $albumName = "";
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
    }

        echo "<script>$('#albumtitle').text('$albumName'.split('/').join(' \u{2192} '));</script>";
    ?>
</div>
<?php

echo "<br><h2 id='stats'>";
if ($countimages > 0 || $albums > 0) {
    echo "$albums albums and $countimages images.";
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

	var numAlbumsLoaded = 0;
	var numImagesLoaded = 0;
        <?php
            if ($countimages === 0 && $albums === 0) {
                echo "return;";
            } else {
                echo "var numAlbums = $albums;";
		echo "var numImages = $countimages;";
            }
         ?>
	var progressText = $("#progress-text");
        progressText.fitText(1);

        $("#pagetitle").fitText(0.7);
	var photosDone = false;
	var albumsDone = false;

	var load = function () {
		progressText.hide();
		if (numAlbums > 0) {
                	$('#albums-container').show();
			new Packery( document.querySelector('#albums-container'), {
                		itemSelector: '.item',
                		columnWidth: 200,
                		gutter: 20
            		});
		}
		if (numImages > 0) {
                	$('#photos-container').show();
			new Packery( document.querySelector('#photos-container'), {
                		itemSelector: '.item',
                		stamp: '.stamp',
                		columnWidth: 200,
                		gutter: 5
         		});
		}
	}

	$('#albums-container').imagesLoaded().always(function( instance, image ) {
		photosDone = true;
		if (photosDone && albumsDone){
			load();
		}
	})	

	$('#photos-container').imagesLoaded().always(function( instance, image ) {
		albumsDone = true;
		if (photosDone && albumsDone){
                        load();
                }
        })

	$('#albums-container').imagesLoaded().progress(function( instance, image ) {
            numAlbumsLoaded++;
            var percent = Math.round((numAlbumsLoaded+numImagesLoaded)*100/(numAlbums+numImages+1));
            progressText.text(percent + '%');
        });
        $('#photos-container').imagesLoaded().progress(function( instance, image ) {
        	numAlbumsLoaded++;
        	var percent = Math.round((numAlbumsLoaded+numImagesLoaded)*100/(numAlbums+numImages+1));
		progressText.text(percent + '%');
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
