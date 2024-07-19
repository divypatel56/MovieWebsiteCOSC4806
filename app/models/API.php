<?php
class API {

private $apiKey;

  public function __construct() {
    $this->apiKey = $_ENV['omdb_key']; // Fetch the API key from the environment variable

  }

}
?>