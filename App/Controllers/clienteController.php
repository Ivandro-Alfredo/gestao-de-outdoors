<?php
  require_once '../Service/clienteService.php';

    class ClienteController {
        private $clienteService = null;
        public function __construct()
        {
            $this->clienteService = new ClienteService();
        }

        public function solicitarAluguelSemImagem($email,$idoutdoor, $quantidade,$total, $provincia, $municipio, $comuna, $dataInicio, $dataFim)
        {
            $result = $this->clienteService->aluguelSemImagem($email,$idoutdoor, $quantidade,$total, $provincia, $municipio, 
                                                            $comuna, $dataInicio, $dataFim);
            return $result;
        }

        public function solicitarAluguelComImagem($email,$tipoOutdoor, $quantidade,$total,$provincia,
                                                $municipio, $comuna, $dataInicio, $dataFim, $imagem)
        {
            $result = $this->clienteService->aluguelComImagem($email,$tipoOutdoor, $quantidade,$total, $provincia, $municipio, 
                                                            $comuna, $dataInicio, $dataFim,$imagem);
            return $result;
        }

        public function alterarDados($dados)
        {
            $result = $this->clienteService->alterarDadosPessoais($dados);
            return $result;
        }

        public function getValorOutdoor($tipoOutdoor)
        {
            $result = $this->clienteService->getValor($tipoOutdoor);
            return $result;
            
        }

        public function selectUsuario($email){
            return $this->clienteService->dadosUsuario($email);
           
        }

        public function listarAluguel($email){
            $result = $this->clienteService->consultarSolicitacaoDeAluguel($email);
            return $result;
        }

        public function verificarCliente($email){
            $result = $this->clienteService->verificaCliente($email);
            return $result;
        }

        public function enviarComprovativo($idaluguel,$data,$arquivo){
            return $this->clienteService->enviarComprovativoParaDb($idaluguel,$data,$arquivo);
        }

        public function obterOutdoor(){
            $result = $this->clienteService->getOutdoor();
            return $result;
        }

        public function obterSolicitacoes($email){
            return $this->clienteService->getListaSolicoes($email);
        }
  }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $dados = file_get_contents('php://input');
        $path = json_decode($dados, true);
        $clienteController = new ClienteController();

        if (isset($path['email'])) {
            $email = $path['email'];
            $result = $clienteController->selectUsuario($email);
            header('Content-Type: application/json');
            echo json_encode($result);
            exit();
      
        } else if(isset($path['alterarDados'])){
            $userDados = $path['alterarDados'];
            $result = $clienteController->alterarDados($userDados);
            if($result===true){
                echo json_encode( "Dados alterados com sucesso");
            }else if($result==='ja existe'){
                echo json_encode("O Endereço de email ja existe");
            }else{
                echo json_encode("Os dados nao foram alterados, requisicao falhou");   
            }
            
          
        }else if(isset($path['solicitacao'])){
            try {
                $aluguel = $path['solicitacao'];
                $email=$aluguel ['email'];
                $idoutdoor = $aluguel ['tipo'];
                $quantidade = $aluguel ['quantidade'];
                $total = $aluguel ['total'];
                $provincia = $aluguel ['provincia'];
                $municipio = $aluguel ['municipio'];
                $comuna =$aluguel ['comuna'];
                $dataInicio = $aluguel ['inicio'];
                $dataFim = $aluguel ['fim'];
                $result = $clienteController->solicitarAluguelSemImagem($email,$idoutdoor, $quantidade,$total,$provincia, $municipio,
                                                                        $comuna, $dataInicio, $dataFim);
                if($result===true){
                    echo json_encode('A sua solicitacao foi submetida, apos o pagamento'+'<br>'
                +'faça o carregamento do comprovativo');
                }else{
                    echo json_encode('A requisicao falhou.');
                }
            } catch (Exception $th) {
                echo "Error: " . $th->getMessage().", Requisicao nao foi concluida.";
            }
        
        }else if(isset($_FILES['imagem'])){
            try {
                $imagemNome = $_FILES['imagem']['name'];
                $email= $_POST ['email'];
                $tipoOutdoor = $_POST ['tipo'];
                $quantidade = $_POST ['quantidade'];
                $total = $_POST ['total'];
                $provincia = $_POST ['provincia'];
                $municipio = $_POST ['municipio'];
                $comuna =$_POST ['comuna'];
                $dataInicio = $_POST ['inicio'];
                $dataFim = $_POST['fim'];
                
                $result = 
                $clienteController->solicitarAluguelComImagem($email,$tipoOutdoor, $quantidade,$total,$provincia,$municipio,
                $comuna, $dataInicio, $dataFim, $imagemNome);
                if($result=== true){
                    header('Content-Type: application/json');
                    echo json_encode('A sua solicitacao foi submetida, apos o pagamento 
                                     faça o carregamento do comprovativo.');
                }else{
                    header('Content-Type: application/json');
                    echo json_encode('A requisicao falhou.');
                }

            } catch (Exception $th) {
                echo "Error: " . $th->getMessage().", Requisicao nao foi concluida.";
            }

        }else if(isset($path['outdoor'])){
            $tipoOutdoor = $path['outdoor'];
            $result = $clienteController->getValorOutdoor($tipoOutdoor);
            
            header('Content-Type: application/json');
            if($result!==false){
                echo json_encode($result);
            }
        }else if(isset($path['userEmail'])){
            $email = $path['userEmail'];
            $result = $clienteController->listarAluguel($email);
            header('Content-Type: application/json');
            echo json_encode($result);
        }else  if(isset($path['verificarEmail'])){
            
            $email = $path['verificarEmail'];
            $result = $clienteController->verificarCliente($email);
            header('Content-Type: application/json');
            echo json_encode($result);
        }else if(isset($_FILES['arquivo'])){
            $arquivo = $_FILES['arquivo']['name'];
            $idaluguel = $_POST['idaluguel'];
            $data = $_POST['data'];
            $submeter= new ClienteController();
            $result = $submeter->enviarComprovativo($idaluguel,$data,$arquivo);
            if($result===true) {
                header('Content-Type: application/json');
                echo json_encode('Carregamento concluido.');
            }else{
                header('Content-Type: application/json');
                echo json_encode('falha');
            }
        }else if(isset($path['carregar'])){
            $email = $path['carregar'];
            $lista = new ClienteController();
            $result = $lista->obterSolicitacoes($email);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
       
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_GET['action'] ) && $_GET['action']==='obterOutdoor') {
            $getOudoor = new ClienteController();
            $result = $getOudoor->obterOutdoor();
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        
    } else {
        http_response_code(400);
    }
?>

