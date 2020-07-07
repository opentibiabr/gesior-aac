<?php
if (!defined('INITIALIZED')) {
	exit;
}
if (!session_id()) @session_start();

$last = NULL;
if (!isset($_SESSION)) {
	$_SESSION = [];
}

if (isset($_SESSION['server_status_last_check'])) {
	$last = $_SESSION['server_status_last_check'];
}
if ($last == NULL || time() > $last + 30) {
	$_SESSION['server_status_last_check'] = time();
	$_SESSION['server_status'] = $config['status']['serverStatus_online'];
}

$infobar = Website::getWebsiteConfig()->getValue('info_bar_active');

if ($_SESSION['server_status'] == 1) {
	$qtd_players_online = $SQL->query("SELECT count(*) as total from `players_online`")->fetch();
	if ($qtd_players_online["total"] == "1") {
		$players_online = ($infobar ? $qtd_players_online["total"] . ' Player Online' : $qtd_players_online["total"] . '<br/>Player Online');
	} else {
		$players_online = ($infobar ? $qtd_players_online["total"] . ' Players Online' : $qtd_players_online["total"] . '<br/>Players Online');
	}
} else {
	$players_online = ($infobar ? 'Server Offline' : 'Server<br/>Offline');
}
echo json_encode($players_online);
die();
