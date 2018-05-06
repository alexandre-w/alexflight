<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Flight;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Booking;

class FlightController extends Controller
{

    /**
     * @Route("/flight", name="flight")
     */
    public function searchFlight(Request $request)
    {

      $data['flight'] = [] ;
      $nbrPassengers = 0 ;

      $form = $this   ->createFormBuilder()
                      ->add('flyingFrom', TextType::class)
                      ->add('flyingTo', TextType::class)
                      ->add('departing', DateType::class)
                      ->add('passengers', ChoiceType::class, array(
                        'choices' => array('1' => 1, '2' => 2 , '3' => 3)
                    ))
                      ->add('search' , SubmitType::class, array('label'=>'Search flights'))
                      ->getForm();

      $form->handleRequest( $request );

      if( $form->isSubmitted() && $form->isValid() )
      {
          $form_data = $form->getData();
          $repo = $this->getDoctrine()->getRepository(Flight::class);

          $flights = $repo->getAvailableFlights($form_data['departing'],
                                                    $form_data['flyingFrom'],
                                                    $form_data['flyingTo'],
                                                    $form_data['passengers']);

          $nbrPassengers = $form_data['passengers'] ;

          if (empty($flights)) {
            $this->addFlash('warning', 'No flights found !');
          }


      } else {

          $flights = [] ;
      }



      return $this->render("flight/form.html.twig", array(
        'form' => $form->createView(),
        'foundFlights' => $flights,
        'passengers' => $nbrPassengers,
      ));

    }


    /**
    * @Route("/createflight", name="createflight")
    * @Security("is_granted('ROLE_ADMIN')")
    */
    public function createFlight(Request $request){

      $flight = new Flight();

      $form= $this  ->createFormBuilder()
                    ->add('flyingFrom')
                    ->add('flyingTo')
                    ->add('departing', DateType::class)
                    ->add('seatsLeft')
                    ->add('flightNumber')
                    ->add('create' , SubmitType::class, array('label'=>'create flight'))
                    ->getForm();


      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $form_data = $form->getData();

        $em = $this->getDoctrine()->getManager();

        $flight->setFlyingFrom($form_data['flyingFrom']);
        $flight->setFlyingTo($form_data['flyingTo']);
        $flight->setDepartingDate($form_data['departing']);
        $flight->setSeatsLeft($form_data['seatsLeft']);
        $flight->setFlightNumber($form_data['flightNumber']);

        $em->persist($flight);
        $em->flush();

      }


      return $this->render("flight/createflight.html.twig", array(
        'form' => $form->createView(),
        'flightCreated' => $flight
      ));
    }

    /**
    * @Route("/manageFlight", name="manageFlight")
    * @Security("is_granted('ROLE_USER')")
    */
    public function manageFlight(Request $request){

      $user = $this->container->get('security.token_storage')->getToken()->getUser();
      $repo = $this->getDoctrine()->getRepository(Flight::class);

      $bookings = $repo->getAllBookingsPerCustomer($user->getId());


      return $this->render("flight/manageflight.html.twig", array(
        'customerBookings' => $bookings
      ));
    }
}
