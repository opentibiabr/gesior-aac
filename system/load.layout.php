<?php
if (!defined('INITIALIZED'))
	exit;
/** @var  $subtopic */
$fnc = function () {
	if (isset($_SESSION['landpage']) && $_SESSION['landpage'] == TRUE) {
		$now = time();
		if (isset($_SESSION['landtime']) && $now >= $_SESSION['landtime'] + Website::getWebsiteConfig()->getValue('landpage_timeout')) {
			unset($_SESSION['landtime'], $_SESSION['landpage']);
		}
	}
};

if ($subtopic == 'latestnews' || $subtopic == '') $fnc();

if (!isset($_SESSION['landpage']) && !isset($_SESSION['landtime']) && $subtopic != "get_online_data" && Website::getWebsiteConfig()->getValue('landpage_isactive')) {
	$_SESSION['landtime'] = time();
	$_SESSION['landpage'] = TRUE;
	//header("Location: " . $config['base_url'] . "?faccess=landing");
}

if ($_REQUEST['faccess'] == "landing") {
	include "load.landpage.php";
} else {
	$layout_header = '<script type="text/javascript\">
function GetXmlHttpObject()
{
var xmlHttp=null;
try
	{
		xmlHttp=new XMLHttpRequest();
	}
catch (e)
	{
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

function MouseOverBigButton(source)
{
	source.firstChild.style.visibility = "visible";
}
function MouseOutBigButton(source)
{
	source.firstChild.style.visibility = "hidden";
}
function BigButtonAction(path)
{
	window.location = path;
}
</script>';
	if ($logged) {
		$layout_header .= "loginStatus=1; loginStatus='true';";
	} else {
		$layout_header .= "loginStatus=0; loginStatus='false';";
	};
	$layout_header .= "<script> var activeSubmenuItem='" . $subtopic . "';  var IMAGES=0; IMAGES='" . $config['server']['url'] . "/" . $layout_name . "/images'; var LINK_ACCOUNT=0; LINK_ACCOUNT='" . $config['server']['url'] . "';</script>";
	include($layout_name . "/layout.php");
}
