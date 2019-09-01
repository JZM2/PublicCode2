<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component;

use App\Entity\Folder;
use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomepageController extends AbstractController
{
	private $submenu = [ '0' => ['name' => 'Nová stanice', 'link' => 'station_new', 'parameters' => [] ],];

	public function __construct()
	{

	}

	/**
	 * @Route("/", name="homepage")
	 */
	public function indexRender()
	{
		return $this->render('homepage/default.html.twig', ['submenuItems' => $this->submenu]);
	}
	
	
	/**
	* @Route("/stations", name="stations")
	*/
	public function stationsRender()
	{
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Station::class);

		/** @var \App\Entity\User $user */
		$user = $this->getUser();
		
		$stations = $user->getStations();
		
		//var_dump($stations);
		
		return $this->render('homepage/stations.html.twig', ['submenuItems' => $this->submenu, 'stations' => $stations /*$repository->findAll()*/ ]);
	}
	
	/**
	 * @Route("/station/new", name="station_new")
	 * **@IsGranted("ROLE_USER")
	 */
	public function newStationRender(Request $request)
	{
		//$this->denyAccessUnlessGranted('user');
		 
		// creates a task and gives it some dummy data for this example
        $station = new \App\Entity\Station();
		
		/** @var \App\Entity\User $user */
		$user = $this->getUser();
		
        //$task->setTask('Write a blog post');
        //$task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->CreateStationForm($station, $request);
		
		if ($form->isSubmitted() && $form->isValid()) {
	        $task = $form->getData();

			$user->addStation($station);
        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($user);
		 $entityManager->persist($station);
		 
         $entityManager->flush();

			return $this->redirectToRoute('homepage');
		}
		
        return $this->render('homepage/new.html.twig', [
            'form' => $form->createView(),
        ]);
	}
	
	/**
	 * 
	 * @Route("/station/edit/{id}", name="station_edit")
	 * @param type $id
	 */
	public function editStationRender($id, Request $request)
	{
		$station = new \App\Entity\Station();
		
		$repository = $this->getDoctrine()->getRepository(\App\Entity\Station::class);
		$station = $repository->find($id);
		
		$form = $this->CreateStationForm($station, $request);
		
		if ($form->isSubmitted() && $form->isValid()) {
	        $task = $form->getData();

			// ... perform some action, such as saving the task to the database
			// for example, if Task is a Doctrine entity, save it!
			$entityManager = $this->getDoctrine()->getManager();
			//$entityManager->persist($station);
			$entityManager->flush();

			return $this->redirectToRoute('homepage');
		}
		
		return $this->render('homepage/edit.html.twig', [
            'form' => $form->createView(),
        ]);
	}
	
	private function CreateStationForm(\App\Entity\Station $station, Request $request)
	{
		$form = $this->createFormBuilder($station)
            ->add('callsign', TextType::class, ['label' => 'volací znak', 'attr' => ['maxlength' => 10, 'size' => 10]])
			->add('operator', TextType::class, ['label' => 'operátor', 'attr' => ['maxlength' => 100, 'size' => 50]])
			->add('street', TextType::class, ['label' => 'ulice a č.p.', 'attr' => ['maxlength' => 100, 'size' => 50]])
			->add('postcode', TextType::class, ['label' => 'PSČ', 'attr' => ['maxlength' => 6, 'size' => 6]])
			->add('city', TextType::class, ['label' => 'Město', 'attr' => ['maxlength' => 100, 'size' => 50]])
			->add('echolink', TextType::class, ['label' => 'echolink', 'attr' => ['maxlength' => 6, 'size' => 7]])
			->add('telephone', TextType::class, ['label' => 'telefon', 'attr' => ['maxlength' => 20, 'size' => 20]])
            ->add('save', SubmitType::class, ['label' => 'Uložit stanici'])
            ->getForm();

		$form->handleRequest($request);
		return $form;
	}
}

?>