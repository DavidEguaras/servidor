<form action="" method="post">
<input type="submit" value="Registro" name="Login_Registro">
</form>

<form action="" method="post">
    <br>    
    <p>Iniciar sesión</p>
    
    <label for="email">Email
        <input type="text" name="email" id="email">
    </label>
    <p class="error">
            <?php
                if(isset($errores))
                    errores($errores,'email');
            ?>
    </p>
    <label for="pass">Token:
        <input type="password" name="pass" id="pass">
    </label>
    <p class="error">
            <?php
                if(isset($errores))
                    errores($errores,'pass');
            ?>
    </p>
    <p class="error">
            <?php
                if(isset($errores))
                    errores($errores,'validado');
            ?>
    </p>
    <br>
    <input type="submit" value="Iniciar Sesión" name="Login_IniciarSesion">
    <br><br>
</form>

<form action="" method="post">
    <input type="submit" value="Volver a la página principal" name="Login_CerrarSesion">
</form>