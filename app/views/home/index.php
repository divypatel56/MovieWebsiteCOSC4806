<?php require_once 'app/views/templates/header.php' ?>
<style>
    body {
        background: url('https://images.unsplash.com/photo-1440404653325-ab127d49abc1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }

    @media (max-width: 576px) {
        .page-header h1 {
            font-size: 2.5rem;
        }
    }

    .page-header h1 {
        animation: fadeIn 2s ease-in-out;
        color: #000;
        
    }
    .page-header{
        margin: 50px;
        bg-color: #000;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .welcome-msg {
        animation: slideIn 2s ease-in-out;
        color: #000;
        font-size: 3rem;
    }

    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-100px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .btn-custom {
        
        border: 2px solid #333;
        padding: 15px 30px;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #fff;
        color: #333;
        border: 2px solid #333;
    }

    
</style>
<div class="container mt-5">
    <div class="page-header text-center">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="display-4 text-white">Welcome To Movie App</h1>
                <p class="lead welcome-msg text-white">
                    <?= htmlspecialchars($_SESSION["username"]) . ", Let's Discover Your Favourite Movie." ?>
                </p>
                
            </div>
        </div>
        <a href="/searchmovie" class="btn btn-dark mt-3">Search Movie</a>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
