<?php

namespace App\Controller;


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
        return $this->render('HOME/homepage.html.twig');
	}
}