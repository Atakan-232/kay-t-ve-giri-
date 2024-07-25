<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("location: index.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $subscribe = isset($_POST["subscribe"]) ? 1 : 0; // Checkbox'ın durumu

    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email Has Already Been Taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            $hashedPw = hash('sha256', $password);
            $query = "INSERT INTO tb_user (name, username, email, password, subscribe) VALUES ('$name', '$username', '$email', '$hashedPw', '$subscribe')";
            mysqli_query($conn, $query);
            echo "<script> alert('Registration Successful'); </script>";
        } else {
            echo "<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body {
            background-color: aqua;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Kayıt</h2>
    <form action="" method="post" autocomplete="off">
        <label for="name">İsim:</label>
        <input type="text" class="field" name="name" id="name" required value=""><br>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" class="field" name="username" id="username" required value=""><br>
        <label for="email">E-posta:</label>
        <input type="email" class="field" name="email" id="email" required value=""><br>
        <label for="password">Şifre:</label>
        <input type="password" class="field" name="password" id="password" required value=""><br>
        <label for="confirmpassword">Şifreyi Onayla:</label>
        <input type="password" class="field" name="confirmpassword" id="confirmpassword" required value=""><br>
        <label for="subscribe">
            <input type="checkbox" name="subscribe" id="subscribe"> Bültene abone ol
        </label><br>
        <button type="submit" class="field" name="submit">Kayıt Ol</button>
    </form>
    <br>
    <a href="login.php">Giriş Yap</a>
</body>
</html>
