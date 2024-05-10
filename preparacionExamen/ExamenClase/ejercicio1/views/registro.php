<form action="" method="post">
    <br>    
    <p>Registro</p>
    
    <label for="email">Email
        <input type="email" name="email" id="email">
    </label>
    <p class="error">
            <?php
                if(isset($errores))
                    errores($errores,'email');
            ?>
    </p>
    <p class="error">
            <?php
                if(isset($errores))
                    errores($errores,'validado');
            ?>
    </p>
    <input type="submit" value="Registrar" name="Registro_Registrar">
    <input type="submit" value="volver" name="Registro_volver">
    <br><br>
</form>