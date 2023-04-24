<?php

namespace App\Form;

use App\Entity\Station;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionResolver\OptionsResolverInterface ;

class StationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStation')
            ->add('longitude')
            ->add('latitude')
            ->add('gouvernorat' , choiceType::class , [
        'choices'  => [
            'Ariana Ville' => 'Ariana Ville',
            'Ettadhamen' => 'Ettadhamen',
            'Kalâat el-Andalous' =>  'Kalâat el-Andalous',
            'La Soukra' =>  'La Soukra',
            'Mnihla' =>  'Mnihla',
            'Raoued'=>  'Raoued',
            'Sidi Thabet' =>  'Sidi Thabet',

        ],
    ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Station::class,
            'cascade_validation' => true,
        ]);
    }




}
