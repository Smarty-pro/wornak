<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('test@test.test');
            $user->setTel('000');

            $encoded = $this->encoder->encodePassword($user, 'test');

            $user->setPassword($encoded);
            $user->setUuid(uniqid("user"));
            $user->setIsVerified(false);
            /*
            $seeker = new JobSeeker();
            $seeker->setFirstName('test'. $i);
            $seeker->setLastName('test'.$i);

            if (mt_rand(0,1) == 0) {
                $gender = 'male';
            } else {
                $gender = 'female';
            }

            $seeker->setGender($gender);

            $date = new DateTime();

            $seeker->setBirthdayDate($date);
            $seeker->setAddress('Los Angeles');
            $seeker->setMobility('international');
            $seeker->setHandicap(false);
            $seeker->setDiploma('High School Certificate');
            $seeker->setSkills('');
            $seeker->setStudyLevel('Bac');

            $user->setJobseeker($seeker);
            */
            $company = new Company();

            $company->setCompanyName('company' . $i);
            $company->setEmployeesNumber('0-100');
            $company->setDescription(' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula nisi. Aliquam turpis est, bibendum vehicula elit nec, ornare. ');

            $user->setCompanies($company);

            $manager->persist($user);
            $manager->persist($company);

            // $manager->persist($seeker);

        }

        $manager->flush();
    }
}
