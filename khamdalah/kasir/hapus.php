<?php
require '../function/function.php';
session_start();

if (!$_SESSION['login']) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['user']['role'] == 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

if (hapus_transaksi($id) > 0) {
    echo "<script>
            alert('berhasil hapus');
            document.location.href = 'kelola_transaksi.php';
        </script>";
} else {
    echo "<script>
            alert('gagal hapus');
            document.location.href = 'kelola_transaksi.php';
        </script>";
}
