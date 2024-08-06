<?php

use App\Models\PublisherModel;
use App\Models\CategoryModel;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penerbit</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <div style="padding-top: 30px;">
        <h1>Daftar Penerbit</h1>
    <?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    </div>
    <div style="padding-bottom: 20px;">
        <a href="/admin/form_tambah_penerbit" class="button-ubah">Tambah Penerbit</a>
    </div>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penerbit</th>
                <th>Nama Penerbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penerbitData as $key => $penerbit) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($penerbit['kode_penerbit']) ?></td>
                    <td><?= esc($penerbit['nama_penerbit']) ?></td>
                    <td>
                    <a href="/admin/form_ubah_penerbit/<?= esc($penerbit['id']) ?>" class="button-ubah">Ubah</a>
                    <a href="/admin/hapus_penerbit/<?= esc($penerbit['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="button-hapus">Hapus</a> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
