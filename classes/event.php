<?php
if (!defined('INITIALIZED'))
	exit;

class Event
{
	private $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function getId()
	{
		return $this->data['id'];
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function getDay()
	{
		return $this->data['day'];
	}

	public function getBeginTime($time)
	{
		if ($this->data['databegin'] == -1) {
			return strtotime(sprintf("%s %s", date('Y-m-d', $time), $this->data['begin']));
		} else {
			return strtotime($this->data['databegin']);
		}
	}
	public function getEndTime($time)
	{
		if ($this->data['databegin'] == -1) {
			return strtotime(sprintf("%s %s", date('Y-m-d', $time), $this->data['end']));
		} else {
			return strtotime($this->data['dataend']);
		}
	}


	public function getDescription()
	{
		return $this->data['description'];
	}

	public function isSeasonal()
	{
		return $this->data['isseasonal'];
	}
	public function getColorLight()
	{
		return $this->data['colorlight'];
	}
	public function getColorDark()
	{
		return $this->data['colordark'];
	}
}
