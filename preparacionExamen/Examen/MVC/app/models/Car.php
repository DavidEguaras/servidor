<?php
class Car {
    public static function getCars($token, $filters = []) {
        $url = API_URL . '/cars';
        if (!empty($filters)) {
            $url .= '?' . http_build_query($filters);
        }

        $options = [
            'http' => [
                'header' => "Authorization: $token\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result);
    }
}
?>
