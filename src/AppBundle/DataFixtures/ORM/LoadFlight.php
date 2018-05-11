<?php

namespace AppBundle\DataFixtures\ORM ;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Flight;
use AppBundle\Entity\City;

/**
 *
 */
class LoadFlight implements FixtureInterface
{

  function load(ObjectManager $manager)
  {

    $melb = $manager->getRepository('AppBundle:City')->findOneBy(array('name' => 'melbourne'));
    $syd = $manager->getRepository('AppBundle:City')->findOneBy(array('name' => 'sydney'));
    $flightOne = new Flight();
    $flightOne->setFlyingFrom($melb);
    $flightOne->setFlyingTo($syd);
    $flightOne->setDepartingDate(new \Datetime());
    $flightOne->setSeatsLeft(100);
    $flightOne->setFlightNumber('MESY100');

    $manager->persist($flightOne);
    $manager->flush();

  }
}
