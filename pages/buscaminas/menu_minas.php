<?php
/**
 * Descripción corta
 *
 * Descripción larga 
 *
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Buscaminas</title>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="?page=buscaminas/buscaminas" method="post">
            <p class="bloque">
                <label>Filas (2-15)</label>
                <input type="number"
                       name="filas"
                       min="2"
                       max="15"
                       pattern="^[2-9]+[0-9]*$"
                       title="Número de filas"
                       value="8"
                       maxlength="2"
                       size="2"
                       required
                       />
            </p>
            <p class="bloque">
                <label>Columnas (2-15)</label>
                <input type="number"
                       name="columnas"
                       min="2"
                       max="15"
                       pattern="^[1-9]+[0-9]*$"
                       title="Número de columnas"
                       value="8"
                       maxlength="2"
                       size="2"
                       required
                       />
            </p>
            <p class="bloque">
                <label>Minas (1+)</label>
                <input type="number"
                       name="minas"
                       min="1"
                       pattern="^[1-9]+[0-9]*$"
                       title="Número de minas inferior a filas * columnas"
                       value="15"
                       maxlength="2"
                       size="2"
                       required
                       />
            </p>
            <br />
            <input type="submit" name="empezar" value="Jugar" />
        </form>
    </body>
</html>