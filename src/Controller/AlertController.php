<?php


namespace App\Controller;


use App\Repository\AlertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlertController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
class AlertController extends AbstractController
{
    /**
     * @Route("/alerts/{slug}")
     * @param $slug
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function index($slug, AlertRepository $alertRepository): Response
    {
        $alert = null;
        $alertArr = null;
        $env = $this->getUser()->getRoles();


        if (isset($slug) && $slug != 'all') {
            $alert = $alertRepository->findOneBy([
                'uid' => $slug
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

        if ($env[0] == 'ROLE_EM') {
            return $this->render('employer-zone/alerts.html.twig', [
                'alert' => $alert,
                'alertArr' => $alertArr,
                'alerts' => $alerts,
                'counter' => $counter
            ]);
        } elseif ($env[0] == 'ROLE_JOS') {
            return $this->render('job-seeker-zone/alerts.html.twig', [
                'alert' => $alert,
                'alertArr' => $alertArr,
                'alerts' => $alerts,
                'counter' => $counter
            ]);
        }

        return $this->redirectToRoute('app_central_homepage');
    }
}