<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Forms\LogFormType;
use App\Entity\Log;

class LogController extends AbstractController {

	private $submenu = [];

	/**
	 * 
	 * @param Request $request
	 * @Route("/log/new/{idf}", name="app_log_new")
	 */
	public function newLog($idf, Request $request) {
		$log = new Log();

		$user = $this->getUser();
		$ids = $user->getSelectStation();

		$station = $user->getStationFromId($ids);
		$folder = $station->getFolderFromId($idf);

		$form = $this->createForm(LogFormType::class, $log);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();

			$folder->addLog($log);

			$entityManager->persist($log);
			$entityManager->persist($folder);

			$entityManager->flush();

			$this->addFlash(
					'notice', 'Log byl úspěšně uložen!'
			);


			return $this->redirectToRoute('app_folder_show', ['id' => $folder->getId(), 'ids' => $station->getId()]);
		}

		return $this->render('log/new.html.twig', [
					'submenuItems' => $this->submenu,
					'ids' => $ids,
					'idf' => $idf,
					'form' => $form->createView(),
		]);
	}

	/**
	 * 
	 * @param Request $request
	 * @return type
	 * @Route("/log/new_ajax", name="app_log_newajax")
	 */
	public function newLogAjax(Request $request) {
		$status = 0;
		$message = "Začátek zpracování formuláře.";
		
		try {
		$log = new Log();

		$user = $this->getUser();
		$ids = $user->getSelectStation();


		$form = $this->createForm(LogFormType::class, $log);
		$form->handleRequest($request);
		
		$data = $form->getData();
		
		$idf = $request->get('log_form')['folderid'];
		$station = $user->getStationFromId($ids);
		$folder = $station->getFolderFromId( $idf );
		

			$entityManager = $this->getDoctrine()->getManager();

			$folder->addLog($log);

			$entityManager->persist($log);
			$entityManager->persist($folder);

			$entityManager->flush();


			$status = 1;
			$message = "Log (".$log->getId().") byl v pořádku uložen.";
			
			$template = $this->renderView('log/row.html.twig', [ 'log' => $data ] );
			
		}
		catch (\Exception $Chyba)
		{
			$status = 0;
			$message = "Log nebyl uložen!<br/>" . $Chyba->getMessage();
		}
		catch (\Symfony\Component\Routing\Exception\InvalidParameterException $Chyba)
		{
			$status = 0;
			$message = "Log nebyl uložen!<br/>" . $Chyba->getMessage();
		}
		
		$template = $this->renderView('log/row.html.twig', [ 'log' => $data ] );
  	return new JsonResponse(array('status' => $status, 'message' => $message, 'row' => $template) );
	}

	/**
	 * @Route("/log/test")
	 */
	public function Test()
	{
		$data = new Log();
		$data->setLogRemarks("poznámka");
		return $this->render('log/row.html.twig', [ 'log' => $data ] );
		
	}


	/**
	 * @Route("/log/del_ajax", name="app_log_delajax")
	 */
	public function deleteAjaxAction(Request $request) {
		
		try {
			$repository = $this->getDoctrine()->getRepository(\App\Entity\Log::class);

			$id = $request->request->get('id');

			$log = $repository->find($id);
			if (!$log) {
				$status = 0;
				$message = 'log nebyl nalezen!';
				
				throw new \Exception($message);
			}
			$folder = $log->getFolder();

			$folder->removeLog($log);
			$entityManager = $this->getDoctrine()->getManager();

			$entityManager->remove($log);
			$entityManager->flush();

			$message = 'Log byl smazán!';
			$status = 1;
		} catch (\Exception $Chyba) {
			$status = 0;
			$message = 'Log nebyl smazán z důvodu:<br>' . $Chyba->getMessage();
		}

		if ($request->isXMLHttpRequest()) {
			return new JsonResponse(array('status' => $status, 'data' => $id, 'message' => $message));
		}
	}

	/**
	 * 
	 * @param integer $id
	 * @Route("/log/delete/{id}", name="app_log_delete")
	 */
	public function deleteAction($id, Request $request) {
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Log::class);

		$log = $repository->find($id);
		if (!$log) {
			throw $this->createNotFoundException(
					'Log (' . $id . ') nebylo nalezeno!'
			);
		}
		$folder = $log->getFolder();

		$folder->removeLog($log);
		$entityManager = $this->getDoctrine()->getManager();

		$entityManager->remove($log);
		$entityManager->flush();

		if ($request->isXMLHttpRequest()) {
			return new JsonResponse(array('data' => 'this is a json response'));
		}

		return $this->redirectToRoute('app_folder_show', ['id' => $folder->getId()]);
	}

	/**
	 * @Route("/log/edit/{id}", name="app_log_edit")
	 */
	public function editLogRender($id, Request $request) {
		$status = 1;
		$message = "probíhá zpracování";
		
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Log::class);

		$log = $repository->find($id);

		$user = $this->getUser();
		$ids = $user->getSelectStation();

		$station = $user->getStationFromId($ids);
		$folder = $station->getFolderFromId($log->getFolderId());

		$form = $this->createForm(LogFormType::class, $log);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();

			$entityManager->persist($log);

			$entityManager->flush();

			return $this->redirectToRoute('app_folder_show', ['id' => $folder->getId()]);
		}



		if ($request->isXMLHttpRequest()) {
			$twig_form = $this->renderView('log/row.html.twig', [ 'log' => $data ] );
			return new JsonResponse(array('status' => $status, 'data' => $id, 'message' => $message, 'twig_form' => $twig_form));
		}
		return $this->render('log/edit.html.twig', [
					'submenuItems' => $this->submenu,
					'ids' => $ids,
					'idf' => $folder->getId(),
					'form' => $form->createView(),
		]);
	}
	
	/**
	 * @Route("/log/edit", name="app_log_edit_ajax")
	 */
	public function editLogAjaxRender(Request $request) {
		$status = 1;
		$message = "probíhá zpracování";
		$id = $request->request->get('id');
		
		try {
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Log::class);

		if ($id > 0)
			$log = $repository->find($id);
		else
		{
			//$log = new \App\Entity\Log();
		}

		
		$user = $this->getUser();
		$ids = $user->getSelectStation();

		$station = $user->getStationFromId($ids);
		$folder = $station->getFolderFromId($log->getFolderId());


		$form = $this->createForm(LogFormType::class, $log);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$message = "probíhá zpracování 290";
			$entityManager = $this->getDoctrine()->getManager();

			$entityManager->persist($log);

			$entityManager->flush();

			$status = 2;
			$message = "Log byl uložen";

			if ($request->isXMLHttpRequest()) {
				$twig_form = $this->renderView('log/form.html.twig', [ 'form' => $form->createView() ] );
				$template = $this->renderView('log/row.html.twig', [ 'log' => $log ] );
				return new JsonResponse(array('status' => $status, 'data' => $id, 'message' => $message, 'twig_form' => $twig_form, 'row' => $template));
			}
			
		}
		elseif($form->isSubmitted())
			$message = "probíhá zpracování 290 -> submitted: " . $form->isSubmitted() . " valid: ". $form->isValid() . " errors: ". $form->getErrors();



		if ($request->isXMLHttpRequest()) {
			$twig_form = $this->renderView('log/form.html.twig', [ 'form' => $form->createView() ] );
			return new JsonResponse(array('status' => $status, 'data' => $id, 'message' => $message, 'twig_form' => $twig_form));
		}
		return $this->render('log/edit.html.twig', [
					'submenuItems' => $this->submenu,
					'ids' => $ids,
					'idf' => $folder->getId(),
					'form' => $form->createView(),
		]);
		}
		catch(\Exception $Chyba)
		{
			return new JsonResponse(array('status' => 0, 'data' => $id, 'message' => "Chyba - " . $Chyba->getMessage() ));
		}
	}

}
