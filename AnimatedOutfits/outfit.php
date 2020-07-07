<?php
// CONFIG
// folder with images
$outfitImagesPath = 'animatedOutfits/';

// FORCE CACHE
header('Cache-control: max-age='.(60*60*24*365));
header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 1337) . ' GMT');
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
{
	header('HTTP/1.0 304 Not Modified');
	/* PHP/webserver by default can return 'no-cache', so we must modify it */
	header('Cache-Control: public');
	header('Pragma: cache');
	exit;
}

// BLOCK OTHER SITES THAT ABUSE YOUR SITE
/*
$overloadList = array('cantebia.pl', 'aurera-global.com', 'marlboro-war.servegame.com', 'wu-uka.com', 'powerot.com.br');
if(in_array(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), $overloadList) || in_array(substr(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), 4), $overloadList))
{
	header('Content-Type: image/gif');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 1337) . ' GMT');
	readfile('x.gif');
}
*/

// LOAD LIBS AND CONFIG THEM
require('libs/outfit.php');

Outfitter::$outfitPath = $outfitImagesPath;
if(!Outfitter::loadData((int)$_GET['id']))
{
	echo 'Outfit does not exist or file cache is not generated.';
	exit; // outfit does not exist
}

header('Content-Type: image/png');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 1337) . ' GMT');
$mount = 0;
if(isset($_GET['mount']))
{
	$mount = (int)$_GET['mount'];
}
if($mount > 0 && !Outfitter::loadData($mount, true))
{
	echo 'Mount outfit does not exist or file cache is not generated.';
	exit; // mount outfit does not exist
}

$direction = 3;
if(isset($_GET['direction']))
{
	$direction = $_GET['direction'];
}
// animations removed
$animation = 1;
Outfitter::instance()->renderOutfit($_GET['id'], $_GET['addons'], $_GET['head'], $_GET['body'], $_GET['legs'], $_GET['feet'], $mount, $direction, $animation);