<?php 

namespace App\Form;

use App\Entity\RgForm;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RgFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CIN', TextType::class) // check 
            ->add('password', PasswordType::class) //check
            ->add('fName', TextType::class) //check
            ->add('lName', TextType::class) //check
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Man' => 'man',
                    'Woman' => 'woman',
                ],
            ]) //check
            ->add('fSituation', ChoiceType::class, [
                'choices' => [
                    'Single' => 'single',
                    'Married' => 'married',
                    'Widower' => 'widower',
                ],
            ]) //check
            ->add('bDate', BirthdayType::class) //check
            ->add('adress', TextareaType::class) //check
            ->add('province', TextType::class) //check
            ->add('commune', TextType::class) //check
            ->add('email', EmailType::class) //check
            ->add('tel', TelType::class) //check
            ->add('aSituation', ChoiceType::class, [
                'choices' => [
                    'With job' => 'with job',
                    'Without job' => 'without job',
                ],
            ]) //check
            ->add('joblessness', DateType::class)
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
            ->add('handicapNature', ChoiceType::class, [
                'choices' => [
                    'Blinded' => 'blinded',
                    'Engine' => 'engine',
                    'Deaf/Mute' => 'deaf/mute',
                    'Mental' => 'mental',
                ],
            ])
            ->add('diplomaType', TextType::class) //check
            ->add('speciality', TextType::class) //check
            ->add('options', TextType::class) //check
            ->add('estabGroup', TextType::class) //check 
            ->add('establissement', TextType::class) //check
            ->add('obtentionYear', DateType::class) //check
            ->add('commentary', TextareaType::class) //check
            ->add('dateDebut', DateType::class) //check
            ->add('dateEnd', DateType::class) //check
            ->add('enterprise', TextType::class) //check
            ->add('jobTitle', TextType::class) //check
            ->add('description', TextareaType::class) //check
            ->add('language', TextareaType::class) //check
            ->add('skills', TextareaType::class) //check
            ->add('liscence', TextType::class) //check
            ->add('activity', TextType::class) //check
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RgForm::class,
        ]);
    }
}