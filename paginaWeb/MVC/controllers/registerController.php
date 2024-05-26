<?php
$errors = array();
if (isset($_REQUEST['registerSubmit'])) {
    $username = $_REQUEST['usernameRegister'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['passwordRegister'];
    $newUserData = [
        'username' => $username,
        'name' => $name,
        'rol' => 'user',
        'password' => $password,
        'email' => $email
    ];
    // Registrar el nuevo usuario en la base de datos
    $newUser = post("user", $newUserData);
    $_SESSION['view'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'loginController.php';
    require $_SESSION['controller'];
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>
