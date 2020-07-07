<?php
if (!defined('INITIALIZED'))
	exit;

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'logout')
	Visitor::logout();
if (!isset($_SESSION['logado'])) {
	if (isset($_REQUEST['account_login']) && isset($_REQUEST['password_login']) && isset($_REQUEST['login']) && $_REQUEST['login'] == 'ok') {
		Visitor::setAccount($_REQUEST['account_login']);
		Visitor::setPassword($_REQUEST['password_login']);

		// if (isset($_REQUEST['secretCode_login'])) {
		//     Visitor::setSecretCode($_REQUEST['secretCode_login']);
		// }

		//Visitor::login(); // this set account and password from code above as login and password to next login attempt
		//Visitor::loadAccount(); // this is required to force reload account and get status of user
		$isTryingToLogin = TRUE;
		$account = new Account();
		$loginAccount = $_REQUEST['account_login'];
		if (!empty($loginAccount)) {
			$account->loadByName($loginAccount);
			if ($account->isLoaded()) {
				if (!$account->isValidPassword($_REQUEST['password_login'])) {
					$isTryingToLogin = false;
					return;
				}

				if ($account->getSecretCode() != NULL) {
					Visitor::setAuthStatus(true);
				}
			}
		}
	}
}

// Seta o auth token
if (Visitor::getLoginState() == Visitor::LOGINSTATE_NOT_TRIED) {
	if (isset($_REQUEST['auth_token'])) {
		Visitor::setAuthToken($_REQUEST['auth_token']);
	}
}

Visitor::login();
