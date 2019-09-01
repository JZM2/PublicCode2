<?php

namespace App\Model\Storage;

class Table extends \App\Model\Storage\AbstractTable
{
	public function __construct($name, array $columns) {
		$this->commandSelect = "SELECT * FROM " . $name . " ";
		
		for ($i = 0 ; $i < count($columns); $i++)
		{
			$parametrs[$i] = "?";
		}
		
		$this->commandInsert = "INSERT INTO " . $name . " ( " . join(', ', $columns) . " ) VALUES (" . join(', ', $parametrs) . ")";
		
		$this->commandUpdate = "UPDATE " . $name . " SET " . join(' = ?, ', $columns) . " = ? WHERE " . $columns[0] . " = ?";
		
		$this->name = $name;
	}

	public function updateData() {
		;
	}
	
	public function fillData($where = '', $parameters = array(), $order = array() ) {
		
		if ($where > '')
			$sql = $this->commandSelect . " WHERE " . $where;
		else
			$sql = $this->commandSelect;
		
		$command = $this->connection->prepare($sql);
		$command->execute($parameters);
		
		$stations = $command->fetchAll();
		
		foreach ($stations as $station)
		{
			$this->addRow($station);
		}
		
	}
}

