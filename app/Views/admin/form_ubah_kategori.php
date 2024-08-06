<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Buku</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>

    <form action="/admin/ubahKategori" method="post" class="form-tambah-buku">
    <h2>Form Ubah Kategori</h2>
        <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
            <?php endif; ?>
        <input type="hidden" name="id" value="<?= esc($category['id']) ?>">
        <div class="form-group">
            <label for="kode_kategori">Kode Kategori</label>
            <input type="text" id="kode_kategori" name="kode_kategori"  value="<?= esc($category['kode_kategori']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" value="<?= esc($category['nama_kategori']) ?>" required>
        </div>
        <button type="submit" class="tambah-buku">Simpan Perubahan</button>
    </form>

</body>
</html>

