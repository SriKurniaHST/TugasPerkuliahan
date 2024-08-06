<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Buku</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>

    <form action="/admin/ubahBuku" method="post" class="form-tambah-buku" enctype="multipart/form-data">
    <h2>Form Ubah Buku</h2>
        <?php if(session()->has('errors')) : ?>
                <div>
            <?php foreach (session('errors') as $error) : ?>
                <?= esc($error) ?><br>
            <?php endforeach ?>
        </div>
            <?php endif; ?>
        <input type="hidden" name="id" value="<?= esc($buku['id']) ?>">
        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul"  value="<?= esc($buku['judul']) ?>" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" value="<?= esc($buku['isbn']) ?>" required>
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang:</label>
            <input type="text" id="pengarang" name="pengarang" value="<?= esc($buku['pengarang']) ?>" required>
        </div>

        <div class="form-group">
        <label for="id_penerbit">Penerbit :</label>
        <select name="id_penerbit">
            <?php foreach ($publishers as $publisher) : ?>
                <option value="<?= esc($publisher['id']) ?>"><?= esc($publisher['nama_penerbit']) ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" value="<?= esc($buku['tahun_terbit']) ?>" min="1900" max="2099" required>
        </div>

        <div class="form-group">
        <label for="id_kategori">Kategori :</label>
        <select name="id_kategori">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= esc($category['id']) ?>"><?= esc($category['nama_kategori']) ?></option>
            <?php endforeach; ?>
         </select>
        </div>

        <div class="form-group">
            <label for="jumlah_buku">Jumlah Buku:</label>
            <input type="number" id="jumlah_buku" name="jumlah_buku" value="<?= esc($buku['jumlah_buku']) ?>" min="1" required>
        </div>

        <div class="form-group">
            <label for="foto_buku">Foto Profil:</label>
            <input type="file" id="foto_buku" name="foto_buku">
        </div>

        <button type="submit" class="tambah-buku">Simpan Perubahan</button>
    </form>

</body>
</html>

