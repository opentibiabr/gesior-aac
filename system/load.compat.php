<?php
if (!defined('INITIALIZED'))
	exit;

use RobThree\Auth\TwoFactorAuth;

/** @var TwoFactorAuth $tfa */
$tfa = new TwoFactorAuth($config['server']['serverName'] . " Authentication");

// DEFINE VARIABLES FOR SCRIPTS AND LAYOUTS (no more notices 'undefinied variable'!)
if (!isset($_REQUEST['subtopic']) || empty($_REQUEST['subtopic']) || is_array($_REQUEST['subtopic'])) {
	$_REQUEST['subtopic'] = "latestnews";
} else
	$_REQUEST['subtopic'] = (string) $_REQUEST['subtopic'];

if (Functions::isValidFolderName($_REQUEST['subtopic'])) {
	if (Website::fileExists("pages/" . $_REQUEST['subtopic'] . ".php")) {
		$subtopic = $_REQUEST['subtopic'];
	} else
		throw new InvalidArgumentException('Cannot load page <b>' . htmlspecialchars($_REQUEST['subtopic']) . '</b>, file does not exist.');
} else
	throw new InvalidArgumentException('Cannot load page <b>' . htmlspecialchars($_REQUEST['subtopic']) . '</b>, invalid file name [contains illegal characters].');

// action that page should execute
if (isset($_REQUEST['action']))
	$action = (string) $_REQUEST['action'];
else
	$action = '';

if (isset($_POST['g-recaptcha-response'])) {
	//G RECAPTCHA TESTE
	$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create(array(
		'http' => array(
			'header' => "Content-type: application/x-www-form-urlencoded\r\n",
			'method' => 'POST',
			'content' => http_build_query(array(
				'response' => $_POST['g-recaptcha-response'],
				'secret' => Website::getWebsiteConfig()->getValue('gRecaptchaSecret'),
				'remoteip' => $_SERVER['REMOTE_ADDR']
			)),
		),
	)));
	// echo $subtopic .'  '. $result;
	$result = json_decode($result);
	Visitor::setRecaptchaStatus($result->success);
}


$logged = false;
/** @var Account $account_logged */
$account_logged = new Account();
$group_id_of_acc_logged = 0;
// with ONLY_PAGE option we want disable useless SQL queries
if (!ONLY_PAGE) {
	// logged boolean value: true/false
	$logged = Visitor::isLogged();
	// Account object with account of logged player or empty Account
	$account_logged = Visitor::getAccount();
	// group of acc. logged
	if (Visitor::isLogged())
		$group_id_of_acc_logged = Visitor::getAccount()->getPageAccess();
}
/** @var string $layout_name ./layouts/ */
$layout_name = './layouts/' . Website::getWebsiteConfig()->getValue('layout');
/**
 * @param string $position Center || Left || Right
 * @return string
 */
$make_button = function ($position) use ($layout_name) {
	$q = "<div class='SubmitButtonRow'>";
	$q .= '
			<div class="' . $position . 'Button">
				<form action="./?subtopic=accountmanagement&action=donate" method="post" style="padding:0px;margin:0px;">
					<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
						<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
							<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
							<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif">
						</div>
					</div>
				</form>
			</div>';
	$q .= "</div>";
	return $q;
};
/** @var string $css_version */
$css_version = Website::getWebsiteConfig()->getValue('cssVersion');

$title = ucwords($subtopic) . ' - ' . Website::getServerConfig()->getValue('serverName');
$topic = $subtopic;
$passwordency = 'sha1';
$news_content = '';
$vocation_name = array();
//alteracao1: descomentar as 3 proximas linhas
//print die(var_dump(Website::getVocations()));
foreach (Website::getVocations() as $vocation) {
	$vocation_name[$vocation->getId()] = $vocation->getName();
}
$layout_ini = parse_ini_file($layout_name . '/layout_config.ini');
foreach ($layout_ini as $key => $value)
	$config['site'][$key] = $value;

//###################### FUNCTIONS ######################
function microtime_float()
{
	return microtime(TRUE);
}

function isPremium($premdays, $lastday)
{
	return Functions::isPremium($premdays, $lastday);
}

function check_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- [ ] '");
	if ($temp != strlen($name))
		return false;
	if (strlen($name) > 25)
		return false;

	return TRUE;
}

