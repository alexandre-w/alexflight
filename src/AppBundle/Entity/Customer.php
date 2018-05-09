<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use \AppBundle\Entity\Booking;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 * @ORM\Table(name="customers")
 **/
class Customer implements UserInterface
{
    /** @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /** @ORM\Column(type="string")
     * @var string
     **/
    private $username;

    /** @ORM\Column(type="string")
     * @var string
     **/
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="customer")
     * @var Booking[] An ArrayCollection of Booking objects.
     **/
    private $bookedCustomers;


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


    /** Constructor **/
    public function __construct()
    {
        $this->bookedCustomers = new ArrayCollection();
    }


    public function addBookedCustomer(Booking $booking)
    {
        $this->bookedCustomers[] = $booking;
    }


    public function removeBookedCustomer(Booking $booking)
    {
        $this->bookedCustomers->removeElement($booking);
    }


    public function getBookedCustomer()
    {
        return $this->bookedCustomers;
    }
}
