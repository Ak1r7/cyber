<?php
require_once '../includes/config.php';
require_once '../includes/auth_functions.php';

if (!is_logged_in()) {
    header('Location: ' . SITE_URL . 'pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    $product = get_product($product_id);
    
    if ($product && $quantity > 0) {
        $total_price = $product['price'] * $quantity;
        $success = create_order($_SESSION['user_id'], $product_id, $quantity, $total_price);
        
        if ($success) {
            header('Location: ' . SITE_URL . 'pages/merch.php?success=1');
            exit;
        }
    }
}

header('Location: ' . SITE_URL . 'pages/merch.php');
exit;
?>