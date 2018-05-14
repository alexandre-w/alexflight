<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use \AppBundle\Entity\Flight;
use \AppBundle\Entity\Customer;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 * @ORM\Table(name="cities")
 **/
class City
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;



    public function getId()
    {
        return $this->id;
    }

    public function getName(){
      return $this->name;
    }

    public function setName($name){
      $this->name = $name;
    }


    /**
    * @ORM\OneToMany(targetEntity="Flight", mappedBy="flyingFrom")
    * @var Flight[] An ArrayCollection of Flight objects.
    **/
    private $flightedFrom = null ;

    /**
    * @ORM\OneToMany(targetEntity="Flight", mappedBy="flyingTo")
    * @var Flight[] An ArrayCollection of Flight objects.
    **/
    private $flightedTo = null ;


    public function __construct()
    {
        $this->flightedFrom = new ArrayCollection();
        $this->flightedTo = new ArrayCollection();
    }

    public function addFlightedFrom(Flight $flight)
    {
        $this->flightedFrom[] = $flight;
    }

    public function removeFlightedFrom(Flight $flight)
    {
        $this->flightedFrom->removeElement($flight);
    }

    public function getFlightedFrom()
    {
        return $this->flightedFrom;
    }


    public function addFlightedTo(Flight $flight)
    {
        $this->flightedTo[] = $flight;
    }

    public function removeFlightedTo(Flight $flight)
    {
        $this->flightedTo->removeElement($flight);
    }

    public function getFlightedTo()
    {
        return $this->flightedTo;
    }

    public function serializeForAutocomplete()
    {
        return array(
            'id' => $this->getId(),
            'label' => $this->getName(),
            'value' => $this->getName(),
        );
    }


}
