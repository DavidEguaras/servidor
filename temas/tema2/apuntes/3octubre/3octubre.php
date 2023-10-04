<pre>
<?php
    print_r($_SERVER);

    print_r($_GET);
?>  
</pre>

<?php 
    echo "<h1>Ambito de Variables</h1>";
    $contador = 5;


    function PruebaVariable($contador){
        echo $contador;
    }

    function PruebaVariableParametro($contador){
        echo $contador;
        $contador++;
        echo $contador;
    }
    
    function PruebaVariableReferencia(&$contador){//es lo mismo que global, pero la global es menos liosa
        echo $contador . "<br>";
        $contador++;
        echo $contador;
    }

    function PruebaVariableGlobal(){
        global $contador;
        echo $contador . "<br>";
        $contador++;
        echo $contador;
    }

    echo "<p> No se puede acceder </p>";
    PruebaVariable($contador);
    echo "<p>Pasado como parametro</p>";


    function contador (){
        static $c = 0;
        $c++;
        echo "<br>" .$c;
    }


    contador();
    contador();
    contador();
    contador();
    contador();

    define("USER","Maria");
    echo USER;
?>