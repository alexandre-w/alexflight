<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Customer
 * @UniqueEntity("username")
 */
class Customer implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;


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
     * Set username
     *
     * @param string $username
     *
     * @return Customer
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    private $plainPassword;

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    public function getRoles(){
      return [
        'ROLE_USER',
      ];
    }

    public function getSalt(){
      return null ;
    }

    public function eraseCredentials(){
      $this->plainPassword = null;
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
     * @return Customer
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
