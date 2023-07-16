 <?php
    class LoginModel{
        private $email;
        private $password;
        private $categoria;
        private $username;
        private static $estado;

        public function __construct($email, $password, $categoria,$estado,$username){
            $this->email = $email;
            $this->password = $password;
            $this->categoria = $categoria;
            $this->username = $username;
            self::$estado = $estado;
            
        }

        function getEmail(){
            return $this->email;
        }

        function setEmail($email){
            $this->email = $email;
        }

        function getPassword(){
            return $this->password;
        }
        function setPassword($password){
            $this->password = $password;
        }
         function setUsername($username){
            return $this->username = $username;
         }

        function getCategoria(){
            return $this->categoria;
        }

        function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        function getEstado(){
            return  self::$estado;
        }

        function getUsername(){
            return $this->username;
        }

    }
 ?>