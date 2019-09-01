<?php

//"mysql:host=$host;dbname=$name"

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component;

class TestController extends Controller
{
	private $submenu = ['submenuNewStation' => 'Nová stanice'];
	private $database;

	public function __construct()
	{
		$this->database = \App\Model\MysqlStorage::getInstance("mysql:host=localhost;dbname=erad2", "erad2", "1j9z8m1");
		
		$this->database->addTable(new \App\Model\Storage\Table(
				'Station',
				['id', 'callsign', 'operator', 'street', 'city', 'echolink', 'post_code', 'iota', 'cq', 'telephone']
				));
		
		$this->database->getTable("Station")->fillData('callsign = :callsign', [':callsign' => 'OK9JZM']);
	}

	/**
	* @Route("/test", name="test")
	*/
	public function indexRender()
	{

		$repository = $this->getDoctrine()->getRepository(\App\Entity\Station::class);
		$stations = $repository->findAll();
		
		
		return $this->render('test/default.html.twig', ['submenuItems' => $this->submenu, 'stations' => $stations , 'stations2' => $this->database->getTable("Station") ]);
	}
}