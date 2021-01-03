<?php


namespace App\Controller;


use App\Entity\SearchBar;
use App\Form\SearchBarType;
use App\Repository\JobPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JoSZoneController
 * @package App\Controller
 * @IsGranted("ROLE_JOS")
 */
class JoSZoneController extends AbstractController
{
    /**
     * @Route("/jos", name="app_jos")
     */
    public function home(): Response
    {
        return $this->render('job-seeker-zone/homepage.html.twig');
    }

    /**
     * @Route("/search-jos", name="app_search_jos")
     * @param JobPostRepository $repository
     * @param Request $request
     * @return Response
     */
    public function search(JobPostRepository $repository, Request $request): Response
    {
        $search = new SearchBar();
        $form = $this->createForm(SearchBarType::class, $search);
        $form->handleRequest($request);
        $jobposts = $repository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $valueToSearch = $search->getSearchContent();
            $jobposts = $repository->findLike($valueToSearch);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($search);
            $entityManager->flush();


        }

        return $this->render('job-seeker-zone/search.html.twig', [
            'jobposts' => $jobposts,
            'form' => $form->createView(),
        ]);
    }


}