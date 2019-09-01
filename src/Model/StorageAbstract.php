<?php

namespace App\Model;

abstract class StorageAbstract
{
	protected $connection;
	
	protected $tables = array();

	public function __construct($connection)
	{
		$this->connection = $connection;
		//$treeBuilder = new TreeBuilder('database');
		
		//var_dump($treeBuilder);
	}
	
	abstract public static function getInstance($connectionString, $username, $password);

	/**
	 * get table
	 * @param string $name name table
	 * @return \App\Model\Storage\Table return table
	 */
	public function getTable($name)
	{
		return $this->tables[$name];
	}
	
	/**
	 * function get array tables
	 * @return array
	 */
	public function getTables()
	{
		return $this->tables;
	}
	
	/**
	 * set table
	 * @return App\Model\Storage\AbstractTable Description
	 */
	public function addTable(\App\Model\Storage\Table $table)
	{
		$table->setConnection($this->connection);
		$this->tables[$table->getName()] = $table;
		return $this->tables[$table->getName()];
	}
	
	public function getStatus()
	{
		$this->connection;
	}

	/**
	* Function get data from data storage
	*/
	abstract public function getData();
}

?>