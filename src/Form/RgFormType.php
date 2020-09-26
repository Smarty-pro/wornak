<?php 

namespace App\Form;

use App\Entity\JobSeeker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RgFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class) //check
            ->add('firstName', TextType::class) //check
            ->add('lastName', TextType::class) //check
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                ],
            ]) //check

            ->add('birthdayDate', BirthdayType::class) //check
            ->add('address', TextareaType::class) //check
            ->add('email', EmailType::class) //check
            ->add('tel', TelType::class) //check

            ->add('mobility', ChoiceType::class, [
                'choices' => [
                    'Local' => 'local',
                    'Regional' => 'regional',
                    'National' => 'national',
                    'International' => 'international',
                ],
            ])
            ->add('handicap', ChoiceType::class, [
                'choices' => [
                    'Yes' => 'true',
                    'No' => 'false',
                ],
            ])
            ->add('diploma', TextType::class) //check
            ->add('skills', TextareaType::class) //check

        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobSeeker::class,
        ]);
    }
}