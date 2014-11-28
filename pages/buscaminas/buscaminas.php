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
unset($_SESSION['tablero']);
unset($_SESSION['visible']);
session_destroy();
session_start();
define("ROWS", 10);
define("COLS", 10);
define("MINES", 10);
define("MINE_TOKEN", 9);

if (!isset($_SESSION['tablero']) 
        || empty($_SESSION['tablero'])) {
    
    $_SESSION['tablero'] = array();
    $_SESSION['visible'] = array();
 
    crearTablero();
    establecerMinas();
    mostrarTablero();   
}

function crearTablero() {
    for ($filas = 0; $filas < ROWS; $filas += 1) {
        for ($columnas = 0; $columnas < COLS; $columnas += 1) {
            $_SESSION['tablero'][$filas][$columnas] = 0;
        }
    }
}

function crearTablaVisible() {
    for ($filas = 0; $filas < count($_SESSION['tablero']); $filas += 1) {
        for ($columnas = 0; $columnas < count($_SESSION['tablero'][$filas]);
            $columnas += 1) {
                
            $enlace = "<a href='?page=buscaminas/buscaminas"
                . "&fila=" . $filas . "&columna=" . $columnas . "'>";
            
            if ($_SESSION['tablero'][$filas][$columnas] === MINE_TOKEN) {
                $_SESSION['visible'][$filas][$columnas] = $enlace . "*</a>";
            }
            else if ($_SESSION['tablero'][$filas][$columnas] === 0) {
                $_SESSION['visible'][$filas][$columnas] = "&nbsp;";
            }
            else {
                $_SESSION['visible'][$filas][$columnas] =
                        $enlace . $_SESSION['tablero'][$filas][$columnas] 
                        . "</a>";
            }
        }
    }
}

function sumaContadorMinas($filas, $columnas) {
    if ($_SESSION['tablero'][$filas][$columnas] !== MINE_TOKEN) {
        $_SESSION['tablero'][$filas][$columnas] += 1;
    }    
}

function establecerNumeros($filas, $columnas) {
    // Buscar algoritmo luego
    if (isset($_SESSION['tablero'][$filas - 1][$columnas])) {
        sumaContadorMinas($filas - 1, $columnas);
    }
    
    if (isset($_SESSION['tablero'][$filas - 1][$columnas + 1])) {
        sumaContadorMinas($filas - 1, $columnas + 1);
    }
    
    if (isset($_SESSION['tablero'][$filas][$columnas + 1])) {
        sumaContadorMinas($filas, $columnas + 1);
    }
    
    if (isset($_SESSION['tablero'][$filas + 1][$columnas + 1])) {
        sumaContadorMinas($filas + 1, $columnas + 1);
    }
    
    if (isset($_SESSION['tablero'][$filas + 1][$columnas])) {
        sumaContadorMinas($filas + 1, $columnas);
    }
    
    if (isset($_SESSION['tablero'][$filas + 1][$columnas - 1])) {
        sumaContadorMinas($filas + 1, $columnas - 1);
    }
    
    if (isset($_SESSION['tablero'][$filas][$columnas - 1])) {
        sumaContadorMinas($filas, $columnas - 1);
    }
    
    if (isset($_SESSION['tablero'][$filas - 1][$columnas - 1])) {
        sumaContadorMinas($filas - 1, $columnas - 1);
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

function mostrarTablero() {
    
    crearTablaVisible();
    generarCabeceraHtml();
    echo "<form>"
        . "<table>";
    
    for ($filas = 0; $filas < ROWS; $filas += 1) {
        echo "<tr>";
        for ($columnas = 0; $columnas < COLS; $columnas += 1) {
            echo "<td>";
            echo $_SESSION['visible'][$filas][$columnas];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table></form>";
}

function generarCabeceraHtml() {
    echo "<html>"
        ."<head>"
        . "<meta charset='utf-8'>"
        . "<title>Buscaminas</title>"
        . "<style>"
        . "    table, tr, td {"
        . "         border: 1px solid gray; border-spacing: 0px;}"
        . "    td {width: 20px;height: 20px;text-align:center}"
        . "    a {display: inline-block;width: 100%;}"
        . "</style>"
        ."</head>";
}