<?

class Coche{
    private $id;
    private $marca;
    private $modelo;
    private $año_fabricacion;
    private $kilometraje;
    private $precio;
    private $color;
    private $descripcion;

    function __construct($id,$marca,$modelo,$año_fabricacion,$kilometraje,$precio,$color,$descripcion){
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año_fabricacion = $año_fabricacion;
        $this->kilometraje = $kilometraje;
        $this->precio = $precio;
        $this->color = $color;
        $this->descripcion = $descripcion;
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

    // id INT AUTO_INCREMENT PRIMARY KEY,
    // marca VARCHAR(50),
    // modelo VARCHAR(50),
    // año_fabricacion INT,
    // kilometraje INT,
    // precio DECIMAL(10,2),
    // color VARCHAR(20),
    // descripcion TEXT