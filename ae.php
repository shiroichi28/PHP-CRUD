<?php
include('./includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' integrity='sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==' crossorigin='anonymous' />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css' integrity='sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==' crossorigin='anonymous' />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <noscript>
            <p class="text-danger">Please enable JavaScript for better experience.</p>
        </noscript>
        <div class="row justify-content-center align-content-center vh-100">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center p-3">Add</h4>
                        <form action="" method="post" autocomplete="off">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">

                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-mobile-retro"></i></span>
                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary w-40">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

    <script src="./assets/js/script.js" defer></script>
</body>

</html>