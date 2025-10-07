<?php
require '../function/function.php';
// session_start();

// if (!$_SESSION['login']) {
//     header("Location: ../login.php");
// }

// if ($_SESSION['user']['role'] == 'admin') {
//     header("Location: ../login.php");
// }

$produk = query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar_kasir.php'; ?>

    <div class="content">
        <h2>Daftar Produk</h2>

        <div class="product-grid">
            <?php foreach ($produk as $row) : ?>
                <div class="product-card">
                    <a href="detail_produk.php?id=<?= $row['id']; ?>">
                        <img src="../img/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>">
                        <h3><?= $row['nama']; ?></h3>
                        <p>Stok: <?= $row['stok']; ?></p>
                        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>


</html>