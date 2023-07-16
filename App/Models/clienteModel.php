<?php

    class ClienteModel{
        public $nome;
        public $username;
        public $email;
        public $morada;
        public $fone;
        public $password;
        public $provincia;
        public $municipio;
        public $comuna;

        public function __construct($nome,$username,$email,$morada,$fone,$password,$provincia
                ,$municipio,$comuna) {
                    $this->nome=$nome;
                    $this->username= $username;
                    $this->email = $email;
                    $this->morada = $morada;
                    $this->fone = $fone;
                    $this->password = $password;
                    $this->provincia = $provincia;
                    $this->municipio = $municipio;
                    $this->comuna = $comuna;

        }
    
        function getNome() {
           return $this->nome;
        }
    
        function getUsername() {
            return $this->username;
        }
    
        function getEmail() {
           return $this->email;
        }
        
        function getMorada() {
            return $this->morada;
         }

        function getFone() {
           return $this->fone;
        }
    
        function getPassword() {
           return $this->password;
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
    
        function setMorada($morada) {
            $this->morada = $morada;
        }

        function setFone($fone) {
            $this->fone = $fone;
        }
    
        function setPassword($password) {
            $this->password = $password;
        }
    
        function setProvincia($provincia) {
            $this->provincia = $provincia;
        }
    
        function setMunicipio($municipio) {
            $this->municipio = $municipio;
        }
    
        function setComuna($comuna) {
            $this->comuna = $comuna;
        }

    }
   
?>