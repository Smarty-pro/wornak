<?php


namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EmZoneController
 * @package App\Controller
 * @IsGranted("ROLE_EM")
 */
class EmZoneController extends AbstractController
{
    /**
     * @Route("/home-em", name="app_em")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('employer-zone/homepage.html.twig');
    }

    /**
     * @Route("/jobPost", name="app_jobpost_em")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function jobPost(Request $request)
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();
        }

        return $this->render('employer-zone/jobpostForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}