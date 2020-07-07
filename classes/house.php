<?php
if (!defined('INITIALIZED'))
	exit;

class House extends ObjectData
{
	public static $table = 'houses';
	public static $fields = ['id', 'owner', 'paid', 'warnings', 'name', 'town_id', 'size', 'rent', 'beds', 'bid', 'bid_end', 'last_bid', 'highest_bidder'];
	public $data = ['owner' => NULL, 'paid' => NULL, 'warnings' => NULL, 'name' => NULL, 'town_id' => NULL, 'size' => NULL, 'rent' => NULL, 'beds' => NULL, 'bid' => NULL, 'bid_end' => NULL, 'last_bid' => NULL, 'highest_bidder' => NULL];

	public function __construct($house_id = NULL)
	{
		if ($house_id != NULL)
			$this->load($house_id);
	}

	public function load($house_id)
	{
		$search_string = $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($house_id);
		$fieldsArray = [];
		foreach (self::$fields as $fieldName)
			$fieldsArray[$fieldName] = $this->getDatabaseHandler()->fieldName($fieldName);
		$this->data = $this->getDatabaseHandler()->query('SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $search_string)->fetch();
	}

	public function save($forceInsert = false)
	{
		if (!isset($this->data['id']) || $forceInsert) {
			$keys = [];
			$values = [];
			foreach (self::$fields as $key)
				if ($key != 'id') {
					$keys[] = $this->getDatabaseHandler()->fieldName($key);
					$values[] = $this->getDatabaseHandler()->quote($this->data[$key]);
				}
			$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			$this->setID($this->getDatabaseHandler()->lastInsertId());
		} else {
			$updates = [];
			foreach (self::$fields as $key)
				if ($key != 'id')
					$updates[] = $this->getDatabaseHandler()->fieldName($key) . ' = ' . $this->getDatabaseHandler()->quote($this->data[$key]);
			$this->getDatabaseHandler()->query('UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . implode(', ', $updates) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
		}
	}

	public function setID($value)
	{
		$this->data['id'] = $value;
	}

	public function getID()
	{
		return $this->data['id'];
	}

	public function setOwner($value)
	{
		$this->data['owner'] = $value;
	}

	public function getOwner()
	{
		return $this->data['owner'];
	}

	public function setPaid($value)
	{
		$this->data['paid'] = $value;
	}

	public function getPaid()
	{
		return $this->data['paid'];
	}

	public function setWarnings($value)
	{
		$this->data['warnings'] = $value;
	}

	public function getWarnings()
	{
		return $this->data['warnings'];
	}

	public function setName($value)
	{
		$this->data['name'] = $value;
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function setTown($value)
	{
		$this->data['town_id'] = $value;
	}

	public function getTown()
	{
		return $this->data['town_id'];
	}

	public function setSize($value)
	{
		$this->data['size'] = $value;
	}

	public function getSize()
	{
		return $this->data['size'];
	}

	public function setRent($value)
	{
		$this->data['rent'] = $value;
	}

	public function getRent()
	{
		return $this->data['rent'];
	}

	public function setBeds($value)
	{
		$this->data['beds'] = $value;
	}

	public function getBeds()
	{
		return $this->data['beds'];
	}

	public function setBid($value)
	{
		$this->data['bid'] = $value;
	}

	public function getBid()
	{
		return $this->data['bid'];
	}

	public function setBidEnd($value)
	{
		$this->data['bid_end'] = $value;
	}

	public function getBidEnd()
	{
		return $this->data['bid_end'];
	}

	public function setLastBid($value)
	{
		$this->data['last_bid'] = $value;
	}

	public function getLastBid()
	{
		return $this->data['last_bid'];
	}

	public function setHighestBidder($value)
	{
		$this->data['highest_bidder'] = $value;
	}

	public function getHighestBidder()
	{
		return $this->data['highest_bidder'];
	}
}
