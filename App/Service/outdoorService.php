<?php
    require_once '../repository/outdoorRepository.php';

class OutdoorService{
    private $outdoorRepository=null;

    public function __construct() {
        $this->outdoorRepository = new OutdoorRepository();
    }

    public function getPrecoFromDB() {
        $preco = $this->outdoorRepository->selectPreco();
        return $preco;
    }

    public function getTipoOutdoorFromDB() {
        $tipoOutdoor = $this->outdoorRepository->selectTipoOutdoor();
        return $tipoOutdoor;
    }

    public function getOutdoorDesponivelFromDB() {
        $outdoorDesponivel = $this->outdoorRepository->selectOutdoorDesponivel();
        return $outdoorDesponivel;
    }

    public function getPesquisaFromDB($search) {
        $result = $this->outdoorRepository->selectAll($search);
        return $result;
    }
    
       
    
}
