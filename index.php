<?php
require 'config.php';
if(empty($_SESSION["id"])){
    header("location: login.php");
}

$id = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update_subscribe"])) {
    $subscribe = isset($_POST["subscribe"]) ? 1 : 0; // Checkbox'ın durumu
    mysqli_query($conn, "UPDATE tb_user SET subscribe = '$subscribe' WHERE id = $id");
    $_SESSION["subscribe"] = $subscribe; // Oturumda güncelle
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <style>
        body {
            background-color: blanchedalmond;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Hoşgeldin <?php echo htmlspecialchars($row["name"]); ?></h1>
    <form method="post" action="">
        <label for="subscribe">
            <input type="checkbox" id="subscribe" name="subscribe" <?php echo $row["subscribe"] ? 'checked' : ''; ?>> Bültene abone ol
        </label><br>
        <button type="submit" name="update_subscribe">Güncelle</button>
    </form>
    <br>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>
