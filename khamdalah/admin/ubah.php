<?php
require '../function/function.php';
// session_start();

// if ($_SESSION['user']['role'] !== 'admin') {
//     header("Location: ../login.php");
//     exit;
// }

$kategoriList = ['Peralatan', 'Pakaian', 'Eelektronik'];

$id = $_GET['id'];

$produk = query("SELECT * FROM produk WHERE id = $id")[0];

if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
            alert('berhasil ubah');
            document.location.href = 'produk.php';
        </script>";
    } else {
        echo "<script>
            alert('gagal ubah');
            document.location.href = 'produk.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Produk</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar.php' ?>

    <div class="form-container">

        <h2>Ubah Produk</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $produk['id']; ?>">

            <div class="form-group">
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" value="<?= $produk['nama']; ?>"><br><br>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori: </label>
                <select name="kategori" id="kategori">
                    <option value="#">-- Pilih Kategori --</option>
                    <?php foreach ($kategoriList as $kategori) : ?>
                        <option value="<?= $kategori ?>"
                            <?= ($produk['kategori'] == $kategori) ? 'selected' : '' ?>><?= $kategori ?></option>
                    <?php endforeach; ?>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="harga">Harga: </label>
                <input type="number" name="harga" id="harga" value="<?= $produk['harga']; ?>"><br><br>
            </div>

            <div class="form-group">
                <label for="stol">Stok :</label>
                <input type="number" id="stok" name="stok" value="<?= $produk['stok']; ?>"><br><br>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar: </label>
                <img src="../img/<?= $produk['gambar']; ?>" alt="" width="50"><br>
                <input type="file" name="gambar" id="gambar">
                <input type="hidden" name="gambarlama" value="<?= $produk['gambar']; ?>"><br><br>
            </div>

            <button type="submit" name="ubah" class="btn">Ubah Sekarang</button>
        </form>
    </div>
</body>

</html>