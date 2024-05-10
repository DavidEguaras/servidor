<?

require ('./modelo/User.php');
require ('./dao/FactoryBD.php');

class UserDAO{

    public static function crearUsuario($user, $token){
        $sql = "insert into Usuarios (user, token) values (?,?)";
        $parametros = array($user, $token);
        $result = FactoryBD::realizaConsulta($sql,$parametros);
        return true;
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
        $sql = "select caduca from Usuarios where token = ? and caduca > now()"; // and caduca < now()
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