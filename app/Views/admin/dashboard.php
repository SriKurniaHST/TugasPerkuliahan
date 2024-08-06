<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body style="padding-top: 20px;">
<?= view('partials/navbar') ?>
    <h1>Halo admin</h1>
    <?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
</body>
</html>