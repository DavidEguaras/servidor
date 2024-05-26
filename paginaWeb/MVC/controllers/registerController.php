<?php
echo($_SESSION['controller']);
$errors = array();
if (isset($_REQUEST['registerSubmit'])) {
    echo('hola');
    $username = $_REQUEST['usernameRegister'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['passwordRegister'];
    $newUserData = ([
        'username' => $username,
        'name' => $name,
        'rol' => 'user',
        'password' => $password,
        'email' => $email
    ]);

    // Registrar el nuevo usuario en la base de datos
    $newUser = post("user", $newUserData);

    if ($newUser) {
        $_SESSION['user'] = $newUser;
        //hacemos que en la session se guarde un array con los carros(objeto) del user
        $_SESSION['userCarts'] = get("cart?USER_ID=" . $_SESSION['user']['USER_ID']);
        $_SESSION['view'] = VIEW . 'home.php';
        $_SESSION['controller'] = CON . 'homeController.php';
        require $_SESSION['controller'];
    } else {
        $errors[] = "Invalid username or password.";
    }
}
?>
