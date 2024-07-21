<?php require_once 'app/views/templates/movieheader.php'; ?>


<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4 text-white">Movie Details</h1>
    </div>

    <!-- Bootstrap Alert -->
    <div id="alert-container" class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
        <strong>Warning!</strong> You need to sign up or log in to your account to give ratings.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="row">
        <!-- Movie Poster -->
        <div class="col-md-4">
            <div class="card mb-3 shadow poster-card">
                <img src="<?php echo $data['movie']['Poster']; ?>" class="card-img-top img-fluid poster-img" alt="<?php echo $data['movie']['Title']; ?>">
            </div>
        </div>
        <!-- Movie Details -->
        <div class="col-md-8">
            <div class="card mb-3 shadow movie-details-card">
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
                        <button id="rate-movie-btn" class="btn btn-primary rate-btn">Rate this Movie</button>
                        <?php if ($data['userRating']): ?>
                            <div id="user-rating" class="mt-3">
                                <p>Your rating: <span id="user-rating-value" class="user-rating-value"><?php echo htmlspecialchars($data['userRating']['Ratings']); ?></span> out of 5</p>
                            </div>
                        <?php else: ?>
                            <div id="user-rating" style="display: none;" class="mt-3">
                                <p>Your rating: <span id="user-rating-value" class="user-rating-value"></span> out of 5</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating Cards -->
    <div class="row mt-4" id="rating-cards" style="display: none;">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="col-2">
                <div class="card mb-3 shadow rating-card" data-rating="<?php echo $i; ?>">
                    <div class="card-body text-center">
                        <div class="star"><?php echo $i; ?></div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Movie Review -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-3 shadow movie-review-card">
                <div class="card-body">
                    <h5 class="card-title">Movie Review</h5>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($data['generatedReview'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Assume user is logged in if this variable is true, otherwise false
var isLoggedIn = <?php echo isset($_SESSION['auth']) ? 'true' : 'false'; ?>;

document.getElementById('rate-movie-btn').addEventListener('click', function() {
    if (isLoggedIn) {
        var ratingCards = document.getElementById('rating-cards');
        ratingCards.style.display = ratingCards.style.display === 'none' ? 'flex' : 'none';
    } else {
        var alertContainer = document.getElementById('alert-container');
        alertContainer.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(function() {
            window.location.href = '/login'; // Redirect to login page if not logged in
        }, 3000); // Show the alert for 3 seconds before redirecting
    }
});

document.querySelectorAll('.rating-card').forEach(function(card) {
    card.addEventListener('click', function() {
        var rating = this.getAttribute('data-rating');
        var movieName = "<?php echo htmlspecialchars($data['movie']['Title']); ?>";
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/searchmovie/rate", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('user-rating-value').textContent = rating;
                document.getElementById('user-rating').style.display = 'block'; // Show the user rating
                document.getElementById('rating-cards').style.display = 'none'; // Hide the rating cards after selection
            } else if (xhr.readyState === 4 && xhr.status === 401) {
                var alertContainer = document.getElementById('alert-container');
                alertContainer.style.display = 'block';
                window.scrollTo({ top: 0, behavior: 'smooth' });
                setTimeout(function() {
                    window.location.href = '/login'; // Redirect to login page if unauthorized
                }, 3000); // Show the alert for 3 seconds before redirecting
            }
        };
        xhr.send("rating=" + encodeURIComponent(rating) + "&movie_name=" + encodeURIComponent(movieName));
    });
});
</script>

<?php require_once 'app/views/templates/footer.php'; ?>

<style>
    /* Custom CSS */
    body {
        background: url('https://images.unsplash.com/photo-1650954316166-c3361fefcc87?q=80&w=1854&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
        background-size: cover;
    }
/* Movie Details Card */
.movie-details-card {
    border-radius: 15px;
    background: linear-gradient(to right, #f8f9fa, #e9ecef);
    border: 1px solid #ddd;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.movie-details-card:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Poster Card */
.poster-card {
    border-radius: 15px;
    overflow: hidden;
}

.poster-img {
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.poster-img:hover {
    transform: scale(1.05);
}

/* Rating Card */
.rating-card {
    background-color: #f1f3f5;
    border: 1px solid #ced4da;
    border-radius: 15px;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.rating-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.star {
    font-size: 2rem;
    color: #f39c12;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.star::before {
    content: "★";
    margin-right: 0.5rem;
}

/* Movie Review Card */
.movie-review-card {
    background-color: ;
    border: 1px solid #ced4da;
    border-radius: 15px;
    padding: 1.5rem;
    transition: box-shadow 0.3s ease;
}

.movie-review-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* User Rating Value */
.user-rating-value {
    background-color: #f39c12;
    color: #fff;
    padding: 0.2rem 0.5rem;
    border-radius: 5px;
}

/* Bootstrap Alert */
.alert {
    border-radius: 10px;
    margin-bottom: 1rem;
}

.alert-dismissible .btn-close {
    padding: 0.75rem 1.25rem;
}

/* Rate Button */
.rate-btn {
    border-radius: 50px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.rate-btn:hover {
    background-color: #0056b3;
    color: #fff;
}
</style>
