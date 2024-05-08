<?php
class ParamValidator
{
    public static function validateParams($data, $requiredParams, &$error)
    {
        foreach ($requiredParams as $param) {
            if (!isset($data[$param]) || empty($data[$param])) {
                $error = $param;
                return false;
            }
        }
        return true;
    }

    public static function validatePassword($password)
    {
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            return false;
        }
        return true;
    }

    //validateEmail

    public static function validateName($name)
    {
        if (preg_match('/[0-9]/', $name)) {
            return false;
        }
        return true;
    }
    

    public static function validateRole($role)
    {
        if ($role !== 'user') {
            return false;
        }
        return true;
    }
  
}
?>
