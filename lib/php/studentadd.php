<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
require_once "students.php";

$id = isset($_GET["id"]) ? $_GET["id"] : null;
$name = "";
$email = "";

// Nếu chỉnh sửa, lấy thông tin sinh viên
if ($id) {
    foreach ($_SESSION["students"] as $student) {
        if ($student["id"] === $id) {
            $name = $student["name"];
            $email = $student["email"];
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    saveStudent($id, $_POST["name"], $_POST["email"]);
    header("Location: studentlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?= $id ? "Sửa" : "Thêm" ?> sinh viên</title>
</head>

<body>
    <h2><?= $id ? "Sửa" : "Thêm" ?> sinh viên</h2>
    <form method="POST">
        <label>Tên:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        <br>
        <button type="submit">Lưu</button>
    </form>
</body>

</html>