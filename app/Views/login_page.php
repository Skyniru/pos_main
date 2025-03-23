<div class="container">
    <div class="login-container">
        <div class="login-header">
            <img src="<?=base_url('assets/images/logo.jpg')?>" alt="POS Logo">
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        
        <form action="<?= site_url('login') ?>" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-login">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="<?= site_url('forgot-password') ?>" class="btn btn-link">Forgot password?</a>
            <br>
            <span class="mt-2 d-block">Don't have an account? <a href="<?= site_url('register') ?>" class="btn btn-link">Register here</a></span>
        </div>
    </div>
</div>
