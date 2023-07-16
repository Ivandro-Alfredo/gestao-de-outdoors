<?php
    require_once '../Service/outdoorService.php';

    class OutdoorController{
        #
        private $outdoorService = null;

       public function __construct()
       {
         $this->outdoorService = new OutdoorService();
       }

       public function consultarPrecoOutdoor(){
        $result= $this->outdoorService->getPrecoFromDB();
        return $result;
       }
      
       public function tipoOutdoor(){
         $result= $this->outdoorService->getTipoOutdoorFromDB();
         return $result;
       }

       public function outdoorDisponivel(){
        $result = $this->outdoorService->getOutdoorDesponivelFromDB();
         return $result;
       }
       
       
       public function pesquisar($search){
        $result = $this->outdoorService->getPesquisaFromDB($search);
        return $result;
      }

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dados = file_get_contents('php://input');
        $path = json_decode($dados, true);

        $precoOutdoor = new OutdoorController();
        if(isset($path['search'])){
            $search = $path['search'];
            $pesquisar=new OutdoorController();

            $result=$pesquisar->pesquisar($search);
            echo json_encode($result);
        }

    }else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])){
        if(isset($_GET['action'])){
            $path = $_GET['action'];
            switch($path){
                case 'consultarPrecoOutdoor':
                    $precoOutdoor = new OutdoorController();
                    $result=$precoOutdoor->consultarPrecoOutdoor();
                    echo json_encode($result);
                break;
                case 'outdoorDisponivel':
                    $outdorDesponivel = new OutdoorController();
                    $result = $outdorDesponivel->outdoorDisponivel();
                    echo json_encode($result);
                break;
                case 'tipoOutdoor':
                    $tipoPreco = new OutdoorController();
                   $result= $tipoPreco->tipoOutdoor();
                    echo json_encode($result);
                    break;
    
            }
            
        }
    }
    
    
?>