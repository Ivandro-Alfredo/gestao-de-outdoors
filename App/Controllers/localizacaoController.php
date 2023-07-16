<?php
    require_once '../Service/localizacaoService.php';

    class Localizacao {
        private $localizacaoService = null;

        public function __construct() {
            $this->localizacaoService = new LocalizacaoService();
        }

        public function obterProvincia() {
            $provincia = $this->localizacaoService->selectAllProvince();
            return $provincia;
        }

        public function obterMunicipioPorProvincia($idprovincia) {
          $municipios = $this->localizacaoService->selectMunicipioPorProvincia($idprovincia);  
          return $municipios;

        }
        public function obterComunaPorMunicipio($idmunicipio) {
            $comunas=$this->localizacaoService->selectComunaPorMunicipio($idmunicipio);  
            return $comunas;   
         }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $dados = file_get_contents('php://input');
        $path = json_decode($dados, true); 
        $localizacaoController = new Localizacao();

        if(isset($path['idprovincia'])){
            try {
                $result = $localizacaoController->obterMunicipioPorProvincia($path);
                header('Content-Type: application/json');
                echo json_encode($result);
            } catch (Exception $th) {
                echo "Error: " . $th->getMessage().", Requisicao nao foi concluida.";
            }
        }else if(isset($path['idmunicipio'])){
            try {
                $result = $localizacaoController->obterComunaPorMunicipio($path);
                header('Content-Type: application/json');
                echo json_encode($result);
            } catch (Exception $th) {
                echo "Error: " . $th->getMessage().", Requisicao nao foi concluida.";
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
            $localizacaoController = new Localizacao();
            $result = $localizacaoController->obterProvincia();
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $th) {
            echo "Error: " . $th->getMessage().", Requisicao nao foi concluida.";
        }
          
    }
?>
