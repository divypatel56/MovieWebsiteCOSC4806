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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="/searchmovie" class="btn btn-secondary mt-3">Back to Search</a>
    </div>
</main>



<?php require_once 'app/views/templates/footer.php'; ?>