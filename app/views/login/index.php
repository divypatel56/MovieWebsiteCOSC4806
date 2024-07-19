<?php require_once 'app/views/templates/headerPublic.php'; ?>
<link rel="stylesheet" href="/app/view/style/style.css">

<main role="main" class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4">Login</h1>
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
