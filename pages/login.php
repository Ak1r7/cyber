<?php
require_once '../includes/config.php';
require_once '../includes/auth_functions.php';

if (is_logged_in()) {
    header('Location: ' . SITE_URL);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        if (login_user($username, $password)) {
            header('Location: ' . SITE_URL);
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    }
}

require_once '../includes/header.php';
?>

<section class="auth-form">
    <div class="container">
        <h1>Login</h1>
        
        <?php if ($error): ?>
            <div class="alert error">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
        
        <p>Don't have an account? <a href="<?php echo SITE_URL; ?>pages/register.php">Register here</a></p>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>