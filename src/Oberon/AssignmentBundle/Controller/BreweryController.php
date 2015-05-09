<?php

namespace Oberon\AssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Oberon\AssignmentBundle\Entity\Brewery;
use Oberon\AssignmentBundle\Client\Curl;

class BreweryController extends Controller
{

  /**
  * @Route("/", name="_brewery")
  * @Template()
  */
  public function indexAction() 
  {
    $client = new Curl('http://downloads.oberon.nl/opdracht/brouwerijen.php');
    $breweries = $client->get();
    var_dump(json_decode($breweries, true));
    $distanceMatrix = $this->get('distance_matrix');
    $distances = $distanceMatrix->getDistance(array(), array());
    var_dump($distances);
    return array();
  }

}