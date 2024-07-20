<?php require_once 'app/views/templates/movieheader.php'; ?>

<style>
/* Background Image */
body {
    background: url('https://images.unsplash.com/photo-1677344297888-81f04aa12a60?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
    background-size: cover;
}

/* Main Container Styling */
.main-container {
    margin-top: 100px;
}

/* Form Container Styling */
.form-container {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

/* Custom Form Styling */
.input-group {
    border-radius: 5px;
    overflow: hidden;
}

.input-group .form-control {
    border: none;
    box-shadow: none;
}

.input-group .btn-primary {
    border-radius: 0;
}

/* Page Header */
.page-header {
    margin-bottom: 40px;
}

.page-header h1 {
    font-size: 3rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

@media (max-width: 576px) {
    .page-header h1 {
        font-size: 2.5rem;
    }
}

/* Alert Styling */
.alert {
    margin-top: 20px;
}

</style>

<main role="main" class="container main-container">
    <div class="page- text-center">
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
                    <div class="alert alert-danger">
                        <?php echo $data['error']; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($data['no_movie'])): ?>
                    <div class="alert alert-warning">
                        <?php echo $data['no_movie']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>
