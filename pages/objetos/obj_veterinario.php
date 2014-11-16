<?php
require("pages/objetos/obj_persona.php");
class Veterinario extends Persona {
    public function curar($animal) {
        $animal->estado = 100;
    }
}
