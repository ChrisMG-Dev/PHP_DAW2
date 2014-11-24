<?php
/**
 * Cuestionario de verbos irregulares en inglés.
 * Página principal
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */

// Incremento
define("INC_PREGUNTAS", 20);

// Número de preguntas disponibles
define("DISP_PREGUNTAS", 145);

function printOption($value, $text, $selected = false) {
    if ($selected) {
        $selected = "selected";
    }

    else {
        $selected = "";
    }

    echo "<option value='" . $value 
        . "'" . $selected 
        . ">" . $text 
        . "</option>";                            
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Verbos Irregulares</title>
        <style type="text/css">
            p label{
                width: 130px;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h1>Test Verbos Irregulares en Inglés</h1>
        <form action="?page=practica1/cuestionario_ingles" method="post">
            <p>
                <label id="lblDificultad">Dificultad: </label>
                <select name="optDificultad">
                    <option value="0" selected>Normal</option>
                    <option value="1">Difícil</option>
                </select>
            </p>
            <p>
                <label id="lblPalabras">Palabras: </label>
                <select name="selectPalabras">
                    <?php
                        for ($i = 0; $i < DISP_PREGUNTAS; $i += INC_PREGUNTAS) {
                            if ($i == INC_PREGUNTAS) {
                                printOption($i, $i, true);
                            }
                            
                            else if ($i < DISP_PREGUNTAS) {
                                printOption($i, $i);
                            }
                        }

                        if ($i - DISP_PREGUNTAS < INC_PREGUNTAS) {
                            $i = $i - ($i - DISP_PREGUNTAS);
                            printOption($i, $i);
                        }
                    ?>
                </select>
            </p>
            <input type="submit" name="empezar" value="Empezar" />
        </form>
    </body>
</html>