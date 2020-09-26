<?php

namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_central_homepage")
     * @return Response
     */
	public function homepage()
	{
        return $this->render('HOME/homepage.html.twig');
	}

    /**
     * @Route("/blog")
     */
	public function blog()
    {
        //TODO
        return $this->render('HOME/blog.html.twig');
    }
}