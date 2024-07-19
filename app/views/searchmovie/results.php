<?php require_once 'app/views/templates/headerPublic.php'; ?>

<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4">Movie Details</h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3 shadow">
                <img src="<?php echo $data['movie']['Poster']; ?>" class="card-img-top img-fluid" alt="<?php echo $data['movie']['Title']; ?>">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $data['movie']['Title']; ?></h2>
                    <p class="card-text"><strong>Year:</strong> <?php echo $data['movie']['Year']; ?></p>
                    <p class="card-text"><strong>Rated:</strong> <?php echo $data['movie']['Rated']; ?></p>
                    <p class="card-text"><strong>Released:</strong> <?php echo $data['movie']['Released']; ?></p>
                    <p class="card-text"><strong>Runtime:</strong> <?php echo $data['movie']['Runtime']; ?></p>
                    <p class="card-text"><strong>Genre:</strong> <?php echo $data['movie']['Genre']; ?></p>
                    <p class="card-text"><strong>Director:</strong> <?php echo $data['movie']['Director']; ?></p>
                    <p class="card-text"><strong>Writer:</strong> <?php echo $data['movie']['Writer']; ?></p>
                    <p class="card-text"><strong>Actors:</strong> <?php echo $data['movie']['Actors']; ?></p>
                    <p class="card-text"><strong>Plot:</strong> <?php echo $data['movie']['Plot']; ?></p>
                    <p class="card-text"><strong>Language:</strong> <?php echo $data['movie']['Language']; ?></p>
                    <p class="card-text"><strong>Country:</strong> <?php echo $data['movie']['Country']; ?></p>
                    <p class="card-text"><strong>Awards:</strong> <?php echo $data['movie']['Awards']; ?></p>
                    <p class="card-text"><strong>IMDB Rating:</strong> <?php echo $data['movie']['imdbRating']; ?></p>

                    <div class="text-center mt-4">
                        <button id="rate-movie-btn" class="btn btn-primary">Rate this Movie</button>
                        <?php if ($data['userRating']): ?>
                            <div id="user-rating" class="mt-3">
                                <p>Your rating: <span id="user-rating-value"><?php echo htmlspecialchars($data['userRating']['Ratings']); ?></span> out of 5</p>
                            </div>
                        <?php else: ?>
                            <div id="user-rating" style="display: none;" class="mt-3">
                                <p>Your rating: <span id="user-rating-value"></span> out of 5</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="/searchmovie" class="btn btn-secondary mt-3">Back to Search</a>
    </div>
</main>

<script>
document.getElementById('rate-movie-btn').addEventListener('click', function() {
    var isLoggedIn = <?php echo isset($_SESSION['auth']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
        window.location.href = '/login';
        return;
    }

    var rating = prompt("Please enter your rating (1-5):");
    if (rating !== null) {
        var movieName = "<?php echo addslashes($data['movie']['Title']); ?>"; // Ensure proper escaping
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/searchmovie/rate", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Rating submitted successfully!");
                document.getElementById('user-rating').style.display = 'block';
                document.getElementById('user-rating-value').textContent = rating;
            }
        };
        xhr.send("rating=" + rating + "&movie_name=" + encodeURIComponent(movieName));
    }
});
</script>

<?php require_once 'app/views/templates/footer.php'; ?>