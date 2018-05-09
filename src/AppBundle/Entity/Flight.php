<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use \AppBundle\Entity\Booking;
use \AppBundle\Entity\City;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlightRepository")
 * @ORM\Table(name="flights")
 **/
class Flight
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="flightedFrom")
     **/
    private $flyingFrom;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="flightedTo")
     **/
    private $flyingTo;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $departingDate;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $seatsLeft;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $flightNumber;

    /**
    * @ORM\OneToMany(targetEntity="Booking", mappedBy="flight")
    * @var Booking[] An ArrayCollection of Booking objects.
    **/
    private $bookedFlights = null ;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setFlyingFrom($flyingFrom)
    {
        $this->flyingFrom = $flyingFrom;

        return $this;
    }


    public function getFlyingFrom()
    {
        return $this->flyingFrom;
    }


    public function setFlyingTo($flyingTo)
    {
        $this->flyingTo = $flyingTo;

        return $this;
    }

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

    public function __construct()
    {
        $this->bookedFlights = new ArrayCollection();
    }

    public function addBookedFlight(Booking $booking)
    {
        $this->bookedFlights[] = $booking;
    }

    public function removeBookedFlight(Booking $booking)
    {
        $this->bookedFlights->removeElement($booking);
    }

    public function getBookedFlight()
    {
        return $this->bookedFlights;
    }

}
