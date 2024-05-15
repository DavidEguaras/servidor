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

    public static function isActive($active)
    {
        if ($active == true){
            return true;
        }
        return false;
    }
    public static function validateRole($role)
    {
        if ($role !== 'user') {
            return false;
        }
        return true;
    }

    public static function validatePrice($price)
    {
        if (!is_numeric($price) || $price <= 0) {
            return false;
        }
        return true;
    }
}
?>
