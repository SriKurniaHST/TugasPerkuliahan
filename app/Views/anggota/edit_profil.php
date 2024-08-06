<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profil</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <div class="container" style="padding-top: 30px;">
    <h1>Update Profil</h1>
    <form action="/anggota/updateProfil/<?= $profil['id'] ?>" method="post" class="form-tambah-buku" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= esc($profil['id']) ?>">
    <input type="hidden" name="id_user" value="<?= esc($profil['id_user']) ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= $profil['nama'] ?>" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" <?= $profil['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $profil['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $profil['tempat_lahir'] ?>" required>
        </div> 
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $profil['tgl_lahir'] ?>" required>
        </div> 
        <div class="form-group">
            <label for="telpon">Telpon:</label>
            <input type="text" id="telpon" name="telpon" value="<?= $profil['telpon'] ?>" required>
        </div> 
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?= $profil['alamat'] ?>" required>
        </div> 
        <div class="form-group">
            <label for="foto_anggota">Foto Profil:</label>
            <input type="file" id="foto_anggota" name="foto_anggota">
        </div>
        <div class="form-group">
            <button class = "tambah-buku" type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>
