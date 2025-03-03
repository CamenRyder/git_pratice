<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nếu danh sách sinh viên chưa tồn tại, tạo một mảng rỗng
if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [];
}

// Lấy danh sách sinh viên
function getStudents()
{
    return $_SESSION["students"];
}

// Thêm hoặc sửa sinh viên
function saveStudent($id, $name, $email)
{
    if ($id === null) {
        // Thêm sinh viên mới
        $_SESSION["students"][] = ["id" => uniqid(), "name" => $name, "email" => $email];
    } else {
        // Cập nhật sinh viên
        foreach ($_SESSION["students"] as &$student) {
            if ($student["id"] === $id) {
                $student["name"] = $name;
                $student["email"] = $email;
                break;
            }
        }
    }
}

// Xóa sinh viên
function deleteStudent($id)
{
    $_SESSION["students"] = array_filter($_SESSION["students"], function ($student) use ($id) {
        return $student["id"] !== $id;
    });
}
