<?php
session_start();

if (isset($_POST['empezar'])) {
    $numFilasErr = '';
    $numColumnasErr = '';
    $numMinasErr = '';
    
    $validado = true;
    
    if (!isset($_POST['numFilas'])
    ) {
        $numFilasErr = "Debe introducir el número de filas";
        $validado = false;
    } else {
        $numFilas = test_input($_POST['numFilas']);
        if (!preg_match('/^[2-9]+[0-9]*$/', $numFilas)) {
            $numFilasErr = "Número de filas inválido";
            $validado = false;
        }
    }
    
    if (!isset($_POST['numColumnas'])) {
        $numColumnasErr = "Debe introducir el número de columnas";
        $validado = false;
    } else {
        $numColumnas = test_input($_POST['numColumnas']);
        if (!preg_match('/^[2-9]+[0-9]*$/', $numColumnas)) {
            $numColumnasErr = "Número de filas inválido";
            $validado = false;
        }
    }
    
    if (!isset($_POST['numMinas'])) {
        $numMinasErr = "Debe introducir el número de minas";
        $validado = false;
    } else {
        $numMinas = test_input($_POST['numMinas']);
        if (!preg_match('/^[1-9]+[0-9]*$/', $numMinas)) {
            $numMinasErr = "Número de minas inválido";
            $validado = false;
        }
    }
    
    if ($validado) {
        $_SESSION['numFilas'] = $numFilas;
        $_SESSION['numColumnas'] = $numColumnas;
        $_SESSION['numMinas'] = $numMinas;
        header('Location: index.php?page=buscaminas/buscaminas');
        exit;
    } else {
        $errorString = '';
        $errorString .= '&numFilasErr=' . $numFilasErr;
        $errorString .= '&numColumnasErr=' . $numColumnasErr;
        $errorString .= '&numMinasErr=' . $numMinasErr;
        header("Location: index.php?page=buscaminas/menu_minas" . $errorString);
        exit;
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function test_input($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}