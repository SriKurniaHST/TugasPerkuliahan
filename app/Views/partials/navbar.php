<?php
$id_user = session()->get('id')
?>
<nav class="navbar">
    <ul class="navbar-nav">
        <?php if(session('role') === 'admin'){ ?>
        <li class="nav-item"><a href="/admin/dashboard">Home</a></li>
        <?php } else if (session ('role') === 'anggota') { ?>
        <li class="nav-item"><a href="/anggota/dashboard">Home</a></li>
        <?php }else{ ?>
        <li class="nav-item"><a href="/">Home</a></li>
        <?php } ?>
    </ul>
    <?php if (session()->has('role')) { ?>
        <ul class="navbar-nav">
            <?php if (session('role') === 'admin') { ?>
                <li class="nav-item"> 
                    <a href="/admin/list_buku">Buku</a>
                </li>
                <li class="nav-item"> 
                    <a href = "/admin/anggota_list">Anggota</a>
                </li>
                <li class="nav-item"> 
                    <a href="/admin/list_peminjaman/">Peminjaman</a>
                </li>
                <li class="nav-item"> 
                    <form action="/auth/logout" method="post">
                        <button type="submit">Logout</button>
                    </form>
                </li>
            <?php } else  if (session('role') === 'anggota') { ?>
                <li class="nav-item"> 
                    <a href="/anggota/showProfil/<?= $id_user ?>">Profil</a>
                </li>
                <li class="nav-item"> 
                    <a href="/anggota/peminjaman/">Peminjaman</a>
                </li>
                <li class="nav-item"> 
                    <a href="/anggota/daftar_buku_pinjam/">Dipinjam</a>
                </li>
                <li class="nav-item"> 
                    <form action="/auth/logout" method="post">
                        <button type="submit">Logout</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</nav>
