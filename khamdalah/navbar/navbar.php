<?php
session_start();

if ($_SESSION["user"]["role"] !== 'admin') {
    header("Location: ../kasir/index.php");
    exit;
}
?>
<nav class="navbar">
    <a href="#" class="logo">Khamdalah</a>

    <ul class="nav-links">
        <li><a href="index.php">Beranda</a></li>
        <li><a href="produk.php">Kelola Produk</a></li>
        <li><a href="laporan_transaksi.php">Lihat Transaksi</a></li>
        <li><a href="../logout.php">Keluar</a></li>
    </ul>

</nav>