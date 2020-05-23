<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\RdForm;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RdFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('language',ChoiceType::class, [
            'choices' => [
                'English' => 'english',
                'Français' => 'français',
                'Hrvatski' => 'hrvatski',
                'IsiZulu' => 'isiZulu',
                'Kinyarwanda' => 'kinyarwanda',
                'Orang Malaysia' => 'orangMalaysia',
                'Português' => 'português',
                'shqiptar' => 'shqiptar',
                'Српски' => 'cрпски',
                'Точик' => 'tочик',
                'հայերեն' => 'հայերեն',
                'العربية' => 'العربية',
                'বাংলা' => 'বাংলা',
                'አማርኛ' => 'አማርኛ',
                'ខ្មែរ' => 'ខ្មែរ',
            ],
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {        $resolver->setDefaults([
        'data_class' => RdForm::class,
    ]);
    }
}