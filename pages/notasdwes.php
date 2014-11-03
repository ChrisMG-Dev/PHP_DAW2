<?php
    /**
     * Calcula la nota final de la asignatura haciendo media con las notas
     * de los tres trimestres.
     * 
     * @author Muñoz Godenir Christopher
     * @version 1.0
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
     */

    $califAlumno = array (
            array (
                "nombre" => "Christopher",
                "1ev" => 9,
                "2ev" => 9,
                "3ev" => 9
            ),
            array (
                "nombre" => "Luis",
                "1ev" => 2,
                "2ev" => 1,
                "3ev" => 3
            ),
            array (
                "nombre" => "Antonio",
                "1ev" => 10,
                "2ev" => 10,
                "3ev" => 9
            ),
            array (
                "nombre" => "Dani",
                "1ev" => 8,
                "2ev" => 9,
                "3ev" => 9
            ),
            array (
                "nombre" => "Alejandro",
                "1ev" => 7,
                "2ev" => 10,
                "3ev" => 9
            ),
            array (
                "nombre" => "Juan Pedro",
                "1ev" => 2,
                "2ev" => 3,
                "3ev" => 6
            ),
            array (
                "nombre" => "Paz",
                "1ev" => 6,
                "2ev" => 8,
                "3ev" => 7
            ),        
            array (
                "nombre" => "Rubén",
                "1ev" => 5,
                "2ev" => 8,
                "3ev" => 10
            )
     );
            
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Notas Desarrollo Web Entorno Servidor</title>
        <style>
            table, th,tr, td {
                border-collapse: collapse;
                border: 2px solid black;
                font-size: x-large;
                text-align: center;
            }
            
            th {
                padding-right: 15px;
                padding-left: 15px;
            }
            
            .aprobado {
                color: green;
            }
            
            .suspenso {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <p>
            <strong>Se redondea a partir de .5 inclusive hacia arriba</strong>
        </p>
        <table>
            <tr>
            <?php
                foreach ($califAlumno[0] as $alumnos => $nombres) {
                    echo ("<th>$alumnos</th>");
                }
                
                echo ("<th>Nota final</th>");
                
                echo("</tr>");
                
                foreach ($califAlumno as $alumnos => $alumno) {
                    $notaMedia = 0;
                    $primerDato = true;
                    echo ("<tr>");
                    foreach ($alumno as $informacion) {
                        
                        echo ("<td>$informacion</td>");
                        if ($primerDato) {
                            $primerDato = false;
                        }
                        
                        else {
                             $notaMedia += $informacion;
                        }
                    }
                    
                    $notaFinal = round($notaMedia / 3);
                    
                    if ($notaFinal >= 5) {
                        $promocion = "aprobado";
                    }
                    
                    else {
                        $promocion = "suspenso";
                    }
                    
                    echo ("<td class='$promocion'>$notaFinal</td>");
                    echo ("</tr>");
                }
            ?>
        </table>
    </body>
</html>
