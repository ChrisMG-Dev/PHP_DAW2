<?php
class Perro {
    private $_nombre;
    private $_color;
    private $_estomago;
    private $_animo;
    private $_salud;
    private $_peso;
    
    public function __construct ($nombre, $color,
            $estomago = "Inactivo") {
        
        $this->_nombre = $nombre;
        $this->_color = $color;
        $this->_estomago = $estomago;
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
    
    private function _hacerDigestion () {
        $this->_estomago = "Haciendo la digestión";
    }
    
    public function comer ($comida) {
        $this->_estomago = "Acabo de comerme un " . $comida;
        return ($this->_estomago);
    }
    
    public function tocar ($lugar) {
        return ("Me han tocado en el/la " . $lugar);
    }
    
    private function _moverCola () {
        return ("Muevo la cola");
    }
    
    private function _hacerNecesidades () {
        return ("Hago mis necesidades"); 
    }
}

