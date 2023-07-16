<?php
    require_once '../config/dbconfig.php';
    require_once '../repository/interface/ILogin.php';
    require_once '../Models/loginModel.php';

    class LoginRepository implements ILogin{

        private $dbConnection;

        public function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function findUser($email){
            $query = $this->dbConnection->prepare("SELECT login.email,login.password,
            login.categoria, login.estado,login.username FROM login where email =:email");
            $query->bindParam(":email",$email);
            $query->execute();
           
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return new LoginModel($result['email'], $result['password'], $result['categoria'],$result['estado'],$result['username']);
            } else {
                // Usuário não encontrado
                return null;
            }
        }
    }
?>