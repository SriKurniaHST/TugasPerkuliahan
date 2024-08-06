<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran</title>
    <link rel="stylesheet" href="/css/style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <?= view('partials/navbar') ?>
    <div class="register-container">
        <h1>Registrasi</h1>
        <?php if(session()->has('errors')): ?>
            <div class="error-message">
                <?php foreach (session('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <form action="/auth/processRegister" method="post" class="register-form">
            <div>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Masukkan ulang password" required>
                <input type="checkbox" onclick="showPasswordMatch()"> Show Password
            </div>
            <br><br>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
        <div class="register-link">
            Sudah punya akun? <a href="<?= site_url('/login') ?>">Klik disini</a>
        </div>
    </div>

    <script>
    function showPasswordMatch() {
        var x = document.getElementById("password");
        var y = document.getElementById("confirm_password");

        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>


</body>
</html>
