<?php

namespace App\Form;

use App\Entity\FindBar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FindBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('studyLevel', ChoiceType::class, [
                'choices' => [
                    'ALL' => '',
                    'Bac' => 'Bac',
                    'Bac+2' => 'Bac+2',
                    'Bac+3' => 'Bac+3',
                    'Bac+4' => 'Bac+4',
                    'Bac+5' => 'Bac+5',
                    'Bac+8' => 'Bac+8',
                ]
            ])
            ->add('training', TextType::class, [
                'empty_data' => ''
            ])
            ->add('location', TextType::class, [
                'empty_data' => ''
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FindBar::class,
        ]);
    }
}
