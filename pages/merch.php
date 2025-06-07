<?php
require_once '../includes/config.php';
require_once '../includes/auth_functions.php';

if (!is_logged_in()) {
    header('Location: ' . SITE_URL . 'pages/login.php');
    exit;
}

$products = get_products();

require_once '../includes/header.php';
?>

<section class="merch">
    <div class="container">
        <h1>CYBER Merchandise</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert success">
                <p>Order placed successfully!</p>
            </div>
        <?php endif; ?>
        
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?php echo SITE_URL; ?>assets/images/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                    
                    <form action="<?php echo SITE_URL; ?>pages/checkout.php" method="get">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn">Buy Now</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>