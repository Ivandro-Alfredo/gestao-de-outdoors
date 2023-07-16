<?php

    class SolicitacaoModel{
        private $nomeSolicitante;
        private $username;
        private $email;
        private $fone;
        private $password;
        private $provinciaCliente;
        private $municipioCliente;
        private $comunaCliente;
        private $nacionalidade;
        private $empresa;
        private $tipoCliente;
        private $atividadeEmpresa;
        private $provincia;
        private $municipio;
        private $comuna;

        public function __construct($nomeSolicitante,$username,$email,$fone,$password,$provinciaCliente
                ,$municipioCliente,$comunaCliente,$nacionalidade,$empresa,$tipoCliente,$atividadeEmpresa,
                $provincia,$municipio,$comuna) {
                    $this->nomeSolicitante=$nomeSolicitante;
                    $this->username= $username;
                    $this->email = $email;
                    $this->fone = $fone;
                    $this->password = $password;
                    $this->provinciaCliente= $provinciaCliente;
                    $this->municipioCliente = $municipioCliente;
                    $this->comunaCliente = $comunaCliente;
                    $this->nacionalidade = $nacionalidade;
                    $this->empresa = $empresa;
                    $this->tipoCliente = $tipoCliente;
                    $this->atividadeEmpresa = $atividadeEmpresa;
                    $this->provincia = $provincia;
                    $this->municipio = $municipio;
                    $this->comuna = $comuna;

        }
    
        function getNomeSolicitante() {
           return $this->nomeSolicitante;
        }
    
        function getUsername() {
            return $this->username;
        }
    
        function getEmail() {
           return $this->email;
        }
    
        function getFone() {
           return $this->fone;
        }
    
        function getPassword() {
           return $this->password;
        }
    
        function getProvinciaCliente() {
           return $this->provinciaCliente;
        }

        function getMunicipioCliente() {
           return $this->municipioCliente;
        }
    
        function getComunaCliente() {
           return $this->comunaCliente;
        }
    
        function getNacionalidade() {
           return $this->nacionalidade;
        }
    
        function getEmpresae() {
           return $this->empresa;
        }
    
        function getAtividadeEmpresa() {
           return $this->atividadeEmpresa;
        }
    
        function getTipoCliente() {
           return $this->tipoCliente;
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

        function setNomeSolicitante($nomeSolicitante) {
            $this->nomeSolicitante=$nomeSolicitante;
        }
    
        function setUsername($username) {
            $this->username= $username;
        }
    
        function setEmail($email) {
            $this->$email = $email;
        }
    
        function setFone($fone) {
            $this->fone = $fone;
        }
    
        function setPassword($password) {
            $this->password = $password;
        }
    
        function setProvinciaCliente($provinciaCliente) {
            $this->provinciaCliente= $provinciaCliente;
        }

        function setMunicipioClientee($municipioCliente) {
            $this->municipioCliente = $municipioCliente;
        }
    
        function setComunaCliente($comunaCliente) {
            $this->comunaCliente = $comunaCliente;
        }
    
        function setNacionalidadee($nacionalidade) {
            $this->nacionalidade = $nacionalidade;
        }
    
        function setEmpresa($empresa) {
            $this->empresa = $empresa;
        }
    
        function setAtividadeEmpresa($atividadeEmpresa) {
            $this->atividadeEmpresa = $atividadeEmpresa;
        }
    
        function setTipoCliente() {
            $this->tipoCliente;
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