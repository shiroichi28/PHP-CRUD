<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die("<h2>Access Denied!</h2> This file is protected and not available to public.");
}
?>
<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul>
            <?php foreach ($_SESSION['error'] as $error) : ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session_unset(); ?>
<?php endif; ?>