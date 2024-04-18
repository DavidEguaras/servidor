<?php
class ParamValidator
{
    public static function validateParams($data, $requiredParams)
    {
        foreach ($requiredParams as $param) {
            if (!isset($data[$param]) || empty($data[$param])) {
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


    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }


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
