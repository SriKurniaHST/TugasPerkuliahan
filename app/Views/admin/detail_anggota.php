
<!DOCTYPE html>
<html>
<head>
    <title>Profil Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 40%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile img {
            width: 150px;
            height: 250px;
            object-fit: cover;
            padding-bottom: 300px;
        }

        .profile-details {
            flex: 1;
            margin-left: 20px;
        }

        .profile-details p {
            margin-bottom: 10px;
        }

        .edit-button {
            text-align: center;
            margin-top: 20px;
        }

        .edit-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit-button a:hover {
            background-color: #0056b3;
        }

        h5{
            color: gray;
        }
    </style>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?= view('partials/navbar') ?>
    <div class="container" style="padding-top: 30px;">
        <h1>Profil Anggota</h1>
        <?php if (!empty($profil)) : ?>
            <div class="profile">
                <div class="profile-image">
                    <img src="/public/upload/anggota/<?= $profil['foto_anggota'] ?>" alt="Foto Profil">
                </div>
                <div class="profile-details">
                    <div>
                        <h5>Nama:</h5><p><?= $profil['nama'] ?></p>
                    </div>
                    <div>
                        <h5>Kode Anggota:</h5> <p><?= $profil['kode_anggota'] ?></p>
                    </div>
                    <div>
                        <h5>Jenis Kelamin:</h5> <p><?= $profil['jenis_kelamin'] ?></p>
                    </div>
                    <div>
                        <h5>Tempat Lahir:</h5> <p><?= $profil['tempat_lahir'] ?></p>
                    </div>
                    <div>
                        <h5>Tanggal Lahir:</h5> <p><?= $profil['tgl_lahir'] ?></p>
                    </div>
                    <div>
                        <h5>No Hp:</h5> <p><?= $profil['telpon'] ?></p>
                    </div>                
                    <div>
                        <h5>Alamat:</h5> <p><?= $profil['alamat'] ?></p>
                    </div>
                </div>
            </div>

        <?php else : ?>
            <p>Profil tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>

