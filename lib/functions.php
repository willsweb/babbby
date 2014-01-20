<?php

/**
 * Returns random colour to be used as background
 *
 * Todo: the totally random bit :)
 * @param bool $totallyrandom pass true to generate random colour
 * @return string
 */
function random_background($totallyrandom=null) {

    $colours = array('424242', '7CA779', 'FFFFFF');

    return $colours[rand(1, count($colours))-1];
}

/**
 * Use to print object and array structures
 *
 * @param obj/array $obj
 */
function print_object($obj) {

    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}
