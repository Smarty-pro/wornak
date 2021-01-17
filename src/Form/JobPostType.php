<?php

namespace App\Form;

use App\Entity\JobPost;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('expDate', DateTimeType::class)
            ->add('salary', MoneyType::class)
            ->add('sector', ChoiceType::class, [
                'choices' => [
                    'Community activities' => '01',
                    'Activities of households as employers of domestic personnel' => '02',
                    'Extra-territorial activities' => '03',
                    'Real estate activities' => '04',
                    'Recreational, cultural and sporting activities' => '05',
                    'Public administration' => '06',
                    'Agriculture, hunting' => '07',
                    'Sanitation, roads and waste management' => '08',
                    'Insurance' => '09',
                    'Other' => '10',
                    'Other extractive industries' => '11',
                    'Financial and insurance auxiliaries' => '12',
                    'Water collection, treatment and distribution' => '13',
                    'Coking, refining, nuclear industries' => '14',
                    'Retail sale and repair of household goods' => '15',
                    'Wholesale trade and trade intermediaries' => '16',
                    'Automobile trade and repair' => '17',
                    'IT systems consulting' => '18',
                    'Construction' => '19',
                    'Publishing, printing, reproduction' => '20',
                    'Education' => '21',
                    'Hydrocarbon extraction' => '22',
                    'Coal, lignite and peat extraction' => '23',
                    'Extraction, exploitation and enrichment of metallic ores' => '24',
                    'Manufacture of other transport equipment' => '25',
                    'Manufacture of other non-metallic mineral products' => '26',
                    'Manufacture of medical, precision optical and watchmaking instruments' => '27',
                    'Manufacture of Radio, Television and Communication equipment' => '28',
                    'Manufacture of office machinery and computer equipment' => '29',
                    'Manufacture of electrical machinery and equipment' => '30',
                    'Manufacture of machinery and equipment' => '31',
                    'Furniture manufacturing, various industries' => '32',
                    'Hotels and restaurants' => '33',
                    'Automobile industry' => '34',
                    'Chemical industry' => '35',
                    'Clothing and fur industry' => '36',
                    'Tobacco Industry' => '37',
                    'Rubber and plastics industry' => '38',
                    'Leather and shoe industry' => '39',
                    'Paper and cardboard industry' => '40',
                    'Textile industry' => '41',
                    'Food industries' => '42',
                    'Financial intermediation' => '43',
                    'Rental without operator' => '44',
                    'Metallurgy' => '45',
                    'Post and telecommunications' => '46',
                    'Production and distribution of electricity, gas and heat' => '47',
                    'Fishing, aquaculture' => '48',
                    'Research and development' => '49',
                    'Recovery' => '50',
                    'Health and social work' => '51',
                    'Auxiliary transport services' => '52',
                    'Domestic services' => '53',
                    'Services provided mainly to businesses' => '54',
                    'Personal services' => '55',
                    'Silviculture, lumbering' => '56',
                    'Air transport' => '57',
                    'Water transport' => '58',
                    'Land transport' => '59',
                    'Metalwork' => '60',
                    'Woodworking and manufacture of wood products' => '61'
                ],
            ])
            ->add('studyLevelRequired', ChoiceType::class, [
                'choices' => [
                    'Bac' => 'Bac',
                    'Bac+2' => 'Bac+2',
                    'Bac+3' => 'Bac+3',
                    'Bac+4' => 'Bac+4',
                    'Bac+5' => 'Bac+5',
                    'Bac+8' => 'Bac+8',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobPost::class,
        ]);
    }
}
