<?php

class Verbo
{
    private $infinitivo;
    private $pasadoSimple;
    private $participativoPasado;
    
    public function __construct($infinitivo, $pasadoSimple,
            $participativoPasado)
    {
        $this->infinitivo = $infinitivo;
        $this->pasadoSimple = $pasadoSimple;
        $this->participativoPasado = $participativoPasado;
    }
    
    public function getInfinitivo() {
        return $this->infinitivo;
    }
    
    public function getPasadoSimple() {
        return $this->pasadoSimple;
    }
    
    public function getParticipativoPasado() {
        return $this->participativoPasado;
    }
    
    public function setInfinitivo($infinitivo) {
        $this->infinitivo = $infinitivo;
    }
    
    public function setPasadoSimple($pasadoSimple) {
        $this->pasadoSimple = $pasadoSimple;
    }
    
    public function setParticipativoPasado($participativoPasado) {
        $this->participativoPasado = $participativoPasado;
    }
}

