<?php
    require_once '../Service/solicitacaoService.php';

    class SolicitacaoController {
        private $solicitacaoService;
        
        public function __construct()
        {
            $this->solicitacaoService = new SolicitacaoService();
        }

        public function clienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa)
        {
            $result=$this->solicitacaoService->registarClienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
            ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa);
            return $result;
        }

        public function clienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
        ,$municipio,$comuna,$nacionalidade,$clienteParticular)
        {
            $result= $this->solicitacaoService->registarClienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
            ,$municipio,$comuna,$nacionalidade,$clienteParticular);
            return $result;
        }

       
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['clienteParticular'])){
            $nome= $_POST['nome'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fone  = $_POST['fone'];
            $morada = $_POST['morada'];
            $password = $_POST['password'];
            $provincia= $_POST['provincia'];
            $municipio = $_POST['municipio'];
            $comuna = $_POST['comuna'];
            $nacionalidade = $_POST['nacionalidade'];
            $clienteParticular= $_POST['clienteParticular'];
            $criptoPassword = password_hash($password , PASSWORD_DEFAULT);

            $enviar = new SolicitacaoController();
            $result=$enviar->clienteParticular($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
            ,$municipio,$comuna,$nacionalidade,$clienteParticular);
            
            if($result===true){
                header('Content-Type: application/json');
                echo json_encode('Registo Concluido, enviaremos o um email de ativacao ');
            }else if($result===false) {
                header('Content-Type: application/json');
                echo json_encode('Ja existe um cliente com esse endereco de email');
            }else{
                header('Content-Type: application/json');
                echo json_encode('Registo incompleto, a requisicao falhou');
            }
            
        }else if(isset($_POST['clienteEmpresa'])){
            $nome= $_POST['nome'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fone  = $_POST['fone'];
            $morada = $_POST['morada'];
            $password = $_POST['password'];
            $provincia = $_POST['provincia'];
            $municipio = $_POST['municipio'];
            $comuna = $_POST['comuna'];
            $nacionalidade = $_POST['nacionalidade'];
            $clienteEmpresa = $_POST['clienteEmpresa'];
            $atividadeEmpresa = $_POST['atividade'];
            $criptoPassword = password_hash($password , PASSWORD_DEFAULT);
            // Envie para o serviço, repositório, etc.
            $enviar = new SolicitacaoController();
            $result= $enviar->clienteEmpresa($nome,$username,$email,$fone,$morada,$criptoPassword,$provincia
                             ,$municipio,$comuna,$nacionalidade,$clienteEmpresa,$atividadeEmpresa);
                                            
            if($result===true){
                header('Content-Type: application/json');
                echo json_encode('Registo Concluido, enviaremos o um email de ativacao ');
            }else if($result===false) {
                header('Content-Type: application/json');
                echo json_encode('Ja existe um cliente com esse endereco de email');
            }else{
                 
                header('Content-Type: application/json');
                echo json_encode('Registo incompleto, a requisicao falhou');
            }
        }
    }else{
        http_response_code(400);
    }
?>