<?php
// Verificar si las constantes no están ya definidas antes de definirlas
if (!defined('IMG')) {
    define('IMG', './webRoot/img/');
}
if (!defined('CSS')) {
    define('CSS', './webRoot/css/');
}
if (!defined('JS')) {
    define('JS', './webRoot/js/');
}
if (!defined('VIEW')) {
    define('VIEW', './views/');
}
if (!defined('CON')) {
    define('CON', './controllers/');
}

require_once('./core/funciones.php');
require_once('./core/curl.php');
require_once('./core/configurarAPI.php');
require_once('./config/confiBD.php');
?>
