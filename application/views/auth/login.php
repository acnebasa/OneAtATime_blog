<!DOCTYPE html>
<html>
<head>
    <title>Login - OneAtATime</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/login') ?>">
        <input type="text" name="user_name" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p><a href="<?= site_url('auth/register') ?>">Register</a></p>
</body>
</html>
