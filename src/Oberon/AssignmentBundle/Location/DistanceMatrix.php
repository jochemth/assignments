<?php

namespace Oberon\AssignmentBundle\Location;

use Oberon\AssignmentBundle\Client\Curl;

class DistanceMatrix 
{

  private $client;

  public function __construct()
  {
    $this->client = new Curl('http://maps.googleapis.com/maps/api/distancematrix/json');
  }

  public function getDistance($origin, $destination) 
  {
    
    $response = $this->client->get('?origins=2011tm&destinations=2800%20Mechelen,%20Belgi\u00eb');    

    return $response;
  }

}