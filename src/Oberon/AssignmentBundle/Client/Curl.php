<?php

namespace Oberon\AssignmentBundle\Client;

class Curl {

  /**
   * Url to make the curl call to
   * @var string
   */
  private $url;

  /**
   * Filehandle for curl connection
   * @var curl object
   */
  private $fileHandle;

  public function __construct($url)
  {
    $this->url = $url;
  }

  /**
   * Make an http GET request using curl
   * @param  string $query query string for GET request
   * @return mixed  data returned from the GET request
   */
  public function get($query = "")
  {
    $url = $this->url.$query;
    $this->fileHandle = curl_init($url);
    curl_setopt($this->fileHandle, CURLOPT_HEADER, 0);
    curl_setopt($this->fileHandle, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($this->fileHandle);

    curl_close($this->fileHandle);
    return $response;
  }
}