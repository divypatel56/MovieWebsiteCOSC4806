<?php require_once 'app/views/templates/headerPublic.php'; ?>
<link rel="stylesheet" href="/app/view/style/style.css">


<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4">Sign Up</h1>
        <p class="lead">Create a new account</p>
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
