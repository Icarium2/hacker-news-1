<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="card shadow p-4 mb-4 bg-card mw-100">
        <h1>Login</h1>
        <p><?php $message ?></p>

        <form action="app/users/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" required>
                <small class="form-text text-muted">Please provide your email address.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
                <small class="form-text text-muted">Please provide your password. <a class="nav-link" href="#">Forgot password? (Not functioning at this time)</a></small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>