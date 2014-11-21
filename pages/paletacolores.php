<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Paleta de colores</title>
        <style>
            td a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
    <?php include("includes/independent_source.php"); ?>
        <table>
            <?php
                /**
                 * Programa que muestra una serie de paletas de colores
                 * con todas las combinaciones posibles desde el RGB(0,0,0)
                 * hasta el RGB(255,255,255) con un determinado incremento
                 * 
                 * @author Muñoz Godenir Christopher+
                 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
                 * @version 1.0
                 */
                define ('INCREMENTO', 15);
                   
                for ($rojo = 0; $rojo < 256; $rojo += INCREMENTO) {
                    for ($verde = 0; $verde < 256; $verde += INCREMENTO) {
                        for ($azul = 0; $azul < 256; $azul += INCREMENTO) {                      
                            $colores = "red=" . $rojo . "&green=" . $verde .
                                    "&blue=" . $azul; 
                            echo ("<td style='background-color: rgb($rojo, "
                                    . "$verde, $azul);'>"
                                    . "<a href='?page=ejercicio1&" . $colores 
                                    . "'>&nbsp;&nbsp;&nbsp;"
                                    . "&nbsp;&nbsp;&nbsp;&nbsp;</a></td>");
                           
                            if ($azul > ((255 - INCREMENTO))) {
                                echo("</tr><tr>");
                           
                            }
                        }
                    }
                        echo ("</tr><tr><td>&nbsp;</td></tr>");
                        
                }
                
            ?>
        </table>
    </body>
</html>
