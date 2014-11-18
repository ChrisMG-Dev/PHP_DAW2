<?php
include("obj_persona.php");
include("obj_perro.php");
class Index {
    public function ejecutar () {
        $persona = new Persona("Christopher", "Muñoz", "Godenir");
        $perro = new Perro("Floppy", "Negro");
        
        echo $persona->darComer($perro, "Jamón");
        echo "<br />";
        echo $persona->tocar($perro, "Cabeza");
        echo "<br />";
        echo $persona->decirEdad();
    }
}

$index = new Index();
$index->ejecutar();