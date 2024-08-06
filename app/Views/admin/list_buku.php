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
        <h1>Daftar Buku</h1>
        <?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    </div>
    <div style="padding-bottom: 20px;">
        <a href="/admin/form_tambah_buku" class="button-ubah">Tambah Buku</a>
        <a href="/admin/list_penerbit" class="button-hapus">Tambah Penerbit</a>
        <a href="/admin/list_kategori" class="button-detail">Tambah Kategori</a>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Genre</th>
                <th>Ketersediaan</th>
                <th>Foto</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bukuData as $key => $buku) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($buku['isbn']) ?></td>
                    <td><?= esc($buku['judul']) ?></td>
                    <td><?= esc($buku['pengarang']) ?></td>
                    <td>
                    <?php
                        $publisherModel = new PublisherModel();
                        $publisher = $publisherModel->find($buku['id_penerbit']);
                        echo $publisher ? esc($publisher['nama_penerbit']) : '-';
                    ?>
                    </td>
                    <td><?= esc($buku['tahun_terbit']) ?></td>
                    <td><?php
                        $CategoryModel = new CategoryModel();
                        $category = $CategoryModel->find($buku['id_kategori']);
                        echo $category ? esc($category['nama_kategori']) : '-'; 
                    ?>
                    </td>
                    <td><?= esc($buku['jumlah_buku']) ?></td>
                    <td>
                    <?php if (!empty($buku['foto_buku'])) : ?>
                        <img src="/public/upload/buku/<?= esc($buku['foto_buku']) ?>" alt="Foto Buku" width="100" height="150">
                    <?php else : ?>
                        <span>Tidak Ada Foto</span>
                    <?php endif; ?>
                     </td>
                    <td>
                    <a href="/admin/form_ubah_buku/<?= esc($buku['id']) ?>" class="button-ubah">Ubah</a>
                    <a href="/admin/hapus_buku/<?= esc($buku['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="button-hapus">Hapus</a> 
                    <a href="/admin/detail_buku/<?= esc($buku['id']) ?>" class="button-detail">Detail</a>
                    </td>
                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
