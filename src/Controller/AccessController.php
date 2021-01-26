<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\JobSeeker;
use App\Entity\User;
use App\Event\AccountActivatedEvent;
use App\Form\CompanyType;
use App\Form\RgFormPartialType;
use App\Form\RgFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccessController extends AbstractController
{
    /**
     * @Route("/register/job-seeker", name="app_registration_job-seeker")
     * @return Response
     */
    public function func1(): Response
    {

        // full registration or partial for job seeker
        return $this->render('REGISTRATION/pg0.html.twig');
    }

    /**
     * @Route("/register/employer", name="app_registration_employer")
     * @return Response
     */
    public function func2(): Response
    {
        return $this->render('REGISTRATION/pg3.html.twig');
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param MailerInterface $mailer
     * @param UserRepository $userRepository
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, MailerInterface $mailer, UserRepository $userRepository)
    {
        if (isset($_GET['ch']) && $_GET['ch'] == 'JRF') {
            $user = new User();
            $jobseeker = new JobSeeker();
            $UserForm = $this->createForm(RgFormPartialType::class, $user);
            $JobseekerForm = $this->createForm(RgFormType::class, $jobseeker);
            $JobseekerForm->handleRequest($request);
            $UserForm->handleRequest($request);


            if ($UserForm->isSubmitted() && $UserForm->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $plainPassword = $user->getPassword();
                $mail = $user->getEmail();
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);
                $user->setActivationToken(md5(uniqid()));
                $user->setUuid(uniqid());
                $user->setIsVerified(false);
                $login = $user->getUuid();
                setcookie('l0g14', $login, time() + 3600);

                //dd($user, $jobseeker);
                $entityManager->persist($user);
                $entityManager->flush();

                $site = 'https://wornak.com';
                $link = $site . $user->getActivationToken();
                $email = (new Email())
                    ->from('lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->render('REGISTRATION/RgForm.html.twig', array(
                    'form' => $JobseekerForm->createView(),
                ));
            }

            if ($JobseekerForm->isSubmitted() && $JobseekerForm->isValid() && isset($_COOKIE['l0g14'])) {
                $entityManager = $this->getDoctrine()->getManager();
                /*
                dump($_COOKIE['tempud']);
                dump($user);
                dump($jobseeker);
                dump($uuid);
                */
                $presentation = $jobseeker->getPresentation();

                if (!$presentation) {
                    $jobseeker->setPresentation('Hello, my name is ' . $jobseeker->getFirstName() . '. I am originally from ' . $jobseeker->getCountry() . ' and I currently live in ' . $jobseeker->getAddress() . '. My skills are ' . $jobseeker->getSkills() . '. I possess a ' . $jobseeker->getDiploma() . '.');
                }

                $entityManager->persist($jobseeker);
                $entityManager->flush();


                $user = $userRepository->findOneBy(array("uuid" => $_COOKIE['l0g14']));
                $user->setJobSeeker($jobseeker);

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_access_thanks');
            }

            return $this->render('REGISTRATION/RgFormPartial.html.twig', array(
                'UserForm' => $UserForm->createView(),
            ));
        }

        if (isset($_GET['ch']) && $_GET['ch'] == 'CR') {
            $user = new User();
            $company = new Company();
            $userForm = $this->createForm(RgFormPartialType::class, $user);
            $companyForm = $this->createForm(CompanyType::class, $company);
            $userForm->handleRequest($request);
            $companyForm->handleRequest($request);

            if ($userForm->isSubmitted() && $userForm->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $plainPassword = $user->getPassword();
                $mail = $user->getEmail();
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);
                $user->setActivationToken(md5(uniqid()));
                $user->setUuid(uniqid());
                $login = $user->getUuid();
                setcookie('l0g14', $login, time() + 3600);

                //dd($user, $jobseeker);
                $entityManager->persist($user);
                $entityManager->flush();

                $site = 'https://wornak.com';
                $link = $site . $user->getActivationToken();
                $email = (new Email())
                    ->from('lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->render('REGISTRATION/RgFormC.html.twig', array(
                    'form' => $companyForm->createView(),
                ));
            }

            if ($companyForm->isSubmitted() && $companyForm->isValid() && isset($_COOKIE['l0g14'])) {
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($company);
                $entityManager->flush();


                $user = $userRepository->findOneBy(array("uuid" => $_COOKIE['l0g14']));
                $user->setCompanies($company);

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_access_thanks');
            }
            return $this->render('REGISTRATION/RgFormPartial.html.twig', array(
                'UserForm' => $userForm->createView(),
            ));
        }

        if (isset($_GET['ch']) && $_GET['ch'] == 'JRP') {
            $user = new User();
            $form = $this->createForm(RgFormPartialType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $plainPassword = $user->getPassword();
                $mail = $user->getEmail();
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);
                $user->setActivationToken(md5(uniqid()));
                $user->setUuid(uniqid());
                $entityManager->persist($user);
                $entityManager->flush();

                $site = 'https://wornak.com';
                $link = $site . $user->getActivationToken();
                $email = (new Email())
                    ->from('lourhzaladnane@gmail.com')
                    ->to($mail)
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Welcome !')
                    ->text($link);

                $mailer->send($email);

                return $this->redirectToRoute('app_access_thanks');
            }
            return $this->render('REGISTRATION/RgFormPartial.html.twig', array(
                'UserForm' => $form->createView(),
            ));
        }

        if (isset($_GET['ch'])) {
            return $this->render('error.html.twig');
        }
        return $this->redirectToRoute('app_central_homepage');
    }

    /**
     * @Route("/verify/{token}", name="app_verify")
     * @param $token
     * @param UserRepository $repo
     * @param EventDispatcherInterface $eventDispatcher
     * @return RedirectResponse
     */
    public function verify($token, UserRepository $repo, EventDispatcherInterface $eventDispatcher): RedirectResponse
    {
        $user = $repo->findOneBy(['activationToken' => $token]);

        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $eventDispatcher->dispatch(new AccountActivatedEvent($user));

        return $this->redirectToRoute('app_central_homepage');
    }

    /**
     * @Route("/thanks")
     * @return Response
     */
    public function thanks(): Response
    {
        return $this->render('/REGISTRATION/thank.html.twig');
    }

    /**
     * @Route("/redirect", name="app_redirect")
     * @param UserRepository $repo
     * @return RedirectResponse
     */
    public function rdct(UserRepository $repo): RedirectResponse
    {
        $user = $repo->findOneBy(['uuid' => $_COOKIE['ud']]);
        $jobseeker = $user->getJobseeker();
        $company = $user->getCompanies();

        if ($user && $jobseeker) {
            return $this->redirectToRoute('app_jos');
        }

        if ($user && $company) {
            return $this->redirectToRoute('app_em');
        }
        return $this->redirectToRoute('app_login');
    }
}