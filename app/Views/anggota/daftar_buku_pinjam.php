<?php use App\Models\BookModel; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku yang Sedang Dipinjam</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .daftar-buku {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .buku {
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .buku p {
            margin: 5px 0;
        }
        .buku h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?= view('partials/navbar') ?>
    <h1 style="padding-top: 30px;">Daftar Buku yang Sedang Dipinjam</h1>
    <div class="daftar-buku">
        <?php if (empty($books)) : ?>
            <p>Tidak ada buku yang sedang dipinjam saat ini.</p>
        <?php else : ?>
            <?php foreach ($books as $book) : ?>
                <div class="buku">
                    <h3>Judul :
                        <?php
                            $bukuModel = new BookModel();
                            $buku = $bukuModel->find($book['id_buku']);
                            echo $buku ? esc($buku['judul']) : '-';
                        ?>
                    </h3>
                    <p>Tanggal Peminjaman: <?= $book['tgl_peminjaman'] ?></p>
                    <p>Tanggal Pengembalian: <?= $book['tgl_pengembalian'] ?></p>
                    <br>
                    <p>Status: 
                        <?php 
                            if ($book['status'] === 'kembali') {
                                echo '<p style="color: green;">' . $book['status'] . '</p>';
                            } elseif ($book['tgl_pengembalian'] < date('Y-m-d')) {
                                $book['status'] = 'terlambat';
                                echo '<p style="color: red;">' . $book['status'] . '</p>';
                            } else {
                                echo '<p style="color: blue;">' . $book['status'] . '</p>';
                            }
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
