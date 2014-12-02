<?php
/**
 * Buscaminas
 *
 * Buscaminas empleando métodos recursivos
 *
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
define("ROWS", 5);
define("COLS", 5);
define("MINES", 2);
define("MINE_TOKEN", 9);
define("BOOM_TOKEN", 10);
define("MINE_GRAPHIC", "<img src='pages/img/mina.png' width='24px' height='24px'>");
define("BOOM_GRAPHIC", "<img src='pages/img/mina2.png' width='24px' height='24px'>");
define("BLANK_GRAPHIC", " ");
define("NUM_CASILLAS", ROWS * COLS);

if (!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['tablero']) 
        || !isset($_SESSION['visible'])
        || !isset($_GET['fila'])
        || !isset($_GET['columna'])) {
    
    $_SESSION['tablero'] = array();
    $_SESSION['visible'] = array();
    $_SESSION['gameover'] = false;
    $_SESSION['clicks'] = 0;
    
    crearTablero();
    establecerMinas();
    crearVisibilidad();
    mostrarTablero(); 
} else {
    
    $destapaFila = $_GET['fila'];
    $destapaColumna = $_GET['columna'];
    
    // El siguiente código neutraliza el problema de que cuente como un click
    // el refrescar la página
    if (!isset($_SESSION['ultimoDestapado'])) {
        $_SESSION['ultimoDestapado'] = $_GET['fila'] . ":" . $_GET['columna'];
    } else {
        if ($_SESSION['ultimoDestapado'] == $_GET['fila'] . ":" . $_GET['columna']) {
            $_SESSION['clicks'] -= 1;
        }
    }
    $_SESSION['ultimoDestapado'] = $_GET['fila'] . ":" . $_GET['columna'];
    $_SESSION['clicks'] += 1;
    destaparVacios($destapaFila, $destapaColumna);

    if ($_SESSION['gameover']) {
        for ($i = 0; $i < ROWS; $i++) {
            for ($j = 0; $j < COLS; $j++) {
                $_SESSION['visible'][$i][$j] = 1;
            }
        }
    }
    mostrarTablero(); 

}

function destaparVacios($filaDestapada, $columnaDestapada) {
    // Si la casilla está vacía
    if ($_SESSION['tablero'][$filaDestapada][$columnaDestapada] === 0) {
        
        // Recorrer sus ocho lados
        for ($row=$filaDestapada-1; $row <= $filaDestapada+1; $row++) { 
            for ($col=$columnaDestapada-1; $col <= $columnaDestapada+1;
                $col++) {
                    
                // Si existe la casilla y no es una mina
                if (isset($_SESSION['tablero'][$row][$col]) 
                        && $_SESSION['tablero'][$row][$col] !== MINE_TOKEN) {
                    
                    // Se comprueba si es una casilla en blanco sin destapar
                    if ($_SESSION['tablero'][$row][$col] === 0
                            && $_SESSION['visible'][$row][$col] === 0) {
                        
                        // Se muestra y se hace lo mismo con ella
                        $_SESSION['visible'][$row][$col] = 1;
                        destaparVacios($row, $col);
                    } else {
                        
                       // Si es un número se muestra pero no se aplica
                       // el algoritmo de destape
                       $_SESSION['visible'][$row][$col] = 1; 
                    }
                }  
            }
        }    
    } else {
        $_SESSION['visible'][$filaDestapada][$columnaDestapada] = 1;
        if ($_SESSION['tablero'][$filaDestapada][$columnaDestapada] 
                === MINE_TOKEN ) {
            $_SESSION['gameover'] = true;
            $_SESSION['tablero'][$filaDestapada][$columnaDestapada] = BOOM_TOKEN;
        }
    }
}

function crearTablero() {
    for ($filas = 0; $filas < ROWS; $filas += 1) {
        for ($columnas = 0; $columnas < COLS; $columnas += 1) {
            $_SESSION['tablero'][$filas][$columnas] = 0;
        }
    }
}

function crearVisibilidad() {
    for ($filas = 0; $filas < count($_SESSION['tablero']); $filas += 1) {
        for ($columnas = 0; $columnas < count($_SESSION['tablero'][$filas]);
            $columnas += 1) {
            $_SESSION['visible'][$filas][$columnas] = 0;
        }    
    }
}

function crearTablaOutput() {
    $boton = "<input type='button'>";
    $output = array();
    $numeroALetra = array(
        1 => "one",
        2 => "two",
        3 => "three",
        4 => "four",
        5 => "five",
        6 => "six",
        7 => "seven",
        8 => "eight",
    );
    for ($filas = 0; $filas < ROWS; $filas += 1) {
        for ($columnas = 0; $columnas < COLS; $columnas += 1) {
                        $enlace = "<a href='?page=buscaminas/buscaminas"
        . "&fila=" . $filas . "&columna=" . $columnas . "'>";

            if ($_SESSION['visible'][$filas][$columnas] === 0) {
                $output[$filas][$columnas] = $enlace . $boton . "</a>";                       
            } else {
                if ($_SESSION['visible'][$filas][$columnas] === 1) {
                    if ($_SESSION['tablero'][$filas][$columnas] ===
                            MINE_TOKEN) {
                        $output[$filas][$columnas] = MINE_GRAPHIC;   
                    }
                    else if ($_SESSION['tablero'][$filas][$columnas] ===
                            BOOM_TOKEN) {
                        $output[$filas][$columnas] = BOOM_GRAPHIC;   
                    }
                    else if ($_SESSION['tablero'][$filas][$columnas]
                            === 0) {
                        $output[$filas][$columnas] = BLANK_GRAPHIC; 
                    }
                    else {
                       $output[$filas][$columnas] = "<span class='" 
                               . $numeroALetra[$_SESSION['tablero'][$filas][$columnas]] . "'>
                               " . $_SESSION['tablero'][$filas][$columnas] . "</span>";
                    }
                }
            }
        }
    }
    return $output;
}

function sumaContadorMinas($filas, $columnas) {
    if (isset($_SESSION['tablero'][$filas][$columnas]) 
            && $_SESSION['tablero'][$filas][$columnas] !== MINE_TOKEN) {
        $_SESSION['tablero'][$filas][$columnas] += 1;
    }    
}

function establecerNumeros($filas, $columnas) {
    for ($row=$filas-1; $row <= $filas+1; $row++) { 
            for ($col=$columnas-1; $col <= $columnas+1; $col++) {
                sumaContadorMinas($row, $col);	
            }
    }
}

function establecerMinas() {

    for ($minas = 0; $minas < MINES; $minas += 1) {
        do {
            $filas = rand(0, ROWS - 1);
            $columnas = rand(0, COLS - 1);  
        } while ($_SESSION['tablero'][$filas][$columnas] === MINE_TOKEN);
        
        $_SESSION['tablero'][$filas][$columnas] = MINE_TOKEN;
        establecerNumeros($filas, $columnas);
    }
}

function gana()
{
    $numVisibles = 0;
    for ($filas = 0; $filas < count($_SESSION['visible']); $filas += 1) {
        for ($columnas = 0; $columnas < count($_SESSION['visible'][$filas]); $columnas++) {
            if ($_SESSION['visible'][$filas][$columnas] === 1) {
                $numVisibles += 1;
            }
        }  
        
        if ($numVisibles === NUM_CASILLAS - MINES) {
            echo "<h2>Has ganado</h2>";
        }
        
    }
}

function mostrarTablero() {
    $output = crearTablaOutput();
    generarCabeceraHtml();
    include("includes/independent_source.php");
    echo "<a href='?page=logout' align='center'>Empezar de nuevo</a><br/>";
    //echo "<b>Clicks: " . $_SESSION['clicks'] . "</b>";
    if ($_SESSION['gameover']) {
        echo "<h2>Has perdido</h2>";
    }
    gana();
    echo "<table>";
    
    for ($filas = 0; $filas < ROWS; $filas += 1) {
        echo "<tr>";
        for ($columnas = 0; $columnas < COLS; $columnas += 1) {
            echo "<td>";
            echo $output[$filas][$columnas];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function generarCabeceraHtml() {
    echo "<html>"
        ."<head>"
        . "<meta charset='utf-8'>"
        . "<title>Buscaminas</title>"
        . "<style>"
        . "    table, tr, td {"
        . "         border: 1px solid gray; border-spacing: 0px;}"
        . "    td {width: 25px;height: 25px;text-align:center; padding: 0 0;}"
        . "    a {display: inline-block;width: 100%; height: 100%; padding: 0 0; margin: 0 0;}"
        . "    span{font-weight: bolder;}"
        . "    .one {color: blue;}"
        . "    .two {color: green;}"
        . "    .three {color: red;}"
        . "    .four {color: #0C2885;}"
        . "    .five {color: #8A260B;}"
        . "    .six {color: #0B8A79;}"
        . "    .seven {color: black;}"
        . "    .eight {color: grey;}"
        . "    input[type=button]{display: inline-block; width: 100%; height: 100%;}"
        . "    input[type=button]:hover{background-color: #C7C7C7;}"
        . "    table {margin: 0 auto;}"
        . "</style>"
        ."</head>";
}