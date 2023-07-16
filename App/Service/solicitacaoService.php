<?php
    require_once '../repository/solicitacaoRepository.php';
    class SolicitacaoService{
        private $solicitacaoRepository = null;
        public function __construct(){
            $this->solicitacaoRepository = new SolicitacaoRepository();
        }
        
        public function registarClienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa)
        {
            $result = $this->solicitacaoRepository->inserirClienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
            ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa);
            return $result;
        }
        
        public function registarClienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteParticular)
        {
            $result = $this->solicitacaoRepository->inserirClienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
            ,$municipio,$comuna,$nacionalidade,$clienteParticular);
            return $result;
        }

    }
?>