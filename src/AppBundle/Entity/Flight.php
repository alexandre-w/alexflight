<?php

namespace AppBundle\Entity;

/**
 * Flight
 */
class Flight
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $flyingFrom;

    /**
     * @var string
     */
    private $flyingTo;

    /**
     * @var \DateTime
     */
    private $departingDate;

    /**
     * @var int
     */
    private $seatsLeft;


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
     * Set flyingFrom
     *
     * @param string $flyingFrom
     *
     * @return Flight
     */
    public function setFlyingFrom($flyingFrom)
    {
        $this->flyingFrom = $flyingFrom;

        return $this;
    }

    /**
     * Get flyingFrom
     *
     * @return string
     */
    public function getFlyingFrom()
    {
        return $this->flyingFrom;
    }

    /**
     * Set flyingTo
     *
     * @param string $flyingTo
     *
     * @return Flight
     */
    public function setFlyingTo($flyingTo)
    {
        $this->flyingTo = $flyingTo;

        return $this;
    }

    /**
     * Get flyingTo
     *
     * @return string
     */
    public function getFlyingTo()
    {
        return $this->flyingTo;
    }

    /**
     * Set departingDate
     *
     * @param \DateTime $departingDate
     *
     * @return Flight
     */
    public function setDepartingDate($departingDate)
    {
        $this->departingDate = $departingDate;

        return $this;
    }

    /**
     * Get departingDate
     *
     * @return \DateTime
     */
    public function getDepartingDate()
    {
        return $this->departingDate;
    }

    /**
     * Set seatsLeft
     *
     * @param integer $seatsLeft
     *
     * @return Flight
     */
    public function setSeatsLeft($seatsLeft)
    {
        $this->seatsLeft = $seatsLeft;

        return $this;
    }

    /**
     * Get seatsLeft
     *
     * @return int
     */
    public function getSeatsLeft()
    {
        return $this->seatsLeft;
    }
    /**
     * @var string
     */
    private $flightNumber;


    /**
     * Set flightNumber
     *
     * @param string $flightNumber
     *
     * @return Flight
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber
     *
     * @return string
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bookings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Flight
     */
    public function addBooking(\AppBundle\Entity\Booking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \AppBundle\Entity\Booking $booking
     */
    public function removeBooking(\AppBundle\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}
