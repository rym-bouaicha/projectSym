<?php

namespace App\Form;

use App\Entity\Rackvelo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RackveloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capacite')
            ->add('modele', choiceType::class ,  [
                    'choices'  => [
                        '1' => '1',
                        '2' => '2',
                        '3' =>  '3', ],])
            ->add('idStation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rackvelo::class,
        ]);
    }
}
