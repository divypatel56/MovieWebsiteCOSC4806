<?php
class SearchMovie extends Controller {
  // Display the search movie page
  public function index() {
      $this->view('searchmovie/index');
  }

  // Handle the search form submission
  public function search(){
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the movie name is set in the POST request
      if(!isset($_POST['movie'])){
        echo "Movie name is not set";
        return;
      }

      $movieName = trim($_POST['movie']); // Trim any whitespace from the movie name

      // Check if the movie name is empty
      if (empty($movieName)) {
        $this->view('searchmovie/index', ['error' => 'Please enter a movie name.']);
        return;
      }

      // Redirect to the movie details page with the movie name
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
         $this->view('searchmovie/index', ['error' => 'Error fetching movie details: ' . $movieDetails['Error']]);
         return;
     }

     // Check if movie details are empty
     if (empty($movieDetails)) {
         $this->view('searchmovie/index', ['no_movie' => 'No movie exists with the provided name.']);
         return;
     }

    // Fetch ratings for the movie
    $movieModel = $this->model('Movie');
    $ratings = $movieModel->getRatingsByMovie($movieName);

    $userRating = null;
    // Check if user is logged in to fetch their rating
    if (isset($_SESSION['auth'])) {
        $userId = $_SESSION['userid'];
        $userRating = $movieModel->getUserRating($movieName, $userId);
    }

    // Fetch generated review for the movie
    $movieReview = $apiModel->getMovieReview($movieName);

    // Pass movie details, ratings, user rating, and generated review to the view
    $this->view('searchmovie/results', [
        'movie' => $movieDetails,
        'ratings' => $ratings,
        'userRating' => $userRating,
        'generatedReview' => $movieReview
    ]);
  }

  // Handle the rate movie button
  public function rate() {
      // Check if the user is logged in
      if (!isset($_SESSION['auth'])) {
          echo "You need to be logged in to rate a movie.";
          return;
      }

      $userId = $_SESSION['userid'];
      $rating = $_POST['rating']; // Get the rating from POST request
      $movieName = $_POST['movie_name']; // Get the movie name from POST request

      // Add the rating to the database
      $movieModel = $this->model('Movie');
      $movieModel->addRatings($movieName, $userId, $rating);

      echo "Rating submitted successfully!";
  }
}
?>
