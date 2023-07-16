<?php
    require_once '../repository/loginRepository.php';
    
    class LoginService{
        private $loginRepository=null;

        public function __construct(){
            $this->loginRepository = new LoginRepository();
        }

        public function autenticarUsuario($email,$password){
            $passwordEnviada =$password;
            $result = $this->loginRepository->findUser($email);
            if($result!=null){
                $passwordRetornada = $result->getPassword();
                $estadoRetornado = $result->getEstado();
                $categoriaRetornada = strtolower($result->getCategoria());
            
                if(password_verify($passwordEnviada,$passwordRetornada)&& ($estadoRetornado==='ativo')){
                    if($categoriaRetornada === 'administrador'){
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['email']=$result->getEmail();
                        $_SESSION['username'] = $result->getUsername();
                        return "Administrador";
                    }else if($categoriaRetornada === 'cliente'){
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['email']=$result->getEmail();
                        $_SESSION['username'] = $result->getUsername();
                        return "Cliente";
                    }else if($categoriaRetornada === 'gestor'){
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['email']=$result->getEmail();
                        $_SESSION['username'] = $result->getUsername();
                       return "Gestor";
                    }
                }else{
                    return "Palavra Passe Errada";
                }
            }else{
                return "email invalido";
            }
        }
    }

?>


