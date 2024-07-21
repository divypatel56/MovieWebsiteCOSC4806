<?php

class Movie {

    // Function to add or update a rating for a movie
    public function addRatings($moviename, $userid, $rating) {
        $db = db_connect(); // Connect to the database

        $moviename = trim(strtolower($moviename)); // Normalize movie name (trim and convert to lowercase)

        // Check if user has already rated this movie
        $existingRating = $this->getUserRating($moviename, $userid);

        if ($existingRating) {
            // Update existing rating if it exists
            $statement = $db->prepare("UPDATE MovieRatings SET Ratings = :rating WHERE Moviename = :moviename AND Userid = :userid");
        } else {
            // Insert new rating if it doesn't exist
            $statement = $db->prepare("INSERT INTO MovieRatings (Moviename, Userid, Ratings, Created_At) VALUES (:moviename, :userid, :rating, NOW())");
        }

        // Bind parameters to the SQL statement
        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR);
        $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
        $statement->bindParam(':rating', $rating, PDO::PARAM_INT);
        $statement->execute(); // Execute the SQL statement
    }

    // Function to get the user's rating for a specific movie
    public function getUserRating($moviename, $userid) {
        $db = db_connect(); // Connect to the database
        $statement = $db->prepare("SELECT Ratings FROM MovieRatings WHERE Moviename = :moviename AND Userid = :userid"); // Prepare the SQL statement
        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR); // Bind the movie name parameter
        $statement->bindParam(':userid', $userid, PDO::PARAM_INT); // Bind the user ID parameter
        $statement->execute(); // Execute the SQL statement
        $result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
        error_log("getUserRating Result: " . print_r($result, true)); // Log the result for debugging
        return $result; // Return the result
    }

    // Function to get all ratings for a specific movie
    public function getRatingsByMovie($moviename) {
        $db = db_connect(); // Connect to the database
        $statement = $db->prepare("SELECT MovieRatings.Ratings, users.Username 
                                   FROM MovieRatings 
                                   JOIN users ON MovieRatings.Userid = users.id 
                                   WHERE MovieRatings.Moviename = :moviename"); // Prepare the SQL statement with a JOIN to get user names
        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR); // Bind the movie name parameter
        $statement->execute(); // Execute the SQL statement
        return $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }
}    

?>
