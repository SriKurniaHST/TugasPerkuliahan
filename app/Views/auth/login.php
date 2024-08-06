<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <?= view('partials/navbar') ?>
    <div class="login-form">
        <h1>Login</h1>
        <form method="post" action="<?= base_url('auth/login') ?>">
            <?php if (session()->has('error')) : ?>
                <div class="error-message"><?= session('error') ?></div>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <div class="register-link">
            Belum punya akun? <a href="<?= site_url('/register') ?>">Klik disini</a>
        </div>
    </div>
</body>
</html>
