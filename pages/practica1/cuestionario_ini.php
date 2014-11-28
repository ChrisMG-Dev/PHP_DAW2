<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */
require_once('Verbo.php');
require_once('Cuestionario.php');


define("MAX_VERBOS", 145);

$validado = true;

if (isset($_GET['location']) && !empty($_GET['location'])) {
    $redirect = urldecode($_GET['location']);
} else {
    $redirect = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['comenzar'])) {
        $validado = false;
        if (!$validado) {
            header("Location: " . $redirect);
            exit;
        }     
    }
    if (!isset($_POST['dificultad']) || empty($_POST['dificultad'])) {
        $_SESSION['cuest_error'] = 'Debe seleccionar una dificultad';
        $validado = false;
        if (!$validado) {
            header("Location: " . $redirect);
            exit;
        }    
    } else {
        if ($_POST['dificultad'] != 'normal' 
            && $_POST['dificultad'] != 'dificil') {    
            $_SESSION['cuest_error'] = 'Dificultad seleccionada inválida';
            $validado = false;
        }
        if (!$validado) {
            header("Location: " . $redirect);
            exit;
        }          
    }
    
    if (!isset($_POST['verbos']) || empty($_POST['verbos'])) {
        $_SESSION['cuest_error'] = 'Debe seleccionar una cantidad de verbos';
        $validado = false;
        if (!$validado) {
            header("Location: " . $redirect);
            exit;
        }   
    } else {
        if (intval($_POST['verbos']) === 0 
                || intval($_POST['verbos']) > MAX_VERBOS) {
            $_SESSION['cuest_error'] = 'Cantidad de verbos inválido';
            $validado = false;
            if (!$validado) {
                header("Location: " . $redirect);
                exit;
            }
        }
    }
    
    $cuestionario = new Cuestionario('datos/verbos/prueba.txt',
            $_POST['verbos'], $_POST['dificultad']); 
    
    $respuestasCorrectasVerb = $cuestionario->getResVerbos();
    $respuestasCorrectas = array ();
    foreach ($respuestasCorrectasVerb as $resp) {
        $respuestasCorrectas[] = $resp->getInfinitivo();
        $respuestasCorrectas[] = $resp->getPasadoSimple();
        $respuestasCorrectas[] = $resp->getParticipativoPasado();
    }
    
    $_SESSION['cuestionario'] = array_chunk($respuestasCorrectas, 3);
    $_SESSION['tiempo'] = $cuestionario->getTiempoIni();
}

else {
    header("Location: " . $redirect);
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Cuestionario</title>
        <style>
            
            table {
                border-spacing: 10px;
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
            }
            
            .incorrecto {
                border: 2px solid red;
            }
        </style>
    </head>
    <body>
        <form 
            action="<?php 
                echo htmlspecialchars('?page=practica1/cuestionario_resultado')?>"
            method="post" >
            <table>
                <tr>
                    <th>Infinitive</th>
                    <th>Past tence</th>
                    <th>Past participe</th>    
                </tr>
                <?php
                if (!isset($_POST['corregir'])) {
                    foreach ($cuestionario->getVerbos() as $verbos) {
                        $conjunto = array (
                            $verbos->getInfinitivo(),
                            $verbos->getPasadoSimple(),
                            $verbos->getParticipativoPasado(),
                        );
                    
                    for ($i = 0; $i < count($conjunto); $i++) {
                        if ($conjunto[$i] == "?") {
                            $conjunto[$i] = "<input type='text' "
                                    . "name='respuestas[]'>";
                        } else {
                            $conjunto[$i] = "<input type='text' "
                                    . "name='respuestas[]'"
                                . " value='" . $conjunto[$i] . "'readonly>";  
                        }  
                    }

                    echo "<tr>";
                    foreach ($conjunto as $conj) {
                        echo "<td>" . $conj . "</td>";
                    }    
                    echo "</tr>";
                   }    
                }
                ?>
            </table>
            <input type="submit" value="Enviar" name="corregir" />
        </form>
    </body>
</html>

