<?php

namespace AppBundle\DataFixtures\ORM ;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\City;

/**
 * Fixtures for City Table
 */
class LoadCity implements FixtureInterface
{

  function load(ObjectManager $manager)
  {
    $names = array('melbourne', 'sydney', 'perth', 'adelaïde', 'darwin', 'brisbane' );

    foreach ($names as $name) {
      $city = new City();
      $city->setName($name);

      $manager->persist($city);
    }

    $manager->flush();
  }
}
