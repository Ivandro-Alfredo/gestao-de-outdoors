<?php
    interface ISolicitacao{
        public function inserirClienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa); //
        public function inserirClienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteParticular);
       
    }
?>