function check_account_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "QWERTYUIOPASDFGHJKLZXCVBNM0123456789");
	if ($temp != strlen($name))
		return false;
	if (strlen($name) < 1)
		return false;
	if (strlen($name) > 32)
		return false;

	return TRUE;
}

function check_name_new_char($name)
{
	$name = (string) $name;
	$name_to_check = strtolower($name);
	//first word can't be:
	$first_words_blocked = array('gm ', 'adm', 'admin', 'administrador', 'cm ', 'god ', 'tutor ', "'", '-');
	//names blocked:
	$names_blocked = array('gm', 'cm', 'god', 'tutor', 'adm', 'admin', 'administrador');
	//name can't contain:
	$words_blocked = array('gamemaster', 'adm', 'admin', 'administrador', 'game master', 'game-master', "game'master", '--', "''", "' ", " '", '- ', ' -', "-'", "'-", 'fuck', 'sux', 'suck', 'noob', 'tutor');
	foreach ($first_words_blocked as $word)
		if ($word == substr($name_to_check, 0, strlen($word)))
			return false;
	if (substr($name_to_check, -1) == "'" || substr($name_to_check, -1) == "-")
		return false;
	if (substr($name_to_check, 1, 1) == ' ')
		return false;
	if (substr($name_to_check, -2, 1) == " ")
		return false;
	foreach ($names_blocked as $word)
		if ($word == $name_to_check)
			return false;
	for ($i = 0; $i < strlen($name_to_check); $i++)
		if ($name_to_check[$i - 1] == ' ' && $name_to_check[$i + 1] == ' ')
			return false;
	foreach ($words_blocked as $word)
		if (!(strpos($name_to_check, $word) === false))
			return false;
	for ($i = 0; $i < strlen($name_to_check); $i++)
		if ($name_to_check[$i] == $name_to_check[($i + 1)] && $name_to_check[$i] == $name_to_check[($i + 2)])
			return false;
	for ($i = 0; $i < strlen($name_to_check); $i++)
		if ($name_to_check[$i - 1] == ' ' && $name_to_check[$i + 1] == ' ')
			return false;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM- '");
	if ($temp != strlen($name))
		return false;
	if (strlen($name) < 1)
		return false;
	if (strlen($name) > 25)
		return false;

	return TRUE;
}

function check_rank_name($name)
{
	$name = (string) $name;
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-[ ] ");
	if ($temp != strlen($name))
		return false;
	if (strlen($name) < 1)
		return false;
	if (strlen($name) > 60)
		return false;

	return TRUE;
}

