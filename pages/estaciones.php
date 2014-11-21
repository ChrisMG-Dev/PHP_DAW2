<?php

$fechaActual = getdate();
$mes = $fechaActual['mon'];
$diaSemana = $fechaActual['mday'];
$estacion = "ERROR";

$estaciones = array(
    "Primavera" => "pages/img/primavera.jpg",
    "Verano" => "pages/img/verano.jpg",
    "Otonio" => "pages/img/otonio.jpg",
    "Invierno" => "pages/img/invierno.jpg",
    "ERROR" => "pages/img/error.jpg"
);

if ($mes >= 3 && $mes <= 6) {
    if ($mes == 3 && $diaSemana >= 20) {
        $estacion = "Primavera";
    }
    
    else if ($mes == 6 && $diaSemana < 21) {
        $estacion = "Primavera";
    }
    
    else if ($mes == 4 || $mes == 5) {
        $estacion = "Primavera";
    }
    
    else {
        $estacion = "Verano";
    }
}

else if ($mes >= 6 && $mes <= 9) {
    if ($mes == 6 && $diaSemana >= 21) {
        $estacion = "Verano";
    }
    
    else if ($mes == 9 && $diaSemana < 23) {
        $estacion = "Verano";
    }
    
    else if ($mes == 7 || $mes == 8) {
        $estacion = "Verano";
    }
    
    else {
        $estacion = "Otonio";
    }
}

else if ($mes >= 9 && $mes <= 12) {
    if ($mes == 9 && $diaSemana >= 23) {
        $estacion = "Otonio";
    }
    
    else if ($mes == 12 && $diaSemana < 21) {
        $estacion = "Otonio";
    }
    
    else if ($mes == 10 || $mes == 11) {
        $estacion = "Otonio";
    }
    
    else {
        $estacion = "Invierno";
    }
}

else if ($mes == 12 && $diaSemana >= 21) {
    $estacion = "Invierno";
}

else if ($mes >= 1 && $mes <= 3) {
    if ($mes == 3 && $diaSemana < 20) {
        $estacion = "Invierno";
    }
    
    else if ($mes == 2) {
        $estacion = "Invierno";
    }
    
    else {
        $estacion = "Primavera";
    }
}

else {
    $estacion = "ERROR";
}

?>

<html>
    </<html>
        <head>
            <title></title>
        </head>
        <body>
            <div id="cabecera">
                <img src="
                     <?php 
                       echo($estaciones[$estacion]);
                     ?>
                     " height="168px"
                     width="100%"/>
            </div>
            <br />
            <?php include("includes/independent_source.php"); ?>
        </body>
    </html>

