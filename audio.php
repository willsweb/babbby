<?php

header('Content-type: application/json');

include 'lib/functions.php';
include 'lib/id3tagreader.php';

$file = random_file('audio/');

$tagreader = new ID3TagsReader();
$tags = $tagreader->getTagsInfo($file);

$title = (isset($tags['Title'])) ? $tags['Title'] : null;
$album = (isset($tags['Album'])) ? $tags['Album'] : null;
$comments = (isset($tags['Comments'])) ? $tags['Comments'] : null;

$scrollertext = '';
if ($title) {
    $scrollertext .= $title;
}
if ($album) {
    $scrollertext .= ' - ' . $album;
}
if ($comments) {
    //$scrollertext .= ' - ' . $comments;
}

$html = "<audio id='audiodiv' autoplay='autoplay'>";
$html .= "<source src=\"{$file}\" type='audio/mpeg'>";
$html .= "Your browser does not support the audio tag.";
$html .= "</audio>";

$data = new stdClass();
$data->html = $html;
$data->scrollertext = $scrollertext;

echo json_encode($data);