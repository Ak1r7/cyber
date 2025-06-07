<?php
require_once '../includes/config.php';
require_once '../includes/auth_functions.php';

if (!is_logged_in()) {
    header('Location: ' . SITE_URL . 'pages/login.php');
    exit;
}

if (!isset($_GET['product_id'])) {
    header('Location: ' . SITE_URL . 'pages/merch.php');
    exit;
}

$product_id = (int)$_GET['product_id'];
$product = get_product($product_id);

if (!$product) {
    header('Location: ' . SITE_URL . 'pages/merch.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity > 0) {

        $_SESSION['current_order'] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'total_price' => $product['price'] * $quantity,
            'product_name' => $product['name']
        ];
        
        header('Location: ' . SITE_URL . 'payment_form/index.html');
        exit;
    }
}

require_once '../includes/header.php';
?>

<section class="checkout">
    <div class="container">
        <h1>Checkout</h1>
        
        <div class="checkout-grid">
            <div class="product-info">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <img src="<?php echo SITE_URL; ?>assets/images/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price">Price: $<?php echo number_format($product['price'], 2); ?></p>
            </div>
            
            <div class="order-form">
                <form method="post">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Total:</label>
                        <p class="total-price" id="totalPrice">$<?php echo number_format($product['price'], 2); ?></p>
                    </div>
                    
                    <button type="submit" class="btn">Place Order</button>
                    <a href="<?php echo SITE_URL; ?>pages/merch.php" class="btn cancel">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('quantity').addEventListener('input', function() {
    const quantity = this.value;
    const price = <?php echo $product['price']; ?>;
    const total = (quantity * price).toFixed(2);
    document.getElementById('totalPrice').textContent = '$' + total;
});
</script>

<?php
require_once '../includes/footer.php';
?>