<?php
include('./includes/db.php');
include('./includes/functions.php');
if (empty($_GET['id'])) {
    $currentPage = 'Add';
} else {
    $currentPage = 'Edit';
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM profile WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows) > 0) {
        $row = $rows[0];
    } else {

        exit('No data found for the given ID.');
    }
}


session_start();
$errors = [];
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $mobile = sanitizeInput($_POST['mobile']);
    if (!validateCSRFToken($_POST['csrf_token'])) {
        $errors['cnf'] = 'Login Error ,Try again';
    }
    if (!validateInput($mobile, 'mobile')) {
        $errors['mobile'] = 'Invalid Mobile Number';
    }

    if (!validateInput($email, 'email')) {
        $errors['email'] = 'Invalid Email';
    }

    if (!validateInput($username, 'username')) {
        $errors['username'] = 'Invalid username';
    }
    // Process password only if not in edit mode
    if (!isset($_GET['id'])) {
        $password = sanitizeInput($_POST['password']);

        if (!validateInput($password, 'password')) {
            $errors['cnf'] = 'Invalid Password';
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        if (empty($errors)) {
            try {
                if (!isset($_GET['id'])) {
                    // Insert new record
                    $stmt = $pdo->prepare('INSERT INTO profile (username, email, mobile, password, created_on) 
                        VALUES (:username, :email, :mobile, :password, :created_on)');
                    $stmt->execute([
                        'username' => strtoupper($username),
                        'email' => $email,
                        'mobile' => $mobile,
                        'password' => $hashedPassword,
                        'created_on' => time()
                    ]);
                } else {
                    // Update existing record
                    $id = $_GET['id'];
                    $stmt = $pdo->prepare("UPDATE profile SET username = :username, email = :email, mobile = :mobile,  edited_on = :edited_on WHERE id = :id");
                    $stmt->execute([
                        'username' => strtoupper($username),
                        'email' => $email,
                        'mobile' => $mobile,
                        'edited_on' => time(),
                        'id' => $id
                    ]);
                }

                // Redirect to index page after successful insert/update
                header('Location: index.php');
                exit();
            } catch (PDOException $e) {
                $errors['db'] = 'Database error: ' . $e->getMessage();
            }
        }
    }

    // Store errors in session
    $_SESSION['error'] = $errors;
    session_regenerate_id();
}
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
                <?php require('message.php') ?>
                <input type="hidden" name="csrf_token" value="<?= esc($_SESSION['csrf_token']) ?>">
                <div class="card">
                    <div class="card-body">
                        <a href="index.php"><button class="btn-primary btn ">Back</button></a>
                        <h4 class="card-title text-center p-3"><?= $currentPage ?></h4>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required value="<?= isset($_GET['id']) ? esc($row['username']) : '' ?>">

                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" required value="<?= isset($_GET['id']) ? esc($row['email']) : '' ?>">
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fa-solid fa-mobile-retro"></i></span>
                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="<?= isset($_GET['id']) ? esc($row['mobile']) : '' ?>" required>
                            </div>
                            <?php if (!isset($id)) : ?>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                                </div>
                            <?php endif ?>

                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-success w-40"><?= esc($currentPage) ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js' integrity='sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==' crossorigin='anonymous'></script>
    <script src="./assets/js/script.js" defer></script>
</body>

</html>