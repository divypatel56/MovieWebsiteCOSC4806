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
      
      // Redirect to the movie details function with the movie name
      header("Location: /searchmovie/movie/" . urlencode($movieName));
      exit();
    }
  }
}
?>