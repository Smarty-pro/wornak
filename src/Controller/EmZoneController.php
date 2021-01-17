<?php


namespace App\Controller;

use App\Entity\FindBar;
use App\Entity\JobPost;
use App\Form\FindBarType;
use App\Form\JobPostType;
use App\Repository\AlertRepository;
use App\Repository\JobSeekerRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function home(AlertRepository $alertRepository): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }

        return $this->render('employer-zone/homepage.html.twig', [
            'alerts' => $alerts,
            'counter' => $counter
        ]);
    }

    /**
     * @Route("/jobpost", name="app_jobpost_em")
     * @param Request $request
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function jobPost(Request $request, AlertRepository $alertRepository): Response
    {
        $user = $this->getUser();
        $jobPost = new JobPost();
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $jobPost->setUid(uniqid("job"));
            $company = $user->getCompanies()->getCompanyName();
            $jobPost->setCompany($company);
            $date = new DateTime('NOW');
            $jobPost->setPublishedAt($date);

            $entityManager->persist($jobPost);
            $entityManager->flush();
        }

        $user = $this->getUser();
        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }

        return $this->render('employer-zone/jobpostForm.html.twig', [
            'form' => $form->createView(),
            'alerts' => $alerts,
            'counter' => $counter
        ]);
    }

    /**
     * @Route("/search-em", name="app_search_em")
     * @param JobSeekerRepository $repository
     * @param Request $request
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function search(JobSeekerRepository $repository, Request $request, AlertRepository $alertRepository): Response
    {
        $search = new FindBar();
        $form = $this->createForm(FindBarType::class, $search);
        $form->handleRequest($request);
        $jobSeekers = $repository->findAll();

        $user = $this->getUser();
        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $location = $search->getLocation();
            $studyLevel = $search->getStudyLevel();
            $training = $search->getTraining();
            dump($search);

            $jobSeekers = $repository->findLike($location, $training, $studyLevel);


            return $this->render('employer-zone/results.html.twig', [
                'jobseekers' => $jobSeekers,
                'counter' => $counter,
                'alerts' => $alerts
            ]);
        }

        return $this->render('employer-zone/search.html.twig', [
            'form' => $form->createView(),
            'alerts' => $alerts,
            'counter' => $counter
        ]);
    }

    /**
     * @Route("/alerts/{token}")
     * @param $token
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function alert($token, AlertRepository $alertRepository): Response
    {
        $alert = null;
        $alertArr = null;
        if (isset($token) && $token != 'all') {
            $alert = $alertRepository->findOneBy([
                'uid' => $token
            ]);
        } else {
            $userId = $this->getUser()->getId();

            $alertArr = $alertRepository->findBy([
                'user' => $userId
            ]);
        }

        $user = $this->getUser();
        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }

        return $this->render('employer-zone/alerts.html.twig', [
            'alert' => $alert,
            'alertArr' => $alertArr,
            'alerts' => $alerts,
            'counter' => $counter
        ]);
    }
}