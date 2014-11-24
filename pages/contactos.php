<?php
    /**
     * Agenda de contactos que permite añadir y eliminar entradas.
     * 
     * @author Muñoz Godenir Christopher
     * @version 1.0
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
     */

    if (!isset($_SESSION)) { 
        session_start(); 
    } 
    
    if (!isset ($_SESSION['contactos'])) {
     $_SESSION['contactos'] = array();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Contactos</title>
        <style>
            label {
                width: 80px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
    <?php include("includes/independent_source.php"); ?>
        <form action="?page=contactos" method="post">
            <fieldset style="display: inline-block;">
                <p>
                    <label>Nombre</label>
                    <input type="text" name="nombre" required />
                </p>
                <p>
                    <label>Email</label>
                    <input type="text" name="email" required />
                </p>
            </fieldset><br/><br />
            <input type="submit" name="guardar" value="Guardar"/>
        </form>
    </body>
</html>

<?php
    
    if (isset ($_POST['guardar']) || isset ($_POST['eliminar'])) {
            
        if (isset ($_POST['eliminar'])){
            array_splice($_SESSION['contactos'],$_POST['eliminar'],1);
        }
    
        if (isset ($_POST['nombre']) || isset ($_POST['email'])) {
            $datos = array(
                "nombre" => $_POST['nombre'],
                "email" => $_POST['email']
            );
            $_SESSION['contactos'][] = $datos;  
        }

        if (count ($_SESSION['contactos']) > 0) {
            echo "<br/>";
            echo "<form action='?page=contactos' method='post'>";
            echo "<table>";
            echo "<tr>";

            foreach ($_SESSION['contactos'][0] as $cabecera => $dato) {
                echo ("<th>$cabecera</th>");
            }

            echo "</tr>";
            $contador = 0;
            foreach ($_SESSION['contactos'] as $contacto){
                echo ("<tr><td>" . $contacto["nombre"] . "</td><td>" 
                        . $contacto["email"] . "</td><td><button type='submit'"
                        . " value='".$contador++."' name='eliminar'>"
                        . "Eliminar</button></td></tr>");
            }

            echo "</table>";
            echo "</form>";
        }       
    }
    
?>

