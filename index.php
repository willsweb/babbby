<?php
include 'lib/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="css/simple.css" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='js/jquery-1.11.0.js'></script>
    <script>
    $(document).ready(function(){
      $("button").click(function(){
        $("#div1").load("demo_test.txt");
      });
    });
    </script>

    <title>Baby</title>
    <style>body {background-color: #<?php echo random_background(); ?>;}</style>
</head>

<body>

    <div id="menu">

        <span id="events">
            <!--
            <ul>
                <li><a href="http://www.supernormalfestival.co.uk" target="_blank">Supernormal Festival 9-11 August 2013 date t.b.c</a></li>
            </ul>
            -->
        </span>

        <span id="contact">
            <!--
            <ul>
                <li><a href="mailto:baby@babbby.com">baby@babbby.com</a></li>
            </ul>
            -->
        </span>

        <span id="press">
            <!--
            <ul>
                <li><a href="javascript:downloadPresspack;">(42MB .zip)</a></li>
            </ul>
            -->
        </span>

        <span id="products">
            <!--
            <ul>
                <li><a href="javascript:load('1');">Near Wanstonia (2012)</a></li>
                <li><a href="javascript:load('1');">Sea Shells Listening (2009)</a></li>
                <li><a href="javascript:load('1');">Vole Radio 1 EP (2006)</a></li>
            </ul>
            -->
        </span>

    </div>

    <div id="content">
        <div id="stage">
            <div id="video">
                <video width="100%" height="100%" autoplay>
                  <source src="video/cityrunningexp.mp4" type="video/mp4"/>
                  <source src="video/cityrunningexp.ogg" type="video/ogg"/>
                      Get a better browser.
                </video>
                <div id="videocover">
                    <img src="img/mask.png"/>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
