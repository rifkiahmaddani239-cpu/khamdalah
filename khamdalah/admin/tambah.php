<?php
require '../function/function.php';

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Berhasil');
                document.location.href = 'produk.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal');
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
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <?php include '../navbar/navbar.php'; ?>
    <div class="form-container">

        <h2>Tambah Produk</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama">
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori">
                    <option value="#">-- Pilih Kategori --</option>
                    <option value="Peralatan">Peralatan</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Elektronik">Elektronik</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga: </label>
                <input type="number" name="harga" id="harga"><br><br>
            </div>

            <div class="form-group">
                <label for="stok">Stok: </label>
                <input type="number" name="stok" id="stok"><br><br>
            </div>

            <div class="form-group"></div>
            <label for="gambar">Gambar: </label>
            <input type="file" name="gambar" id="gambar"><br><br>

            <button type="submit" name="tambah" class="btn">Tambah</button>
        </form>
    </div>
</body>

</html>