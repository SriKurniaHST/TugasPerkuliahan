<!DOCTYPE html>
<html>
<head>
    <title>Data diri anda</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
         .container {
            width: 40%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?= view('partials/navbar_khusus') ?>

    <div class="container">

    <h2>Masukkan Data diri anda</h2>

    <form action="/anggota/detailAnggota" method="post" class="form-tambah-member" enctype="multipart/form-data">
        <?php if(session()->has('errors')) : ?>
            <div>
                <?php foreach (session('errors') as $error) : ?>
                    <?= esc($error) ?><br>
                <?php endforeach ?>
            </div>
        <?php endif;?>
        

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" required>
        </div>

        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
        </div>

        <div class="form-group">
            <label for="telpon">Telepon:</label>
            <input type="text" id="telpon" name="telpon" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="foto_anggota">Foto Anggota:</label>
            <input type="file" name="foto_anggota" id="foto_anggota">
        </div>

        <button type="submit" class="tambah-member">Simpan</button>
    </form>
    </div>

</body>
</html>
