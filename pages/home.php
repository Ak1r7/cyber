<section class="hero">
    <div class="container" style="background-image: ">
        <h1>Welcome to CYBER.MD</h1>
        <p>Your ultimate cyber destination</p>
        <?php if (!is_logged_in()): ?>
            <a href="<?php echo SITE_URL; ?>pages/register.php" class="btn">Join Now</a>
        <?php endif; ?>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2>Our Features</h2>
        <div class="feature-grid">
            <div class="feature">
                <h3>Cyber News</h3>
                <p>Latest updates from the cyber world</p>
            </div>
            <div class="feature">
                <h3>Security Tips</h3>
                <p>Protect yourself online</p>
            </div>
            <div class="feature">
                <h3>Premium Merch</h3>
                <p>Exclusive cyber-themed products</p>
            </div>
        </div>
    </div>
</section>