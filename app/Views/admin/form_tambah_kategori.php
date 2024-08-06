<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Kategori</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <div style="padding-top: 30px;">
    <form action="/admin/tambahKategori" method="post" class="form-tambah-buku" enctype="multipart/form-data">
    <h2>Form Kategori</h2>
        <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
            <?php endif; ?>
        <div class="form-group">
            <label for="kode_kategori">Kode Kategori</label>
            <input type="text" id="kode_kategori" name="kode_kategori" required>
        </div>

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" required>
        </div>

        <button type="submit" class="tambah-buku">Simpan</button>
    </form>
    </div>

</body>
</html>

