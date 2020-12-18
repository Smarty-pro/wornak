<?php

namespace App\Form;

use App\Entity\JobPost;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jobTitle', TextType::class)
            ->add('description', TextType::class)
            ->add('jobZone', TextType::class)
            ->add('training', TextType::class)
            ->add('contractType', TextType::class)
            ->add('tags', CheckboxType::class)
            ->add('expDate', DateTimeType::class)
            ->add('salary', MoneyType::class)
            ->add('sector', ChoiceType::class)
            ->add('studyLevelRequired', ChoiceType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobPost::class,
        ]);
    }
}
