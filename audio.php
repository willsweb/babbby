<?php

header('Content-type: application/json');

include 'lib/functions.php';

$playlist = random_audio_playlist('audio');
$firsttrack = array_values($playlist)[0]['filename'];
$scrollertext = array_values($playlist)[0]['id3tagtext'];

$html = "<audio id='audiodiv' autoplay='autoplay'>";
$html .= "<source src=\"$firsttrack\" type='audio/mpeg'>";
$html .= "Your browser does not support the audio tag.";
$html .= "</audio>";
$html .= "<ul id='playlist'>";
foreach ($playlist as $track) {
    $filename = $track['filename'];
    $class = ($filename == $firsttrack) ? " class='active'" : '';
    $html .= "<li{$class}>";
    $html .= "<a href=\"$filename\" title=\"{$track['id3tagtext']}\"/>";
    $html .= "</li>";
}
$html .= "</ul>";

$data = new stdClass();
$data->html = $html;
$data->scrollertext = $scrollertext;

echo json_encode($data);
