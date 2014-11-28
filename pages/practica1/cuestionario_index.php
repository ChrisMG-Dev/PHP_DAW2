<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */
$errorMsg = '';

if (isset($_SESSION['cuest_error']) && !empty($_SESSION['cuest_error'])) {
    $errorMsg = $_SESSION['cuest_error'];
    unset($_SESSION['cuest_error']);
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Verbos Irregulares</title>
        <style>
            #errorMsg {
                color: red;
            }
        </style>
    </head>
    <body>
    <div id="container">
        <h1>Verbos Irregulares</h1>
        <form 
            action="<?php
                    echo htmlspecialchars(
                        '?page=practica1/cuestionario_ini&location=' 
                        . urlencode($_SERVER['REQUEST_URI']));?>"
            method="POST">
            <p>
                <label>Dificultad del test</label>
                <select name="dificultad" required>
                    <option value="normal" selected>Normal</option>
                    <option value="dificil">Difícil</option>
                </select>                    
            </p>
             <p>
                <label>Número de verbos</label>
                <select name="verbos" required>
                    <option value="20">20</option>
                    <option value="40" selected>40</option>
                    <option value="60">60</option>
                    <option value="80">80</option>
                    <option value="100">100</option>
                    <option value="120">120</option>
                    <option value="145">TODOS</option>           
                </select>                    
            </p>
            <br />
            <input type="submit" value="Comenzar!" name="comenzar" />
        </form>
        <div id="errorMsg"><?php $errorMsg ?></div>
     </div>
    </body>
</html>