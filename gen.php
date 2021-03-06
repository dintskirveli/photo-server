<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>My Фотогрэфs</title>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/packery.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <style type="text/css">
        body {
            margin: 0px;
            background:orange;
            font-family: 'Helvetica Neue', arial, sans-serif;
        
            text-align: center;
	}

        #pagetitle {
            color: white;
            text-shadow: rgb(204, 204, 204) 0px 1px 0px, rgb(201, 201, 201) 0px 2px 0px, rgb(187, 187, 187) 0px 3px 0px, rgb(185, 185, 185) 0px 4px 0px, rgb(170, 170, 170) 0px 5px 0px, rgba(0, 0, 0, 0.0980392) 0px 6px 1px, rgba(0, 0, 0, 0.0980392) 0px 0px 5px, rgba(0, 0, 0, 0.298039) 0px 1px 3px, rgba(0, 0, 0, 0.2) 0px 3px 5px, rgba(0, 0, 0, 0.247059) 0px 5px 10px, rgba(0, 0, 0, 0.2) 0px 10px 10px, rgba(0, 0, 0, 0.14902) 0px 20px 20px;
            font-family: 'Lobster', cursive;
            margin-top: 10px;
            margin-bottom: 50px;
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

        .packery {
            margin: 0 auto;
        }
        .packery:after {
            content: ' ';
            display: block;
            clear: both;
        }

        .item img {
            width: 100%;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;

        }

        .random img{
            width: auto;
        }

        .random h3{
            margin-top: 0px;
            font-size: 16px;
        }

        .random h1{
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
            width: 2%;
        }

        .grid-sizer {
            width: 200px;
        }

        #stats {
            display: none;
            text-align: center;
        }

	#progress-text {
		color: white;
	}

    </style>
</head>

<body>

<div id="progress"></div>
<h1 id="pagetitle">Фотогрэфs</h1>


<div id="container" class="packery">
    <h1 id="progress-text"></h1>
    <!--<div id="container" class="packery js-packery" data-packery-options='{ "gutter": ".gutter-sizer", "itemSelector": ".item", "columnWidth": ".grid-sizer" }'>-->
    <div class="gutter-sizer"></div>
    <div class="grid-sizer"></div>
    <a onclick="randomAlbum()" class="random"><div class='item'><img src='random.png'/><h3>Random Album</h3></div></a>
    <a onclick="randomImages()" class="random"><div class='item'><h1>500</h1><h3>Random Photos</h3></div></a>
    <?php
    $countimages = 0;
    $albums = 0;

    $secret=array("2014_12_26_Cocktails", "2015_02_Syracuse");
    $dir    = 'photos';
    #echo `pwd`;
    $files = scandir($dir,1);
    foreach ($files as $file) { 
       $fullfile = $dir."/".$file;
       if (!in_array($file, $secret) && $file != "." && $file != ".." && is_dir($fullfile)) {
            #echo $fullfile;
	    $img = `find "$fullfile" | grep /thumbs/ | grep -i .jpg | shuf | head -n 1`;
            $imgcount = intval(`find "$fullfile" | grep /small/ | wc -l`);
            $albums = $albums + 1;
            $countimages = $countimages + $imgcount;
            echo "<a href='album.php?name=$file' ><div class='item'><img src='$img'/><h3>$file</h3><p>$imgcount images.</p></div></a>"; 
        }
    }
    ?>
</div>
<?php
echo "<h2 id='stats'>";
if ($albums > 0) {
    echo "$albums albums and $countimages images.";
} else {
    echo "... will be back soon :(";
}
echo "</h2>";
?>

<script>
    function randomAlbum() {
        var albums = $("#container a").not(".random")
        albums[Math.floor(Math.random() * albums.length)].click()
    }

    function randomImages() {
        window.location.href = "album.php?random=true";
    }

    // overwrite Packery methods
    var __resetLayout = Packery.prototype._resetLayout;
    Packery.prototype._resetLayout = function() {
        __resetLayout.call( this );
        // reset packer
        var parentSize = getSize( this.element.parentNode );
        var colW = this.columnWidth + this.gutter;
        this.fitWidth = Math.floor( ( parentSize.innerWidth + this.gutter ) / colW ) * colW;
        console.log( colW, this.fitWidth )
        this.packer.width = this.fitWidth;
        this.packer.height = Number.POSITIVE_INFINITY;
        this.packer.reset();
    };


    Packery.prototype._getContainerSize = function() {
        // remove empty space from fit width
        var emptyWidth = 0;
        for ( var i=0, len = this.packer.spaces.length; i < len; i++ ) {
            var space = this.packer.spaces[i];
            if ( space.y === 0 && space.height === Number.POSITIVE_INFINITY ) {
                emptyWidth += space.width;
            }
        }

        return {
            width: this.fitWidth - this.gutter - emptyWidth,
            height: this.maxY - this.gutter
        };
    };

    // always resize
    Packery.prototype.resize = function() {
        this.layout();
    };

    docReady( function() {

        <?php
            if ($countimages == 0) {
                echo "return;";
            } else {
                echo "var numThumbs = $albums;";
            }
         ?>

        $("#pagetitle").fitText(0.7);
        var progressText = $("#progress-text");
        progressText.fitText(1);


        var numLoaded = 0;
        $('#container').imagesLoaded().progress(function( instance, image ) {
            numLoaded++;
            var percent = Math.round(numLoaded*100/(numThumbs+1));
            progressText.text(percent + '%');
        });

        $('#container').imagesLoaded().always(function(instance){
            progressText.hide();
            $('#container a').show();
            $('#stats').show();
            new Packery( document.querySelector('.packery'), {
                itemSelector: '.item',
                columnWidth: 200,
                gutter: 20
            });

        });
    });
</script>
</body>
</html>
