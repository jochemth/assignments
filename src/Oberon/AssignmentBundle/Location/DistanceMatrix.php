<?php

namespace Oberon\AssignmentBundle\Location;

use Oberon\AssignmentBundle\Client\Curl;
use Oberon\AssignmentBundle\Location\Location;

/**
 * Service for using Google Api distance matrix api
 */
class DistanceMatrix 
{

  private $client;

  public function __construct()
  {
    $this->client = new Curl('http://maps.googleapis.com/maps/api/distancematrix/json');
  }

  /**
   * Get the distance between origin and destination(s)
   * @param  string $origin       zipcode of origin
   * @param  array  $destinations array of Location objects
   * @return array               array of Location objects
   */
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

    // make a http GET request to the distance matrix api
    $response = $this->client->get($queryString);    

    $distances = $this->handleResponse($response);

    // add the distance to the correct Location object
    foreach ($distances as $key => $distance) 
    {
      $destinations[$key]->setDistance($distance);
    }

    return $destinations;
  }

  /**
   * Create an array of distances in meters from the api response
   * @param  string $response distance matrix api response
   * @return array           array with distances in meters
   */
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