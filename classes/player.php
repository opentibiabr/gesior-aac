<?php
if (!defined('INITIALIZED'))
	exit;

class Player extends ObjectData
{
	const LOADTYPE_ID = 'id';
	const LOADTYPE_NAME = 'name';
	const LOADTYPE_ACCOUNT_ID = 'account_id';
	public static $table = 'players';
	public static $fields = array('id', 'name', 'group_id', 'account_id', 'level', 'vocation', 'health', 'healthmax', 'experience', 'lookbody', 'lookfeet', 'lookmount', 'lookhead', 'looklegs', 'looktype', 'lookaddons', 'maglevel', 'mana', 'manamax', 'manaspent', 'soul', 'town_id', 'posx', 'posy', 'posz', 'conditions', 'cap', 'sex', 'lastlogin', 'lastip', 'save', 'skull', 'skulltime', 'lastlogout', 'blessings', 'deletion', 'deleted', 'balance', 'stamina', 'skill_fist', 'skill_fist_tries', 'skill_club', 'skill_club_tries', 'skill_sword', 'skill_sword_tries', 'skill_axe', 'skill_axe_tries', 'skill_dist', 'skill_dist_tries', 'skill_shielding', 'skill_shielding_tries', 'skill_fishing', 'skill_fishing_tries', 'create_ip', 'create_date', 'comment', 'hide_char', 'signature', 'marriage_status', 'marriage_spouse', 'loyalty_ranking');
	public static $skillNames = array('fist', 'club', 'sword', 'axe', 'dist', 'shielding', 'fishing');
	public static $onlineList;
	public $data = array('name' => NULL, 'group_id' => 1, 'account_id' => NULL, 'level' => 1, 'vocation' => 0, 'health' => 1, 'healthmax' => 1, 'experience' => 0, 'lookbody' => 0, 'lookfeet' => 0, 'lookmount' => 0, 'lookhead' => 0, 'looklegs' => 0, 'looktype' => 128, 'lookaddons' => 0, 'maglevel' => 0, 'mana' => 0, 'manamax' => 0, 'manaspent' => 0, 'soul' => 0, 'town_id' => 6, 'posx' => 0, 'posy' => 0, 'posz' => 0, 'conditions' => NULL, 'cap' => 0, 'sex' => 1, 'lastlogin' => 0, 'lastip' => 0, 'save' => 1, 'skull' => 0, 'skulltime' => 0, 'lastlogout' => 0, 'blessings' => 0, 'deletion' => 0, 'deleted' => 0, 'balance' => 0, 'stamina' => 0, 'skill_fist' => 10, 'skill_fist_tries' => 0, 'skill_club' => 10, 'skill_club_tries' => 0, 'skill_sword' => 10, 'skill_sword_tries' => 0, 'skill_axe' => 10, 'skill_axe_tries' => 0, 'skill_dist' => 10, 'skill_dist_tries' => 0, 'skill_shielding' => 10, 'skill_shielding_tries' => 0, 'skill_fishing' => 10, 'skill_fishing_tries' => 0, 'create_ip' => 0, 'create_date' => 0, 'comment' => NULL, 'hide_char' => 0, 'signature' => NULL, 'marriage_status' => NULL, 'marriage_spouse' => NULL, 'loyalty_ranking' => NULL);
	public $items;
	public $storages;
	public $depot_items;
	public $account;
	public $rank;
	public $guildNick;

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
			throw new InvalidArgumentException('Wrong Player search_by type.');
		$fieldsArray = array();
		foreach (self::$fields as $fieldName)
			$fieldsArray[] = $this->getDatabaseHandler()->fieldName($fieldName);

		$this->data = $this->getDatabaseHandler()->query('SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $search_string)->fetch();
	}

	public function loadById($id)
	{
		$this->load($id, self::LOADTYPE_ID);
	}

