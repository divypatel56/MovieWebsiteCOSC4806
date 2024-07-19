<?php require_once 'app/views/templates/header.php' ?>
<div class="container mt-5">
    <div class="page-header text-center">
        <div class="row">
            <div class="col-lg-12 bg-light p-5">
                <h1 class="display-4">Welcome</h1>
                <p class="lead">
                    <?= "Hello, " . htmlspecialchars($_SESSION["username"]) . ".<br> Today is: " . date("Y-m-d") . "." ?>
                </p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 text-center">
            <p><a href="/logout" class="btn btn-danger">Logout</a></p>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
