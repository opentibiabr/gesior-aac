<?php
if (!defined('INITIALIZED'))
	exit;

class PicPayPayment extends ObjectData
{
	const LOADTYPE_ID = 'id';
	public static $table = 'picpay_payment';
	public static $fields = array('id', 'account_id', 'account_name', 'item', 'coins', 'price', 'data', 'pid', 'status', 'cpf', 'firstname', 'lastname', 'email', 'phone', 'authorizationid');
	public $data = array('account_id' => 0, 'account_name' => NULL, 'item' => NULL, 'coins' => 0, 'price' => 0, 'data' => NULL, 'pid' => NULL, 'status' => NULL, 'cpf' => NULL, 'firstname' => '', 'lastname' => '', 'email' => '', 'phone' => NULL, 'authorizationid' => NULL);

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

		$this->data = $this->getDatabaseHandler()->query('SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $search_string)->fetch();
	}

	public function loadById($id)
	{
		$this->load($id, 'id');
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

			$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			$this->setID($this->getDatabaseHandler()->lastInsertId());
		} else {
			$updates = array();
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

	public function delete()
	{
		$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));

		unset($this->data['id']);
	}

	public function getID()
	{
		return $this->data['id'];
	}

	public function find($name)
	{
		$this->loadByName($name);
	}

	public function setAccount($value)
	{
		$this->data["account_id"] = $value;
	}
	public function getAccount()
	{
		return $this->data["account_id"];
	}
	public function setAccountName($value)
	{
		$this->data["account_name"] = $value;
	}
	public function getAccountName()
	{
		return $this->data["account_name"];
	}
	public function setProductID($value)
	{
		$this->data["pid"] = $value;
	}
	public function getProductID()
	{
		return $this->data["pid"];
	}
	public function setPrice($value)
	{
		$this->data["price"] = $value;
	}
	public function getPrice()
	{
		return $this->data["price"];
	}
	public function setCoins($value)
	{
		$this->data["coins"] = $value;
	}
	public function getCoins()
	{
		return $this->data["coins"];
	}
	public function setItem($value)
	{
		$this->data["item"] = $value;
	}
	public function getItem()
	{
		return $this->data["item"];
	}
	public function setfirstname($value)
	{
		$this->data["firstname"] = $value;
	}
	public function getfirstname()
	{
		return $this->data["firstname"];
	}
	public function setlastname($value)
	{
		$this->data["lastname"] = $value;
	}
	public function getlastname()
	{
		return $this->data["lastname"];
	}
	public function setCPF($value)
	{
		$this->data["cpf"] = $value;
	}
	public function getCPF()
	{
		return $this->data["cpf"];
	}
	public function setEMAIL($value)
	{
		$this->data["email"] = $value;
	}
	public function getEMAIL()
	{
		return $this->data["email"];
	}
	public function setPhone($value)
	{
		$this->data["phone"] = $value;
	}
	public function getPhone()
	{
		return $this->data["phone"];
	}
	public function setStatus($value)
	{
		$this->data["status"] = $value;
	}
	public function setStatus()
	{
		return $this->data["status"];
	}
	public function setAuthorizationid($value)
	{
		$this->data["authorizationid"] = $value;
	}
	public function getAuthorizationid()
	{
		return $this->data["authorizationid"];
	}
	public function setData()
	{
		$this->data["data"] = time();
	}
	public function getData()
	{
		return $this->data["data"];
	}
}
