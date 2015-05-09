<?php

namespace Oberon\AssignmentBundle\Client;

class Curl {

  private $url;
  private $fileHandle;

  public function __construct($url)
  {
    $this->url = $url;
  }

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