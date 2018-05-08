<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Flight;

class FlightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('flyingFrom', TextType::class)
                ->add('flyingTo', TextType::class)
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
