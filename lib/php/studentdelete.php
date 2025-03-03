<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
require_once "students.php";

if (isset($_GET["id"])) {
    deleteStudent($_GET["id"]);
}

header("Location: student-list.php");
exit();
