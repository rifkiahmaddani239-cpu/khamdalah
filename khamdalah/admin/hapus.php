<?php
require '../function/function.php';
session_start();

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "<script>
            alert('berhasil hapus');
            document.location.href = 'produk.php';
        </script>";
} else {
    echo "<script>
            alert('gagal hapus');
            document.location.href = 'produk.php';
        </script>";
}
