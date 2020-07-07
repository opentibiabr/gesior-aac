<?php
if (!defined('INITIALIZED'))
	exit;

use RobThree\Auth\TwoFactorAuth;

class Visitor
{
	const LOGINSTATE_NOT_TRIED = 1;
	const LOGINSTATE_NO_ACCOUNT = 2;
	const LOGINSTATE_WRONG_PASSWORD = 3;
	const LOGINSTATE_LOGGED = 4;
	const LOGINSTATE_WRONG_SECRETCODE = 5;
	const LOGINSTATE_WRONG_RECAPTCHA = 6;
	const LOGINSTATE_ASK_TWO_FACTOR = 7;
	const LOGINSTATE_INCORRECT_TWO_FACTOR = 8;

	private static $loginAccount;
	private static $loginPassword;
	private static $loginSecretCode;
	private static $loginRecaptcha = true;
	private static $authenticStatus;
	private static $auth_token;
	private static $auth_status;
	/** @var Account */
	private static $account;
	private static $loginState = self::LOGINSTATE_NOT_TRIED;

	public static function setSecretCode($code)
	{
		$_SESSION['SecretCode'] = $code;
	}

	public static function setRecaptchaStatus($status)
	{
		$_SESSION['recaptcha'] = $status;
	}
	public static function isRealBot()
	{
		return $_SESSION['recaptcha'] && $_SESSION['recaptcha'] == true;
	}

	public static function setPassword($value)
	{
		$_SESSION['password'] = $value;
	}

	public static function getLoginState()
	{
		return self::$loginState;
	}

	public static function isLogged()
	{
		return self::isTryingToLogin() && self::getAccount()->isLoaded();
	}

	public static function isTryingToLogin()
	{
		return !empty(self::$loginAccount);
	}

	public static function getAccount()
	{
		if (!isset(self::$account)) {
			self::loadAccount();
		}
		return self::$account;
	}

	public static function setAccount($value)
	{
		$_SESSION['account'] = $value;
	}

	public static function setAuthStatus($value)
	{
		self::$auth_status = $value;
	}

	public static function getAuthStatus()
	{
		return self::$auth_status;
	}

	public static function setAuthToken($value)
	{
		$_SESSION['auth_token'] = $value;
	}

	public static function getAuthToken()
	{
		return $_SESSION['auth_token'];
	}


	public static function loadAccount()
	{
		if (self::$loginState != self::LOGINSTATE_LOGGED) {
			self::$account = new Account();
		}

		if (!isset($_SESSION['recaptcha'])) {
			self::$loginState = self::LOGINSTATE_WRONG_RECAPTCHA;
			self::$account = new Account();
			return;
		}

		if ($_SESSION['recaptcha'] !== true) {
			self::$loginState = self::LOGINSTATE_WRONG_RECAPTCHA;
			self::$account = new Account();
			return;
		}

		// empty
		if (empty(self::$loginAccount)) {
			self::$loginState = self::LOGINSTATE_NOT_TRIED;
			self::$account = new Account();
			return;
		}

		self::$account->loadByName(self::$loginAccount);
		if (!self::$account->isLoaded()) {
			self::$loginState = self::LOGINSTATE_NO_ACCOUNT;
			self::$account = new Account();
			return;
		}

		$secretCode = self::$account->getSecretCode();
		$useSecret = (self::$account->getSecretCode() === NULL ? false : true);
		$authStatus = self::$auth_status;

		if (!isset($_SESSION['auth_token'])) {
			if ($useSecret) {
				self::$loginState = self::LOGINSTATE_ASK_TWO_FACTOR;
				self::$account = new Account();
				return;
			}
		}

		if (isset($_SESSION['auth_token']) && $useSecret) {
			$authToken = $_SESSION['auth_token'];
			require_once("system/load.twoFactors.php");
			if (!TokenAuth6238::verify(self::$account->getSecretCode(), $authToken)) {
				self::$loginState = self::LOGINSTATE_INCORRECT_TWO_FACTOR;
				self::$account = new Account();
				return;
			}
		}

		if (!self::$account->isValidPassword(self::$loginPassword)) {
			self::$loginState = self::LOGINSTATE_WRONG_PASSWORD;
			self::$account = new Account();
			return;
		}


		self::$loginState = self::LOGINSTATE_LOGGED;
		$_SESSION['logado'] = true;

		if (self::$loginState !== self::LOGINSTATE_LOGGED) {
			self::$account = new Account();
		}
	}

	public static function getAuthenticStatus()
	{
		return self::$authenticStatus;
	}

	public static function login()
	{
		if (isset($_SESSION['account']))
			self::$loginAccount = $_SESSION['account'];
		if (isset($_SESSION['password']))
			self::$loginPassword = $_SESSION['password'];
		if (isset($_SESSION['SecretCode']))
			self::$loginSecretCode = $_SESSION['SecretCode'];
		if (isset($_SESSION['recaptcha']))
			self::$loginRecaptcha = $_SESSION['recaptcha'];
	}

	public static function logout()
	{
		unset($_SESSION['account']);
		unset($_SESSION['password']);
		unset($_SESSION['SecretCode']);
		unset($_SESSION['recaptcha']);
		unset($_SESSION['logado']);
		self::$loginAccount = NULL;
		self::$loginPassword = NULL;
		self::$account = new Account();
		self::$loginState = self::LOGINSTATE_NOT_TRIED;
	}

	public static function getIP()
	{
		return ip2long($_SERVER['REMOTE_ADDR']);
	}
}
