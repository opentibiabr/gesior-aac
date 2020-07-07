<?php
if (!defined('INITIALIZED'))
	exit;

class SQL_Order
{
	const ASC = 'ASC';
	const DESC = 'DESC';
	/** @var SQL_Order */
	public $field;
	public $order = self::ASC;

	public function __construct($field, $order = NULL)
	{
		$this->field = $field;
		if ($order !== NULL)
			$this->order = $order;
	}

	public function getField()
	{
		return $this->field;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function __toString()
	{
		return $this->field->__toString() . ' ' . $this->order;
	}
}
