<?php
if (!defined('INITIALIZED'))
	exit;

class Account extends ObjectData
{
	const LOADTYPE_ID = 'id';
	const LOADTYPE_NAME = 'name';
	const LOADTYPE_MAIL = 'email';
	public static $table = 'accounts';
	public static $fields = array('id', 'name', 'password', 'secret', 'secret_status', 'premdays', 'coins', 'lastday', 'email', 'key', 'create_ip', 'creation', 'page_access', 'location', 'rlname', 'birth_date', 'gender', 'email_new', 'email_new_time', 'email_code', 'next_email', 'last_post', 'flag', 'vote', 'loyalty_points', 'guild_points', 'player_sell_bank', 'proxy_id', 'vip_time');
	public $data = array('name' => NULL, 'password' => NULL, 'secret' => NULL, 'secret_status' => 0, 'premdays' => 0, 'coins' => 0, 'lastday' => 0, 'email' => NULL, 'key' => NULL, 'create_ip' => 0, 'creation' => 0, 'page_access' => 0, 'location' => NULL, 'rlname' => NULL, 'birth_date' => NULL, 'gender' => NULL, 'email_new' => NULL, 'email_new_time' => 0, 'email_code' => NULL, 'next_email' => 0, 'last_post' => 0, 'flag' => NULL, 'vote' => 0, 'loyalty_points' => 0, 'guild_points' => 0, 'player_sell_bank' => 0, 'proxy_id' => 0, 'vip_time' => 0);
	public $players;
	public $playerRanks;
	public $guildAccess;
	public $bans;

	public function __construct($search_text = NULL, $search_by = self::LOADTYPE_ID)
	{
		if ($search_text != NULL)
			$this->load($search_text, $search_by);
	}

