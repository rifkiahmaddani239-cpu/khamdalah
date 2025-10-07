<?php
$conn = mysqli_connect("localhost", "root", "", "khamdalah");

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function uploadGambar()
{
    $namaFile = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
        return 'default.png';
    } else {
        $ekastensiValid = ['png', 'jpeg', 'jpg'];
        $ekstensiFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        if (!in_array($ekstensiFile, $ekastensiValid)) {
            echo "<script>alert('Tidak Valid !');</script>";
            return false;
        }

        $namaFileBaru = uniqid() . '.' . $ekstensiFile;

        move_uploaded_file($tmp, "../img/" . $namaFileBaru);

        return $namaFileBaru;
    }
}

function tambah($data)
{
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $harga = (int)($data['harga']);
    $stok = (int)($data['stok']);
    $gambar = uploadGambar();

    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO produk (nama, kategori, harga, stok, gambar) 
                VALUES ('$nama', '$kategori', $harga, $stok, '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;

    $produk = query("SELECT * FROM produk WHERE id = $id")[0];
    $gambar = $produk['gambar'];

    if ($gambar !== 'default.png' && file_exists('../img/' . $gambar)) {
        unlink("../img/" . $gambar);
    }

    mysqli_query($conn, "DELETE FROM produk WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = (int)($data['id']);
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $harga = (int)($data['harga']);
    $stok = (int)($data['stok']);
    $gambarLama = mysqli_real_escape_string($conn, $data['gambarlama']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        if ($gambarLama !== 'default.png' && file_exists("../img/" . $gambarLama)) {
            unlink("../img/" . $gambarLama);
        }
        $gambar = uploadGambar();
    }

    $query = "UPDATE produk
                SET nama = ?, kategori = ?, harga = ?, stok = ?, gambar = ? 
                WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssiisi", $nama, $kategori, $harga, $stok, $gambar, $id);

    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function beli($data)
{
    global $conn;

    $id = (int)($data['id']);
    $jumlah = (int)($data['jumlah']);

    $produk = query("SELECT * FROM produk WHERE id = $id")[0];

    $total = $jumlah * $produk['harga'];
    $kasir_id = $_SESSION['user']['id'];

    mysqli_query($conn, "INSERT INTO transaksi (user_id, total)
                    VALUES ($kasir_id, $total)");

    $transaksi_id = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, produk_id, qty, subtotal)
                    VALUES ($transaksi_id, $id, $jumlah, $total)");

    mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function hapus_transaksi($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id = $id");
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");

    return mysqli_affected_rows($conn);
}
