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
//Function to fetch movie review from Gemini API
  public function getMovieReview($title) {
      $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key='.$_ENV['gemini_key'];
      $data = array(
          "contents" => array(
              array(
                  "parts" => array(
                      array(
                          "text" => "Generate a movie review which contains ratings between 1 star to 5 star for the movie " . $title
                      )
                  )
              )
          )
      );
      $json_data = json_encode($data);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);

      if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
          error_log('Curl error: ' . curl_error($ch));
          return 'Error fetching review';
      }

      curl_close($ch);

      // Log the API response for debugging
      error_log('API response: ' . $response);

      $response_data = json_decode($response, true);

      if (isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
          $review_text = $response_data['candidates'][0]['content']['parts'][0]['text'];
          return $review_text;
      } else {
          return 'No review generated';
      }
  }


}
?>