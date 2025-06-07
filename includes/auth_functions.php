<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function register_user($username, $email, $password) {
    global $pdo;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashed_password]);
}

function login_user($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    
    return false;
}

function get_products() {
    global $pdo;
    
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll();
}

function get_product($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function create_order($user_id, $product_id, $quantity, $total_price) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$user_id, $product_id, $quantity, $total_price]);
}
?>