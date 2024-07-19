<?php
class API {

private $apiKey;

  public function __construct() {
    $this->apiKey = $_ENV['omdb_key']; // Fetch the API key from the environment variable

  }
//Function to fetch movie details from the OMDB API
  public function getMovieDetails($movieName) {
      $query_url = "http://www.omdbapi.com/?apikey=" . $this->apiKey . "&t=" . urlencode($movieName);
      $json = file_get_contents($query_url);
      if ($json === FALSE) {
          return ['Error' => 'Could not fetch data from OMDB API'];
      }
      return json_decode($json, true);
  }

}
?>