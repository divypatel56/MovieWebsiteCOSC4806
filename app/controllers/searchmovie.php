<?php
class SearchMovie extends Controller {
  public function index() {
      $this->view('searchmovie/index');
  }

  // Handle the search form submission
  public function search(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the movie name is set in the POST request
      if(!isset($_POST['movie'])){
        echo "Movie name is not set";
        return;
      }
      
      $movieName = trim($_POST['movie']);

       // Check if the movie name is empty
      if (empty($movieName)) {
        $this->view('searchmovie/index', ['error' => 'Please enter a movie name.']);
        return;
      }

      header("Location: /searchmovie/movie/" . urlencode($movieName));
      exit();
    }
  }

   // Display the movie details for the given movie
  public function movie($movieName) {
    $movieName = urldecode($movieName); // Decode the movie name

    // Check if the movie name is empty
    if (empty($movieName)) {
        $this->view('searchmovie/index', ['error' => 'Please enter a movie name.']);
        return;
    }

    // Fetch movie details from the API model
    $apiModel = $this->model('API');
    $movieDetails = $apiModel->getMovieDetails($movieName);

    // Check if there was an error fetching movie details
      if (isset($movieDetails['Error'])) {
        echo "Error fetching movie details: " . $movieDetails['Error'];
        return;
      }
    
    $movieModel = $this->model('Movie');
    $ratings = $movieModel->getRatingsByMovie($movieName);

    $userRating = null;
    if (isset($_SESSION['auth'])) {
        $userId = $_SESSION['userid'];
        $userRating = $movieModel->getUserRating($movieName, $userId);
    }

    $this->view('searchmovie/results', ['movie' => $movieDetails, 'ratings' => $ratings, 'userRating' => $userRating]);
  }

  //Handel the rate movie button
  public function rate() {
      if (!isset($_SESSION['auth'])) {
          echo "You need to be logged in to rate a movie.";
          return;
      }

      $userId = $_SESSION['userid'];
      $rating = $_POST['rating'];
      $movieName = $_POST['movie_name'];

      $movieModel = $this->model('Movie');
      $movieModel->addRatings($movieName, $userId, $rating);

      echo "Rating submitted successfully!";
  }
}
?>