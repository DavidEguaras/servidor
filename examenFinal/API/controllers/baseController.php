<?php

class BaseController
{
    public static function getUriSegments()
    {
        $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }

    public static function getQueryStringParams()
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    public static function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}

?>
