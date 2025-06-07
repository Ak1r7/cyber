<?php
require_once '../includes/config.php';
require_once '../includes/auth_functions.php';

if (!is_logged_in()) {
    header('Location: ' . SITE_URL . 'pages/login.php');
    exit;
}

require_once '../includes/header.php';
?>

<?php if (isset($_GET['order_success'])): ?>
    <div class="alert success">
        <p>Your order has been placed successfully!</p>
    </div>
<?php endif; ?>

<section class="profile">
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        
        <div class="profile-info">
            <h2>Your Account</h2>
            <p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <p>Member since: <?php 
                global $pdo;
                $stmt = $pdo->prepare("SELECT created_at FROM users WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch();
                echo date('F j, Y', strtotime($user['created_at']));
            ?></p>
        </div>
        
        <div class="orders">
            <h2>Your Orders</h2>
            <?php
            $stmt = $pdo->prepare("
                SELECT o.*, p.name as product_name, p.price as unit_price 
                FROM orders o 
                JOIN products p ON o.product_id = p.id 
                WHERE o.user_id = ? 
                ORDER BY o.order_date DESC
            ");
            $stmt->execute([$_SESSION['user_id']]);
            $orders = $stmt->fetchAll();
            
            if ($orders): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td>$<?php echo number_format($order['unit_price'], 2); ?></td>
                                <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                                <td><?php echo date('M j, Y', strtotime($order['order_date'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You haven't placed any orders yet.</p>
                <a href="<?php echo SITE_URL; ?>pages/merch.php" class="btn">Shop Now</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>