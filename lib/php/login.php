<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra thông tin đăng nhập (cố định là "tên sinh viên" và mật khẩu "123")
    if ($password === "123") {
        $_SESSION["username"] = $username;
        header("Location: studentlist.php");
        exit();
    } else {
        $error = "Sai mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng nhập</h2>
    <form method="POST">
        <label>Tên sinh viên:</label>
        <input type="text" name="username" required>
        <br>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Đăng nhập</button>
    </form>
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>

</html>