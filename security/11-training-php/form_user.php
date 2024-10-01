<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; // Add new user
$_id = NULL;
$errors = [];

if (!empty($_GET['id'])) {
    $encoded_id = $_GET['id'];
    $_id = base64_decode($encoded_id);
    $user = $userModel->findUserById($_id);
}

if (!empty($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kiểm tra Name
    if (empty($name)) {
        $errors['name'] = "Name không được để trống.";
    } elseif (!preg_match('/^[A-Za-z0-9]{5,15}$/', $name)) {
        $errors['name'] = "Name từ 5-15 ký tự và không có ký tự đặc biệt";
    }

    // Kiểm tra Password
    if (empty($password)) {
        $errors['password'] = "Password không được để trống.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()])[A-Za-z\d~!@#$%^&*()]{5,10}$/', $password)) {
        $errors['password'] = "Password từ 5-10 ký tự, phải có chữ thường, chữ hoa, số và ký tự đặc biệt.";
    }

    if (empty($errors)) {
        if (!empty($_id)) {
            $userModel->updateUser($_POST);
        } else {
            $userModel->insertUser($_POST);
        }
        header('location: list_users.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_id) ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php echo !empty($user[0]['name']) ? htmlspecialchars($user[0]['name']) : '' ?>'>
                    <?php if (isset($errors['name'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['name']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <?php if (isset($errors['password'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>
</html>
