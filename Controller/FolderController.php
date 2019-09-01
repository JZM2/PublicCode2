<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Forms\FolderFormType;
use App\Entity\Station;
use App\Entity\Folder;
use App\Forms\LogFormType;
use App\Entity\Log;

class FolderController extends AbstractController
{
	private $submenu = [];

	private $ids = 0;
	
	private static $id_station;
	private $id_stat;
	
	private function generateSubmenu(): array
	{
		$this->submenu = [ 0 => ['name' => 'Nová složka', 'link' => 'app_folders_new', 'parameters' => [ 'ids' => 0] ]];
		
		return $this->submenu;
	}
	
	/**
	 * @Route("/folders/edit/{id}", name="app_folders_edit")
	 */
	public function editRender($id, Request $request)
	{
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Folder::class);
		
		/**
		 * @var App/Entity/Folder $folder
		 */
		$folder = $repository->find($id);
		
		$form = $this->createForm(FolderFormType::class, $folder);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
	        $task = $form->getData();
			
			$entityManager->persist($folder);
			$entityManager->flush();

			// ... perform some action, such as saving the task to the database
			// for example, if Task is a Doctrine entity, save it!
			//$entityManager = $this->getDoctrine()->getManager();
			//$entityManager->persist($station);
			//$entityManager->flush();

			return $this->redirectToRoute('app_folders');
		}
		
		return $this->render('folders/edit.html.twig', [
            'form' => $form->createView(),
			'ids' => $this->ids,
        ]);
	}
	
	/**
	 * @Route("/folders/new", name="app_folders_new")
	 */
	public function newRender(Request $request)
	{
		$user = $this->getUser();
	
		$entityManager = $this->getDoctrine()->getManager();
		$folder = new \App\Entity\Folder();
		$station = $entityManager->getRepository( Station::class )->find($user->getSelectStation() );
        //$task->setTask('Write a blog post');
        //$task->setDueDate(new \DateTime('tomorrow'));
		$folder->setStation( $station );

		$form = $this->createForm(FolderFormType::class, $folder);
		$form->handleRequest($request);
		
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$station->addFolder($folder);
			$entityManager->persist($folder);
			$entityManager->persist($station);
			
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_folders');
		}
		
		
		return $this->render('folders/new.html.twig', [
            'form' => $form->createView(),
			'id_station' => self::$id_station,
			'id_stat' => $this->id_stat,
        ]);
	}
	
	/**
	 * @Route("/folders/show/{id}", name="app_folder_show")
	 */
	public function logsShowRender(Folder $folder, Request $request)
	{
		$user = $this->getUser();
		$this->ids = $user->getSelectStation();
		
		$this->submenu = [ 
			0 => ['name' => 'Nová složka', 'link' => 'app_folders_new', 'parameters' => [] ],];
		
		$station = $user->getStationFromId($this->ids);
		
		if (!$station->isFolderInStation( $folder->getId() ))
			throw new \Exception('Složka není ve vybrané stanici, nebo nemáte do složky povolený přístup.');

		$logs = $this->getDoctrine()
				->getRepository(Log::class)
				->findOrderByNum( $folder->getId(), $station->getId() );
		//$folder = $station->getFolderFromId($id);
		
		//$folder = $station->getFolders()[$id];
		
		//$folder = $this->getDoctrine()->getRepository( Folder::class )->find($id);
		$log = new \App\Entity\Log();
		$form = $this->createForm(LogFormType::class, $log);
		$form->add('folderid', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class, ['data' => $folder->getId()]);
		
		
		return $this->render('folders/logs.html.twig', [
			'submenuItems' => $this->submenu,
			'station' => $station,
			'folder' => $folder,
			'logs' => $logs,
			'ids' => $this->ids,
			'idf' => $folder->getId(),
			'form' => $form->createView(),
				]);
	}
	
	/**
	 * @Route("/folders/{ids}", name="app_folders_ids")
	 */
	public function StationSetAction($ids, Request $request)
	{
		$this->submenu = [ 
			0 => ['name' => 'Nová složka', 'link' => 'app_folders_new', 'parameters' => ['ids' => $ids,] ] ];
		
		$this->ids = $ids;
		//$station = $this->getDoctrine()->getRepository( Station::class )->find($ids);
		
		//echo count($station->getFolder());
		
		$user = $this->getUser();
		
		
		$user->setConfig(['select_station' => $ids]);
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($user);
		$entityManager->flush();
		
		$station = $user->getStationFromId($this->ids);
		//$folder = $station->getFolders()[$id];
		
		return $this->redirectToRoute('app_folders');
		//return $this->render('folders/default.html.twig', ['submenuItems' => $this->submenu, 'station' => $station, 'ids' => $this->ids ]);
	}	
	/**
	 * @Route("/folders", name="app_folders")
	 */
	public function foldersShowRender()
	{
		$this->submenu = [ 
			0 => ['name' => 'Nová složka2', 'link' => 'app_folders_new', 'parameters' => [] ] ];
		
		
		//$station = $this->getDoctrine()->getRepository( Station::class )->find($ids);
		
		//echo count($station->getFolder());
		
		$user = $this->getUser();
		
		$this->ids = $user->getSelectStation();
		$station = $user->getStationFromId($this->ids);
		//$folder = $station->getFolders()[$id];
		
		
		return $this->render('folders/default.html.twig', ['submenuItems' => $this->submenu, 'station' => $station, 'ids' => $this->ids ]);
	}
	
	public function setIds($ids)
	{
		$this->ids = $ids;
	}
	
	public function getIds()
	{
		return $this->ids;
	}
}
