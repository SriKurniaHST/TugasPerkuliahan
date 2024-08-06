<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan Sri</title>
    <link rel="stylesheet" href="/css/style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }

        .content h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 1.2em;
            color: #555;
        }

        .auth-links {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .auth-links a {
            text-decoration: none;
            color: black;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .auth-links a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
     <?= view('partials/navbar') ?>
    <div class="content">
        <h1>Selamat Datang di Perpustakaan Sri</h1>
        <p>Buku adalah kalam para perintis, penemu, dan pemimpi yang tidak akan pernah sirna ditelan masa.</p>
        <?php if (!session()->has('role')) { ?>
            <div class="auth-links">
                <a href="<?= site_url('/login') ?>">Masuk</a>
                <a href="<?= site_url('/register') ?>">Daftar</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
