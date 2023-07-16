<?php
    require_once '../repository/localizacaoRepository.php';

class LocalizacaoService{
    private $localizacaoRepository=null;

    public function __construct() {
        $this->localizacaoRepository = new LocalizacaoRepository();
    }

    public function selectAllProvince() {
        $selectAllProvince = $this->localizacaoRepository->selectProvince();
        return $selectAllProvince;
    }

    public function selectMunicipioPorProvincia($idprovincia){
        $selectAllMunicipo = $this->localizacaoRepository-> selectMunicipioProvince($idprovincia);
        return $selectAllMunicipo;
    }
    
    public function selectComunaPorMunicipio($idmunicipio) {
        $selectAllComuna = $this->localizacaoRepository-> selectComunaMunicipio($idmunicipio);
        return $selectAllComuna;
    }
}
