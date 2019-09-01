<?php

namespace App\Model;

use \PDO;

class MysqlStorage extends StorageAbstract
{
	public static function getInstance($connectionString, $username, $password)
	{
		try {
		$connection = new \PDO($connectionString, $username, $password);		
		
		$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		$instance = new self($connection);
		}
		catch (PDOException $Chyba)
		{
			echo "Chyba: " . $Chyba->getMessage();
		}
		return $instance;
	}

	public function getData()
	{
		
	}
	

}