	public function save($forceInsert = false)
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
			$this->setID($this->getDatabaseHandler()->lastInsertId());
		} else {
			$updates = array();
			foreach (self::$fields as $key)
				$updates[] = $this->getDatabaseHandler()->fieldName($key) . ' = ' . $this->getDatabaseHandler()->quote($this->data[$key]);
			$this->getDatabaseHandler()->query('UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . implode(', ', $updates) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
		}
	}

	public function setID($value)
	{
		$this->data['id'] = $value;
	}

	public function getDepotItems()
	{
		$player_id = $this->getID();
		$depot_items = $this->getDatabaseHandler()->query("SELECT depot.player_id, depot.itemtype, depot.sid, depot.pid, depot.count, sum(depot.count) as real_count FROM player_depotitems depot where depot.player_id = $player_id group by depot.itemtype, depot.player_id, depot.itemtype, depot.sid, depot.pid, depot.count ORDER BY depot.player_id ASC")->fetchAll();
		return $depot_items;
	}

	public function getID()
	{
		return $this->data['id'];
	}

	public function getItems($forceReload = false)
	{
		if (!isset($this->items) || $forceReload)
			$this->items = new ItemsList($this->getID());

		return $this->items;
	}

	public function getExpForLevel($lv)
	{
		$lv--;
		return ((50 * $lv * $lv * $lv) - (150 * $lv * $lv) + (400 * $lv)) / 3;
	}

	/**
	 * @param null $class
	 * @param null $direction
	 * @return string
	 */
	public function makeOutfitUrl($full_link = false)
	{
		if ($full_link == false)
			return "/AnimatedOutfits/animoutfit.php?id={$this->getLookType()}&addons={$this->getLookAddons()}&head={$this->getLookHead()}&body={$this->getLookBody()}&legs={$this->getLookLegs()}&feet={$this->getLookFeet()}&mount={$this->getLookMount()}";
		else if ($full_link == true)
			return "<img class='Outfit' src='/AnimatedOutfits/animoutfit.php?id={$this->getLookType()}&addons={$this->getLookAddons()}&head={$this->getLookHead()}&body={$this->getLookBody()}&legs={$this->getLookLegs()}&feet={$this->getLookFeet()}&mount={$this->getLookMount()}' alt='' name=''>";
	}

	public function getLookType()
	{
		return $this->data['looktype'];
	}

	public function getLookAddons()
	{
		return $this->data['lookaddons'];
	}

	public function getLookHead()
	{
		return $this->data['lookhead'];
	}

	public function getLookBody()
	{
		return $this->data['lookbody'];
	}

	public function getLookLegs()
	{
		return $this->data['looklegs'];
	}

	public function getLookFeet()
	{
		return $this->data['lookfeet'];
	}

	public function getLookMount()
	{
		return $this->data['lookmount'];
	}

	public function getStorage($key)
	{
		if (!isset($this->storages)) {
			$this->loadStorages();
		}
		if (isset($this->storages[$key]))
			return $this->storages[$key];
		else
			return NULL;
	}

	public function loadStorages()
	{
		$this->storages = array();
		// load all
		$storages = $this->getDatabaseHandler()->query('SELECT ' . $this->getDatabaseHandler()->fieldName('player_id') . ', ' . $this->getDatabaseHandler()->fieldName('key') .
			', ' . $this->getDatabaseHandler()->fieldName('value') . ' FROM ' . $this->getDatabaseHandler()->tableName('player_storage') .
			' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']))->fetchAll();
		foreach ($storages as $storage) {
			$this->storages[$storage['key']] = $storage['value'];
		}
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function saveItems()
	{
		if (isset($this->items)) {
			// if any script changed ID of player, function should save items with new player id
			$this->items->setPlayerId($this->getID());
			$this->items->save();
		} else
			throw new LogicException('Items not loaded, cannot save');
	}

	public function saveStorages()
	{
		if (isset($this->storages)) {
			$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName('player_storage') . ' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
			foreach ($this->storages as $key => $value) {
				//save each
				$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName('player_storage') . ' (' . $this->getDatabaseHandler()->fieldName('player_id') . ', ' .
					$this->getDatabaseHandler()->fieldName('key') . ', ' . $this->getDatabaseHandler()->fieldName('value') . ', ) VALUES (' .
					$this->getDatabaseHandler()->quote($this->data['id']) . ', ' . $this->getDatabaseHandler()->quote($key) . ', ' . $this->getDatabaseHandler()->quote($value) . ')');
			}
		} else
			throw new LogicException('Storages not loaded, cannot save');
	}

	public function getStorages()
	{
		if (!isset($this->storages)) {
			$this->loadStorages();
		}
		return $this->storages;
	}

	public function setStorage($key, $value)
	{
		if (!isset($this->storages)) {
			$this->loadStorages();
		}
		$this->storages[$key] = $value;
	}

	public function removeStorage($key)
	{
		if (!isset($this->storages)) {
			$this->loadStorages();
		}
		if (isset($this->storages[$key]))
			unset($this->storages[$key]);
	}

	public function getSkill($id)
	{
		if (isset(self::$skillNames[$id]))
			return $this->data['skill_' . self::$skillNames[$id]];
		else
			throw new InvalidArgumentException('Skill ' . htmlspecialchars($id) . ' does not exist');
	}

	public function setSkill($id, $value)
	{
		if (isset(self::$skillNames[$id]))
			$this->data['skill_' . self::$skillNames[$id]] = $value;
	}

	public function getSkillCount($id)
	{
		if (isset(self::$skillNames[$id]))
			return $this->data['skill_' . self::$skillNames[$id] . '_tries'];
		else
			throw new InvalidArgumentException('Skill ' . htmlspecialchars($id) . ' does not exist');
	}

	public function setSkillCount($id, $value)
	{
		if (isset(self::$skillNames[$id]))
			$this->data['skill_' . self::$skillNames[$id] . '_tries'] = $value;
	}

	public function hasGuild()
	{
		return $this->getRank() != NULL && $this->getRank()->isLoaded();
	}


	/**
	 * @param bool $forceReload
	 * @return GuildRank
	 */
	public function getRank($forceReload = false)
	{
		if (!isset($this->guildNick) || !isset($this->rank) || $forceReload)
			$this->loadRank();

		return $this->rank;
	}

	public function setRank($rank = NULL)
	{
		$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName('guild_membership') . ' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->getID()));
		if ($rank !== NULL) {
			$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName('guild_membership') . ' (' . $this->getDatabaseHandler()->fieldName('player_id') . ', ' . $this->getDatabaseHandler()->fieldName('guild_id') . ', ' . $this->getDatabaseHandler()->fieldName('rank_id') . ', ' . $this->getDatabaseHandler()->fieldName('nick') . ') VALUES (' . $this->getDatabaseHandler()->quote($this->getID()) . ', ' . $this->getDatabaseHandler()->quote($rank->getGuildID()) . ', ' . $this->getDatabaseHandler()->quote($rank->getID()) . ', ' . $this->getDatabaseHandler()->quote('') . ')');
		}
		$this->rank = $rank;
	}

	public function loadRank()
	{
		$ranks = $this->getDatabaseHandler()->query('SELECT ' . $this->getDatabaseHandler()->fieldName('rank_id') . ', ' . $this->getDatabaseHandler()->fieldName('nick') . ' FROM ' . $this->getDatabaseHandler()->tableName('guild_membership') . ' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->getID()))->fetch();
		if ($ranks) {
			$this->rank = new GuildRank($ranks['rank_id']);
			$this->guildNick = $ranks['nick'];
		} else {
			$this->rank = NULL;
			$this->guildNick = '';
		}
	}

	public function getGuildNick()
	{
		if (!isset($this->guildNick) || !isset($this->rank))
			$this->loadRank();

		return $this->guildNick;
	}

	public function setGuildNick($value)
	{
		$this->guildNick = $value;
		$this->getDatabaseHandler()->query('UPDATE ' . $this->getDatabaseHandler()->tableName('guild_membership') . ' SET ' . $this->getDatabaseHandler()->fieldName('nick') . ' = ' . $this->getDatabaseHandler()->quote($this->guildNick) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->getID()));
	}

	public function removeGuildInvitations()
	{
		$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName('guild_invites') . ' WHERE ' . $this->getDatabaseHandler()->fieldName('player_id') . ' = ' . $this->getDatabaseHandler()->quote($this->getID()));
	}

	/*
	 * default tfs 0.3.6 fields
	*/

	public function unban()
	{
		$this->getAccount()->unban();
	}


	/**
	 * @param bool $forceReload
	 * @return Account
	 */
	public function getAccount($forceReload = false)
	{
		if (!isset($this->account) || $forceReload)
			$this->loadAccount();

		return $this->account;
	}

	public function setAccount(Account $account)
	{
		$this->account = $account;
		$this->setAccountID($account->getID());
	}

	public function setAccountID($value)
	{
		$this->data['account_id'] = $value;
	}

	public function loadAccount()
	{
		$this->account = new Account($this->getAccountID());
	}

	public function getAccountID()
	{
		return $this->data['account_id'];
	}

	public function isBanned()
	{
		return $this->getAccount()->isBanned();
	}

	public function isNamelocked()
	{
		return false;
	}

	public function delete()
	{
		$this->db->query('UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . $this->getDatabaseHandler()->fieldName('deleted') . ' = 1 WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));

		unset($this->data['id']);
	}

	public function getVocationName()
	{
		$voc = $this->getVocation();
		switch ($voc) {
			case 0:
				$voc = "No Vocation";
				break;
			case 1:
				$voc = "Sorcerer";
				break;
			case 2:
				$voc = "Druid";
				break;
			case 3:
				$voc = "Paladin";
				break;
			case 4:
				$voc = "Knight";
				break;
			case 5:
				$voc = "Master Sorcerer";
				break;
			case 6:
				$voc = "Elder Druid";
				break;
			case 7:
				$voc = "Royal Paladin";
				break;
			case 8:
				$voc = "Elite Knight";
				break;
			default:
				break;
		}
		return $voc;
	}

	public function getVocation()
	{
		return $this->data['vocation'];
	}

	public function setName($value)
	{
		$this->data['name'] = $value;
	}

	public function getMarriageStatus()
	{
		return $this->data['marriage_status'];
	}

	public function getMarriage()
	{
		return $this->data['marriage_spouse'];
	}

	public function setVocation($value)
	{
		$this->data['vocation'] = $value;
	}

	public function setLevel($value)
	{
		$this->data['level'] = $value;
	}

	public function getLevel()
	{
		return $this->data['level'];
	}

	public function setExperience($value)
	{
		$this->data['experience'] = $value;
	}

	public function getExperience()
	{
		return $this->data['experience'];
	}

	public function setHealth($value)
	{
		$this->data['health'] = $value;
	}

	public function getHealth()
	{
		return $this->data['health'];
	}

	public function setHealthMax($value)
	{
		$this->data['healthmax'] = $value;
	}

	public function getHealthMax()
	{
		return $this->data['healthmax'];
	}

	public function setMana($value)
	{
		$this->data['mana'] = $value;
	}

	public function getMana()
	{
		return $this->data['mana'];
	}

	public function setManaMax($value)
	{
		$this->data['manamax'] = $value;
	}

	public function getManaMax()
	{
		return $this->data['manamax'];
	}

	public function setMagLevel($value)
	{
		$this->data['maglevel'] = $value;
	}

	public function getMagLevel()
	{
		return $this->data['maglevel'];
	}

	public function setManaSpent($value)
	{
		$this->data['manaspent'] = $value;
	}

	public function getManaSpent()
	{
		return $this->data['manaspent'];
	}

	public function setSex($value)
	{
		$this->data['sex'] = $value;
	}

	public function getSex()
	{
		return $this->data['sex'];
	}

	public function setTown($value)
	{
		$this->data['town_id'] = $value;
	}

	public function setPosX($value)
	{
		$this->data['posx'] = $value;
	}

	public function getPosX()
	{
		return $this->data['posx'];
	}

	public function setPosY($value)
	{
		$this->data['posy'] = $value;
	}

	public function getPosY()
	{
		return $this->data['posy'];
	}

	public function setPosZ($value)
	{
		$this->data['posz'] = $value;
	}

	public function getPosZ()
	{
		return $this->data['posz'];
	}

	public function setSoul($value)
	{
		$this->data['soul'] = $value;
	}

	public function getSoul()
	{
		return $this->data['soul'];
	}

	public function setConditions($value)
	{
		$this->data['conditions'] = $value;
	}

	public function getConditions()
	{
		return $this->data['conditions'];
	}

	public function setLastIP($value)
	{
		$this->data['lastip'] = $value;
	}

	public function getLastIP()
	{
		return $this->data['lastip'];
	}

	public function setLastLogin($value)
	{
		$this->data['lastlogin'] = $value;
	}

	public function getLastLogin()
	{
		return $this->data['lastlogin'];
	}

	public function setLastLogout($value)
	{
		$this->data['lastlogout'] = $value;
	}

	public function getLastLogout()
	{
		return $this->data['lastlogout'];
	}

	public function setSkull($value)
	{
		$this->data['skull'] = $value;
	}

	public function getSkull()
	{
		return $this->data['skull'];
	}

	public function setSkullTime($value)
	{
		$this->data['skulltime'] = $value;
	}

	public function getSkullTime()
	{
		return $this->data['skulltime'];
	}

	public function setBlessings($value)
	{
		$this->data['blessings'] = $value;
	}

	public function getBlessings()
	{
		return $this->data['blessings'];
	}

	public function setBalance($value)
	{
		$this->data['balance'] = $value;
	}

	public function getBalance()
	{
		return $this->data['balance'];
	}

	public function setStamina($value)
	{
		$this->data['stamina'] = $value;
	}

	public function getStamina()
	{
		return $this->data['stamina'];
	}

	public function setDeleted($value)
	{
		$this->data['deleted'] = (int) $value;
	}

	public function isDeleted()
	{
		return (bool) $this->data['deleted'];
	}

	public function setLoyaltyRanking($value)
	{
		$this->data['loyalty_ranking'] = (int) $value;
	}

	public function isLoyaltyRanking()
	{
		return (bool) $this->data['loyalty_ranking'];
	}

	public function setDeletion($value)
	{
		$this->data['deletion'] = (int) $value;
	}

	public function getDeletion()
	{
		return $this->data['deletion'];
	}

	public function setLookBody($value)
	{
		$this->data['lookbody'] = $value;
	}

	public function setLookFeet($value)
	{
		$this->data['lookfeet'] = $value;
	}

	public function setLookHead($value)
	{
		$this->data['lookhead'] = $value;
	}

	public function setLookLegs($value)
	{
		$this->data['looklegs'] = $value;
	}

	public function setLookType($value)
	{
		$this->data['looktype'] = $value;
	}

	public function setLookAddons($value)
	{
		$this->data['lookaddons'] = $value;
	}

	public function setCreateIP($value)
	{
		$this->data['create_ip'] = $value;
	}

	public function getCreateIP()
	{
		return $this->data['create_ip'];
	}

	public function setHidden($value)
	{
		$this->data['hide_char'] = (int) $value;
	}

	public function setComment($value)
	{
		$this->data['comment'] = htmlspecialchars(trim($value));
	}

	public function getComment()
	{
		return $this->data['comment'];
	}

	public function setSignature($value)
	{
		$this->data['signature'] = htmlspecialchars(trim($value));
	}

	public function getSignature()
	{
		return $this->data['signature'];
	}

	public function setGroup($value)
	{
		$this->setGroupID($value);
	}

	/*
	 * Custom AAC fields
	 * create_ip , INT, default 0
	 * create_date , INT, default 0
	 * hide_char , INT, default 0
	 * comment , TEXT, default ''
	*/

	public function setGroupID($value)
	{
		$this->data['group_id'] = $value;
	}

	public function getGroup()
	{
		return $this->getGroupID();
	}

	public function getGroupID()
	{
		return $this->data['group_id'];
	}

	public function getCreated()
	{
		return $this->getCreateDate();
	}

	public function getCreateDate()
	{
		return $this->data['create_date'];
	}

	public function setCreated($value)
	{
		$this->setCreateDate($value);
	}

	public function setCreateDate($value)
	{
		$this->data['create_date'] = $value;
	}

	public function setCap($value)
	{
		$this->setCapacity($value);
	}

	public function setCapacity($value)
	{
		$this->data['cap'] = $value;
	}

	public function getCap()
	{
		return $this->getCapacity();
	}

	/*
	 * for compability with old scripts
	*/

	public function getCapacity()
	{
		return $this->data['cap'];
	}

	public function isSaveSet()
	{
		return $this->getSave();
	}

	public function getSave()
	{
		return $this->data['save'];
	}

	public function unsetSave()
	{
		$this->setSave(0);
	}

	public function setSave($value = 1)
	{
		$this->data['save'] = (int) $value;
	}

	public function getTownId()
	{
		return $this->getTown();
	}

	public function getTown()
	{
		return $this->data['town_id'];
	}

	public function getHideChar()
	{
		return $this->isHidden();
	}

	public function isHidden()
	{
		return (bool) $this->data['hide_char'];
	}

	public function find($name)
	{
		$this->loadByName($name);
	}

	public function loadByName($name)
	{
		$this->load($name, self::LOADTYPE_NAME);
	}

	public function isOnline()
	{
		return self::isPlayerOnline($this->getID());
	}

	public static function isPlayerOnline($playerID)
	{
		if (!isset(self::$onlineList)) {
			self::$onlineList = array();
			$onlines = Website::getDBHandle()->query('SELECT ' . Website::getDBHandle()->fieldName('player_id') . ' FROM ' . Website::getDBHandle()->tableName('players_online'))->fetchAll();
			foreach ($onlines as $online) {
				self::$onlineList[$online['player_id']] = $online['player_id'];
			}
		}

		return isset(self::$onlineList[$playerID]);
	}

	public function getOnline()
	{
		return self::isPlayerOnline($this->getID());
	}

	public function getAchievementsPoints()
	{
		$pp = $this->getDatabaseHandler()->query("SELECT * FROM `s_achievements`")->fetchAll();
		$points = 0;
		foreach ($pp as $i) {
			// 300000
			if (self::getStorage(300000 + $i["id"]) > 0) {
				$points += $i["points"];
			}
		}
		return $points;
	}

	public function getAchievements()
	{
		$pp = $this->getDatabaseHandler()->query("SELECT * FROM `s_achievements`")->fetchAll();
		$ach = array();
		$c = 0;
		foreach ($pp as $i) {
			// 300000
			if (self::getStorage(300000 + $i["id"]) > 0) {
				$c++;
				$ach[$c] = $i["id"];
			}
		}
		return $ach;
	}


	public function getOutfits()
	{
		$outfits = array();
		$count = 0;
		$playerStorages = $this->getStorages();
		for ($key = 10001000 + 1; $key < 10001000 + 500; $key++) {
			if (isset($playerStorages[$key])) {
				$value = $playerStorages[$key];
				$outfitType = ($value & 0xFFFF0000) >> 16;
				$outfitAddonToImageGenerator = ($value & 0x0000FFFF);
				$outfitHasAddon1 = ($value & 0x0000FFFF & 1) > 0;
				$outfitHasAddon2 = ($value & 0x0000FFFF & 2) > 0;
				$count++;
				$outfits[$count] = array('look_type' => $outfitType, 'look_addon' => $outfitAddonToImageGenerator, 'has_addon_1' => $outfitHasAddon1, 'has_addon_2' => $outfitHasAddon2);
			}
		}
		return $outfits;
	}

	public function getMounts()
	{
		$mounts = array();
		$playerStorages = $this->getStorages();
		for ($mountId = 1; $mountId < 300; $mountId++) {
			$tmpMountId = $mountId - 1;
			$key = 10002001 + ($tmpMountId / 31);

			if (isset($playerStorages[$key])) {
				if (((1 << ($tmpMountId % 31)) & $playerStorages[$key]) != 0) {
					$mounts[] = $mountId;
				}
			}
		}
		return $mounts;
	}


	public function getURLOutfit($mount, $animado)
	{
		if ($animado === 1) {
			$base = Website::getWebsiteConfig()->getValue('animatedOutfits_url');
		} else {
			$base = Website::getWebsiteConfig()->getValue('outfit_images_url') . "?id=";
		}

		$base .= $this->getLookType() . "&body=" . $this->getLookType() . "&feet=" . $this->getLookFeet() . "&head=" . $this->getLookHead() . "&legs=" . $this->getLookLegs() . "&addons=" . $this->getLookAddons();
		if ($mount === 1)
			$base .= "&mount=" . $this->getLookMount();

		return $base;
	}
}
