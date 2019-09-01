<?php
namespace App\Controller;

use App\Entity\User;
use App\Forms\RegistrationFormType;
use App\Security\StubAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
			$roles = ['user'];
			
			$user->setRoles($roles);
			// encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirect('app_homepage');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
	
	/**
	 * 
	 * @Route("/user", name="app_useredit")
	 * @param Request $request
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @return Response
	 */
	public function editor(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
	{
		$form = $this->createForm(RegistrationFormType::class, $this->getUser() );
		$form->handleRequest($request);
		
		return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
		
	}
}

