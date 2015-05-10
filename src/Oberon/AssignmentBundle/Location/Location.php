<?php

namespace Oberon\AssignmentBundle\Location;

class Location
{

  /**
   * @var string
   *
   */
  private $name;

  /**
   * @var string
   *
   */
  private $address;

  /**
   * @var string
   *
   */
  private $zipcode;

  /**
   * @var string
   *
   */
  private $city;

  /**
   * @var integer
   *
   */
  private $distance;

  /**
   * Set name
   *
   * @param string $name
   * @return Location
   */
  public function setName($name)
  {
      $this->name = $name;

      return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
      return $this->name;
  }

  /**
   * Set address
   *
   * @param string $address
   * @return Location
   */
  public function setAddress($address)
  {
      $this->address = $address;

      return $this;
  }

  /**
   * Get address
   *
   * @return string 
   */
  public function getAddress()
  {
      return $this->address;
  }

  /**
   * Set zipcode
   *
   * @param string $zipcode
   * @return Location
   */
  public function setZipcode($zipcode)
  {
      $this->zipcode = $zipcode;

      return $this;
  }

  /**
   * Get zipcode
   *
   * @return string 
   */
  public function getZipcode()
  {
      return $this->zipcode;
  }

  /**
   * Set city
   *
   * @param string $city
   * @return Location
   */
  public function setCity($city)
  {
      $this->city = $city;

      return $this;
  }

  /**
   * Get city
   *
   * @return string 
   */
  public function getCity()
  {
      return $this->city;
  }

  /**
   * Set distance
   *
   * @param   $distance distance in meters
   * @return  Location
   */
  public function setDistance($distance)
  {
      $this->distance = $distance;

      return $this;
  }


  /**
   * Get distance
   * Distance in meters
   * @return   integer
   */
  public function getDistance()
  {
      return $this->distance;  
  }
}