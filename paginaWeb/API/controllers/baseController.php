<?php
class BaseController
{
    /*
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }*/

    public static function getUriSegments()
    {
        $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }

    public static function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    public static function sendOutput($data, $httpHeaders=array())
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