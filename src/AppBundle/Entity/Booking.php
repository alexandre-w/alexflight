<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bookingDate", type="datetime", nullable=true)
     */
    private $bookingDate;


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
    /**
     * @var \AppBundle\Entity\Customer
     */
    private $customer;

    /**
     * @var \AppBundle\Entity\Flight
     */
    private $flight;


    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Booking
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set flight
     *
     * @param \AppBundle\Entity\Flight $flight
     *
     * @return Booking
     */
    public function setFlight(\AppBundle\Entity\Flight $flight = null)
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return \AppBundle\Entity\Flight
     */
    public function getFlight()
    {
        return $this->flight;
    }
    /**
     * @var integer
     */
    private $reservedSeats;


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
