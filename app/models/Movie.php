<?php

class Movie {

    public function addRatings($moviename, $userid, $rating) {
        $db = db_connect();

        $moviename = trim(strtolower($moviename)); // Normalize movie name

        // Check if user has already rated this movie
        $existingRating = $this->getUserRating($moviename, $userid);

        if ($existingRating) {
            // Update existing rating
            $statement = $db->prepare("UPDATE MovieRatings SET Ratings = :rating WHERE Moviename = :moviename AND Userid = :userid");
        } else {
            // Insert new rating
            $statement = $db->prepare("INSERT INTO MovieRatings (Moviename, Userid, Ratings,Created_At) VALUES (:moviename, :userid, :rating, NOW())");
        }

        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR);
        $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
        $statement->bindParam(':rating', $rating, PDO::PARAM_INT);
        $statement->execute();
    }


    public function getUserRating($moviename, $userid) {
        $db = db_connect();
        $statement = $db->prepare("SELECT Ratings FROM MovieRatings WHERE Moviename = :moviename AND Userid = :userid");
        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR);
        $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        error_log("getUserRating Result: " . print_r($result, true)); // Debugging line
        return $result;
    }

    public function getRatingsByMovie($moviename) {
        $db = db_connect();
        $statement = $db->prepare("SELECT MovieRatings.Ratings, users.Username 
                                   FROM MovieRatings JOIN users ON MovieRatings.Userid = users.id 
                                   WHERE MovieRatings.Moviename = :moviename");
        $statement->bindParam(':moviename', $moviename, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}    

?>