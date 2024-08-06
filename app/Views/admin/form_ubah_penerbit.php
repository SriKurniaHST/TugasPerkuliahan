<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Buku</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>

    <form action="/admin/ubahPenerbit" method="post" class="form-tambah-buku">
    <h2>Form Ubah Penerbit</h2>
        <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
            <?php endif; ?>
        <input type="hidden" name="id" value="<?= esc($penerbit['id']) ?>">
        <div class="form-group">
            <label for="kode_penerbit">Kode Penerbit</label>
            <input type="text" id="kode_penerbit" name="kode_penerbit"  value="<?= esc($penerbit['kode_penerbit']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_penerbit">Nama Penerbit</label>
            <input type="text" id="nama_penerbit" name="nama_penerbit" value="<?= esc($penerbit['nama_penerbit']) ?>" required>
        </div>
        <button type="submit" class="tambah-buku">Simpan Perubahan</button>
    </form>

</body>
</html>

