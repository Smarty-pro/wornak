<?php


namespace App\Controller;

use App\Entity\JobPost;
use App\Form\JobPostType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('employer-zone/homepage.html.twig');
    }

    /**
     * @Route("/jobpost", name="app_jobpost_em")
     * @param Request $request
     * @return Response
     * @throws LogicException
     */
    public function jobPost(Request $request): Response
    {
        $user = $this->getUser();
        $jobPost = new JobPost();
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $jobPost->setReference(md5(uniqid()));
            $company = $user->getCompanies()->getCompanyName();
            $jobPost->setCompany($company);
            $date = new DateTime('NOW');
            $jobPost->setPublishedAt($date);

            $entityManager->persist($jobPost);
            $entityManager->flush();
            return $this->redirectToRoute('app_em');
        }

        return $this->render('employer-zone/jobpostForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function search(): Response
    {

    }
}