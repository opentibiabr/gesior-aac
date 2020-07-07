<?php
// CONFIG
$password = '';
$outfitImagesPath = 'animatedOutfits';


// SCRIPT
if($password == '')
	exit('Password cannot be empty. Protect your server!');

if(!isset($_REQUEST['password']) || $password != $_REQUEST['password'])
	exit('Invalid password. Edit URL. Admin can find password in cacheFenerator.php file.');


error_reporting(E_ERROR | E_WARNING | E_PARSE);
$dirIterator = new RecursiveDirectoryIterator($outfitImagesPath, FilesystemIterator::UNIX_PATHS);
$iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);


$outfits = [];
$i = 0;
foreach ($iterator as $file)
{
	if ($file->isFile())
	{
		$outfitIdData = explode('/', $file->getPath());
		$outfitId = $outfitIdData[1];
		$outfits[$outfitId]['files'][] = $file->getPath() . '/' . $file->getFilename();
		if(isset($outfits[$outfitId]['framesNumber']))
			$outfits[$outfitId]['framesNumber'] = max($outfits[$outfitId]['framesNumber'], (int) substr($file->getFilename(), 0, 1));
		else
			$outfits[$outfitId]['framesNumber'] = (int) substr($file->getFilename(), 0, 1);
    }
}

// CODE TO CHECK WHAT VALUES OF 'framesNumber' ARE POSSIBLE FOR YOUR OUTFITS
$frameNumbers = [];
foreach($outfits as $outfitId => $outfit)
{
	file_put_contents($outfitImagesPath . '/' . $outfitId . '/outfit.data.txt', serialize($outfit));
	$frameNumbers[$outfit['framesNumber']]++;
}
var_dump($frameNumbers);
