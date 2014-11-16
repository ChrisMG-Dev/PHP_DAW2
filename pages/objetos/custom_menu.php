<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */

include_once "obj_persona.php";
include_once "obj_veterinario.php";

if(!isset($_POST['entrar'])) {
    header("Location: index.php?page=objetos/login_personas");
}

if(!isset($_SESSION['animales'])) {
    $_SESSION['animales'] = array();
}

if ($_POST['tipoPersona'] == "persona") {
    $persona = new Persona("Chuck", "Norris", "31889889A");
}

else if ($_POST['tipoPersona'] == "veterinario") {
    $persona = new Veterinario("Dr. Chuck", "Norris", "31889889A");
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Custom Menu</title>
    </head>
    <body>
        <h2>Animales</h2>
        <form action="?page=objetos/crear_animal" method="post">
            <?php
                if(isset($_SESSION['animales'])) {
                   echo "<ul>";
                   foreach ($_SESSION['animales'] as $animal) {
                       echo "<li>" . $animal->getNombre() . "</li>";
                   }
                   echo "</ul>";
                }
            ?>
            <input type="submit" name="crear" value="Crear animal" />            
        </form>
    </body>
</html>