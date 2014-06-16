<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'lib/functions.php';
?>

<video width='100%' height='100%' autoplay>
  <source src='<?php echo random_file('video/'); ?>' type='video/mp4'/>
      Get a better browser.
</video>
<div id='canvascover'>
    <img src='img/mask.png'/>
</div>