<?php
    require_once '../repository/gestoryRepository.php';
    class GestorService{
        private $gestorRepository=null;

        public function __construct(){
            $this->gestorRepository=new GestorRepository();
        }

        public function newOutdoor( $outdoor, $preco, $provincia,$municipio,$comuna){
           return $this->gestorRepository->insert( $outdoor, $preco, $provincia,$municipio,$comuna);
        }
        
        public function buscarAllOutdoor(){
            $result = $this->gestorRepository->select();
            return $result;
        }

        public function atualizarNaBd($id,$outdoor, $preco, $provincia,$municipio,$comuna){
            $result = $this->gestorRepository->update($id, $outdoor, $preco, $provincia,$municipio,$comuna);
            return $result;
        }

        public function deleteFromBd($id){
            $result = $this->gestorRepository->delete($id);
            return $result;
        }

        public function buscar(){
            return $this->gestorRepository->allSolicitacao();
        }

        public function buscarCaminhoId($id){
            return $this->gestorRepository->caminho($id);
        }

        public function enviarParaService($idaluguel){
            return $this->gestorRepository->aprovarSolicitacao($idaluguel);
            
        }

        public function recusarPedido($idaluguel){
            return $this->gestorRepository->recusarSolicitacao($idaluguel);
            
        }
    }
?>