<?php

use App\Models\PublisherModel;
use App\Models\CategoryModel;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?= view('partials/navbar') ?>
    <div style="padding-top: 30px;">
        <h1>Daftar Kategori</h1>
        <?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    </div>
    <div style="padding-bottom: 20px;">
        <a href="/admin/form_tambah_kategori" class="button-ubah">Tambah Kategori</a>
    </div>

    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kategori</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategoriData as $key => $kategori) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($kategori['kode_kategori']) ?></td>
                    <td><?= esc($kategori['nama_kategori']) ?></td>
                    <td>
                    <a href="/admin/form_ubah_kategori/<?= esc($kategori['id']) ?>" class="button-ubah">Ubah</a>
                    <a href="/admin/hapus_kategori/<?= esc($kategori['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="button-hapus">Hapus</a> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
