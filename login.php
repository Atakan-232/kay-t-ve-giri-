<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("location: index.php");
}

if(isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $hashedPw = hash('sha256', $password);
    
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0) {
        if($hashedPw == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["subscribe"] = $row["subscribe"]; // Checkbox durumunu sakla
            header("Location: index.php");
        } else {
            echo "<script>alert('Incorrect Password');</script>";
        }
    } else {
        echo "<script>alert('User Not Registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Giriş</title>
    <style>
        body {
            background-color: goldenrod;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Giriş</h2>
    <form action="" method="post" autocomplete="off">
        <label for="usernameemail">Kullanıcı Adı veya E-posta:</label>
        <input type="text" class="field" name="usernameemail" id="usernameemail" required value=""><br>
        <label for="password">Şifre:</label>
        <input type="password" class="field" name="password" id="password" required value=""><br>
        <button type="submit" class="field" name="submit">Giriş Yap</button>
    </form>
    <br>
    <a href="registration.php">Kayıt Ol</a>
</body>
</html>
