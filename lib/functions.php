<?php

/**
 * Returns random hex colour code
 * Minimun value 0
 * Maximum value 255
 *
 * @param array $selection predefined selection of colours to choose from
 * @return string
 */
function random_colour($selection=array()) {

    if ($selection) {
        return $selection[rand(1, count($selection))-1];
    }

    $colour = '';

    $red = array(
        'min' => 100,
        'max' => 255
    );

    $green = array(
        'min' => 100,
        'max' => 255
    );

    $blue = array(
        'min' => 100,
        'max' => 255
    );

    $levels = array(
        $red,
        $green,
        $blue
    );

    foreach ($levels as $level) {
        $colour .= str_pad(dechex(rand($level['min'], $level['max'])), 2, '0', STR_PAD_LEFT);
    }

    return $colour;
}

/**
 * Returns random filename from /video folder
 *
 * @param string directory to pick a random file from
 * @return string
 */
function random_file($dir) {

    $files = array();
    $new = array();

    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..' && $file != '.keep') {
                    $files[] = $file;
                }
            }
            closedir($dh);
        }

        $keys = array_keys($files);
        shuffle($keys);
        foreach($keys as $key) {
            $new[$key] = $files[$key];
        }

        // todo: return the whole array?

        $randomfile = array_values($new)[0];
        $basefilename = substr($randomfile, 0, strlen($string) - 4);

        return $dir . $basefilename;
    }
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
