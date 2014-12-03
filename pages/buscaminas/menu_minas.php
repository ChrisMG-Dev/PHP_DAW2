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

if (!isset($_SESSION)) {
    session_start();    
}

$numFilasErr = '';
$numColumnasErr = '';
$numMinasErr = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['numFilasErr'])) {
        $numFilasErr = $_GET['numFilasErr'];
    }
    if (isset($_GET['numColumnasErr'])) {
        $numColumnasErr = $_GET['numColumnasErr'];
    }
    if (isset($_GET['numMinasErr'])) {
        $numMinasErr = $_GET['numMinasErr'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Buscaminas</title>
        <style>
            label {
                display: inline-block;
                width: 100px;
            }
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="
            <?php
                echo htmlspecialchars('?page=buscaminas/validar'); 
            ?>
              " method="post">
            <p class="bloque">
                <label>Filas (2-15)</label>
                <input type="number"
                       name="numFilas"
                       min="2"
                       max="15"
                       pattern="^[2-9]+[0-9]*$"
                       title="Número de filas"
                       value="8"
                       maxlength="2"
                       size="2"
                       required
                       />
                <span class="error"><?php echo $numFilasErr; ?></span>
            </p>
            <p class="bloque">
                <label>Columnas (2-15)</label>
                <input type="number"
                       name="numColumnas"
                       min="2"
                       max="15"
                       pattern="^[2-9]+[0-9]*$"
                       title="Número de columnas"
                       value="8"
                       maxlength="2"
                       size="2"
                       required
                       />
                <span class="error"><?php echo $numColumnasErr; ?></span>
            </p>
            <p class="bloque">
                <label>Minas (1+)</label>
                <input type="number"
                       name="numMinas"
                       min="1"
                       pattern="^[1-9]+[0-9]*$"
                       title="Número de minas inferior a filas * columnas"
                       value="15"
                       maxlength="2"
                       size="2"
                       required
                       />
                <span class="error"><?php echo $numMinasErr; ?></span>
            </p>
            <br />
            <div class="buttonPanel">
                <input type="submit" name="empezar" value="Jugar" />
            </div>
        </form>
    </body>
</html>