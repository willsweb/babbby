<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

include 'lib/functions.php';

$html = html_writer::div_open(array('id' => 'menu'));

$spanids = array('events', 'contact', 'press', 'products');
foreach ($spanids as $spanid) {
    $html .= html_writer::span('', array('id' => $spanid, 'class' => 'dynamic'));
}

$html .= html_writer::div_close();

echo $html;
