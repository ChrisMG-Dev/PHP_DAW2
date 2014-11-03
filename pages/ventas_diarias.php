<?php

    $ventasDiarias = array (
        1344.11, 1788.95, 1522.20, 1101.98, 1256.40,
        2407.13, 2105.33, 905.65, 1000.10, 1800.50,
        888.14, 2003.45, 1677.45, 1230.99, 1056.40,
        1456.56, 1924.98, 3103.33, 1203.33, 1023.44
        );
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Ventas diarias</title>
        <style>
            table, th, td {
                border-spacing: 0;
                border: 1px solid black;
                text-align: center;
            }
            
            td[colspan] {
                font-weight: bold;
                color: red;
            }
            
            th {
                padding: 1px 1px 1px 1px;
            }
            
        </style>
    </head>
    <body>
    <?php include("includes/source.php"); ?>
        <table>
            <tr>
                <th>Día</th>
                <th>Venta del día</th>
                <th>Acumulativo</th>
            </tr>
        <?php 
        
        setlocale(LC_MONETARY,"es_ES.UTF-8");
        
        $ventaAcumulada = 0;
        
        foreach ($ventasDiarias as $indice => $ventaDelDia) {
            echo ("<tr>");
            echo ("<th>" . ($indice + 1) . "</th>");
            echo ("<td>" . money_format("%.2n", $ventaDelDia) . "</td>");
            $ventaAcumulada += $ventaDelDia;
            echo ("<td>" . money_format("%.2n", $ventaAcumulada) . "</td>");
            echo ("</tr>");
        }
            
        echo ("<tr><th>Promedio</th>");
        echo ("<td colspan='2'>" . money_format(
                "%.2n",($ventaAcumulada / count ($ventasDiarias))
                ));
        echo ("</td></th>");
        ?>
        </table>
    </body>
</html>
