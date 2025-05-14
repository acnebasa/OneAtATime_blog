<!DOCTYPE html>
<html>
<head>
    <title>Register - OneAtATime</title>
</head>
<body>
    <h2>Register</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color:green;"><?= $success ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/register') ?>">
        <input type="text" name="user_name" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <p><a href="<?= site_url('auth/login') ?>">Already have an account? Login</a></p>
</body>
</html>
