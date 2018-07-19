<?php
if(!defined('INITIALIZED'))
	exit;

class GuildWar extends ObjectData
{
	const STATE_INVITED = 0;
	const STATE_ON_WAR = 1;
	const STATE_REJECTED = 2;
	const STATE_CANCELED = 3;
	const STATE_WAR_ENDED = 4;

	public static $table = 'guild_wars';
	public $data = array('guild_id' => null, 'name' => null, 'level' => null,);
	public static $fields = array('id', 'guild1', 'guild2', 'name1', 'name2', 'status', 'started', 'ended');

    public function __construct($warID = null)
    {
		if($warID != null)
			$this->load($warID);
    }

	public function load($id)
	{
		$fieldsArray = array();
		foreach(self::$fields as $fieldName)
			$fieldsArray[] = $this->getDatabaseHandler()->fieldName($fieldName);

		$this->data = $this->getDatabaseHandler()->query('SELECT ' . implode(', ', $fieldsArray) . ' FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($id))->fetch();
	}

	public function save($forceInsert = false)
	{
		if(!isset($this->data['id']) || $forceInsert)
		{
			$keys = array();
			$values = array();
			foreach(self::$fields as $key)
				if($key != 'id')
				{
					$keys[] = $this->getDatabaseHandler()->fieldName($key);
					$values[] = $this->getDatabaseHandler()->quote($this->data[$key]);
				}
			$this->getDatabaseHandler()->query('INSERT INTO ' . $this->getDatabaseHandler()->tableName(self::$table) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $values) . ')');
			$this->setID($this->getDatabaseHandler()->lastInsertId());
		}
		else
		{
			$updates = array();
			foreach(self::$fields as $key)
				$updates[] = $this->getDatabaseHandler()->fieldName($key) . ' = ' . $this->getDatabaseHandler()->quote($this->data[$key]);
			$this->getDatabaseHandler()->query('UPDATE ' . $this->getDatabaseHandler()->tableName(self::$table) . ' SET ' . implode(', ', $updates) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
		}
	}

	public function delete()
	{
		if($this->isLoaded())
		{
			$this->getDatabaseHandler()->query('DELETE FROM ' . $this->getDatabaseHandler()->tableName(self::$table) . ' WHERE ' . $this->getDatabaseHandler()->fieldName('id') . ' = ' . $this->getDatabaseHandler()->quote($this->data['id']));
			$_tmp = new self();
			$this->data = $_tmp->data;
			unset($_tmp);
		}
		else
			new Error_Critic('', __METHOD__ . '() - cannot delete, guild war not loaded');
	}

	public function getID(){return $this->data['id'];}
	public function setID($value){$this->data['id'] = $value;}
	public function getGuild1ID(){return $this->data['guild1'];}
	public function setGuild1ID($value){$this->data['guild1'] = $value;}
	public function getGuild2ID(){return $this->data['guild2'];}
	public function setGuild2ID($value){$this->data['guild2'] = $value;}
	public function getGuild1Name(){return $this->data['name1'];}
	public function setGuild1Name($value){$this->data['name1'] = $value;}
	public function getGuild2Name(){return $this->data['name2'];}
	public function setGuild2Name($value){$this->data['name2'] = $value;}
	public function getStatus(){return $this->data['status'];}
	public function setStatus($value){$this->data['status'] = $value;}
	public function getStarted(){return $this->data['started'];}
	public function setStarted($value){$this->data['started'] = $value;}
	public function getEnded(){return $this->data['ended'];}
	public function setEnded($value){$this->data['ended'] = $value;}
}