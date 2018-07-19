<?php
//$text = $_GET['text'];
require_once "custom_scripts/gd-text/Box.php";
require_once "custom_scripts/gd-text/Color.php";
require_once "custom_scripts/gd-text/HorizontalAlignment.php";
require_once "custom_scripts/gd-text/TextWrapping.php";
require_once "custom_scripts/gd-text/VerticalAlignment.php";
require_once "custom_scripts/gd-text/Struct/Point.php";
require_once "custom_scripts/gd-text/Struct/Rectangle.php";

use GDText\Box;
use GDText\Color;

$text = $_REQUEST['text'];


$im = imagecreatetruecolor(500, 35);
$backgroundColor = imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, imagecolortransparent($im, null));


$box = new Box($im);
$box->setFontFace("images/martel.ttf"); // http://www.dafont.com/elevant-by-pelash.font
$box->setFontSize(25);
$box->setFontColor(new Color(240, 209, 164));
$box->setBox(0, -5, 500, 35);
$box->setTextAlign('left', 'top');

$box->setStrokeColor(new Color(1, 1, 1)); // Set stroke color
$box->setStrokeSize(1); // Stroke size in pixels

$box->draw($text); // Text to draw

header("Content-type: image/png;");
imagepng($im, null, 9, PNG_ALL_FILTERS);
die();

/** Just for save the original code
if (!file_exists('images/head/' . $text . '.png')) {
    $font = "images/martel.ttf";
    $image = imagecreatefrompng('images/head/headline.png');
    imagettftext($image, 18, 0, 4, 20, imagecolorallocate($image, 240, 209, 164), $font, $text);
    imagepng($image, 'images/head/' . $text . '.png');
}
$img = 'images/head/' . $text . '.png';
$pic = imagecreatefrompng($img);
header('Content-type: image/png');
imagepng($pic);
 * */
