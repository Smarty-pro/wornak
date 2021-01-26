<?php


namespace App\Controller;


use App\Repository\AlertRepository;
use App\Repository\JobPostRepository;
use App\Repository\RequestsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RequestController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
class RequestController extends AbstractController
{
    /**
     * @Route("/requests/{token}")
     * @param $token
     * @param RequestsRepository $requestsRepository
     * @param JobPostRepository $jobPostRepository
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function index($token, RequestsRepository $requestsRepository, JobPostRepository $jobPostRepository, AlertRepository $alertRepository): Response
    {
        $user = $this->getUser();
        $requests = null;
        $env = $this->getUser()->getRoles();

        if ($token == 'pending') {
            $requests = $requestsRepository->findBy([
                'status' => 'pending',
                'user' => $user
            ]);
            $subtitle = 'Pending Requests';
        } elseif ($token == 'accepted') {
            $requests = $requestsRepository->findBy([
                'status' => 'accepted',
                'user' => $user
            ]);
            $subtitle = 'Accepted Requests';
        } elseif ($token == 'denied') {
            $requests = $requestsRepository->findBy([
                'status' => 'denied',
                'user' => $user
            ]);
            $subtitle = 'Denied Requests';
        }

        $userId = $user->getId();

        $alertArr = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alertArr as $value) {
            $counter++;
        }

        if ($env[0] == 'ROLE_EM') {
            return $this->render('employer-zone/requests.html.twig', [
                'requests' => $requests,
                'subtitle' => $subtitle,
                'alertArr' => $alertArr,
                'counter' => $counter
            ]);
        } elseif ($env[0] == 'ROLE_JOS') {
            return $this->render('job-seeker-zone/requests.html.twig', [
                'requests' => $requests,
                'subtitle' => $subtitle,
                'alertArr' => $alertArr,
                'counter' => $counter
            ]);
        }

        return $this->redirectToRoute('app_central_homepage');
    }
}