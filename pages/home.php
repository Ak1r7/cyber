<section class="hero">
    <div class="hero-content">
        <h1>Welcome to CYBER.MD</h1>
        <p>Your ultimate cyber security and technology destination</p>
        <?php if (!is_logged_in()): ?>
            <a href="<?php echo SITE_URL; ?>pages/register.php" class="btn">Join Our Community</a>
        <?php else: ?>
            <a href="<?php echo SITE_URL; ?>pages/merch.php" class="btn">Explore Our Products</a>
        <?php endif; ?>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2>Why Choose CYBER.MD?</h2>
        <div class="feature-grid">
            <div class="feature">
                <h3>Advanced Security</h3>
                <p>Cutting-edge cyber security solutions for your digital life</p>
            </div>
            <div class="feature">
                <h3>Premium Merch</h3>
                <p>Exclusive cyber-themed merchandise for enthusiasts</p>
            </div>
            <div class="feature">
                <h3>Community</h3>
                <p>Join our growing community of cyber professionals</p>
            </div>
        </div>
    </div>
</section>