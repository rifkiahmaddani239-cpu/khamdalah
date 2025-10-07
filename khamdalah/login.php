<?php
require "function/function.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'role' => $row['role'] ?? 'kasir'
            ];

            if ($_SESSION['user']['role'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: kasir/index.php');
            }
        } else {
            echo "<script>alert('password salah bang!');</script>";
        }
    } else {
        echo "<script>alert('username belum terdaftar');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kasir</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="form-container">

        <h2>Silahkan Login</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"> <br><br>
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password"><br><br>
            </div>

            <button type="submit" name="login" class="btn">Masuk</button><br><br>
            <a href="register.php" class="register-link">Belum punya akun? Daftar di siniform</a>
        </form>

    </div>
</body>

</html>