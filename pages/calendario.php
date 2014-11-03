<?php
    /**
     * Calendario PHP que muestra los días de un mes
     * de un determinado año cargado en una constante.
     * 
     * @author Muñoz Godenir Christopher
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
     * @version 1.02
     */


    $diasSemana = array(
        1 => "Lunes",
        2 => "Martes",
        3 => "Miércoles",
        4 => "Jueves",
        5 => "Viernes",
        6 => "Sábado",
        7 => "Domingo"
    );
    
    define('FECHA', '2015-01-01');
    define('PRIMER_DIA', substr_replace(FECHA, '01', 8));
    
    $dia = date("d", strtotime(FECHA));
    $diaSemana = date("N", strtotime(FECHA));
    $primerDiaMes = date("N", strtotime(PRIMER_DIA));
    $diasDelMes = date("t", strtotime(FECHA));
    
    if (substr(FECHA, 8) > $diasDelMes 
        || substr(FECHA, 8) <= 0) {
            echo ("Fecha inválida");
            exit(0);
    }
                
    //Número máximo de columnas del calendario
    define('MAX_COL', 7);
                
    //El número de celdas de una fila en todo momento
    $bloque = 0; 
                
    /* Indica si ya se ha alcanzado el primer día del mes, 
    * es necesario para crear celdas vacías si el primer día del
    * mes no empieza un lunes. */
    $flag = 0;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Calendario mes</title>
        <style>
            
            th, td, tr {
                font-family: Arial;
                font-size: larger;
            }
            
            th, td {
                padding-right: 15px;
                padding-left: 15px;
            }
            
            td {
                text-align: center;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            
            h2 {
                margin-left: 340px;
            }
            
            .actual {
                color: green;
                font-weight: bold;
            }
            
            .domingo {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2><?php echo (FECHA);?></h2>
        <table>
            <?php
                
                for ($dias = 1;$dias < 8;$dias += 1) {
                    echo("<th>$diasSemana[$dias]</th>");
                }
                
                echo ("<tr>");
                
                for ($dias = 1; $dias <= $diasDelMes; $dias += 1) {
                    
                    if ($bloque == MAX_COL) {
                        echo ("</tr><tr>");
                        $bloque = 0;
                    }
                   
                    if ($dias == $primerDiaMes && $flag == 0) {
                        $dias = 1;
                        $flag = 1;
                    }
                    
                    /*
                     * Se cumple una vez se hayan rellenado las posibles celdas
                     * vacías
                     */
                    
                    if ($flag == 1) {
                        
                        if ($dia == $dias) {
                            echo ("<td class='actual'>$dias</td>");
                        }
                        
                        else if ($bloque == (MAX_COL - 1)) {
                            $domingo = strtolower($diasSemana['7']);
                            echo ("<td class=\"$domingo\">$dias</td>");
                        }
                        
                        else {
                            echo ("<td>$dias</td>");
                        }
                        
                    }
                    
                    else {
                        echo ("<td>&nbsp;</td>");
                    }
                    
                    $bloque += 1;
                    
                }
                
                echo ("</tr>");
                
            ?>
        </table>
        <br />
    </body>
</html>
