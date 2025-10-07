<?php
require '../function/function.php';
// session_start();

// if ($_SESSION["user"]["role"] !== 'admin') {
//     header("Location: ../login.php");
//     exit;
// }

$produk = query("SELECT * FROM produk");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar.php'; ?>


    <div class="content">
        <h2>Silahkan Kelola Produk</h2>

        <a href="tambah.php">Tambah Produk</a><br><br>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            <?php foreach ($produk as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="../img/<?= $row['gambar']; ?>" alt="" width="50">
                        </td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('yakin');">Hapus</a>
                            <a href="ubah.php?id=<?= $row['id']; ?>">Ubah</a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>