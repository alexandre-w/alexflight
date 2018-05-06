<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Flight;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Booking;

class BookingController extends Controller
{

    /**
    * @Route("/book/{flightId}/{passengers}", name="bookflight")
    * @Security("is_granted('ROLE_USER')")
    */
    public function bookFlight(Request $request, $flightId, $passengers ){

      $user = $this->container->get('security.token_storage')->getToken()->getUser();
      $flight = $this->getDoctrine()->getRepository(Flight::class)->find($flightId);

      // Update the flight
      $seatsLeft = $flight->getSeatsLeft() - $passengers ;
      $flight->setSeatsLeft($seatsLeft);

      // Create the new Booking
      $newBooking = new Booking();
      $newBooking->setCustomer($user);
      $newBooking->setFlight($flight);
      $newBooking->setReservedSeats($passengers);

      $em = $this->getDoctrine()->getManager();
      $em->persist($newBooking);
      $em->flush();

      return $this->render("flight/thanksbooking.html.twig");
    }

}
