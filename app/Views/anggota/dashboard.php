<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
<div style="padding-top: 30px;">

<?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <br>
    <h1>Halo <?=session('username'); ?></h1>
    <div>
</body>
</html>