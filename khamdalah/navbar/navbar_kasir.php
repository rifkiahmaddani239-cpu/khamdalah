<?php
session_start();

if (!$_SESSION['login']) {
    header("Location: ../login.php");
}

if ($_SESSION['user']['role'] == 'admin') {
    header("Location: ../admin/index.php");
}

?>

<nav class="navbar">
    <a href="#" class="logo">Khamdalah</a>

    <ul class="nav-links">
        <li><a href="index.php">Beranda</a></li>
        <li><a href="kelola_transaksi.php">Kelola Transaksi</a></li>
        <li><a href="../logout.php">Keluar</a></li>
    </ul>

</nav>