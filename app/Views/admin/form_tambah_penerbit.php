<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Penerbit</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <div style="padding-top: 30px;">
    <form action="/admin/tambahPenerbit" method="post" class="form-tambah-buku" enctype="multipart/form-data">
    <h2>Form Kategori</h2>
        <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
            <?php endif; ?>
        <div class="form-group">
            <label for="kode_penerbit">Kode Penerbit</label>
            <input type="text" id="kode_penerbit" name="kode_penerbit" required>
        </div>

        <div class="form-group">
            <label for="nama_penerbit">Nama Penerbit</label>
            <input type="text" id="nama_penerbit" name="nama_penerbit" required>
        </div>

        <button type="submit" class="tambah-buku">Simpan</button>
    </form>
    </div>

</body>
</html>

