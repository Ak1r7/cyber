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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        try {
            if (register_user($username, $email, $password)) {
                // Автоматический вход после регистрации
                if (login_user($username, $password)) {
                    header('Location: ' . SITE_URL);
                    exit;
                }
            }
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $error = 'Username or email already exists';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

require_once '../includes/header.php';
?>

<section class="auth-form">
    <div class="container">
        <h1>Register</h1>
        
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
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn">Register</button>
        </form>
        
        <p>Already have an account? <a href="<?php echo SITE_URL; ?>pages/login.php">Login here</a></p>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>