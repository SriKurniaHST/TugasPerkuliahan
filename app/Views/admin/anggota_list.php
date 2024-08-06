<!DOCTYPE html>
<html>
<head>
    <title>Daftar Anggota</title>
    <link rel="stylesheet" href="/css/style.css"> 
</head>
<body>
    <?= view('partials/navbar') ?>
    <div style="padding-top: 30px;">
    <h1>Daftar Anggota</h1>
    </div>
    <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($siswaData as $key => $siswa) : ?>
                <tr>
                    <td><?=$key + 1?></td>
                    <td><?= esc($siswa['username']) ?></td>
                    <td style="text-transform: capitalize;"><?= esc($siswa['role']) ?></td>
                    <td>  <a href="/admin/detail_anggota/<?= esc($siswa['id']) ?>" class="button-ubah">Detail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
