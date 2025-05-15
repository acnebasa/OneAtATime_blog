<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - OneAtATime</title>
</head>
<body>
    <h2>Admin Login</h2>

    <?php if (!empty($error) || $this->session->flashdata('error')): ?>
        <p style="color:red;"><?= $error ?: $this->session->flashdata('error') ?></p>
    <?php endif; ?>

    <?php if (!empty($success) || $this->session->flashdata('success')): ?>
        <p style="color:green;"><?= $success ?: $this->session->flashdata('success') ?></p>
        <?php if (!empty($success)): ?>
            <script>
                setTimeout(() => {
                    window.location.href = '<?= site_url('admin/dashboard') ?>';
                }, 2000);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <form method="post" action="<?= site_url('admin/login') ?>">
        <input type="text" name="name" placeholder="Admin Name" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>