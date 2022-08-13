<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom*'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom*'
            ])
            ->add('familyTypology', ChoiceType::class, [
                'label' => 'Typologie familiale',
                'choices' => array_flip(Person::HEAT)
                /*  'choices'  => [
                    'Homme seul' => 0,
                    'Femme seule' => 1,
                    'Couple sans enfants' => 2,
                    'Famille avec enfants' => 3
                ],*/
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'choice',
                'years' => range(date('Y') - 100, date('Y') + 5), // Lists 100 Years Before and 5 After
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de naissance'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
