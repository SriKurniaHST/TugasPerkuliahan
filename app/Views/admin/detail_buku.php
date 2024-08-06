
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="/css/style.css">   
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0;
            margin: 0;
            background-color: #f4f4f4;
        }

        .book-container {
            display: flex;
            width: 50%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            padding: 20px;
        }

        .book-details {
            padding: 20px;
        }

        .book-details h2 {
            margin-top: 0;
        }

        .book-details p {
            margin-bottom: 5px;
        }

        .book-cover img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
<?= view('partials/navbar') ?>
    <div class="book-container">
        <div class="book-cover">
            <?php if (!empty($buku['foto_buku'])) : ?>
                <img src="/public/upload/buku/<?= esc($buku['foto_buku']) ?>" alt="Foto Buku">
            <?php else : ?>
                <span>Tidak Ada Foto</span>
            <?php endif; ?> 
        </div>
        <div class="book-details">
            <h1><?= esc($buku['judul']) ?></h2>
            <p>ISBN: <?= esc($buku['isbn']) ?></p>
            <p>Pengarang: <?= esc($buku['pengarang']) ?></p>
            <p>Penerbit: <?= esc($buku['id_penerbit']) ?></p>
            <p>Tahun Terbit: <?= esc($buku['tahun_terbit']) ?></p>
            <p>Jenis Buku: <?= esc($buku['id_kategori']) ?></p>
            <p>Ketersediaan: <?= esc($buku['jumlah_buku']) ?></p>

            
        </div>
    </div>
</body>
</html>
