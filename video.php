<?php
include 'lib/functions.php';
?>
<video id='vid' width='100%' height='100%' autoplay>
  <source src='<?php echo random_file('video/') . '.mp4'; ?>' type='video/mp4'/>
  <source src='<?php echo random_file('video/') . '.oggtheora.ogv'; ?>' type='video/ogg'/>
  <source src='<?php echo random_file('video/') . '.webmhd.wemb'; ?>' type='video/webm'/>
      Get a better browser.
</video>
<div id='canvascover'>
    <img src='img/mask.png'/>
</div>
