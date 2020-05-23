<?php

namespace App\Controller;

use App\Entity\RdForm;
use App\Form\RdFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_central_homepage")
     * @param Request $request
     * @return Response
     */
	public function rdct(Request $request)
	{
        $rdform = new RdForm();
        $form = $this->createForm(RdFormType::class, $rdform);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($rdform);
        }
        return $this->render('redirect.html.twig', array(
            'form' => $form->createView(),
        ));
	}
}