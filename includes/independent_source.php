<?php

    $exercise = $_GET['page'] . '.php';
    echo "<p><a href='/showSource.php?file=" . $exercise 
        . "'>Ver código Fuente</a>";
    echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
    echo "<a href='/showSource.php?file=" . $exercise 
        . "&download=yes'>Descargar código fuente</a></p>";
            

