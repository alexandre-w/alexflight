<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Flight;
use AppBundle\Form\CityType;

class FlightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('flyingFrom', EntityType::class, array (
                  'class'         => 'AppBundle:City',
                  'choice_label'  => 'name',
                  'multiple'      => false,
                ))
                ->add('flyingTo', EntityType::class, array(
                  'class'         => 'AppBundle:City',
                  'choice_label'  => 'name',
                  'multiple'      => false,
                ))
                ->add('departingDate', DateType::class,
                      array('widget' => 'single_text' ,
                             ))
                ->add('seatsLeft', TextType::class)
                ->add('flightNumber', TextType::class)
                ->add('create', SubmitType::class,
                      array('label' => 'Create a flight',
                      'attr' => ['class' => 'btn btn-lg btn-info btn-block']
                      ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Flight::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_flight';
    }


}
