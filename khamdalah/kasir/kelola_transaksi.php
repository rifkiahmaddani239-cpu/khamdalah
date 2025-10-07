<?php
require '../function/function.php';
session_start();

if (!$_SESSION['login']) {
    header("Location: ../login.php");
}

if ($_SESSION['user']['role'] == 'admin') {
    header("Location: ../admin/index.php");
}

$user_id = $_SESSION['user']['id'];

$transaksi = query("SELECT t.*
                    FROM transaksi t
                    WHERE t.user_id = $user_id
                    ORDER BY t.tanggal ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <nav class="navbar">
        <a href="#" class="logo">Khamdalah</a>

        <ul class="nav-links">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="kelola_transaksi.php">Kelola Transaksi</a></li>
            <li><a href="../logout.php">Keluar</a></li>
        </ul>

    </nav>

    <div class="content">

        <h2>Kelola Transaksi</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <?php $total = 0 ?>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>N<?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td>
                            <a href="detail_transaksi.php?id=<?= $row['id']; ?>">Detail</a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('yakin hapus');">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php $total += $row['total']; ?>
            <?php endforeach; ?>

            <tbody>
                <tr>
                    <th colspan="2">Total</th>
                    <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>