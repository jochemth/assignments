<?php

namespace Oberon\AssignmentBundle\Location;

use Oberon\AssignmentBundle\Client\Curl;
use Oberon\AssignmentBundle\Location\Location;

class DistanceMatrix 
{

  private $client;

  public function __construct()
  {
    $this->client = new Curl('http://maps.googleapis.com/maps/api/distancematrix/json');
  }

  public function getDistance($origin, array $destinations) 
  {
    $queryString = '';
    $queryString = '?origins='.urlencode($origin);

    if(!empty($destinations))
    {
      $queryString .= '&destinations=';
      foreach ($destinations as $destination) 
      {
        if($destination instanceof Location)
        {
          $queryString .= urlencode($destination->getZipCode().','.$destination->getCity()).'|';
        }
      }
    }

    $response = $this->client->get($queryString);    

    $distances = $this->handleResponse($response);

    foreach ($distances as $key => $distance) 
    {
      $destinations[$key]->setDistance($distance);
    }

    return $destinations;
  }

  private function handleResponse($response)
  {
    $response = json_decode($response, true);
    if(isset($response['rows']))
    {
      $distances = array();
      foreach ($response['rows'] as $row) 
      {
        foreach ($row['elements'] as $element)
        {
          if(isset($element['distance']))
          {
            $distances[] = $element['distance']['value'];
          }
        }
      }
    }

    return $distances;
    
  }

}