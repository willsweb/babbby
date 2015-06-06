<?php
include 'lib/functions.php';
?>
<video id='vid' width='100%' height='100%' autoplay>
    <?php $basefilename = random_file('video/'); ?>
    <source src='<?php echo $basefilename . '.mp4'; ?>' type='video/mp4'/>
    <source src='<?php echo $basefilename . '.oggtheora.ogv'; ?>' type='video/ogg'/>
    <source src='<?php echo $basefilename . '.webmhd.webm'; ?>' type='video/webm'/>
      Get a better browser.
</video>
<div id='canvascover'>
    <img src='img/mask.png'/>
</div>
