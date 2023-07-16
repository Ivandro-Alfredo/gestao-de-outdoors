<?php
require_once '../Service/gestorService.php';

class GestorController{
    private $gestorService = null;

    public function __construct()
    {
        $this->gestorService = new GestorService();
    }

    public function addNewOutdoor( $outdoor, $preco, $provincia,$municipio,$comuna){
      $result = $this->gestorService->newOutdoor( $outdoor, $preco, $provincia,$municipio,$comuna);
      return $result;
    }

    public function updateOutdoor($id,$outdoor, $preco, $provincia,$municipio,$comuna){
      $result = $this->gestorService->atualizarNaBd($id, $outdoor, $preco, $provincia,$municipio,$comuna);
      return $result;
    }

    public function deleteOutdoor($id){
      $result = $this->gestorService->deleteFromBd($id);
      return $result;
    
    }

    public function selectAllOutdor(){
        $result = $this->gestorService->buscarAllOutdoor();
        return $result;
    }

    public function selectAllAluguel(){
      return $this->gestorService->buscar();
    }

    public function analisarComprovativo($id){
      return $this->gestorService->buscarCaminhoId($id);
    }

    public function aprovarSolicitacao($idaluguel){
      return $this->gestorService->enviarParaService($idaluguel);
      
    }

    public function recusarSolicitacao($idaluguel){
      return $this->gestorService->recusarPedido($idaluguel);
    }
}

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['tipoOutdoor'])){

      $outdoor = $_POST['tipoOutdoor'];
      $preco = $_POST['preco'];
      $provincia = $_POST['provincia'];
      $municipio = $_POST['municipio'];
      $comuna = $_POST['comuna'];
    
      $add = new GestorController();
      $result = $add->addNewOutdoor( $outdoor, $preco, $provincia,$municipio,$comuna);
      if($result===true){
        header('Content-Type: application/json');
        echo json_encode('Dados enviados com sucesso!');
      }else{
        header('Content-Type: application/json');
        echo json_encode('Falha na requisicao');
      }

    }else if(isset($_POST['outdoor'])){

      $outdoor = $_POST['outdoor'];
      $preco = $_POST['preco'];
      $provincia = $_POST['provincia'];
      $municipio = $_POST['municipio'];
      $comuna = $_POST['comuna'];
      $id = $_POST['id'];
      $update = new GestorController();
      $result = $update->updateOutdoor($id,$outdoor, $preco, $provincia,$municipio,$comuna);
      if($result===true){
        header('Content-Type: application/json');
        echo json_encode('Dados atualizados com sucesso.');
      }else if($result===false){
        header('Content-Type: application/json');
        echo json_encode('Atualizacao dos dados falhou.');
      }else{
        header('Content-Type: application/json');
        echo json_encode('Requisicao falhou');
      }
    }else if(isset($_POST['cod'])){
      $id = $_POST['cod'];
      
      $apagar = new GestorController();
      $result = $apagar->deleteOutdoor($id);
     
     if($result===true){
        header('Content-Type: application/json');
        echo json_encode('Dado deletado com sucesso');
      }else{
        header('Content-Type: application/json');
        echo json_encode('Falha na requisicao');
      }

    }else if(isset($_POST['idaluguel'])){
      $id = $_POST['idaluguel'];
      $caminho = new GestorController();
      $result = $caminho->analisarComprovativo($id);
     if($result!== false){

     }
      header('Content-Type: application/json');
      echo json_encode($result);
    }else if(isset($_POST['aprovarSolicitacao'])){
      $idaluguel = $_POST['aprovarSolicitacao'];
      $aprovar = new GestorController();
      $resp = $aprovar->aprovarSolicitacao($idaluguel);
      if($resp === true){
        header('Content-Type: application/json');
        echo json_encode('Solicitacao aprovada');
      }else{
        header('Content-Type: application/json');
        echo json_encode('Oops! algo correu mal, requisicao falhou.');
      }
  
    }else if(isset($_POST['recusarSolicitacao'])){
      $idaluguel = $_POST['recusarSolicitacao'];
      $recusar = new GestorController();
      $resp = $recusar->recusarSolicitacao($idaluguel);
      if($resp === true){
        header('Content-Type: application/json');
        echo json_encode('Solicitacao Foi Rejeitada e apagada');
      }else{
        header('Content-Type: application/json');
        echo json_encode('Oops! algo correu mal, requisicao falhou.');
      }
    }
    
  } else if($_SERVER['REQUEST_METHOD'] == 'GET') {

      if(isset($_GET['action']) && $_GET['action']=== 'editar'){
        $editar = new GestorController();
        $result = $editar->selectAllOutdor();
        header('Content-Type: application/json');
        echo json_encode($result);
      }else if (isset($_GET['action']) && $_GET['action']=== 'analise'){
        $pegar = new GestorController();
        $result = $pegar->selectAllAluguel();
        header('Content-Type: application/json');
        echo json_encode($result);
      }

  }else{
    http_response_code(400);
  }

?>