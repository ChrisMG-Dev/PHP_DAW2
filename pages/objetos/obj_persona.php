<?php
include_once("obj_animal.php");
class Persona {
    private $_nombre;
    private $_apellidos;
    private $_dni;
    
    public function __construct ($nombre, $apellidos, $dni) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
    }
    
    public function darDeComer(Animal $animal, $comida) {
        $animal->comer($comida);
    }
}
