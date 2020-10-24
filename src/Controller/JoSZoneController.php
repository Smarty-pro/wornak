<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\RgFormPartialType;
use App\Repository\JobPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SearchBar;
use App\Form\SearchBarType;

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
    public function home()
    {
        return $this->render('job-seeker-zone/homepage.html.twig');
    }

    /**
     * @Route("/search-jos", name="app_search_jos")
     * @param JobPostRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function search(JobPostRepository $repository, Request $request)
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