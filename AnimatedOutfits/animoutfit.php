<?php
// CONFIG

// walk speed, lower = faster (100 = 1 second between frames)
$speeds = [ // outfitAnimationFramesNumber = speed
	1 => 50,
	2 => 35,
	3 => 30,
	4 => 15,
	5 => 15,
	6 => 15,
	7 => 15,
	8 => 8,
	9 => 8
];
// folder with images
$outfitImagesPath = 'animatedOutfits/';

// FORCE CACHE
header('Cache-control: max-age='.(60*60*24*365));
header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 1337) . ' GMT'); // date in 1970

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
Custom image for servers that abuse your script: 
$overloadList = array('cantebia.pl', 'aurera-global.com', 'marlboro-war.servegame.com', 'wu-uka.com', 'powerot.com.br');
if(isset($_SERVER['HTTP_REFERER']) && (in_array(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), $overloadList) || in_array(substr(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), 4), $overloadList)))
{
	header('Content-Type: image/gif');
	readfile('x.gif');
	exit;
}
*/

// LOAD LIBS AND CONFIG THEM
require('libs/outfit.php');
require('libs/gifCreator.php');

Outfitter::$outfitPath = $outfitImagesPath;
if(!Outfitter::loadData((int)$_GET['id']))
{
	echo 'Outfit does not exist or file cache is not generated.';
	exit; // outfit does not exist
}

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
header('Content-type: image/gif');

$direction = 3;
if(isset($_GET['direction']))
{
	$direction = (int)$_GET['direction'];
}
$addons = 0;
if(isset($_GET['addons']))
{
	$addons = (int)$_GET['addons'];
}

$frames = [];
$durations = [];

$moveAnimFrames = Outfitter::getOutfitFramesNumber();

// rotate player, BIG IMAGES, 20-80 KB per outfit!
//for($direction = 1; $direction <= 4; $direction++) 
for($i = 1; $i <= $moveAnimFrames; $i++)
{
    $frames[] = Outfitter::instance()->outfit((int)$_GET['id'], $addons, (int)$_GET['head'], (int)$_GET['body'], (int)$_GET['legs'], (int)$_GET['feet'], $mount, $direction, $i);
	$durations[] = $speeds[$moveAnimFrames];
}

$gc = new GifCreator();
$gc->create($frames, $durations, 0);
$gifBinary = $gc->getGif(); // maybe add some cache? if you got a lot of space on HDD :)
echo $gifBinary;