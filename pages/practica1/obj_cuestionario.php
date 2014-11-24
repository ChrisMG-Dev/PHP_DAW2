<?php

class Cuestionario {
    private $_preguntas;
    private $_estado;
    private $_puntuacion;
    
    public function __construct($preguntas) {
        $this->_preguntas = array ();
        foreach ($preguntas as $pregunta) {
            $this->_preguntas[] = $pregunta;   
        }
        
        $this->_estado = 1;
        $this->_puntuacion = 0;
    }
    
    public function getEstado() {
        return $this->_estado;
    }
    
    public function getPuntuacion() {
        return $this->_puntuacion;
    }
    
    public function getPreguntas() {
        return $this->_preguntas;
    }
    
    public function setPreguntas($preguntas) {
        $this->_preguntas = $preguntas;
    }
}

