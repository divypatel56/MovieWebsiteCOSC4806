<?php require_once 'app/views/templates/headerPublic.php'; ?>

<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4">Search for a Movie</h1>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <form action="/searchmovie/search" method="post" class="bg-light p-4 rounded shadow">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="movie" placeholder="Enter movie name" required>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>