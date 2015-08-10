<?php

include 'id3tagreader.php';

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
 * Returns random filename from the passed folder
 *
 * @param string $dir Folder to pick a random file from
 * @return string
 */
function random_video($dir) {

    $files = array();
    $new = array();

    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..' && $file != '.keep' && $file != '.DS_Store') {
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

        $randomfile = array_values($new)[0];
        $info = new SplFileInfo($randomfile);
        $extension = $info->getExtension();

        $basefilenamelength = strlen($randomfile) - strlen($extension) - 1;
        $basefilename = substr($randomfile, 0, $basefilenamelength);
        $basefilename = str_replace('.oggtheora', '', $basefilename);
        $basefilename = str_replace('.webmhd', '', $basefilename);
        return $dir . $basefilename;
    }
}

/**
 * Returns random playlist from the audio folder
 *
 * @return array
 */
function random_audio_playlist() {

    $playlist = array();

    if ($dh = opendir('audio/')) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..' && $file != '.keep' && $file != '.DS_Store') {
                $files[] = $file;
            }
        }
        closedir($dh);
    }

    $keys = array_keys($files);
    shuffle($keys);
    foreach($keys as $key) {
        $playlist[$key] = $files[$key];
    }

    return $playlist;
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
