<?php


require_once 'model/dataAccessObject/userDao.php'; // Incluir la definición de la clase UserDAO
require_once 'model/objectModels/userModel.php'; // Incluir la definición de la clase UserModel


class UserController extends BaseController
//EN CADA CONTROLLER TENGO QUE HACER VALIDACIONES, QUE DEVUELVAN UN ARRAY CON LOS ERRORES SOLO PARA POST Y PUT (LOS DEMAS SE VALIDAN "SOLOS")
/*tengo que comprobar:
    -Si un email tiene formato de email, 
    -Si el nombre de usuario es valido (contiene letras y numeros, sin caracteres especiales (solo barrabaja))
    -Si la contraseña es entre 10 y 20 caracteres, con mayusculas, minusculas, caracteres espciales y numeros
*/
{
    private $userDAO;

    public function __construct()
    {
        //$userDAO = new UserDAO();
        
    }

    public function metodo(){
        // SWTICH METHOD
        //get
         // index.php/user toods
         //index.php/user/1 busca id
         //index.php/user?user=maria&pass=maria usa filtros para la busqueda

         //post
         //llamo a la funcion que valide

        
    
    }

    public function createUser()
    {
        $datos = file_get_contents('php://input');
        $datos = json_decode($datos,true);
        print_r($datos);
        // Obtener los datos necesarios para crear un nuevo usuario
        // Validar los datos(array asociativo)
        $username = isset($data[2]) ? $data[2] : null;
        $name = isset($data[3]) ? $data[3] : null;
        $rol = isset($data[4]) ? $data[4] : null;
        $password = isset($data[5]) ? $data[5] : null;
        $email = isset($data[6]) ? $data[6] : null;

        

        // Crear un nuevo objeto UserModel con los datos proporcionados
        $newUser = new UserModel($username, $name, $rol, $password, $email, true);

        // Llamar al método createUser en UserDAO para agregar el nuevo usuario a la base de datos
        try {
            $result = $this->userDAO->createUser($newUser);
            if ($result) {
                $this->sendOutput('User created successfully', array('HTTP/1.1 201 Created'));
            } else {
                $this->sendOutput('Failed to create user', array('HTTP/1.1 500 Internal Server Error'));
            }
        } catch (Exception $e) {
            $this->sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }

    public function loginUser()
    {
        $data = $this->getUriSegments();
        // Obtener los datos necesarios para iniciar sesión
        $username = isset($data[2]) ? $data[2] : null;
        $password = isset($data[3]) ? $data[3] : null;

        try {
            // Llamar al método validateUser en UserDAO para validar las credenciales del usuario
            $user = $this->userDAO->validateUser($username, $password);
            
            if ($user && $user->isActive()) {
                $this->sendOutput('Login existoso', array('HTTP/1.1 200 OK'));
            } else {
                $this->sendOutput('Nombre de usuario o contraseña invalidos', array('HTTP/1.1 401 Unauthorized'));
            }
        } catch (Exception $e) {
            $this->sendOutput($e->getMessage(), array('HTTP/1.1 500 Internal Server Error'));
        }
    }


}
?>
