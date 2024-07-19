<?php require_once 'app/views/templates/headerPublic.php'; ?>
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

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
        <h1 class="display-4 text-white">Sign Up</h1>
        <p class="lead text-white">Create a new account</p>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php if(isset($_SESSION['validation_errors'])): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($_SESSION['validation_errors'] as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['validation_errors']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="/create/register" method="post">
                        <fieldset>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input required type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" id="password">
                                <small class="form-text text-muted">
                                    Password must be at least 8 characters long, contain both uppercase and lowercase letters, at least one number, and at least one special character.
                                </small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input required type="password" class="form-control" name="confirm_password" id="confirm_password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>
