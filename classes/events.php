<?php
if (!defined('INITIALIZED'))
	exit;

class Events implements Iterator, Countable
{
	public $iterator = 0;
	/**
	 * @var array $groups
	 * @property Group $groups
	 */
	private $events = [];
	private $XML;
	private $count = 0;

	public function __construct($file)
	{
		$XML = new DOMDocument();
		if (!$XML->load($file)) {
			throw new InvalidArgumentException('events::__construct - cannot load file <b>' . htmlspecialchars($file) . '</b>');
		}
		$this->XML = $XML;

		foreach ($XML->getElementsByTagName('event') as $event) {
			$groupData = [];
			if ($event->hasAttribute('name')) {
				$count++;
				$groupData['id'] = $count;
				$groupData['name'] = $event->getAttribute('name');
				$groupData['description'] = $event->getAttribute('description');
				if ($event->hasAttribute('day')) {
					$diasemana = array('domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6, "todos" => 8);
					$groupData['day'] = $diasemana[$event->getAttribute('day')];
					$groupData['begin'] = $event->getAttribute('begin');
					$groupData['end'] = $event->getAttribute('end');
					$groupData['databegin'] = -1;
				} else {
					$groupData['databegin'] = $event->getAttribute('databegin');
					$groupData['dataend'] = $event->getAttribute('dataend');
					$groupData['day'] = 9;
				}
				if ($event->hasAttribute('isseasonal'))
					$groupData['isseasonal'] = ($event->getAttribute('isseasonal') == "1" ? true : false);
				else
					$groupData['isseasonal'] = false;

				if ($event->hasAttribute('colorlight'))
					$groupData['colorlight'] = $event->getAttribute('colorlight');
				else
					$groupData['colorlight'] = '#8B6D05';

				if ($event->hasAttribute('colordark'))
					$groupData['colordark'] = $event->getAttribute('colordark');
				else
					$groupData['colordark'] = '#735D10';

				$this->events[$groupData['id']] = new Event($groupData);
			} else
				throw new RuntimeException('#C Cannot load events. <b>name</b> parameter is missing');
		}
	}

	/*
	 * Get group
	*/

	public function getEventName($id)
	{
		$group = self::getEvent($id);
		if ($group) {
			return $group->getName();
		}

		return false;
	}

	/*
	 * Get group name without getting group
	*/

	public function getEvent($id)
	{
		if (isset($this->events[$id])) {
			return $this->events[$id];
		}

		return false;
	}

	public function current()
	{
		return $this->events[$this->iterator];
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
		return isset($this->events[$this->iterator]);
	}

	public function count()
	{
		return count($this->events);
	}
}
