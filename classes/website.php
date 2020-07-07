<?php
if (!defined('INITIALIZED'))
	exit;

class Website
{
	/** @var ConfigPHP */
	public static $serverConfig;
	/** @var ConfigLUA */
	public static $websiteConfig;
	/** @var Vocations */
	public static $vocations;
	public static $events;
	/** @var Groups */
	public static $groups;
	/** @var Database_MySQL */
	public static $SQL;
	private static $passwordsEncryption = 'sha1';

	/**
	 * @param $value
	 */
	public static function setDatabaseDriver($value)
	{
		self::$SQL = NULL;

		switch ($value) {
			case Database::DB_MYSQL:
				/** @var Database_MySQL */
				self::$SQL = new Database_MySQL();
				break;
		}
	}

	/**
	 * @return Database_MySQL
	 */
	public static function getDBHandle()
	{
		if (isset(self::$SQL))
			return self::$SQL;
		else
			throw new RuntimeException('#C-9 Database driver not set.');
	}

	/**
	 * @param $fileNameArray
	 * @return ConfigPHP
	 */

	/**
	 * @param $path
	 * @return bool|string
	 */
	public static function getFileContents($path)
	{
		$file = file_get_contents($path);

		if ($file === false)
			throw new RuntimeException('Cannot read from file: <b>' . htmlspecialchars($path) . '</b>');

		return $file;
	}

	/**
	 * @param      $path
	 * @param      $data
	 * @param bool $append
	 * @return bool|int
	 */
	public static function putFileContents($path, $data, $append = false)
	{
		if ($append)
			$status = file_put_contents($path, $data, FILE_APPEND);
		else
			$status = file_put_contents($path, $data);

		if ($status === false)
			throw new RuntimeException('Cannot write to: <b>' . htmlspecialchars($path) . '</b>');

		return $status;
	}

	/**
	 * @param $path
	 */
	public static function deleteFile($path)
	{
		unlink($path);
	}

	/**
	 * @param $path
	 * @return bool
	 */
	public static function fileExists($path)
	{
		return file_exists($path);
	}

	/**
	 * @return ConfigPHP
	 */
	public static function getServerConfig()
	{
		if (!isset(self::$serverConfig))
			self::loadServerConfig();

		return self::$serverConfig;
	}

	public static function loadServerConfig()
	{
		self::$serverConfig = new ConfigPHP();
		global $config;
		self::$serverConfig->setConfig($config['server']);
	}

	/**
	 * @param      $password
	 * @param null $account
	 * @return string
	 */
	public static function encryptPassword($password, $account = NULL)
	{
		return hash(self::$passwordsEncryption, $password);
	}

	/**
	 * @return Vocations
	 */
	public static function getVocations()
	{
		if (!isset(self::$vocations))
			self::loadVocations();

		return self::$vocations;
	}

	public static function loadVocations()
	{
		$path = self::getWebsiteConfig()->getValue('serverPath');
		self::$vocations = new Vocations($path . 'data/XML/vocations.xml');
	}

	public static function getEvents()
	{
		if (!isset(self::$events))
			self::loadEvents();

		return self::$events;
	}

	public static function loadEvents()
	{
		$path = self::getWebsiteConfig()->getValue('serverPath');
		self::$events = new Events($path . 'data/XML/events.xml');
	}

	public static function getEvent($id)
	{
		if (!isset(self::$events))
			self::loadEvents();

		return self::$events->getEvent($id);
	}

	/**
	 * @return ConfigLUA
	 */
	public static function getWebsiteConfig()
	{
		if (!isset(self::$websiteConfig))
			self::loadWebsiteConfig();

		return self::$websiteConfig;
	}

	public static function loadWebsiteConfig()
	{
		self::$websiteConfig = new ConfigPHP();
		global $config;
		self::$websiteConfig->setConfig($config['site']);
	}

	/**
	 * @param $id
	 * @return string
	 */
	public static function getVocationName($id)
	{
		if (!isset(self::$vocations))
			self::loadVocations();

		return self::$vocations->getVocationName($id);
	}

	/**
	 * @return Groups
	 */
	public static function getGroups()
	{
		if (!isset(self::$groups))
			self::loadGroups();

		return self::$groups;
	}

	public static function loadGroups()
	{
		$path = self::getWebsiteConfig()->getValue('serverPath');
		self::$groups = new Groups($path . 'data/XML/groups.xml');
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public static function getGroupName($id)
	{
		if (!isset(self::$groups))
			self::loadGroups();

		return self::$groups->getGroupName($id);
	}

	/**
	 * @param $IP
	 * @return string
	 */
	public static function getCountryCode($IP)
	{
		$a = explode(".", $IP);
		if ($a[0] == 10) // IPs 10.0.0.0 - 10.255.255.255 = private network, so can't geolocate
			return 'unknown';
		if ($a[0] == 127) // IPs 127.0.0.0 - 127.255.255.255 = local network, so can't geolocate
			return 'unknown';
		if ($a[0] == 172 && ($a[1] >= 16 && $a[1] <= 31)) // IPs 172.16.0.0 - 172.31.255.255 = private network, so can't geolocate
			return 'unknown';
		if ($a[0] == 192 && $a[1] == 168) // IPs 192.168.0.0 - 192.168.255.255 = private network, so can't geolocate
			return 'unknown';
		if ($a[0] >= 224) // IPs over 224.0.0.0 are not assigned, so can't geolocate
			return 'unknown';
		$longIP = $a[0] * 256 * 256 * 256 + $a[1] * 256 * 256 + $a[2] * 256 + $a[3]; // we need unsigned value
		if (!file_exists('cache/flags/flag' . $a[0])) {
			$flagData = @file_get_contents('http://country-flags.ots.me/flag' . $a[0]);
			if ($flagData === false)
				return 'unknown';
			if (@file_put_contents('cache/flags/flag' . $a[0], $flagData) === false)
				return 'unknown';
		}
		$countries = unserialize(file_get_contents('cache/flags/flag' . $a[0])); // load file
		$lastCountryCode = 'unknown';
		foreach ($countries as $fromLong => $countryCode) {
			if ($fromLong > $longIP)
				break;
			$lastCountryCode = $countryCode;
		}
		return $lastCountryCode;
	}

	/**
	 * @return string
	 */
	public static function generateSessionKey()
	{
		global $SQL;
		while (true) {
			$sessionKey = Website::newSessionKey();
			$result = $SQL->query('SELECT `id` FROM `accounts` WHERE `authToken` LIKE "' . $sessionKey . '"')->fetch();
			if (empty($result)) {
				break;
			}
		}
		return $sessionKey;
	}

	/**
	 * @return string
	 */
	public static function newSessionKey()
	{
		srand(time());
		$lenght = 0;
		$sessionKey = "";
		while ($lenght < 30) {
			$char = substr("0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRESTUVWXYZ", rand(0, strlen("0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRESTUVWXYZ") - 1), 1);
			if (!strstr($sessionKey, $char)) {
				$sessionKey .= $char;
				$lenght++;
			}
		}
		return $sessionKey;
	}
}
