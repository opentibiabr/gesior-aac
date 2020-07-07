<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 23/03/2018
 * Time: 23:30
 * @param $new_image
 * @param $image_source
 */

require_once "custom_scripts/gd-text/Box.php";
require_once "custom_scripts/gd-text/Color.php";
require_once "custom_scripts/gd-text/HorizontalAlignment.php";
require_once "custom_scripts/gd-text/TextWrapping.php";
require_once "custom_scripts/gd-text/VerticalAlignment.php";
require_once "custom_scripts/gd-text/Struct/Point.php";
require_once "custom_scripts/gd-text/Struct/Rectangle.php";

use GDText\Box;
use GDText\Color;

require 'config/config.php';
// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);
// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);
if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', true);
// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');
// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');
// DATABASE
include_once('./system/load.database.php');
function setTransparency($new_image, $image_source)
{

	$transparencyIndex = imagecolortransparent($image_source);
	$transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);

	if ($transparencyIndex >= 0) {
		$transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);
	}
	$transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
	imagefill($new_image, 0, 0, $transparencyIndex);
	imagecolortransparent($new_image, $transparencyIndex);
}

function playerPortraitCreate($base, $player)
{
	// Obtendo o tamanho original
	list($width_orig, $height_orig) = getimagesize($base);
	list($width_orig2, $height_orig2) = getimagesize($player);

	// Calculando a proporção
	$ratio_orig = $width_orig / $height_orig;
	$ratio_orig2 = $width_orig2 / $height_orig2;
	/// Largura e altura máximos (máximo, pois como é proporcional, o resultado varia)
	// No caso da pergunta, basta usar $_GET['width'] e $_GET['height'], ou só
	// $_GET['width'] e adaptar a fórmula de proporção abaixo.
	$width = 500;
	$height = 500;
	$width2 = 100;
	$height2 = 100;
	if ($width / $height > $ratio_orig) {
		$width = $height * $ratio_orig;
	} else {
		$height = $width / $ratio_orig;
	}
	if ($width2 / $height2 > $ratio_orig2) {
		$width2 = $height2 * $ratio_orig2;
	} else {
		$height2 = $width2 / $ratio_orig2;
	}
	// O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
	$extension = explode(".", $base);
	$extension = $extension[count($extension) - 1];
	$image_p = imagecreatetruecolor($width, $height);
	$image = NULL;
	if ($extension == "jpg" || $extension == "jpeg") {
		$image = imagecreatefromjpeg($base);
	} elseif ($extension == "gif") {
		$image = imagecreatefromgif($base);
	} elseif ($extension == "png") {
		$image = imagecreatefrompng($base);
	}
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

	$image_player = imagecreatetruecolor($width2, $height2);
	$marcadagua = imagecreatefromgif($player);
	setTransparency($image_player, $marcadagua);
	imagecopyresized($image_player, $marcadagua, 0, 0, 0, 0, $width2, $height2, $width_orig2, $height_orig2);
	//    imagedestroy($marcadagua);

	//pega o tamanho da imagem principal
	$dwidth = imagesx($image_p);
	$dheight = imagesy($image_p);

	//pega o tamanho da imagem que vai ser centralizada
	$mwidth = imagesx($image_player);
	$mheight = imagesy($image_player);
	//Calcula a x e y posição pra colocar a imagem no centro da outra
	//A função round arredonda os valores
	$xPos = round(($dwidth - $mwidth) / 2 - 40);
	$yPos = round(($dheight - $mheight) / 2 - 40);
	imagecopymerge($image_p, $image_player, $xPos, $yPos, 0, 0, $mwidth, $mheight, 100);
	//    imagedestroy($image_player);
	//    imagecopyresampled($image_p, $image_player, $xPos, $yPos, 0, 0, $mwidth, $mheight, 100,100);
	return $image_p;
}

if (isset($_REQUEST['name'])) {
	$name = $_REQUEST['name'];
	$p = new Player();
	$p->loadByName($name);

	$url1 = 'images/bg.png';
	$url2 = "https://outfits.ferobraglobal.com/animoutfit.php?id={$p->getLookType()}&addons={$p->getLookAddons()}&head={$p->getLookHead()}&body={$p->getLookBody()}&legs={$p->getLookLegs()}&feet={$p->getLookFeet()}&mount={$p->getLookMount()}";
	$player_portrait = playerPortraitCreate($url1, $url2);
	$im = $player_portrait;

	$w = imagesx($im);
	$h = imagesy($im);

	$box = new Box($im);
	$box->setFontFace(__DIR__ . "/images/martel.ttf"); // http://www.dafont.com/elevant-by-pelash.font
	$box->setFontColor(new Color(240, 209, 164));
	$box->setStrokeColor(new Color(1, 1, 1)); // Set stroke color
	$box->setStrokeSize(1); // Stroke size in pixels

	$box->setTextAlign('center', 'center');
	$box->setFontSize(30);
	if ($p->getLookMount() != 0) {
		$box->setBox(0, -90, $w, $h);
	} else {
		$box->setBox(0, -60, $w, $h);
	}
	$box->draw(ucfirst($p->getName())); // Text to draw
	$box->setFontSize(30);
	$box->setBox(0, 40, $w, $h);
	$box->draw(ucfirst($p->getVocationName())); // Text to draw
	$box->setFontFace(__DIR__ . '/images/Roboto-Regular.ttf');
	//    $box->setBox(0, 400, $w, $h);
	//    $box->draw("Level: {$p->getLevel()}"); // Text to draw

	header('Content-Type: image/png');
	imagepng($im, NULL, 9, PNG_ALL_FILTERS);
	imagedestroy($im);
}
