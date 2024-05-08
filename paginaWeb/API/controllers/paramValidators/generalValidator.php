<?php
class GeneralValidator
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


  
}
?>
