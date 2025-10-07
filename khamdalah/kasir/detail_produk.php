<?php
require '../function/function.php';
session_start();

if (!$_SESSION['login']) {
    header("Location: ../login.php");
}

if ($_SESSION['user']['role'] == 'admin') {
    header("Location: ../admin/index.php");
}
$id = $_GET['id'];

$produk = query("SELECT * FROM produk WHERE id = $id")[0];

if (isset($_POST['beli'])) {
    if (beli($_POST) > 0) {
        echo "<script>
            alert('berhasil beli');
            document.location.href = 'kelola_transaksi.php';
        </script>";
    } else {
        echo "<script>
            alert('gagal beli');
            document.location.href = 'index.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar_kasir.php'; ?>

    <div class="content">
        <h2>Detail Produk</h2>
        <div class="detail-card">
            <img src="../img/<?= $produk['gambar']; ?>" alt="<?= $produk['nama']; ?>" width="200">
            <h3><?= $produk['nama']; ?></h3>
            <p>Kategori: <?= $produk['kategori']; ?></p>
            <p>Harga: <strong>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></strong></p>
            <p>Stok Tersedia: <?= $produk['stok']; ?></p>

            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $produk['id']; ?>">
                <input type="number" min="1" max="<?= $produk['stok']; ?>" value="1" name="jumlah">
                <button type="submit" name="beli" onclick="return confirm('Yakin ingin beli produk ini?');">
                    Beli Sekarang
                </button>
            </form>
        </div>
    </div>
</body>

</html>