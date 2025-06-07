<?php
require_once __DIR__ . '/auth_functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CYBER.MD</title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>">
                    <img src="<?php echo SITE_URL; ?>assets/images/logo.png" alt="CYBER.MD">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>pages/merch.php">Merch</a></li>
                    <?php if (is_logged_in()): ?>
                        <li><a href="<?php echo SITE_URL; ?>pages/profile.php">Profile</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo SITE_URL; ?>pages/login.php">Login</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main></main>