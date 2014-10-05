<?php
include 'lib/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type='text/javascript' src='js/jquery-1.11.0.js'></script>
    <script type='text/javascript' src='js/simple.js'></script>
    <link href="css/simple.css" rel="stylesheet" type="text/css"/>
    <title>Baby</title>
    <style>body {background-color: #<?php echo random_colour(); ?>;}</style>
</head>
<body>

    <div id="menu">
        <span id="events" class="dynamic" alt=""></span>
        <span id="contact" class="dynamic"></span>
        <span id="press" class="dynamic"></span>
        <span id="products" class="dynamic"></span>
    </div>

    <div id='content'>

        <div id="popup">
            <img id='close' src='img/close.png'/>
            <div id='info' class='content'></div>
        </div>

        <div id="scroller">
            <div class="scrollingtext"></div>
        </div>

        <div id='stage'>

            <div id='canvas' class='content'></div>

            <button id="video" class="dynamic media">
                <img src="img/video.png"  />
            </button>
            <button id="audio"  class="dynamic media">
                <img src="img/audio.png"  />
            </button>
        </div>

    </div>

</body>
</html>
