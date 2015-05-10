<?php

namespace Oberon\AssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oberon\AssignmentBundle\Client\Curl;
use Oberon\AssignmentBundle\Form\ZipcodeType;
use Oberon\AssignmentBundle\Location\Location;

class BreweryController extends Controller
{

  /**
  * @Route("/", name="_brewery")
  * @Template()
  */
  public function indexAction(Request $request) 
  {
    $form = $this->createForm(new ZipcodeType());
    $closestLocation = null;
    
    $form->handleRequest($request);

        if ($form->isValid()) 
        {

          $formData = $form->getData();

          $origin = $formData['zipcode'];

          $client = new Curl('http://downloads.oberon.nl/opdracht/brouwerijen.php');
          $breweries = $client->get();
          $breweries = json_decode($breweries, true);
          
          $destinations = array();

          if(isset($breweries['breweries']))
          {
            foreach($breweries['breweries'] as $brewery)
            {
              $location = new Location();
              $location->setName($brewery['name']);
              $location->setZipCode($brewery['zipcode']);
              $location->setCity($brewery['city']);
              $location->setAddress($brewery['address']);
              $destinations[] = $location;
            }
          }

          $distanceMatrix = $this->get('distance_matrix');
          $distances = $distanceMatrix->getDistance($origin, $destinations);

          usort($distances, function($a, $b)
          {
            return $a->getDistance() > $b->getDistance();
          });

          $closestLocation = $distances[0];
        }

    return array('form' => $form->createView(), 'closest' => $closestLocation);

  }

}