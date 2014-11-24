<?php
/**
 * Descripcion
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
require_once("obj_cuestionario.php");

if(!isset($_POST['empezar'])) {
    header("Location: index?page=practica1/index_p1");
}

if(!isset($_SESSION["dificultad"])) {
    $_SESSION["dificultad"] = $_POST["optDificultad"];
}

if(!isset($_SESSION["preguntas"])) {
    $filePreguntas = fopen("datos/verbos/prueba.txt", "r");
    $preguntas = array();

    if ($filePreguntas) {
        // Recoge línea y verifica si existe
        while (($buffer = fgets ($filePreguntas)) !== false) {
            $buffer = explode (",", $buffer);    
            $preguntas[] = $buffer;
        }
        
        $cuestionario = new Cuestionario($preguntas);
        $preguntas_mod = $cuestionario->getPreguntas();
        $preguntas_rand = array();
        $numbers = range(0, count($preguntas_mod)- 1);
        shuffle($numbers);
        
        for ($i = 0; $i < $_POST['selectPalabras']; $i += 1) {
            $preguntas_rand[] = $preguntas_mod[$numbers[$i]];
        }
        
        if ($_POST["optDificultad"] == "0") {
            for ($i = 0; $i < count($preguntas_rand); $i += 1) {
                $preguntas_rand[$i][0] = "?";
            }
        }
        
        else if ($_POST["optDificultad"] == "1") {
            for ($i = 0; $i < count($preguntas_rand); $i += 1) {
                $preguntas_rand[$i][1] = "?";
                $preguntas_rand[$i][2] = "?";
            }
        }             
        
        $cuestionario->setPreguntas($preguntas_rand);
    }
    
    else {
        echo "Se ha producido un error en la lectura del archivo";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Preguntas</title>
        <style>
            .respVisible {
                display: inline-block;
                width: 10%;
            }
            
            input[type=text] {
                display: inline-block;
                width: 100px;
            }
            
            td {
                padding: 5px 30px;
                min-width: 100px;
                min-height: 30px;
            }
            
            table, td, th {
                border: 1px solid grey;
                border-spacing: 0;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2> Cuestionario </h2>
        <div id="contenedor">
            <table>
                <th>Infinitive</th>
                <th>Past tence</th>
                <th>Past participe</th>
            <?php
                foreach ($cuestionario->getPreguntas() as $preguntas => $pregunta) {
                    echo "<tr>";
                    foreach ($pregunta as $indice => $palabra) {
                        if ($pregunta[$indice] != "?") {
                            echo "<td class='respVisible'>" 
                                . $pregunta[$indice] . "</td>";
                        }

                        else {
                            echo "<td><input type='text' /></td>";
                        }
                    }
                    echo "</tr>";
                }  
            ?>                
            </table>
        
        </div>
    </body>
</html>