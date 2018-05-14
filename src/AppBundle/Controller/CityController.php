<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\City;

class CityController extends Controller
{
    /**
     * @Route("/city", name="city")
     */
    public function ListAction(Request $request)
    {
      $cityName = $request->get('term');

      $cities = $this->getDoctrine()
                ->getRepository(City::class)
                ->getCityWithLike($cityName );

      $results = array();
      foreach($cities as $city){
        $results[] = $city->serializeForAutocomplete();
      }

      return new JsonResponse($results);
    }

}
