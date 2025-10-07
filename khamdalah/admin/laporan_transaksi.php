<?php
require '../function/function.php';
// session_start();

// if ($_SESSION["user"]["role"] !== 'admin') {
//     header("Location: ../login.php");
//     exit;
// }

$transaksi = query("SELECT t.*, u.username
                    FROM transaksi t
                    JOIN users u ON t.user_id = u.id
                    ORDER BY t.tanggal ASC");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="../style//style.css">
</head>

<body>
    <?php include '../navbar/navbar.php'; ?>

    <div class="content">
        <h2>Daftar Transaksi</h2><br>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kasir</th>
                    <th>No Nota</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $pendapatan = 0; ?>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['username']; ?></td>
                        <td>N<?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td>
                            <a href="detail_transaksi.php?id=<?= $row['id']; ?>">Detail</a>
                        </td>
                    </tr>
                </tbody>
                <?php $pendapatan += $row['total']; ?>
            <?php endforeach; ?>
            <tr>
                <tbody>
                    <th colspan="3">Pendapatan</th>
                    <th colspan="3">Rp <?= number_format($pendapatan, 0, ',', '.'); ?></th>
                </tbody>
            </tr>
        </table>
    </div>
</body>

</html>