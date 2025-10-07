<?php
require 'function/function.php';
if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username udah ada');
                document.location.href = 'register.php';
            </script>";
        return false;
    }

    if ($password1 !== $password2) {
        echo "<script>alert('password tidak sama');</script>";
    } else {
        $password = password_hash($password2, PASSWORD_DEFAULT);

        mysqli_query($conn, "INSERT INTO users (username, password)
                        VALUES ('$username', '$password')");

        echo "<script>
                alert('Berhasil daftar, silahkan login');
                document.location.href = 'login.php';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="form-container">

        <h2>Register</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"><br><br>
            </div>

            <div class="form-group">

                <label for="password1">Password: </label>
                <input type="password" name="password1" id="password1"><br><br>
            </div>

            <div class="form-group">

                <label for="password2">Password: </label>
                <input type="password" name="password2" id="password2"><br><br>
            </div>

            <button type="submit" name="daftar" class="btn">Daftar</button>
            <a href="login.php" class="register-link">Login sekarang</a>
        </form>
    </div>
</body>

</html>