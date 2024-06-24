<?php

class Usuario
{     
    public $nome, $idade;

    public function cadastrar($nome, $idade){
        $this->nome = $nome;
        $this->idade = $idade;
    }
    
    public function imprimir(){
        $r = 'nome'.$this->nome.'<br>';
        $r = 'idade'.$this->idade.'<br>';

        return $r;
    }
}