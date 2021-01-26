<?php


namespace App\Controller;


use App\Repository\AlertRepository;
use App\Repository\RequestsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OfferController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/offers/{token}")
     * @param $token
     * @param RequestsRepository $repository
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function index($token, RequestsRepository $repository, AlertRepository $alertRepository): Response
    {
        $user = $this->getUser();
        $offers = null;
        $env = $this->getUser()->getRoles();

        $userId = $user->getId();

        $alertArr = $alertRepository->findBy([
            'user' => $userId
        ], null, '3');

        $counter = 0;
        foreach ($alertArr as $value) {
            $counter++;
        }


        if ($env[0] == 'ROLE_EM') {

            $company = $this->getUser()->getCompanies();

            if ($token == 'current') {

                $offers = $repository->findBy([
                    'company' => $company
                ]);


            } elseif ($token == 'archived') {

                $offers = $repository->findBy([
                    'company' => $company,
                    'status' => 'Archived'
                ]);
            }

            return $this->render('employer-zone/offers.html.twig', [
                'offers' => $offers,
                'alertArr' => $alertArr,
                'counter' => $counter
            ]);
        } elseif ($env[0] == 'ROLE_JOS') {

            $jobSeeker = $user->getJobseeker();

            if ($token == 'current') {

                $offers = $repository->findBy([
                    'jobSeeker' => $jobSeeker
                ]);

            } elseif ($token == 'archived') {

                $offers = $repository->findBy([
                    'jobSeeker' => $jobSeeker,
                    'status' => 'Archived'
                ]);

            }

            return $this->render('job-seeker-zone/offers.html.twig', [
                'offers' => $offers,
                'alertArr' => $alertArr,
                'counter' => $counter
            ]);
        }
        return $this->redirectToRoute('app_central_homepage');
    }
}