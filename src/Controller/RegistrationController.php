<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RgFormType;
use App\Entity\RgForm;

class RegistrationController extends AbstractController
{
	/**
	*@Route("/registration", name="app_registration")
	*/
	public function func1()
	{
		// job seeker or employer
		return $this->render('English/REGISTRATION/pg1.html.twig');
	}
	/**
	*@Route("/registration/employer", name="app_response1")
	*/
	public function func2()
	{
		// particular or company
		return $this->render('REGISTRATION/pg2.html.twig'); 
	}
	/**
	*@Route("/registration/job-seeker", name="app_response2")
	*/
	public function func3()
	{
		// full registration or partial for job seeker
		return $this->render('REGISTRATION/pg0.html.twig');
	}
	/**
	 * @Route("/registration/job-seeker/partial-registration", name="app_registration_partial")
	 */
	public function func4()
	{
		//rdct to partial registration form for job seeker
		return $this->render('REGISTRATION/pg3.html.twig');
	}

    /**
     * @Route("/registration/job-seeker/full-registration/", name="app_registration_full")
     * @param Request $request
     * @return Response
     */
	public function func6(Request $request)
	{
		$rgform = new RgForm();
		$form = $this->createForm(RgFormType::class, $rgform);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
		    dump($rgform);
		}
		return $this->render('REGISTRATION/RgForm.html.twig', array(
            'form' => $form->createView(),
        ));
	}
}