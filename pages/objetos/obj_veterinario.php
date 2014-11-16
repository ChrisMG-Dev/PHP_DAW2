<?php
class Veterinario extends Persona {
    public function curar($animal) {
        $animal->estado = 100;
    }
}
