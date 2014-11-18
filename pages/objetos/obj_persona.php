<?php
class Persona {
    private $_nombre;
    private $_apellido;
    private $_edad;
    private $_fechaNacimiento;
    
    public function __construct($nombre, $apellido, $edad, 
            $fechaNacimiento = "1990/23/11") {
        $this->_nombre = $nombre;
        $this->_apellido = $nombre;
        $this->_edad = $edad;
        $this->_fechaNacimiento = date($fechaNacimiento);
    }

    public function decirEdad() {
        return ($this->_calcularEdad());
    }
    
    private function _calcularEdad() {
        $fechaActual = getdate();
        $edad = $fechaActual['year'] - $this->_fechaNacimiento['year'];

        if ($fechaActual['mon'] < $this->_fechaNacimiento['mon']) {
            $edad -= 1;
        }

        else if ($this->_fechaNacimiento['mon'] == $fechaActual['mon']) {
            if ($fechaActual['day'] < $this->_fechaNacimiento['day']) {
                $edad -= 1;
            }
        }
        
        return ($edad); 
    }
    
    public function tocar ($objeto, $lugar) {
        return ($objeto->tocar($lugar));
    }
    
    public function darComer ($objeto, $comida) {
        return ($objeto->comer($comida));
    }
}