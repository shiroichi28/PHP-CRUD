<?php

include('./includes/db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css' integrity='sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==' crossorigin='anonymous' />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <a href="ae.php"><button class="btn-primary btn ">Add</button></a>
            <table class="table table-bordered mt-3">
                <thead>
                    <th>S.no</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th colspan="2">Actions</th>
                </thead>
                <tbody>
                    <?php $stmt = $pdo->query("SELECT * FROM profile ");
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                    <?= empty($rows) ? '<tr ><td colspan="6">No data</td></tr>' : "" ?>
                    <?php foreach ($rows as $i => $row) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['mobile'] ?></td>
                            <td><a href="ae.php?id=<?= $row['id'] ?>"><button class="btn btn-primary">Edit</button></a></td>
                            <td><a href="delete.php?id=<?= $row['id'] ?>"><button class="btn btn-danger">Delete</button></a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>


    </div>
    <script src="./assets/js/script.js"></script>
</body>

</html>