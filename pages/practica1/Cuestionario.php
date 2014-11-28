<?php
require_once('Verbo.php');
ini_set('auto_detect_line_endings', true);
class Cuestionario
{
    private $estado;
    private $tiempo_ini;
    private $tiempo_fin;
    private $tiempo_total;
    private $verbos;
    private $verbos_res;
    private $cantidad;
    private $dificultad;
    
    public function __construct($urlVerbos, $cantidad, $dificultad)
    {
        $this->estado = 1;
        $this->tiempo_ini = microtime(true);
        $this->cantidad = $cantidad;
        $this->dificultad = $dificultad;
        $this->verbos = $this->recogerVerbos($urlVerbos);
        $this->mezclarVerbos();
    }
    
    public function terminar() {
        $this->tiempo_fin = microtime(true);
        $this->tiempo_total = $this->tiempo_fin - $this->tiempo_ini;
        $this->estado = 0;
    }
    
    public function getTiempoIni() {
        return $this->tiempo_ini;
    }
    
    public function getTiempoTotal() {
        return $this->tiempo_total;
    }
    
    private function recogerVerbos($urlVerbos)
    {
        $filePreguntas = fopen($urlVerbos, "r");
        $preguntas = array();
        $i = 0;
        if ($filePreguntas) {
            // Recoge línea y verifica si existe
            while (($buffer = fgetcsv($filePreguntas)) !== false) {
                if($i < $this->cantidad) {
                    $verbo = new Verbo($buffer[0], $buffer[1], $buffer[2]);
                    $preguntas[] = $verbo;
                    $i++;   
                }
            }
        }  
        
        return $preguntas;
    }
    
    public function getVerbos()
    {
        return $this->verbos;
    }
    
    public function getResVerbos(){
        return $this->verbos_res;
    }
    
    private function addVerbo($verbo) {
        $this->verbos[] = $verbo;
    }
    
    private function setVerbos($verbos) {
        $this->verbos = $verbos;
    }
    
    private function setVerbosRes($verbos_res) {
        $this->verbos_res = $verbos_res;
    }
    
    private function mezclarVerbos()
    {
        $preguntas_rand = array();
        $numbers = range(0, count($this->getVerbos())- 1);
        shuffle($numbers);
        $verbos = $this->getVerbos();
        for ($i = 0; $i < count($verbos); $i += 1) {
            $preguntas_rand[] = $verbos[$numbers[$i]];
        }
        
        for ($i = 0; $i < count($verbos); $i += 1) {
            $respuestas_rand[] = clone($verbos[$numbers[$i]]);
        }
        
        $this->verbos_res = $respuestas_rand;
        
        if ($this->dificultad == 'normal') {
            for ($i = 0; $i < count($preguntas_rand); $i += 1) {
                $random = rand(0, 2);
                if ($random == 0) {
                   $preguntas_rand[$i]->setInfinitivo('?');  
                }
                else if ($random == 1) {
                    $preguntas_rand[$i]->setPasadoSimple('?'); 
                }
                else if ($random == 2) {
                    $preguntas_rand[$i]->setParticipativoPasado('?'); 
                }
            }
        }
        
        else if ($this->dificultad == 'dificil') {
            for ($i = 0; $i < count($preguntas_rand); $i += 1) {
                do {
                    $random1 = rand(0, 2);
                    $random2 = rand(0, 2);
                } while($random1 === $random2);
                if ($random1 == 0 || $random2 == 0) {
                  $preguntas_rand[$i]->setInfinitivo('?');  
                }
                if ($random1 == 1 || $random2 == 1) {
                    $preguntas_rand[$i]->setPasadoSimple('?'); 
                }
                if ($random1 == 2 || $random2 == 2) {
                    $preguntas_rand[$i]->setParticipativoPasado('?'); 
                }
            }
        }                
        $this->setVerbos($preguntas_rand);
    }
}