<?php
namespace App\Model\Storage;

abstract class AbstractRow
{
	protected $cells = Array();
	
	public function __construct(array $cells) {
		$this->cells = $cells;
	}
}

