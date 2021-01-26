<?php


namespace App\Controller;

use App\Entity\FindBar;
use App\Entity\JobPost;
use App\Entity\Requests;
use App\Event\EnrollEvent;
use App\Form\FindBarType;
use App\Form\JobPostType;
use App\Repository\AlertRepository;
use App\Repository\CompanyRepository;
use App\Repository\JobPostRepository;
use App\Repository\JobSeekerRepository;
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

        $hasEnrolled = false;
        if (isset($_GET['hasEnrolled'])) {
            $hasEnrolled = $_GET['hasEnrolled'];
        }
        return $this->render('employer-zone/homepage.html.twig', [
            'alertArr' => $alerts,
            'counter' => $counter,
            'hasEnrolled' => $hasEnrolled
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

            $name = $user->getCompanies()->getCompanyName();

            $jobPost->setEmployerName($name);
            $company = $user->getCompanies()->addJobPost($jobPost);
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
            'alertArr' => $alerts,
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
                'alertArr' => $alerts
            ]);
        }

        return $this->render('employer-zone/search.html.twig', [
            'form' => $form->createView(),
            'alertArr' => $alerts,
            'counter' => $counter
        ]);
    }

    /**
     * @Route("/seeker/{token}")
     * @param JobSeekerRepository $seekerRepository
     * @param $token
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function seeker(JobSeekerRepository $seekerRepository, $token, AlertRepository $alertRepository): Response
    {
        $jobSeeker = $seekerRepository->findOneBy([
            'id' => $token
        ]);


        $user = $this->getUser();
        $userId = $user->getId();

        $alerts = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alerts as $value) {
            $counter++;
        }


        return $this->render('employer-zone/seeker.html.twig', [
            'jobseeker' => $jobSeeker,
            'counter' => $counter,
            'alertArr' => $alerts
        ]);
    }

    /**
     * @Route("/enroll/{token}")
     * @param $token
     * @param EventDispatcherInterface $eventDispatcher
     * @param JobPostRepository $jobPostRepository
     * @param CompanyRepository $companyRepository
     * @param UserRepository $userRepository
     * @param RequestsRepository $requestsRepository
     * @param JobSeekerRepository $seekerRepository
     * @return Response
     */
    public function enroll($token, EventDispatcherInterface $eventDispatcher, JobPostRepository $jobPostRepository, CompanyRepository $companyRepository, UserRepository $userRepository, RequestsRepository $requestsRepository, JobSeekerRepository $seekerRepository): Response
    {
        // Alert the job seeker
        $jobSeeker = $seekerRepository->findOneBy([
            'id' => $token
        ]);
        $user = $jobSeeker->getUsers();
        $user = $user[0];

        $eventDispatcher->dispatch(new EnrollEvent($user));

        //Register in the database
        $request = new Requests();
        $date = new DateTime("NOW");

        $request->setUser($this->getUser());
        $request->setJobSeeker($jobSeeker);
        $request->setStatus('Pending');
        $request->setPublishedAt($date);

        $title = 'Recruit of ' . $jobSeeker->getFirstName();

        $request->setTitle($title);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($request);
        $entityManager->flush();

        $hasEnrolled = true;

        return $this->redirectToRoute('app_em', [
            'hasEnrolled' => $hasEnrolled
        ]);
    }
}