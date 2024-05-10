<?php
class User {
    public $username;
    public $password;
    public $token;

    public function __construct($username, $password, $token = null) {
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
    }

    public static function register($username, $password) {
        $data = [
            'username' => $username,
            'password' => $password
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents(API_URL . '/users', false, $context);
        return json_decode($result);
    }

    public static function login($username, $password) {
        $data = [
            'username' => $username,
            'password' => $password
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents(API_URL . '/login', false, $context);
        return json_decode($result);
    }
}
?>
