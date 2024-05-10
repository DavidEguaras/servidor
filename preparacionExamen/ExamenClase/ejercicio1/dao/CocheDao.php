<?

class CocheDAO{
    function findAllCoches(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URI_API."coches?token=".$_SESSION['token']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(curl_getinfo($ch,CURLINFO_HTTP_CODE)==405)
            return null;
        
        curl_close($ch);
        return $response;
    }

    public static function filtrarCoches($filtro) {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, URI_API."coches?token=".$_SESSION['token']."&fltro=".$filtro);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(curl_getinfo($ch,CURLINFO_HTTP_CODE)==405)
            return null;
        
        curl_close($ch);
        return $response;
    }
}

