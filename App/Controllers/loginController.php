<?php
    require_once '../Service/loginService.php';
    
    class Login{
        private $loginService = null;
        public function __construct()
        {
            $this->loginService = new LoginService();
        }

        public function tipoUuario($email,$password){
           $user = $this->loginService->autenticarUsuario($email,$password);
           if ($user === 'Administrador') {
                return json_encode(['tipo' => 'Administrador']);
            }else if($user === 'Cliente'){
                return json_encode(['tipo' => 'Cliente']);
            }else if($user === 'Gestor'){
                return json_encode(['tipo' => 'Gestor']);
            }
            return json_encode(['tipo' => 'Usuario Inexistente']);
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        $acess = new Login();
        $resultado = $acess->tipoUuario($email, $password);
        
        header('Content-Type: application/json');
        echo $resultado;
        exit();
    } else {
        echo "Acesso Negado.";
    }
?>