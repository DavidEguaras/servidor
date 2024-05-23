<?

class UserDAO{

    public static function crearUsuario($user, $token){
    $array = json_encode(array($user,$token));
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, URI_API."user");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
        array('Content-Type: application/json', 'Content-length: ' . strlen($array)));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($http_code != 201) {
        echo "No se ha podido insertar el recurso";
    }
    curl_close($ch);
    return $response;
    }

    public static function validarUsuario($user, $token){
        $sql = "select * from Usuarios where user = ? and token = ?";
        $parametros = array($user,$token);
        $result = FactoryBD::realizaConsulta($sql,$parametros);
        if($result->rowCount()==1){
            $usuarioStd = $result->fetchObject();
            $usuario = new User(
                $usuarioStd->id,
                $usuarioStd->user,
                $usuarioStd->token,
                $usuarioStd->caduca
            );
            // echo "LOGIN CORRECTO";
            return $usuario;
        } else {
            // echo "Login incorrecto";
            return null;
        }
    }

    public static function findCaducaByUser($user){
        //return 1 objeto usuario
        $sql = "select caduca from Usuarios where user = ?"; // and caduca < now()
        $parametros = array($user);
        $result = FactoryBD::realizaConsulta($sql,$parametros);
        
        if($result->rowCount()==1){
            $caduca = $result->fetchColumn();
            return $caduca;
        } else {
            return null;
        }
    }
}