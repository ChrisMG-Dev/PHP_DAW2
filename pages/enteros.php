<?php include("includes/independent_source.php"); ?>
<?php

    $enteros = array (
        1,23,55,23,24,66,10,76,22,41
    );
    
    echo ("<p>De los siguientes números:</p>");
    echo ("<p>");
    
    foreach ($enteros as $entero) {
        echo (" " . $entero);
    }
    
    echo ("</p>");
    echo ("<br />El entero más grande es: " . max ($enteros));
    echo ("<br />La media de los enteros es: " 
            . array_sum ($enteros) / count ($enteros));

?>