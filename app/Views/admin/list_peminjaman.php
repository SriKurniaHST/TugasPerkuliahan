<?php 
use App\Models\BookModel;
use App\Models\UserModel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View All Loans</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* CSS styling can be added here */
    </style>
</head>
<body>
    <?= view('partials/navbar') ?>
    <h1 style="padding-top: 30px;">Semua Peminjaman</h1>
    <?php if (session()->has('success')) : ?>
        <div class="alert success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <div class="loan-list">
        <?php if (empty($loans)) : ?>
            <p>Tidak ada buku yang dipinjam.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loans as $loan) : ?>
                        <tr>
                        <td>
                                <?php
                                    $userModel = new UserModel();
                                    $user = $userModel->find($loan['id_user']);
                                    echo $user ? esc($user['username']) : '-';
                                ?>
                            </td>
                            <td>
                                <?php
                                    $bukuModel = new BookModel();
                                    $buku = $bukuModel->find($loan['id_buku']);
                                    echo $buku ? esc($buku['judul']) : '-';
                                ?>
                            </td>
                            <td><?= $loan['tgl_peminjaman'] ?></td>
                            <td><?= $loan['tgl_pengembalian'] ?></td>
                            <td><?= $loan['status'] ?></td>
                            <?php if($loan['status'] != 'Kembali') { ?>
                            <td><a href="/admin/kembali/<?= $loan['id'] ?>" class="button-ubah" onclick="return confirm('Apakah buku sudah kembali ke perpustakaan?')" >Kembali</td>
                            <?php }else{ ?>
                            <td>Buku sudah dikembalikan</td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>    
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
