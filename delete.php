<?php
include('./includes/db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM profile WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Redirect to index page after successful delete
    header('Location: index.php');
    exit();
} else {
    exit('No function for the given ID.');
}
