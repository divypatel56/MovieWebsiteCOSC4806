<?php require_once 'app/views/templates/headerPublic.php'; ?>

<style>
/* Background Image */
body {
    background: url('https://images.pexels.com/photos/9433910/pexels-photo-9433910.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2') no-repeat center center fixed;;
    background-size:cover;
}

/* Form Container Styling */
.form-container {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    animation: fadeInUp 1s ease-in-out;
}

/* Fade In Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Button Hover Effect */
.btn-primary {
    transition: background-color 0.3s, transform 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}
</style>

<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4 text-white">Search Movie</h1>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <form action="/searchmovie/search" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="movie" placeholder="Enter movie name" required>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <?php if (isset($data['error'])): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $data['error']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>
