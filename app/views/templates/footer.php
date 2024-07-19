<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .footer-custom {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px 0;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        }
        .footer-custom a {
            color: white;
        }
    </style>
</head>
<body>
    <footer class="footer mt-auto footer-custom">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 mb-2">
                    <h6>Contact Us</h6>
                    <p class="mb-1" style="font-size: 0.9rem;">Email: divydpatel@algomau.ca</p>
                    <p class="mb-1" style="font-size: 0.9rem;">Phone: (123) 456-7890</p>
                    <div>
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.linkedin.com/in/divy-patel-1a106b1a0/" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <p class="mb-0" style="font-size: 0.8rem;">&copy; <?php echo date('Y'); ?> Divy Patel. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
