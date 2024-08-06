<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <h1 style="padding-top: 25px;">Form Peminjaman</h1>
    <form action="/anggota/prosesPinjam" method="post"class = "form-tambah-buku">
        <input type="hidden" name="id_buku" value="<?= $id_buku ?>">
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam" required>
        </div>
        <div class="form-group">
            <label for="tanggal_kembali">Tanggal kembali:</label>
            <input type="date" name="tanggal_kembali" required>
        </div>
        <button type="submit" class="tambah-buku">Proses Peminjaman</button>
    </form>

</body>
</html>
