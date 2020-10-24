<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\JobSeeker;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\RgFormPartialType;
use App\Repository\JobSeekerRepository;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route("/registration/job-seeker", name="app_registration_job-seeker")
     * @param JobSeekerRepository $repo
     * @return Response
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
     * @Route("/verify/{token}", name="verification")
     * @param $token
     * @param JobSeekerRepository $jobSeeker
     * @return RedirectResponse
     * @throws NotFoundHttpException
     */
    public function verify($token, JobSeekerRepository $jobSeeker)
    {
        $user = $jobSeeker->findOneBy(['activation_token' => $token]);


        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'User activated');


        return $this->redirectToRoute('app_central_homepage');
    }

    /**
     * @Route("/thanks")
     * @return Response
     */
    public function thanks()
    {
        return $this->render('/REGISTRATION/thank.html.twig');
    }

    /**
     * @Route("/redirect", name="app_redirect")
     * @param UserRepository $repo
     */
    public function rdct(UserRepository $repo)
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