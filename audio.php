<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'lib/functions.php';
include 'lib/id3tagreader.php';

$file = random_file('audio/');

$tagreader = new ID3TagsReader();
$tags = $tagreader->getTagsInfo($file);

print_object($tags);
?>

<audio  autoplay="autoplay">
  <source src="<?php echo $file; ?>" type="audio/mpeg">
  Your browser does not support the audio tag.
</audio>