	public function load($search_text, $search_by = self::LOADTYPE_ID)
	{
		if (in_array($search_by, self::$fields))
			$search_string = $this->getDatabaseHandler()->fieldName($search_by) . ' = ' . $this->getDatabaseHandler()->quote($search_text);
		else
			throw new InvalidArgumentException('Wrong Account search_by type.');
		$fieldsArray = array();
		foreach (self::$fields as $fieldName)
			$fieldsArray[$fieldName] = $this->getDatabaseHandler()->fieldName($fieldName);

		//echo 'SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $search_string;
		$this->data = $this->getDatabaseHandler()->query('SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $search_string)->fetch();
	}

	public function getSecret()
	{
		return $this->data['secret'];
	}

	public function setSecret($secret)
	{
		$this->data['secret'] = $secret;
	}

	public function getSecretCode()
	{
		if (self::getSecret() != NULL) {
			return self::getSecret();
		}

		return NULL;
	}

	public function getSecretStatus()
	{
		return $this->data['secret_status'];
	}

	public function setSecretStatus($status)
	{
		$this->data['secret_status'] = ($status === TRUE ? 1 : 0);
	}

	public function loadById($id)
	{
		$this->load($id, 'id');
	}

	public function save($forceInsert = FALSE)
	{
		if (!isset($this->data['id']) || $forceInsert) {
			$keys = array();
			$values = array();
			foreach (self::$fields as $key)
				if ($key != 'id') {
					$keys[] = $this->getDatabaseHandler()->fieldName($key);
					$values[] = $this->getDatabaseHandler()->quote($this->data[$key]);
				}

			//echo 'INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')';
			$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			//            var_dump('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			//            print_r('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			$this->setID($this->getDatabaseHandler()->lastInsertId());
		} else {
			$updates = array();
			foreach (self::$fields as $key)
				if ($key != 'id')
					$updates[] = $this->getDatabaseHandler()->fieldName($key) . ' = ' . $this->getDatabaseHandler()->quote($this->data[$key]);
			if ($key == 'player_sell_bank' && $this->data["player_sell_bank"] == '')
				$this->data["player_sell_bank"] = 0;

			//            echo 'UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . implode(', ', $updates) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']);
			$this->getDatabaseHandler()->query('UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . implode(', ', $updates) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
		}
	}

	public function setID($value)
	{
		$this->data['id'] = $value;
	}

	public function unban()
	{
		$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName('account_bans') . ' WHERE ' . $this->getDatabaseHandler()->fieldName('account_id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));

		unset($this->bans);
	}

	public function isBanned($forceReload = FALSE)
	{
		$this->loadBans($forceReload);
		return count($this->bans) > 0;
	}

	public function loadBans($forceReload = FALSE)
	{
		if (!isset($this->bans) || $forceReload) {
			$this->bans = new DatabaseList('AccountBan');
			$filter = new SQL_Filter(new SQL_Field('account_id'), SQL_Filter::EQUAL, $this->data['id']);
			$this->bans->setFilter($filter);
		}
	}

	public function getBanTime($forceReload = FALSE)
	{
		$this->loadBans($forceReload);
		$lastExpires = 0;
		$now = date('Y-m-d h:i:s');
		foreach ($this->bans->data as $ban) {
			if ($ban['expires_at'] <= $now) {
				$lastExpires = 0;
				break;
			}
			if ($ban['expires_at'] > $now && $ban['expires_at'] > $lastExpires)
				$lastExpires = $ban['expires_at'];
		}
		return $lastExpires;
	}

	public function delete()
	{
		$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));

		unset($this->data['id']);
	}

	public function setName($value)
	{
		$this->data['name'] = $value;
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function setPassword($value)
	{
		$this->data['password'] = Website::encryptPassword($value, $this);
	}

	public function getPassword()
	{
		return $this->data['password'];
	}

	public function setPremDays($value)
	{
		$this->data['premdays'] = $value;
	}

	public function setLastDay($value)
	{
		$this->data['lastday'] = $value;
	}

	public function setKey($value)
	{
		$this->data['key'] = $value;
	}

	public function getKey()
	{
		return $this->data['key'];
	}

	public function setCreateIP($value)
	{
		$this->data['create_ip'] = $value;
	}

	public function getCreateIP()
	{
		return $this->data['create_ip'];
	}

	public function setCreateDate($value)
	{
		$this->data['creation'] = $value;
	}

	public function getCreateDate()
	{
		return $this->data['creation'];
	}

	public function setPremiumPoints($value)
	{
		$this->data['coins'] = $value;
	}

	public function getPremiumPoints()
	{
		return $this->data['coins'];
	}

	public function setPageAccess($value)
	{
		$this->data['page_access'] = $value;
	}

	public function getPageAccess()
	{
		return $this->data['page_access'];
	}

	public function setLocation($value)
	{
		$this->data['location'] = $value;
	}

	public function getLocation()
	{
		return $this->data['location'];
	}

	public function setLoyalty($value)
	{
		$this->data['loyalty_points'] = $value;
	}

	public function getLoyalty()
	{
		return $this->data['loyalty_points'];
	}

	public function setRLName($value)
	{
		$this->data['rlname'] = $value;
	}

	public function getRLName()
	{
		return $this->data['rlname'];
	}

	public function setBirthDate($value)
	{
		$this->data['birth_date'] = $value;
	}

	public function getBirthDate()
	{
		return $this->data['birth_date'];
	}

	public function setGender($value)
	{
		$this->data['gender'] = $value;
	}

	public function getGender()
	{
		return $this->data['gender'];
	}

	public function setFlag($value)
	{
		$this->data['flag'] = $value;
	}

	public function getFlag()
	{
		return $this->data['flag'];
	}

	public function getEMail()
	{
		return $this->getMail();
	}

	public function getMail()
	{
		return $this->data['email'];
	}

	public function setEMail($value)
	{
		$this->setMail($value);
	}

	public function setMail($value)
	{
		$this->data['email'] = $value;
	}

	public function getPlayersList()
	{
		return $this->getPlayers();
	}

	public function getPlayers($forceReload = FALSE)
	{
		if (!isset($this->players) || $forceReload) {
			$this->players = new DatabaseList('Player');
			$this->players->setFilter(new SQL_Filter(new SQL_Field('account_id'), SQL_Filter::EQUAL, $this->getID()));
			$this->players->addOrder(new SQL_Order(new SQL_Field('name')));
			$this->players->load();
		}
		return $this->players;
	}

	public function getID()
	{
		return $this->data['id'];
	}

	public function getGuildAccess($guildID)
	{
		return $this->getGuildLevel($guildID);
	}

	public function isValidPassword($password)
	{
		return ($this->data['password'] == Website::encryptPassword($password, $this));
	}

	public function find($name)
	{
		$this->loadByName($name);
		if (!$this->isLoaded())
			$this->loadByEmail($name);
	}

	public function loadByName($name)
	{
		$this->load($name, 'name');
		if (!$this->isLoaded())
			$this->loadByEmail($name);
	}

	public function findByEmail($email)
	{
		$this->loadByEmail($email);
	}

	public function loadByEmail($mail)
	{
		$this->load($mail, 'email');
	}

	public function isPremium()
	{
		return ($this->getPremDays() > 0);
	}

	public function getPremDays()
	{
		return $this->data['premdays'] - (date("z", time()) + (365 * (date("Y", time()) - date("Y", $this->data['lastday']))) - date("z", $this->data['lastday']));
	}

	public function getLastLogin()
	{
		return $this->getLastDay();
	}

	public function getLastDay()
	{
		return $this->data['lastday'];
	}
	public function getProxyId()
	{
		return $this->data['proxy_id'];
	}
	public function isVip()
	{
		return $this->data['vip_time'] > time();
	}
	public function getVipTime()
	{
		return $this->data['vip_time'];
	}
	public function setVipTime($value)
	{
		$this->data['vip_time'] = $value;
	}
}
