<?

class User{
    private $id;
    private $user;
    private $token;
    private $caduca;


    function __construct($id,$user,$token,$caduca){
        $this->id = $id;
        $this->user = $user;
        $this->token = $token;
        $this->caduca = $caduca;
    }

    public function __get($att){
        if (property_exists(__CLASS__, $att)) {
            return $this->$att;
        }
    }
    public function __set($att, $val){
        if (property_exists(__CLASS__, $att)) {
            $this->$att = $val;
        }
 
    }

}