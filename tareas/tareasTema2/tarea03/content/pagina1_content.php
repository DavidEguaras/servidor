<div class="container">
    <h1>Actividad 1 - PHP</h1>
    <p>Nombre del archivo: <?php echo $_SERVER['PHP_SELF']; ?></p>
    <p>Dirección IP del equipo: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
    <p>Path del archivo: <?php echo __FILE__; ?></p>
    <!-- Resto del contenido del ejercicio 1 -->
</div>
<div class="container">
    <h2>Enlace al archivo actual</h2>
    <p><a href="ver_archivo.php?archivo=pagina1_content.php">Ver Contenido del Archivo</a></p>
</div>
