<?php
    class OutdoorModel{
        public $preco;

        public function __construct($preco){
            $this->preco = $preco;
        }

        public function getPreco(){
            return $this->preco;
        }
        public function setPreco($preco){
            $this->preco = $preco;
        }
        
    }
?>