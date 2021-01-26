<?php


namespace App\Controller;


use App\Entity\Requests;
use App\Entity\SearchBar;
use App\Event\ApplicationEvent;
use App\Form\SearchBarType;
use App\Repository\AlertRepository;
use App\Repository\CompanyRepository;
use App\Repository\JobPostRepository;
use App\Repository\RequestsRepository;
use App\Repository\UserRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
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

        $hasApplied = false;
        if (isset($_GET['hasApplied'])) {
            $hasApplied = $_GET['hasApplied'];
        }
        return $this->render('job-seeker-zone/homepage.html.twig', [
            'alertArr' => $alerts,
            'counter' => $counter,
            'hasApplied' => $hasApplied
        ]);
    }

    /**
     * @Route("/search-jos", name="app_search_jos")
     * @param JobPostRepository $repository
     * @param Request $request
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function search(JobPostRepository $repository, Request $request, AlertRepository $alertRepository): Response
    {
        $search = new SearchBar();
        $form = $this->createForm(SearchBarType::class, $search);
        $form->handleRequest($request);

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

            $valueToSearch = $search->getSearchContent();
            $locationToSearch = $search->getLocation();

            $jobposts = $repository->findLike($valueToSearch, $locationToSearch);


            return $this->render('job-seeker-zone/results.html.twig', [
                'jobposts' => $jobposts,
                'counter' => $counter,
                'alertArr' => $alerts,
            ]);
        }

        return $this->render('job-seeker-zone/search.html.twig', [
            'form' => $form->createView(),
            'alertArr' => $alerts,
            'counter' => $counter
        ]);
    }

    /**
     * @Route("/job/{token}")
     * @param JobPostRepository $jobPostRepository
     * @param $token
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function job(JobPostRepository $jobPostRepository, $token, AlertRepository $alertRepository): Response
    {
        $jobPost = $jobPostRepository->findOneBy([
            'uid' => $token
        ]);
        //**************************************************

        // user's information
        $user = $this->getUser();
        $userInfo = $user->getJobSeeker();

        $address = $userInfo->getAddress();
        $mobility = $userInfo->getMobility();
        $skills = $userInfo->getMobility();
        $studyLevel = $userInfo->getStudyLevel();

        //job's information
        $jobZone = $jobPost->getJobZone();
        $training = $jobPost->getTraining();
        $studyLevelRequired = $jobPost->getStudyLevelRequired();

        //comparison
        $compatibility = 0;

        if ($address == $jobZone or $address != $jobZone and $mobility == 'national' or $mobility == 'international') {
            $compatibility++;
        }
        if ($skills == $training) {
            $compatibility++;
        }
        if ($studyLevel == $studyLevelRequired) {
            $compatibility++;
        }

        // transform compatibility value from a int to a percentage
        if ($compatibility == 1) {
            $compatibility = '33%';
        } elseif ($compatibility == 2) {
            $compatibility = '66%';
        } elseif ($compatibility == 3) {
            $compatibility = '100%';
        } elseif ($compatibility == 0) {
            $compatibility = '0%';
        }
        // dump($compatibility);


        //**************************************************


        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }


        return $this->render('job-seeker-zone/job.html.twig', [
            'jobpost' => $jobPost,
            'counter' => $counter,
            'alertArr' => $alerts,
            'compatibility' => $compatibility
        ]);
    }

    /**
     * @Route("/apply/{token}")
     * @param $token
     * @param EventDispatcherInterface $eventDispatcher
     * @param JobPostRepository $jobPostRepository
     * @param CompanyRepository $companyRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function apply($token, EventDispatcherInterface $eventDispatcher, JobPostRepository $jobPostRepository, CompanyRepository $companyRepository, UserRepository $userRepository, RequestsRepository $requestsRepository): Response
    {
        // Alert the company
        $jobpost = $jobPostRepository->findOneBy([
            'uid' => $token
        ]);

        $companyName = $jobpost->getEmployerName();

        $company = $companyRepository->findOneBy([
            'companyName' => $companyName
        ]);

        $companyId = $company->getId();

        $user = $userRepository->findOneBy([
            'companies' => $companyId
        ]);

        $eventDispatcher->dispatch(new ApplicationEvent($user));

        //Register in the database
        $request = new Requests();
        $date = new DateTime("NOW");

        $request->setUser($this->getUser());
        $request->setJobpost($jobpost);
        $request->setStatus('Pending');
        $request->setPublishedAt($date);

        $title = 'Application for ' . $jobpost->getJobTitle();

        $request->setTitle($title);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($request);
        $entityManager->flush();

        $hasApplied = true;

        return $this->redirectToRoute('app_jos', [
            'hasApplied' => $hasApplied
        ]);

    }
}