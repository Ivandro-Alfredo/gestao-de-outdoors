<?php
    include_once '../Service/adminService.php';

    class AdminController{
        private $adminService = null;

        public function __construct()
        {
            $this->adminService = new AdminService();
        }

        public function RegistarGestor($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
        ,$municipio,$comuna ,$nacionalidade)
        {
            $result=$this->adminService->registar($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
            ,$municipio,$comuna ,$nacionalidade);
            return $result;
        }

        public function ativarConta(){
            header('Location:../Views/listar/ativarConta.php');
        }

        public function verEmailRecebido(){
            header('Location:../Views/listar/verEmail.php');
        }

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gestor = $_POST['gestor'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $fone  = $_POST['fone'];
        $morada = $_POST['morada'];
        $password = $_POST['password'];
        $provincia = $_POST['provincia'];
        $municipio = $_POST['municipio'];
        $comuna = $_POST['comuna'];
        $nacionalidade = $_POST['nacionalidade'];
        $criptoPassword = password_hash($password , PASSWORD_DEFAULT);
        $enviar = new AdminController(); 
        $result= $enviar->RegistarGestor($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
                ,$municipio,$comuna ,$nacionalidade);
        if($result=='Registo Concluido.'){
            return json_encode($result);
        }else{
            return json_encode($result);
        }

    } else{
        echo 'pagina nao encontrada';
    }

?>