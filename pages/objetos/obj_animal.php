<?php
class Animal {
    private $_nombre;
    private $_especie;
    private $_raza;
    private $_animo;
    private $_hambre;
    private $_salud;
    private $_necesidades;
    
    public function __construct ($nombre, $especie, $raza, $animo = 100,
            $hambre = 0, $salud = 0) {
        $this->_nombre = $nombre;
        $this->_especie = $especie;
        $this->_raza = $raza;
        $this->_animo = $animo;
        $this->_hambre = $hambre;
        $this->_salud = $salud;
        $this->_necesidades = false;
    }
    
    public function comer ($comida) {
        if ($this->$hambre - 20 < 0) {
            $this->$hambre = 0;
        }
        
        else {
            $this->$hambre -= 20;
        }
    }
    
    public function  hacerNecesidades() {
        if ($this->_necesidades) {
            $this->_necesidades = false;
        }
    }
    
    public function getNombre () {
        return $this->_nombre;
    }
    
    public function getEspecie () {
        return $this->_especie;
    }
    
    public function getRaza () {
        return $this->_raza;
    }
}
