<?php
define('VIEW', './views/');
define('CON', './controllers/');

require('./core/funciones.php');
require('./core/curl.php');
require('./core/configurarAPI.php');
require('./config/configBD.php');
require('./model/FactoryBD.php');
require('./model/DAOs/usuariosDAO.php');
require('./model/modelObjects/Usuario.php');



?>
