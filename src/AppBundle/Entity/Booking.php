<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use \AppBundle\Entity\Flight;
use \AppBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 * @ORM\Table(name="bookings")
 **/
class Booking
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $bookingDate;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $reservedSeats;


    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="bookedCustomers")
     **/
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Flight", inversedBy="bookedFlights")
     **/
    private $flight;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     *
     * @return Booking
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }




    public function setCustomer(Customer $customer = null)
    {

        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }


    public function setFlight(Flight $flight = null)
    {
      $flight->addBookedFlight(this);
      $this->flight = $flight;
    }

    public function getFlight()
    {
        return $this->flight;
    }



    /**
     * Set reservedSeats
     *
     * @param integer $reservedSeats
     *
     * @return Booking
     */
    public function setReservedSeats($reservedSeats)
    {
        $this->reservedSeats = $reservedSeats;

        return $this;
    }

    /**
     * Get reservedSeats
     *
     * @return integer
     */
    public function getReservedSeats()
    {
        return $this->reservedSeats;
    }
}
