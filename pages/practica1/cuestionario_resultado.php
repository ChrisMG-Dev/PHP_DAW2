<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */
require_once('Cuestionario.php');
require_once('Verbo.php');

if (empty($_SERVER['HTTP_REFERER'])) {
    $location = "index.php?page=practica1/cuestionario_index";
} else {
    $location = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['corregir'])) {
        header("Location: " . $location);
        exit;
    }
    
    if (!isset($_POST['respuestas'])
            || !isset($_SESSION['cuestionario'])
            || empty($_POST['respuestas'])
            || empty($_SESSION['cuestionario'])
        ) {
        header("Location: " . $location);
        exit;
    }
    
    $respondido = array_chunk($_POST["respuestas"], 3);
    $respuestas = $_SESSION['cuestionario'];
    $tiempoIni = $_SESSION['tiempo'];
    $tiempoFin = microtime(true);
    $tiempoTotal = $tiempoFin - $tiempoIni;
    echo "Tiempo total: " . intval($tiempoTotal) . " Segundos!!!";
    echo "<table>"
            . "<tr>"
            . "<th>Infinitive</th>"
            . "<th>Past tence</th>"
            . "<th>Past participe</th>"   
            . "</tr>";

    for ($i = 0; $i < count($respondido); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($respondido[$i]); $j++) {
            if ($respondido[$i][$j] == $respuestas[$i][$j]) {
                echo "<td>"
                    . "<input class='correcto' type='text' value='" . $respuestas[$i][$j] . "'"
                    . "readonly>" 
                    . "</td>";
            }
            else {
                echo "<td>"
                    . "<input class='incorrecto' type='text' value='" . $respondido[$i][$j] . "'"
                    . "title='La respuestas era: " . $respuestas[$i][$j] . "'"
                    . "readonly>" 
                    . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    header("Location: " . $location);
    exit;    
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title></title>
        <style>
            table {
                border-spacing: 10px;
                width: 500px;
                margin: 0 auto;
            }

            
            td, th {
                text-align: center;
                width: 120px;
            }
            
            input[type=text] {
                width: 120px;
                text-align: center;
            }
            
            input[type=text]:read-only {
                background-color: #e2e2e2;
                text-align: center;
            }

            form {
                display: block;
                width: 410px;
                margin: 0 auto;
            }
            
            input[type=submit]{
                display: block;
                margin: 0 auto; 
            }            
            .correcto {
                border: 2px solid green;
                color: green;
            }
            
            .incorrecto {
                border: 2px solid red;
                color: red;
            }
        </style>
    </head>
    <body>

    </body>
</html>