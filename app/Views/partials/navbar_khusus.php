<?=
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
        <li class="nav-item"> 
            <form action="/auth/logout" method="post">
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>
