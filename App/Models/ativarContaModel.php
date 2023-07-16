<?php

    class AtivarContaModel{
      
        public $nome;
        public $username;
        public $email;
        public $tipoCliente;
        public $atividade;
        public $fone;
        public $morada;
        public $municipio;
        public $provincia;
        public $comuna;
        public $nacionalidade;
        public $categoria;
        public $estado;
        
           
    
        public function __construct($nome,$username,$email,$tipoCliente,$atividade,$fone,$morada,$provincia
                    ,$municipio,$comuna,$nacionalidade,$categoria,$estado)
         {

            $this->nome=$nome;
            $this->username= $username;
            $this->email = $email;
            $this->tipoCliente = $tipoCliente;
            $this->atividade = $atividade;
            $this->fone = $fone;
            $this->morada =$morada;          
            $this->provincia= $provincia;
            $this->municipio = $municipio;
            $this->comuna = $comuna;
            $this->nacionalidade = $nacionalidade;
            $this->categoria = $categoria;
            $this->estado = $estado;

        }
        
            function getNomeSolicitante() {
               return $this->nome;
            }
        
            function getUsername() {
                return $this->username;
            }
        
            function getEmail() {
               return $this->email;
            }

            function getTipoCliente() {
                return $this->tipoCliente;
            }

            function getAtividade() {
                return $this->atividade;
            }
        
            function getFone() {
               return $this->fone;
            }
        
            function getProvincia() {
               return $this->provincia;
            }
    
            function getMunicipio() {
               return $this->municipio;
            }
        
            function getComuna() {
               return $this->comuna;
            }
        
            function getNacionalidade() {
               return $this->nacionalidade;
            }
        
            function getCategoria() {
               return $this->categoria;
            }
        
        
            function getEstado() {
               return $this->estado;
            }

            function getMorada() {
                return $this->morada;
            }
             
            
            //seters
            function setNome($nome) {
                $this->nome=$nome;
            }
        
            function setUsername($username) {
                $this->username= $username;
            }
        
            function setEmail($email) {
                $this->$email = $email;
            }
            
            function setTipoCliente($tipoCliente) {
                $this->tipoCliente=$tipoCliente;
            }

            function setAtividade($atividade) {
                return $this->atividade=$atividade;
            }

            function setFone($fone) {
                $this->fone = $fone;
            }
        
            function setProvinciaCliente($provincia) {
                $this->provincia= $provincia;
            }
    
            function setMunicipio($municipio) {
                $this->municipio = $municipio;
            }
        
            function setComunaCliente($comuna) {
                $this->comuna = $comuna;
            }
        
            function setNacionalidade($nacionalidade) {
                $this->nacionalidade = $nacionalidade;
            }
        
            function setCategoria($categoria) {
                $this->categoria = $categoria;
            }
            
            function setEstado($estado) {
                $this->estado=$estado;
            }
            function setMorada($morada) {
                $this->morada = $morada;
            }
        
        }
   
?>
