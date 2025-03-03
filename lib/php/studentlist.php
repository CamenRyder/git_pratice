<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
require_once "students.php";
$students = getStudents();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>

<body>
    <h2>Danh sách sinh viên</h2>
    <a href="logout.php">Đăng xuất</a>
    <a href="studentadd.php">Thêm sinh viên</a>
    <table>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student["name"]) ?></td>
                <td><?= htmlspecialchars($student["email"]) ?></td>
                <td>
                    <a href="studentadd.php?id=<?= $student['id'] ?>">Sửa</a>
                    <a href="studentdelete.php?id=<?= $student['id'] ?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>