function check_guild_name($name)
{
	$name = (string) $name;
	$words_blocked = array('--', "''", "' ", " '", '- ', ' -', "-'", "'-", '  ');
	$temp = strspn("$name", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-' ");
	if ($temp != strlen($name))
		return false;
	if (strlen($name) < 1)
		return false;
	if (strlen($name) > 60)
		return false;

	foreach ($words_blocked as $word)
		if (!(strpos($name, $word) === false))
			return false;

	return TRUE;
}

function check_password($pass)
{
	$pass = (string) $pass;
	$temp = strspn("$pass", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890");
	if ($temp != strlen($pass))
		return false;
	if (strlen($pass) > 40)
		return false;

	return TRUE;
}

function check_mail($email)
{
	$email = (string) $email;
	$ok = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}/";
	return (preg_match($ok, $email)) ? TRUE : false;
}

function getReason($reasonId)
{
	return Functions::getBanReasonName($reasonId);
}

//################### DISPLAY FUNCTIONS #####################
//return shorter text (news ticker)
function short_text($text, $chars_limit)
{
	if (strlen($text) > $chars_limit)
		return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")) . '...';
	else
		return $text;
}

//return text to news msg
function news_place()
{
	return '';
}

// we don't want to count AJAX scripts/guild images as page views, we also don't need status
if (!ONLY_PAGE) {
	// STATUS CHECKER
	$statustimeout = 1;
	foreach (explode("*", str_replace(" ", "", $config['server']['statusTimeout'])) as $status_var)
		if ($status_var > 0)
			$statustimeout = $statustimeout * $status_var;

	$statustimeout = $statustimeout / 1000;
	$config['status'] = [];
	if (is_file('cache/serverstatus.txt')) {
		$config['status'] = parse_ini_file('cache/serverstatus.txt');
	}
	if ($config['status']['serverStatus_lastCheck'] + $statustimeout < time()) {
		$config['status']['serverStatus_checkInterval'] = $statustimeout + 3;
		$config['status']['serverStatus_lastCheck'] = time();
		$statusInfo = new ServerStatus($config['server']['ip'], $config['server']['statusProtocolPort'], 1);
		//alteracao2, por essa condicao de volta na proxima linha: if ($statusInfo->isOnline()) {
		if ($statusInfo->isOnline()) {
			//	if(1==2){
			$config['status']['serverStatus_online'] = 1;
			$config['status']['serverStatus_players'] = $statusInfo->getPlayersCount();
			$config['status']['serverStatus_playersMax'] = $statusInfo->getPlayersMaxCount();
			$h = floor($statusInfo->getUptime() / 3600);
			$m = floor(($statusInfo->getUptime() - $h * 3600) / 60);
			$config['status']['serverStatus_uptime'] = $h . 'h ' . $m . 'm';
			$config['status']['serverStatus_monsters'] = $statusInfo->getMonsters();
		} else {
			$config['status']['serverStatus_online'] = 0;
			$config['status']['serverStatus_players'] = 0;
			$config['status']['serverStatus_playersMax'] = 0;
		}
		// $file = fopen("cache/serverstatus.txt", "w");
		// $file_data = '';
		// foreach ($config['status'] as $param => $data) {
		//     $file_data .= $param . ' = "' . str_replace('"', '', $data) . '"';
		// }
		// rewind($file);
		// fwrite($file, $file_data);
		// fclose($file);
	}
	//PAGE VIEWS COUNTER
	// $views_counter = "cache/usercounter.txt";
	// // checking if the file exists
	// if (file_exists($views_counter)) {
	//     $actie = fopen($views_counter, "r+");
	//     $page_views = fgets($actie, 9);
	//     $page_views++;
	//     rewind($actie);
	//     fputs($actie, $page_views, 9);
	//     fclose($actie);
	// } else {
	//     // the file doesn't exist, creating a new one with value 1
	//     $actie = fopen($views_counter, "w");
	//     $page_views = 1;
	//     fputs($actie, $page_views, 9);
	//     fclose($actie);
	// }
}


function makeReCapcthaButton()
{
	$txt = '
	<div class="g-recaptcha"
		data-sitekey="' . Website::getWebsiteConfig()->getValue('gRecaptchaSiteKey') . '"
		data-callback="onSubmit"
		data-size="invisible">
	</div>';

	return $txt;
}

function generateRandomString($length = 16, $onlyNumbers = true)
{
	if ($onlyNumbers)
		$characters = '1234567890';
	else
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function showError($message)
{
	$message = '
	<div class="SmallBox" style="margin-top:10px;">
		<div class="MessageContainer" >
			<div class="BoxFrameHorizontal" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-horizontal.gif);" /></div>
			<div class="BoxFrameEdgeLeftTop" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif);" /></div>
			<div class="BoxFrameEdgeRightTop" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif);" /></div>
			<div class="ErrorMessage" >
				<div class="BoxFrameVerticalLeft" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-vertical.gif);" /></div>
				<div class="BoxFrameVerticalRight" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-vertical.gif);" /></div>
				<div class="AttentionSign" style="background-image:url(layouts/tibiacom/images/global/content/attentionsign.gif);" /></div>
				<b>Ocorreram os seguintes erros:</b><br/>
				<li>' . $message . '
			</div>
			<div class="BoxFrameHorizontal" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-horizontal.gif);" /></div>
			<div class="BoxFrameEdgeRightBottom" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif);" /></div>
			<div class="BoxFrameEdgeLeftBottom" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif);" /></div>
		</div>
	</div><br>';

	return $message;
}

function tibiaTable($title, $body)
{
	$message = '
	<div class="TableContainer">
		<table class="Table1" cellpadding="0" cellspacing="0">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif)"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif)"></span>
					<span class="CaptionBorderTop" style="background-image:url(layouts/tibiacom/images/global/content/table-headline-border.gif)"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-vertical.gif)"></span>
					<div class="Text">' . $title . '</div>
					<span class="CaptionVerticalRight" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-vertical.gif)"></span>
					<span class="CaptionBorderBottom" style="background-image:url(layouts/tibiacom/images/global/content/table-headline-border.gif)"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif)"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(layouts/tibiacom/images/global/content/box-frame-edge.gif)"></span>
				</div>
			</div>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table width="100%">
							' . $body . '
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div><br>';

	return $message;
}
