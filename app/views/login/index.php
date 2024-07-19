<?php require_once 'app/views/templates/headerPublic.php'; ?>


<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    /* Background Image */
    body {
        background: url('https://images.unsplash.com/photo-1485846234645-a62644f84728?q=80&w=2059&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
        background-size: cover;
    }

    @media (max-width: 576px) {
        .page-header h1 {
            font-size: 2.5rem;
        }
    }

</style>


<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4 text-white">Login</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="/login/verify" method="post">
                        <fieldset>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input required type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </fieldset>
                    </form>
                    <p class="mt-3 text-center">Don't have an account? <a href="/create">Create one here</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>
