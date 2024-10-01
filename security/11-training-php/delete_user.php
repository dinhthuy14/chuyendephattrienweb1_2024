<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

// Kiểm tra token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token không hợp lệ!'); // Dừng lại nếu token không hợp lệ
}

$id = NULL;
if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $userModel->deleteUserById($id); // Xóa người dùng khỏi database
}

// Xóa token CSRF sau khi sử dụng để tránh sử dụng lại token cũ
unset($_SESSION['csrf_token']);

header('Location: list_users.php'); // Chuyển hướng về trang danh sách người dùng
exit;

