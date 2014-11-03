<?php

    $primitiva = array ();

    // El número de bolas que se van a sacar
    define ('NUM_BOLAS', 6);
    
    // El valor de bola más baja
    define ('MIN_TIRADA', 1);
    
    // El valor de la bola más alta
    define ('MAX_TIRADA', 49);
    
    for ($i = 0; $i < NUM_BOLAS; $i += 1) {
        $numeroAleatorio = rand (MIN_TIRADA, MAX_TIRADA);
        
        if (in_array ($numeroAleatorio, $primitiva)) {
            $i -= 1;
        }
        
        else {
            $primitiva[] = $numeroAleatorio;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Primitiva</title>
        <style>
            .seleccionado {
                color: black;
                font-weight: bolder;
            }
            
            td {
                border-spacing: 0;
                border: 1px solid #FF00BB;
                margin: 1px 1px;
            }
            
            table {
                border: 4px solid #FF22BB;
                border-spacing: 0;
                
            }
            
            td {
                width: 40px;
                height: 40px;
                text-align: center;
                vertical-align: middle;
                color: #E04ACC;
            }
            
            td span {
                padding: 5px 5px 5px 5px;
                width: 15px;
                height: 15px;
                border: 1px solid #E04ACC;
                display: inline-block;
                font-size: 11px;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <table>
            <?php
            
            $casillaVacia = false;
            
            for ($fila = 0; $fila < 10; $fila += 1) {
                
                echo ("<tr>");
      
                    for ($casilla = $fila; $casilla <= ($fila + 40);
                        $casilla += 10) {

                        // Primera casilla en blanco
                        if ($fila == 0 && !$casillaVacia) {
                            echo ("<td><img src='pages/img/logo.png' width='42px'"
                                    . "height='42px' /></td>");
                            $casillaVacia = true;
                        }

                        else {
                            // Marcar seleccionados
                            if (in_array ($casilla, $primitiva)) {
                                echo ("<td class='seleccionado'><span>" 
                                        . $casilla . "</span></td>"); 
                            }
                            
                            else {
                                echo ("<td><span>" . $casilla . "</span></td>");   
                            }
                        }                         
                    }
                echo ("</tr>");
            }
            ?>
        </table>
    </body>
</html>