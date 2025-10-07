<?php
require '../function/function.php';
// session_start();

// if ($_SESSION["user"]["role"] !== 'admin') {
//     header("Location: ../login.php");
//     exit;
// }

$id = $_GET['id'];

$transaksi = query("SELECT t.*, u.username
                FROM transaksi t
                JOIN users u ON t.user_id = u.id
                WHERE t.id = $id")[0];

$detail = query("SELECT td.*, p.nama, p.harga
                FROM transaksi_detail td 
                JOIN produk p ON td.produk_id = p.id
                WHERE td.transaksi_id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar.php'; ?>

    <div class="content">

        <h2>Detail Transaksi</h2><br>
        <h4>Nama Kasir : <?= $transaksi['username']; ?></h4>
        <h4>Nomer Nota : N<?= str_pad($transaksi['id'], 4, '0', STR_PAD_LEFT); ?></h4>
        <h4>Tanggal : <?= $transaksi['tanggal']; ?></h4><br>

        <table class="table">
            <tr>
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </thead>
            </tr>
            <?php $no = 1; ?>
            <?php $total = 0; ?>
            <?php foreach ($detail as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['qty']; ?></td>
                        <td>Rp <?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
                <?php $total += $row['subtotal']; ?>
            <?php endforeach; ?>
            <tbody>
                <tr>
                    <th colspan="4">Total</th>
                    <th>Rp <?= number_format($total, 0, ',', '.'); ?></th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>