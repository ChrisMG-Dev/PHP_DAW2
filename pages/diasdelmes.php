<?php
    $mes = 2;
    $anio = 2014;
    $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
?>

<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Días del mes</title>
    </head>
    <body>
        <p>
        <?php 
            echo("Hay $dias días en el mes $mes del año $anio.");
        ?>
        </p>
        <br />
        <?php include("includes/source.php"); ?>
    </body>
</html>

