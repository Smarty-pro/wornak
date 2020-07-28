<?php

namespace App\Controller;

use App\Entity\CompanyContact;
use App\Entity\JobSeeker;
use App\Entity\User;
use App\Form\CompanyContactType;
use App\Form\RgFormPartialType;
use App\Repository\JobSeekerRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RgFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AccessController extends AbstractController
{
	/**
	*@Route("/registration/job-seeker", name="app_registration_job-seeker")
	*/
	public function func1()
	{
		// full registration or partial for job seeker
		return $this->render('REGISTRATION/pg0.html.twig');
	}

    /**
     * @Route("/registration/employer", name="app_registration_employer")
     * @return Response
     */
	public function func2()
    {
        return $this->render('REGISTRATION/pg2.html.twig');
    }

    /**
     * @Route("/registration/employer/company", name="app_registration_particular")
     */
	public function func3()
    {
        return $this->render('REGISTRATION/pg1.html.twig');
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param MailerInterface $mailer
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer)
    {
        if (isset($_GET['ch']) && $_GET['ch'] == 'JRF') {
            $rgform = new JobSeeker();
            $form = $this->createForm(RgFormType::class, $rgform);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $plainPassword =  $rgform->getPassword();
                $mail = $rgform->getEmail();
                $encoded = $encoder->encodePassword($rgform, $plainPassword);
                $rgform->setPassword($encoded);
                $rgform->setActivationToken(md5(uniqid()));
                $entityManager->persist($rgform);
                $entityManager->flush();

                $site = 'https://wornak.com';
                $link =  $site . $rgform->getActivationToken();
                $email = (new Email())
                    ->from( 'lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->redirectToRoute('app_access_thanks');
            }
            return $this->render('REGISTRATION/RgForm.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        if (isset($_GET['ch']) && $_GET['ch'] == 'CR') {
            $rgform = new CompanyContact();
            $form = $this->createForm(CompanyContactType::class, $rgform);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $rgform->setActivationToken(md5(uniqid()));
                $entityManager->persist($rgform);
                $entityManager->flush();
                $mail = $rgform->getEmail();

                $site = 'https://wornak.com';
                $link =  $site . $rgform->getActivationToken();
                $email = (new Email())
                    ->from( 'lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->redirectToRoute('app_access_thanks');
            }
            return $this->render('REGISTRATION/pg1.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        if (isset($_GET['ch']) && $_GET['ch'] == 'JRP') {
            $rgform = new User();
            $form = $this->createForm(RgFormPartialType::class, $rgform);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $plainPassword =  $rgform->getPassword();
                $mail = $rgform->getEmail();
                $encoded = $encoder->encodePassword($rgform, $plainPassword);
                $rgform->setPassword($encoded);
                $rgform->setActivationToken(md5(uniqid()));
                $entityManager->persist($rgform);
                $entityManager->flush();

                $site = 'https://wornak.com';
                $link =  $site . $rgform->getActivationToken();
                $email = (new Email())
                    ->from( 'lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->redirectToRoute('app_access_thanks');
            }
            return $this->render('REGISTRATION/RgFormPartial.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        if (isset($_GET['ch'])) {
            return $this->render('error.html.twig');
        }
        return $this->redirectToRoute('app_central_homepage');
    }

    /**
     * @Route("/verify/{token}", name="verification")
      * @param $token
     * @param JobSeekerRepository $jobSeeker
     * @return RedirectResponse
     */
    public function verify($token, JobSeekerRepository $jobSeeker)
    {
        $user = $jobSeeker->findOneBy(['activation_token' => $token]);

        if(!$user){
            // On renvoie une erreur 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur activé avec succès');


        return $this->redirectToRoute('app_central_homepage');
    }

    /**
     * @Route("/thanks")
     * @return Response
     */
    public function thanks()
    {
       return $this->render('REGISTRATION/thankyou.html.twig');
    }
}