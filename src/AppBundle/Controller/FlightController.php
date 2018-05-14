<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Flight;
use AppBundle\Form\FlightType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Booking;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FlightController extends Controller
{



    /**
     * @Route("/flight", name="flight")
     */
    public function searchAction(Request $request)
    {

      $data['flight'] = [] ;
      $nbrPassengers = 0 ;

      $form = $this   ->createFormBuilder()
                      ->add('flyingFrom', TextType::class)
                      ->add('flyingFromId', HiddenType::class)
                      ->add('flyingTo', TextType::class)
                      ->add('flyingToId', HiddenType::class)
                      ->add('departing', DateType::class , array('widget' => 'single_text'))
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
                                                    $form_data['flyingFromId'],
                                                    $form_data['flyingToId'],
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
    public function createAction(Request $request){

      $flight = new Flight();

      $form = $this->createForm(FlightType::class, $flight, [] );

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){

        $em = $this->getDoctrine()->getManager();

        $em->persist($flight);

        $em->flush();

        $this->addFlash('info', 'Flight Created : ' . $flight->getFlightNumber() );

      }


      return $this->render("flight/createflight.html.twig", array(
        'form' => $form->createView(),
      ));
    }

    /**
    * @Route("/manageFlight", name="manageFlight")
    * @Security("is_granted('ROLE_USER')")
    */
    public function manageAction(Request $request){

      $user = $this->container->get('security.token_storage')->getToken()->getUser();
      $repo = $this->getDoctrine()->getRepository(Flight::class);

      $bookings = $repo->getAllBookingsPerCustomer($user->getId());


      return $this->render("booking/manageBooking.html.twig", array(
        'customerBookings' => $bookings
      ));
    }


    /**
     * @Route("/listflights", name="listflights")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function listAction(Request $request)
    {
      $flightQuery = $this->getDoctrine()->getRepository(Flight::class)->getQueryAllFlights();

      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
        $flightQuery,
        $request->query->getInt('page', 1),
        5);

        return $this->render('flight/listflights.html.twig', [
          'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/removeflight/{flightId}", name="removeflight")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function removeAction(Request $request, $flightId){

      $flightToRemove = $this->getDoctrine()->getRepository(Flight::class)->find($flightId);
      $flightNumber = $flightToRemove->getFlightNumber();
      $em = $this->getDoctrine()->getManager();
      $em->remove($flightToRemove);
      $em->flush();

      $this->addFlash('info', 'Flight Deleted : ' . $flightNumber);

      return $this->redirectToRoute('listflights', [

      ]);
    }

}
