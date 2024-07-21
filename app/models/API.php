<?php
class API {

private $apiKey;

  // Constructor to initialize the API key from environment variables
  public function __construct() {
    $this->apiKey = $_ENV['omdb_key']; // Fetch the API key from the environment variable
  }

  // Function to fetch movie details from the OMDB API
  public function getMovieDetails($movieName) {
      $query_url = "http://www.omdbapi.com/?apikey=" . $this->apiKey . "&t=" . urlencode($movieName); // Construct the query URL
      $json = file_get_contents($query_url); // Fetch the JSON response from the URL
      if ($json === FALSE) {
          return ['Error' => 'Could not fetch data from OMDB API']; // Return an error if the request fails
      }
      return json_decode($json, true); // Decode the JSON response into an associative array
  }

  // Function to fetch movie review from Gemini API
  public function getMovieReview($title) {
      $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key='.$_ENV['gemini_key']; // API endpoint with the API key
      $data = array(
          "contents" => array(
              array(
                  "parts" => array(
                      array(
                          "text" => "Generate a movie review for movie " . $title . " review contains the following movie details; Ratings, 1-5 lines movie review."
                      )
                  )
              )
          )
      );
      $json_data = json_encode($data); // Encode the data array to JSON
      $ch = curl_init($url); // Initialize a cURL session
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set the content type to application/json
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Set the POST fields to the JSON data
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (not recommended for production)
      $response = curl_exec($ch); // Execute the cURL session

      if (curl_errno($ch)) { // Check for cURL errors
          echo 'Curl error: ' . curl_error($ch); // Print the cURL error
          error_log('Curl error: ' . curl_error($ch)); // Log the cURL error
          return 'Error fetching review'; // Return an error message
      }

      curl_close($ch); // Close the cURL session

      // Log the API response for debugging
      error_log('API response: ' . $response); // Log the API response

      $response_data = json_decode($response, true); // Decode the JSON response into an associative array

      // Check if the review text is present in the response
      if (isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
          $review_text = $response_data['candidates'][0]['content']['parts'][0]['text']; // Extract the review text
          return $review_text; // Return the review text
      } else {
          return 'No review generated'; // Return a message if no review is generated
      }
  }

}
?>
