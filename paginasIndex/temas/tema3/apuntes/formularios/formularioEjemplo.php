<?php
    include("./validaciones.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <?php
        $errores=array();
        

        if(enviado()){ 
            validaFormulario($errores);           
            echo "<pre>";
            print_r($_REQUEST);
        }else{
    ?>

    <!--enviar datos del usuario/cliente al servidor
        action => donde se quieren enviar los datos
                Si no se le da un fichero llama a la pagina actual
        method => como se envian (GET en la URL/POST oculto en la caja name )        
    -->
    <form action="" method="post" name="formulario1" enctype="multipart/form-data">
        <label for="nombre">Nombre:<input type="text" name="nombre" id="nombre" placeholder="nombre" 
        value=<?php recuerda('nombre')?>></label>
        <p class="error">
                <?php  errores($errores,'nombre'); ?>
        <p>
        <label for="apellido">Apellido: <input  type="text" name="apellido" id="apellido" 
        value=<?php recuerda('apellido')?>></label>
        <p class="error">
                <?php  errores($errores,'apellido'); ?>
        <p>
        <br>

        <!--Si queremos que solamente se eliga uno se debe poner el mismo nombre
            value = determina lo que se manda        
        -->
        <label for="hombre">Hombre:<input 
            <?php
                recuerdaRadio('genero', 'hombre')
            ?>type="radio" name="genero" id="hombre" value="hombre"></label>
        <label for="mujer">Mujer:<input
        <?php
                recuerdaRadio('genero', 'mujer')
            ?> type="radio" name="genero" id="mujer" value="mujer"></label>
        <br>

        <!--
            Enviar mas de una del grupo se envia en el name el nombre con []      
        -->
        <p>Aficiones(Al menos una)</p>
        <label for="ch1">Montar a caballo<input <?php
                recuerdaCheck('aficion', 'jinete');
            ?>type="checkbox" name="aficion[]" id="ch1" value ="jinete"></label>
        <label for="ch2">Jugar al futbol<input <?php
                recuerdaCheck('aficion', 'futbolista');
            ?> type="checkbox" name="aficion[]" value="futbolista" id="ch2"></label>
        <label for="ch3">Nadar<input <?php
                recuerdaCheck('aficion', 'nadador');
            ?>type="checkbox" name="aficion[]" value="nadador" id="ch3"></label>
        <p class="error">
                <?php  errores($errores,'aficion'); ?>
        <p>
        <br>

        <!--
            Formato de la fecha año-mes-dia      
        -->
        <label for="fecha_n">Fecha Nacimiento <input
            value = '<?php recuerda('fecha_n');?>'
            type="datetime-local" name="fecha_n" id="fecha_n"></label>

        <p class="error">
                <?php  errores($errores,'fecha_n'); ?>
        <p>
        <br>

    
        <!--
            lo que queremos que nos pase tiene que estar en la etiqueta value     
        -->
        <p>Equipos Baloncesto</p>
        <select name="equipos" id="">
            <option value="0">Seleccione una opcion</option>
            <option value="Lakers">Lakers</option>
            <option value="Celtics">Celtics</option>
            <option value="Bulls">Bulls</option>
        </select>
        <br>

        <!--
            Fichero los recibe el servidoren $_FILES
        -->
        <input type="file" name="fichero" id="fichero">
        <br>
        
        <!--
            El usuario no lo ve en el navegador
            -Se le da un value para verificar que se en via al darle al boton
        -->
        <input type="hidden" name="usaurioVIP" value="156">
        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Borrar" name="borrar">
    </form>

    <?php
        }
    ?>
</body>
</html>