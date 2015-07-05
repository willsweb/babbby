<?php

header('Content-type: application/json');

include 'lib/functions.php';
include 'lib/id3tagreader.php';

/*
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
*/
$scrollertext = 'blah blah blah';

$playlist = random_audio_playlist();
$firsttrack = array_values($playlist)[0];

$html = "<audio id='audiodiv' autoplay='autoplay'>";
$html .= "<source src=\"audio/{$firsttrack}\" type='audio/mpeg'>";
$html .= "Your browser does not support the audio tag.";
$html .= "</audio>";
$html .= "<ul id='playlist'>";
foreach ($playlist as $track) {
    $class = ($track == $firsttrack) ? 'active' : '';
    $html .= "<li class='{$class}'>";
    $html .= "<a href=\"audio/{$track}\"/>";
    $html .= "</li>";
}
$html .= "</ul>";

$data = new stdClass();
$data->html = $html;
$data->scrollertext = $scrollertext;

echo json_encode($data);