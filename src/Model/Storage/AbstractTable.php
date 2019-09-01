<?php

namespace App\Model\Storage;

abstract class AbstractTable
{
	protected $rows = array();
	protected $columns = array();
	protected $name;
	
	protected $commandInsert;
	protected $commandUpdate;
	protected $commandDelete;
	protected $commandSelect;
	
	protected $connection;

	abstract public function __construct($name, array $columns);
	
	public function getRows()
	{
		return $this->rows;
	}
	
	public function getRowsCount()
	{
		return count($this->rows);
	}
	
	public function getRow($index)
	{
		return $this->rows[$index];
	}
	
	public function addRow($row)
	{
		$id = count($this->rows);
		if ($id < 0)
			$id = 0;
		$this->rows[$id] = $row;
	}
	
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getName()
	{
		return $this->name;
	}
	
	public function setInsert($command)
	{
		$this->commandInsert = $command;
	}
	
	public function getInsert()
	{
		return $this->commandInsert;
	}
	
	public function setSelect($command)
	{
		$this->commandSelect = $command;
	}
	
	public function getSelect()
	{
		return $this->commandSelect;
	}
	
	public function setUpdate($command)
	{
		$this->commandUpdate = $command;
	}
	
	public function getUpdate()
	{
		return $this->commandUpdate;
	}
	
	public function setDelete($command)
	{
		$this->commandDelete = $command;
	}
	
	public function getDelete($command)
	{
		return $this->commandDelete;
	}
	
	abstract public function updateData();
	abstract public function fillData($where = '', $parameters = array(), $order = array());
}