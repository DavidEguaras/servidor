<?


$caduca = UserDAO::findCaducaByUser($_SESSION['user']);
$_SESSION['caduca'] = $caduca;

if (isset($_REQUEST['Home_CerrarSesion'])){
    session_destroy();
    header('Location: ./index.php');
    exit;
}
elseif (isset($_REQUEST['Home_FiltrarCoches'])) {
    if (!empty($_REQUEST['filtrar_coches'])){
        $coches = CocheDAO::filtrarCoches($_REQUEST['filtrar_coches']);
        $_SESSION['coches'] = $coches;
    }
}
else {
    $coches = CocheDAO::findAllCoches();
    $_SESSION['coches'] = $coches;
}
