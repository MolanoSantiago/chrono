<?php
require_once('../modelos/tabla.php');

class controlatabla{

    public function __construct(){
        
    }

    public function mostrartabla(){
        $tabla = new tabla();
        return $tabla -> mostrartabla();
    }
    public function mostrarPerfil(){
        $tabla = new tabla();
        return $tabla -> mostrarPerfil();
    }
}



?>