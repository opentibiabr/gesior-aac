<?php
if (!defined('INITIALIZED'))
	exit;

class Groups implements Iterator, Countable
{
	public $iterator = 0;
	/**
	 * @var array $groups
	 * @property Group $groups
	 */
	private $groups = [];
	private $XML;

	public function __construct($file)
	{
		$XML = new DOMDocument();
		if (!$XML->load($file)) {
			throw new InvalidArgumentException('Cannot load file <b>' . htmlspecialchars($file) . '</b>');
		}
		$this->XML = $XML;

		foreach ($XML->getElementsByTagName('group') as $group) {
			$groupData = [];
			if ($group->hasAttribute('id') && $group->hasAttribute('name')) {
				$groupData['id'] = $group->getAttribute('id');
				$groupData['name'] = $group->getAttribute('name');
				$this->groups[$groupData['id']] = new Group($groupData);
			} else
				throw new RuntimeException('Cannot load group. <b>id</b> or/and <b>name</b> parameter is missing');
		}
	}

	/*
	 * Get group
	*/

	public function getGroupName($id)
	{
		$group = self::getGroup($id);
		if ($group) {
			return $group->getName();
		}

		return false;
	}

	/*
	 * Get group name without getting group
	*/

	public function getGroup($id)
	{
		if (isset($this->groups[$id])) {
			return $this->groups[$id];
		}

		return false;
	}

	public function current()
	{
		return $this->groups[$this->iterator];
	}

	public function rewind()
	{
		$this->iterator = 0;
	}

	public function next()
	{
		++$this->iterator;
	}

	public function key()
	{
		return $this->iterator;
	}

	public function valid()
	{
		return isset($this->groups[$this->iterator]);
	}

	public function count()
	{
		return count($this->groups);
	}
}
